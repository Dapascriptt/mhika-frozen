<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        ContactMessage::create($request->only([
            'name',
            'email',
            'subject',
            'message',
        ]));

        return redirect()
            ->route('contact')
            ->with('success', 'Pesan berhasil diterima. Tim Mhika Frozen Food akan menghubungi Anda kembali.');
    }
}
