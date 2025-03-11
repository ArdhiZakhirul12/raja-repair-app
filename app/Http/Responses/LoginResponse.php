<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user(); // Ambil user yang login

        // Redirect berdasarkan role
        if ($user->hasRole('super-admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('teknisi')) {
            return redirect()->route('teknisi.dashboard');
        }

        return redirect()->route('dashboard'); // Default untuk cabang atau user lain
    }
}
