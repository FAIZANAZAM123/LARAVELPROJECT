<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
}
