<?php

namespace App\Http\Controllers;

use App\Models\ConsultChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultChatController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'expert') {
            $users = User::where('role', 'user')->get();
        } else {
            $users = User::where('role', 'expert')->get();
        }

        return view('consults.index', compact('users'));
    }
    
    public function chat(Request $request, $expertId)
    {
        $userId = Auth::id();

        $chats = ConsultChat::with('user')
            ->where(function($query) use ($userId, $expertId) {
                $query->where(function($q) use ($userId, $expertId) {
                    $q->where('user_id', $userId)->where('expert_id', $expertId);
                })->orWhere(function($q) use ($userId, $expertId) {
                    $q->where('user_id', $expertId)->where('expert_id', $userId);
                });
            })
            ->orderBy('created_at')
            ->get();

        $user = User::findOrFail($expertId);

        return view('consults.chat', compact('chats', 'user'));
    }

    public function store(Request $request, $expertId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userId = auth()->id();
        $expert = User::findOrFail($expertId);

        $role = auth()->user()->role === 'expert' ? 'expert' : 'user';

        $consult = ConsultChat::create([
            'user_id'   => $userId,
            'expert_id' => $expertId,
            'role'      => $role,
            'message'   => $request->message,
        ]);

        if ($consult) {
            if ($role == 'expert') {
                return redirect()->route('expert.consult-chat.chat', ['expert' => $expertId]);
            } else {
                return redirect()->route('consult-chat.chat', ['expert' => $expertId]);
            }
        }
    }

}
