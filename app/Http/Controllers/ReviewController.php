<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Review;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Index page: list AI chat need_review + modal untuk koreksi
    public function index()
    {
        $aiChats = Chat::where('role', 'ai')
            ->where('status', 'need_review')
            ->with('case.chats', 'case') // ambil semua chat dalam case
            ->latest()
            ->get();

        // Persiapkan data: setiap AI chat, cari pertanyaan user relevan
        $chats = $aiChats->map(function ($aiChat) {
            $userChat = $aiChat->case->chats
                ->where('role', 'user')
                ->filter(fn($c) => $c->id < $aiChat->id)
                ->last(); // user chat terakhir sebelum AI chat

            return (object) [
                'id' => $aiChat->id,
                'case_title' => $aiChat->case->title ?? 'No Case',
                'ai_message' => $aiChat->message,
                'confidence' => $aiChat->metadata['confidence'] ?? '-',
                'user_message' => $userChat->message ?? '-',
                'user_name' => $userChat->user->name ?? '-',
                'case_chat_id' => $aiChat->case_chat_id,
            ];
        });

        return view('reviews.index', compact('chats'));
    }

    // Simpan jawaban pakar dari modal
    public function store(Request $request, $chat_id)
    {
        $request->validate([
            'answer' => 'required|string',
            'sources' => 'nullable|string',
            'add_to_kb' => 'nullable|boolean',
        ]);

        $aiChat = Chat::findOrFail($chat_id);

        // Simpan jawaban pakar sebagai chat baru
        Chat::create([
            'case_chat_id' => $aiChat->case_chat_id,
            'user_id' => Auth::id(),
            'role' => 'expert',
            'message' => $request->answer,
            'metadata' => $request->sources ? ['sources' => $request->sources] : null,
            'status' => 'approved',
        ]);

        // Update status AI chat
        $aiChat->status = 'approved';
        $aiChat->save();

        Review::create([
            'chat_id' => $aiChat->id,
            'expert_id' => Auth::id(),
            'answer' => $request->answer,
            'sources' => $request->sources,
            'status' => 'approved',
        ]);

        // Simpan ke Knowledge Base jika dicentang
        if ($request->add_to_kb) {
            // Ambil pertanyaan user relevan
            $userChat = $aiChat->case->chats
                ->where('role', 'user')
                ->filter(fn($c) => $c->id < $aiChat->id)
                ->last();

            KnowledgeBase::create([
                'question' => $userChat->message ?? $aiChat->message,
                'answer' => $request->answer,
                'sources' => $request->sources,
            ]);
        }

        return redirect()->route('reviews.index')
            ->with('success', 'Jawaban pakar berhasil disimpan.');
    }

    public function history()
    {
        $expertId = Auth::id();

        if(Auth::user()->role == 'admin') {
            $aiChats = Chat::where('role', 'ai')
            ->where('status', 'approved')
            ->with(['case.chats', 'case', 'review'])
            ->latest()
            ->get();
        } else {
            $aiChats = Chat::where('role', 'ai')
            ->where('status', 'approved')
            ->with(['case.chats', 'case', 'review'])
            ->whereHas('review', function ($q) use ($expertId) {
                $q->where('expert_id', $expertId);
            })
            ->latest()
            ->get();
        }

        $chats = $aiChats->map(function ($aiChat) {
            $userChat = $aiChat->case->chats
                ->where('role', 'user')
                ->filter(fn($c) => $c->id < $aiChat->id)
                ->last();

            $review = $aiChat->review; // karena sudah di-load dengan with()

            return (object) [
                'id' => $aiChat->id,
                'case_title' => $aiChat->case->title ?? 'No Case',
                'review_message' => $review->answer ?? '-',
                'review_references' => $review->sources ?? '-',
                'ai_message' => $aiChat->message ?? '-',
                'ai_references' => isset($aiChat->metadata['sources'])
                    ? implode(', ', $aiChat->metadata['sources'])
                    : '-',
                'confidence' => $aiChat->metadata['confidence'] ?? '-',
                'user_message' => $userChat->message ?? '-',
                'user_name' => $userChat->user->name ?? '-',
                'case_chat_id' => $aiChat->case_chat_id,
            ];
        });

        return view('reviews.history', compact('chats'));
    }

}
