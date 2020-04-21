<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;
    public function showResetForm(\Illuminate\Http\Request $request, $token = null)
    {
        return view('admin.auth.passwords.reset',[
            'token'=>$token,
            'email'=>$request->input('email'),
        ]);
    }
    protected function credentials(Request $request)
    {
        return array_merge($request->only(
            'email', 'password', 'password_confirmation', 'token'
        ),['active'=>true]) ;
    }
    public function broker(): PasswordBroker
    {
        return Password::broker('admins');
    }
}
