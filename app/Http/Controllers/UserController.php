<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if ($user->isAdmin()) {
            // return redirect()->route('dashboard');
            // return view('pages.home');
        // }

        return redirect()->route('user.dashboard');
        // return view('pages.user.home');
    }
}
