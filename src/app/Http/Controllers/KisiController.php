<?php

namespace App\Http\Controllers;

use App\Models\Kisi;
use Illuminate\Http\Request;

class KisiController extends Controller
{
    public function index()
    {
        $kisiler = Kisi::latest()->get();
        return view('welcome', compact('kisiler'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'required|string|max:255',
            'yas' => 'required|integer|min:1|max:150',
        ]);

        Kisi::create($request->only('ad', 'soyad', 'yas'));

        return redirect('/')->with('success', 'Kayıt başarıyla eklendi.');
    }
}
