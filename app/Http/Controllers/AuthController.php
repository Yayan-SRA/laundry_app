<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => "Laundry App",
            'active' => 'login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => "register",
            'active' => 'register',
            'stores' => Store::latest()->get(),
            'roles' => Role::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'store_id' => 'required',
            'role_id' => 'required',
            'name' => 'required|min:5|max:255',
            'password' => ['required', 'min:5', 'max:255'],
        ]);

        $getRole = Role::where('id', $request->role_id)->first();
        if ($getRole->name == 'Super Admin') {
            $validatedData['store_id'] = 0;
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        // cara lain kirim flash data dengan lngsng menggunakan with di redirect
        // $request->session()->flash('success', 'Resgistration successfull! Please login');

        // return redirect('/login')->with('success', 'Resgistration successfull! Please login');
        return redirect('/dashboard/super/master/user')->with('success', 'Resgistration successfull');;
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required', 'min:5', 'max:255'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $validate = User::where('name', $credentials['name'])->first();
            if ($validate->role->name === 'Super Admin') {
                return redirect()->intended('/dashboard/super');
            }
            return redirect()->intended('/dashboard');
        }


        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
