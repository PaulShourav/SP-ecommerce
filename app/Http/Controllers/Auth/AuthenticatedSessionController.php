<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->route('admin');
       // $check=User::where("email",$request->email)->first();
        // if(Auth::check() && Auth::user()->status=="0"){
        //     return redirect()->back()->with("message",'Sorry, You are not verified yet.');
        // }

        // if(Auth::check() && Auth::user()->status=="1"){
            if (Auth::user()->id && Auth::user()->user_type=='Admin') {
                return redirect()->intended(RouteServiceProvider::Admin);
            } elseif(Auth::user()->id && Auth::user()->user_type=='Customer') {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        // }
       
  
       
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
