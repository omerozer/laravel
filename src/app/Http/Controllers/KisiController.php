<?php

namespace App\Http\Controllers;

use App\Models\Kisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'email' => 'nullable|email',
            'gorsel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('ad', 'soyad', 'yas', 'email');

        if ($request->hasFile('gorsel')) {
            $data['gorsel'] = $request->file('gorsel')->store('kisiler', 'public');
        }

        Kisi::create($data);

        return redirect('/')->with('success', 'Kayıt başarıyla eklendi.');
    }

    public function update(Request $request, Kisi $kisi)
    {
        $request->validate([
            'ad' => 'required|string|max:255',
            'soyad' => 'required|string|max:255',
            'yas' => 'required|integer|min:1|max:150',
            'email' => 'nullable|email',
            'gorsel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'nullable|boolean',
        ]);

        $data = $request->only('ad', 'soyad', 'yas', 'email');
        if ($request->has('aktif')) {
            $data['aktif'] = filter_var($request->aktif, FILTER_VALIDATE_BOOLEAN);
        }

        if ($request->hasFile('gorsel')) {
            if ($kisi->gorsel) {
                Storage::disk('public')->delete($kisi->gorsel);
            }
            $data['gorsel'] = $request->file('gorsel')->store('kisiler', 'public');
        }

        $kisi->update($data);

        return redirect('/')->with('success', 'Kayıt başarıyla güncellendi.');
    }
}
