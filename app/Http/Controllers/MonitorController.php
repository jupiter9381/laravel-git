<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Monitor;
use Ixudra\Curl\Facades\Curl;

class MonitorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view(){
      return view('monitor');
    }

    public function index() {
      $monitors = Monitor::where('user_id', Auth::user()->id)->get();
      return view('monitor_list', compact('monitors'));
    }

    public function search($id) {
      
      $client = new \GuzzleHttp\Client();
      $res = $client->get('https://api.github.com/search/code?q=Eloquent+in:file+language:php+user:jupiter9381');
      echo $res->getStatusCode(); // 200
      echo $res->getBody();
      var_dump("sdfsdf");
      exit();
      return view('monitor_search');
    }
    public function add_monitor(Request $request) {
      $user_id = Auth::user()->id;
      $name = $request->input('name');
      $password = $request->input('password') === NULL ? '0' : '1';
      $api_key = $request->input('api_key') === NULL ? '0' : '1';
      $secret_key = $request->input('secret_key') === NULL ? '0' : '1';
      $aws_key = $request->input("aws_key") === NULL ? '0' : '1';
      $ftp_key = $request->input("ftp_key") === NULL ? '0' : '1';
      $login = $request->input("login") === NULL ? '0' : '1';
      $github_token = $request->input("github_token") === NULL ? '0' : '1';
      $other = $request->input("other");

      $monitor = new Monitor();
      $monitor->user_id = $user_id;
      $monitor->name = $name;
      $monitor->password = $password;
      $monitor->api_key = $api_key;
      $monitor->secret_key = $secret_key;
      $monitor->aws_key = $aws_key;
      $monitor->ftp_key = $ftp_key;
      $monitor->login = $login;
      $monitor->github_token = $github_token;
      $monitor->other = $other;
      $monitor->save();

      return redirect('/monitors/create');
    }
}
