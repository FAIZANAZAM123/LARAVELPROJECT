<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Jobs\SendPasswordResetNotification;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/dashboard';

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
                dispatch(new SendPasswordResetNotification($user, $password));
            }
        );

        return redirect()->route('login')->with('status', 'Password reset successfully');
    }
}
