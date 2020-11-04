<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function guestLogin()
    {
        $email = 'test@test';
        $password = 'testtest';

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('home');
        }

        return redirect('/');
    }
}
