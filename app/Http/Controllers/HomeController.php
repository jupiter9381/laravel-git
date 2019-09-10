<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

use Ixudra\Curl\Facades\Curl;
use App\Monitor;
use DB;

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

      $user_id = Auth::user()->id;
      $user = User::where('id', $user_id)->get();
      $monitors = $files = DB::table('files')->select(DB::raw('count(*) as count, monitors.name as monitor_name, monitors.id as monitor_id'))
                      ->join('monitors', 'monitors.id', '=', 'files.monitor_id')
                      ->where('files.user_id', $user_id)
                      ->groupBy('files.monitor_id')
                      ->get();

      // $github_token = $user[0]->github_token;
      //
      // $headers = [
      //   'Authorization' => 'token '.$github_token,
      //   'Accept' => 'application/json',
      //   'Content-Type' => 'application/json',
      // ];
      // $client = new \GuzzleHttp\Client([
      //   'headers' => $headers
      // ]);
      //
      // $res = $client->get('https://api.github.com/user');
      // $res = json_decode($res->getBody());
      // $github_login = $res->login;
      //
      // $headers = [
      //   'Accept' => 'application/json',
      //   'Content-Type' => 'application/json'
      // ];
      // $client = new \GuzzleHttp\Client([
      //   'headers' => $headers
      // ]);
      //
      // $monitors = Monitor::where('user_id', $user_id)->get();
      //
      // foreach ($monitors as $key => $value) {
      //   $res = $client->get('https://api.github.com/search/code?q=pre_browser_img+in:file+user:jupiter9381');
      //
      //   $res = json_decode($res->getBody());
      //   $file_number = $res->total_count;
      //   $value->filenumber = $file_number;
      // }

      return view('home', compact('monitors'));
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

    public function logut(){
      Auth::logout();
      return redirect('/');
    }
}
