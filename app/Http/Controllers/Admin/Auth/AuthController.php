<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        try {
            if (auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else
                return redirect()->route('admin.login')->with(['error' => 'الإيميل أو الباسورد غير صحيح!']);
        } catch (\Exception $ex) {
          //  return $ex;
            return redirect()->back()->with(['error' => 'لقد حدث خطأ يرجى المحاولة فيما بعد']);
        }
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect()->route('admin.login');
    }

}

