<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\CaseChat;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index($caseId)
    {
        $case = CaseChat::findOrFail($caseId);
        $chats = Chat::with('case')
            ->where('case_chat_id', $caseId)
            ->where(function($query) {
                $query->where('role', 'user') 
                    ->orWhere('role', 'ai'); 
            })
            ->orderBy('created_at')
            ->get();


        return view('chats.index', compact('chats','caseId', 'case'));
    }
    public function store(Request $request, $caseId)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $userChat = Chat::create([
            'case_chat_id' => $caseId,
            'user_id' => Auth::id(),
            'role' => 'user',
            'message' => $request->message,
        ]);

        $normalizedMessage = strtolower(trim($request->message));
        $normalizedMessage = preg_replace('/[^\p{L}\p{N}\s]/u', '', $normalizedMessage);

        $answer = 'Mohon maaf, saat ini AI belum memiliki jawaban. Silakan ajukan pertanyaan lain atau coba lagi nanti.';
        $sources = [];
        $confidence = 0;

        $exactMatch = DB::table('knowledge_bases')
            ->whereRaw('LOWER(question) = ?', [$normalizedMessage])
            ->first();

        if ($exactMatch) {
            $answer = $exactMatch->answer;
            $sources = $exactMatch->sources ? explode(',', $exactMatch->sources) : [];
            $confidence = 1.0;
        } else {
            $results = DB::select("
                SELECT id, question, answer, sources,
                    MATCH(question, answer) AGAINST(? IN BOOLEAN MODE) AS score
                FROM knowledge_bases
                WHERE MATCH(question, answer) AGAINST(? IN BOOLEAN MODE)
                ORDER BY score DESC
                LIMIT 1
            ", [$normalizedMessage, $normalizedMessage]);

            if (!empty($results) && $results[0]->score > 0) {
                $answer = $results[0]->answer;
                $sources = $results[0]->sources ? explode(',', $results[0]->sources) : [];
                $confidence = min(1, $results[0]->score / 5);
            }
        }

        Chat::create([
            'case_chat_id' => $caseId,
            'user_id' => Auth::id(),
            'role' => 'ai',
            'message' => $answer,
            'metadata' => [
                'confidence' => $confidence,
                'sources' => $sources,
            ],
            'status' => $confidence < 0.7 ? 'need_review' : 'auto',
        ]);

        return redirect()->route('chats.index', $caseId);
    }
}
