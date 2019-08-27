<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile() {
      $id = Auth::user()->id;
      $user = User::find($id);
      return view('profile', compact('user'));
    }

    public function updateProfile(Request $request){
      $id = Auth::user()->id;
      $user = User::find($id);
      $user->github_token = $request->input('github_token');
      $user->save();
      return redirect('/profile');
    }
}
