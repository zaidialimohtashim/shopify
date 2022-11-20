<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login');
    }
    public function adminLogin(Request $request)
    {
        // dd(Hash::make("12345678"));
        $this->validate($request, [
            'email'   => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // $data = $request->session()->all();
            // dd($data);
            return redirect()->intended('/admin/admin_product_list');
        }
        return redirect()->back()->withErrors(['msg' => 'Somthing wrong with you credentails']);
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect(route('login'));

    }
}
