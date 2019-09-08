<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Monitor;
use Ixudra\Curl\Facades\Curl;
use App\File;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use DB;

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

      $user_id = Auth::user()->id;
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
      $monitor = Monitor::where('id', $id)->first();

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
        // $file = new File;
        // $file->user_id = $user_id;
        // $file->monitor_id = $user_id;
        // $file->url = $item->html_url;
        // $file->isChecked = 1;
        // $file->save();
        array_push($searches, $data);
      }

      return view('monitor_search', compact('searches', 'monitor'));
    }
    public function add_monitor(Request $request) {
      $user_id = Auth::user()->id;
      $name = $request->input('name');

      $name = explode(PHP_EOL, $name);

      foreach ($name as $key => $value) {
        $password = $request->input('password') === NULL ? '0' : '1';
        $api_key = $request->input('api_key') === NULL ? '0' : '1';
        $secret_key = $request->input('secret_key') === NULL ? '0' : '1';
        $aws_key = $request->input("aws_key") === NULL ? '0' : '1';
        $ftp_key = $request->input("ftp_key") === NULL ? '0' : '1';
        $login = $request->input("login") === NULL ? '0' : '1';
        $github_token = $request->input("github_token") === NULL ? '0' : '1';
        $other = $request->input("other");

        $monitor = Monitor::where('name',$value)->where('password', $password)
                  ->where('api_key', $api_key)->where('secret_key', $secret_key)
                  ->where('aws_key', $aws_key)->where('ftp_key', $ftp_key)
                  ->where('login', $login)->where('github_token', $github_token)
                  ->where('other', $other)->get();
        if(!$monitor){
          $monitor = new Monitor();
          $monitor->user_id = $user_id;
          $monitor->name = trim($value);
          $monitor->password = $password;
          $monitor->api_key = $api_key;
          $monitor->secret_key = $secret_key;
          $monitor->aws_key = $aws_key;
          $monitor->ftp_key = $ftp_key;
          $monitor->login = $login;
          $monitor->github_token = $github_token;
          $monitor->other = $other;
          $monitor->save();
        }
      }
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

    public function checkMonitors(Request $request) {
      $user_id = Auth::user()->id;
      $files = DB::table('files')->select("files.*", "monitors.name as monitor_name", "monitors.password", "api_key", "secret_key", "aws_key",
                          "ftp_key", "login", "monitors.github_token", "other", "users.email")
                      ->join('monitors', 'monitors.id', '=', 'files.monitor_id')
                      ->join('users', 'users.id', '=', 'files.user_id')
                      ->where('files.user_id', $user_id)
                      ->where('isChecked', 0)
                      ->get();

      if(count($files) > 0){
        foreach ($files as $key => $value) {
          $search_string = "";
          if($value->password == 1) $search_string .= "Password, ";
          if($value->api_key == 1) $search_string .= "API, ";
          if($value->secret_key == 1) $search_string .= "Secret, ";
          if($value->aws_key == 1) $search_string .= "AWS, ";
          if($value->ftp_key == 1) $search_string .= "FTP, ";
          if($value->login == 1) $search_string .= "Login, ";
          if($value->github_token == 1) $search_string .= "Github, ";
          if($value->other == 1) $search_string .= "Other, ";

          // $data = ['email' => $value->email, 'monitor_name' => $value->monitor_name, 'search_string' => $search_string, 'monitor_id' => $value->monitor_id];
          // Mail::to($value->email)->send(new NotificationEmail($data));
        }
        //$files
        // $data = ['email' => 'jupiter9381@gmail.com'];
        //
        //
      }
      return response()->json([
        'result' => $data
      ]);
      // $monitors = Monitor::where('user_id', $user_id)->get();
      //
      // $token = Auth::user()->github_token;
      //
      // $headers = [
      //   'Authorization' => 'token '.$token,
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
      // foreach ($monitors as $key => $value) {
      //   if($key > 0) continue;
      //   $res = $client->get('https://api.github.com/search/code?q=pre_browser_img+in:file+user:jupiter9381');
      //
      //   $res = json_decode($res->getBody());
      //   $items = $res->items;
      //
      //   $searches = array();
      //   foreach ($items as $key => $item) {
      //     $file = File::where('')
      //     $data = array(
      //       "filename" => $item->name,
      //       "html_url" => $item->html_url,
      //       "repository" => $item->repository->name,
      //     );
      //     array_push($searches, $data);
      //   }
      // }
    }
}
