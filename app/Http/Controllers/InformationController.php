<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;

class InformationController extends Controller
{
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // Contoh: bisa disimpan ke database atau dikirim via email
        Mail::to('admin@example.com')->send(new ContactMail($validated));

        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
