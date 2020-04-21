<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm(): View
    {
        return view('admin.auth.passwords.email');
    }
    protected function credentials(Request $request)
    {
        return array_merge($request->only('email'),['active'=>true]);
    }
    public function broker(){
        return Password::broker('admins');
    }
}
