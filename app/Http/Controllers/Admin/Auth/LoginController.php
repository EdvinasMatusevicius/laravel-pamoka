<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(): View{
        return view('admin.auth.login');
    }
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'),['active'=>true]);
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
 