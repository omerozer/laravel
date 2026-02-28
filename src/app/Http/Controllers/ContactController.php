<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        $host = Setting::get('smtp_host');
        if ($host) {
            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $host,
                'port' => (int) (Setting::get('smtp_port') ?? 587),
                'encryption' => Setting::get('smtp_encryption') ?: null,
                'username' => Setting::get('smtp_username') ?: null,
                'password' => Setting::get('smtp_password') ?: null,
                'timeout' => null,
            ]);

            Config::set('mail.from', [
                'address' => Setting::get('mail_from_address') ?? config('mail.from.address'),
                'name' => Setting::get('mail_from_name') ?? config('mail.from.name'),
            ]);
        }

        $to = Setting::get('mail_from_address') ?? config('mail.from.address');

        try {
            Mail::raw(
                "Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}",
                function ($message) use ($to, $validated) {
                    $message->to($to)
                        ->replyTo($validated['email'])
                        ->subject('Contact form: ' . $validated['name']);
                }
            );
        } catch (\Throwable $e) {
            return redirect()->back()->with('contact_error', $e->getMessage());
        }

        return redirect()->back()->with('contact_success', true);
    }
}
