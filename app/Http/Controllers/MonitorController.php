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

      $token = Auth::user()->github_token;

      $headers = [
        'Authorization' => 'token '.$token,
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ];
      $client = new \GuzzleHttp\Client([
        'headers' => $headers
      ]);

      $res = $client->get('https://api.github.com/user');
      $res = json_decode($res->getBody());
      $github_login = $res->login;

      $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
      ];
      $client = new \GuzzleHttp\Client([
        'headers' => $headers
      ]);
      $res = $client->get('https://api.github.com/search/code?q=pre_browser_img+in:file+user:jupiter9381');

      $res = json_decode($res->getBody());
      $items = $res->items;

      $searches = array();
      foreach ($items as $key => $item) {
        $data = array(
          "filename" => $item->name,
          "html_url" => $item->html_url,
          "repository" => $item->repository->name,
        );
        array_push($searches, $data);
      }

      return view('monitor_search', compact('searches'));
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

    public function search_code(Request $request) {
      $url = $request->input('url');
      $url = str_replace("https://github.com", "https://raw.githubusercontent.com", $url);
      $url = str_replace("blob/", "", $url);
      $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
      ];

      $client = new \GuzzleHttp\Client([
        'headers' => $headers
      ]);
      $res = $client->get($url);
      $res = $res->getBody()->getContents();

      return response()->json([
        'result' => htmlentities($res)
      ]);
    }
}
