<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Monitor;
use Auth;

class StripeController extends Controller
{
    //
    public function stripe(Request $request) {
      return view('stripe');
    }

    public function postStripe(Request $request) {
      $user_id = Auth::user()->id;

      $search_num = 0;
      $name = $request->input('name');
      $name = explode(PHP_EOL, $name);

      if($request->input('password') == 1) $search_num++;
      if($request->input('api_key') == 1) $search_num++;
      if($request->input('secret_key') == 1) $search_num++;
      if($request->input('aws_key') == 1) $search_num++;
      if($request->input('ftp_key') == 1) $search_num++;
      if($request->input('login') == 1) $search_num++;
      if($request->input('github_token') == 1) $search_num++;

      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      Stripe\Charge::create ([
              "amount" => $search_num * count($name) * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "Test payment from gitmittest."
      ]);

      foreach ($name as $key => $value) {
        $password = $request->input('password');
        $api_key = $request->input('api_key');
        $secret_key = $request->input('secret_key');
        $aws_key = $request->input("aws_key");
        $ftp_key = $request->input("ftp_key");
        $login = $request->input("login");
        $github_token = $request->input("github_token");
        $other = $request->input("other");

        $monitor = Monitor::where('name',$value)->where('password', $password)
                  ->where('api_key', $api_key)->where('secret_key', $secret_key)
                  ->where('aws_key', $aws_key)->where('ftp_key', $ftp_key)
                  ->where('login', $login)->where('github_token', $github_token)
                  ->where('other', $other)->get();

        if(count($monitor) == 0){
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
}
