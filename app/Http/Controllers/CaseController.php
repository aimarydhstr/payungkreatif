<?php

namespace App\Http\Controllers;

use App\Models\CaseChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    public function index() {
        $cases = CaseChat::with('chats')->where('user_id', Auth::id())->get();
        return view('cases.index', compact('cases'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'status' => 'required|in:open,closed'
        ]);

        CaseChat::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('cases.index')->with('success', 'Case berhasil dibuat!');
    }

}
