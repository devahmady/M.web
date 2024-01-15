<?php

namespace App\Http\Controllers;
use App\Models\MikrotikApi;
use Illuminate\Http\Request;

class PPPoEController extends Controller
{
    public function index(){
        // data router yang di kirim
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        // connet mikrotik api 
        $API = new MikrotikApi();
        // debugging prosses 
        $API->debug('false');
        if($API->connect($ip,$user,$pass)) {
          $secret = $API->comm('/ppp/secret/print');
          $profil = $API->comm('/ppp/profile/print');  
        } else {
          return 'koneksi gagal';
        }
         $data = [
          'jumlahscret' => count($secret),
          'secret' => $secret,
          'profile' => $profil,
         ]; 

        //  @dd($data);
      return view('pppoe.secret', $data);
  }
}
error_reporting(0);