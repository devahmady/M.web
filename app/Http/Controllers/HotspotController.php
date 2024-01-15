<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\RouterOs;

class HotspotController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotuser = $API->comm('/ip/hotspot/user/print', array(
                "?uptime" => "0"
            ));

            // Gunakan UptimeHelper untuk memformat waktu uptime
            foreach ($hotspotuser as $user) {
                $formattedUptime = RouterOs::formatUptime($user['uptime']);
                // Lakukan sesuatu dengan $formattedUptime, misalnya, tambahkan ke $user['formattedUptime']
                $user['formattedUptime'] = $formattedUptime;
            }

            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $json = json_encode($hotspotuser);
            // echo $json;

            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,
            ];
            // dd($hotspotuser);
            return view('hotspot.users', $data);
        } else {
            return redirect('failed');
        }
    }

    public function add(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            if ($request['timelimit'] == '') {
                $timelimit = '0';
            } else {
                $timelimit = $request['timelimit'];
            }

            $API->comm('/ip/hotspot/user/add', array(
                'name' => $request['user'],
                'password' => $request['password'],
                'server' => $request['server'],
                'profile' => $request['profile'],
                'limit-uptime' => $timelimit,
                'comment' => $request['comment'],
            ));
            // return ;
            // Alert::success('Success', 'Selamat anda Berhasil menambhakan user Hotspot');
            return redirect('hotspot/users');
        } else {

            return redirect('failed');
        }
    }

    public function generate(Request $request)
    {

        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = true;

        if ($API->connect($ip, $user, $password)) {

            $jumlah =  $request->jumlah;
            $karakter = $request->karakter;
            $nilai = [];


            if ($API->connect($ip, $user, $password)) {
                $currentDate = now()->format('Y-m-d');
                for ($i = 0; $i < $jumlah; $i++) {
                    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $stringLength = strlen($stringSpace);
                    $string = str_repeat($stringSpace, ceil($karakter / $stringLength));
                    $shuffledString = str_shuffle($string);
                    $shuffledString2 = str_shuffle($string);
                    $randomString = substr($shuffledString, 1, $karakter);
                    $randomString2 = substr($shuffledString2, 1, $karakter);
                    array_push($nilai, $randomString);
                    $pilih = $request->pilih;
                    if ($pilih == 1) {
                        $randomString2 = $randomString;
                    };

                    if ($request['timelimit'] == '') {
                        $timelimit = '0';
                    } else {
                        $timelimit = $request['timelimit'];
                    }

                    $API->comm('/ip/hotspot/user/add', array(
                        'name' => $randomString,
                        'password' => $randomString2,
                        'server' => $request['server'],
                        'profile' => $request['profile'],
                        'limit-uptime' => $timelimit,
                        'comment' => $request['comment'] . ' - ' . $currentDate,

                    ));
                }
                // return ;
                // Alert::success('Success', 'Selamat anda Berhasil menambhakan user Hotspot');
                return redirect()->route('hotspot.users');
            } else {

                return redirect('failed');
            }
        }
    }

    public function dell($id)
    {

        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = true;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ip/hotspot/user/remove', array(
                '.id' => '*' . $id,
            ));
            return redirect()->route('hotspot.users');
        }
    }

    public function active()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotactive = $API->comm('/ip/hotspot/active/print');

            $data = [
                'menu' => 'Hotspot',
                'totalhotspotactive' => count($hotspotactive),
                'hotspotactive' => $hotspotactive,
            ];

            return view('hotspot.active', $data);
        } else {

            return redirect('failed');
        }
    }

    public function profile()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $pools = $API->comm('/ip/pool/print');
            $parentq = $API->comm('/queue/simple/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
          
            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'jumon' => count($profile),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,
                'pool' => $pools,
                'parentq' => $parentq,
            ];
            $addressPools = $this->getAddressPools();
            $API->disconnect(); // pastikan untuk disconnect setelah selesai menggunakan API

            return view('hotspot.profile', $data)->with('addressPools', $addressPools);
        } else {
            return redirect('failed');
        }
    }


    public function addProfile(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = true;

        if ($API->connect($ip, $user, $password)) {

            $addressPools = $this->getAddressPools($API);
            $name = $request->input('name');
            $rateLimit = $request->input('rate-limit');
            $sharedUsers = $request->input('shared-users');
            $timeout = $request->input('session-timeout');
            $pool = $request->input('ppool');
            $parentq = $request->input('parentqq');
            $convertedTimeout = $this->convertToMikroTikTime($timeout);
            
            $onLoginScript = '{:local username $user; :if ([/system schedule find name=$username]="") do={ /system schedule add name=$username interval=' . $convertedTimeout . ' on-event="/ip hotspot user remove [find name=$username]\r\n/ip hotspot active remove [find user=$username]\r\n/system schedule remove [find name=$username] "}}}';

            // Tambahkan profil
            $add = $API->comm("/ip/hotspot/user/profile/add", [
                "name" => $name,
                "on-login" => $onLoginScript,
                "address-pool" => $pool,
                "rate-limit" => $rateLimit,
                "shared-users" => $sharedUsers,
                "session-timeout" => $convertedTimeout,
                "parent-queue" => $parentq,
                // Tambahkan parameter lain sesuai kebutuhan
            ]);
            
            // Eksekusi perintah "on-login" script
            $API->comm($onLoginScript);

            // Ambil informasi profil setelah ditambahkan
            $result = $API->comm("/ip/hotspot/user/profile/print", [
                "?name" => $name,
            ]);

            // Respons JSON dengan informasi profil
            // return response()->json($result);

            // Redirect ke halaman profil
            return redirect('hotspot/profile');
        } else {
            return redirect('failed');
        }
    }



    private function convertToMikroTikTime($input)
    {
        // Pisahkan komponen waktu (angka, satuan) dari input
        preg_match_all('/(\d+)([a-zA-Z]+)/', $input, $matches, PREG_SET_ORDER);

        $totalHours = 0;

        foreach ($matches as $match) {
            $value = (int) $match[1];
            $unit = strtolower($match[2]);

            // Konversi ke jam berdasarkan satuan waktu
            switch ($unit) {
                case 'd':
                    $totalHours += $value * 24;
                    break;
                case 'h':
                    $totalHours += $value;
                    break;
                case 'm':
                    $totalHours += $value / 60;
                    break;
                case 's':
                    $totalHours += $value / 3600;
                    break;
                    // Tambahkan kasus lain sesuai kebutuhan
            }
        }

        // Format waktu yang sesuai dengan format MikroTik RouterOS (jam:menit:detik)
        $formattedTime = sprintf('%02d:%02d:00', $totalHours, ($totalHours * 60) % 60);

        return $formattedTime;
    }




    private function getAddressPools()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $addressPools = $API->comm('/ip/pool/print');
            $API->disconnect();
            return $addressPools;
        } else {
            return [];
        }
    }

    private function getParent()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $getQueue = $API->comm('/simpel/queue/print');
            $API->disconnect();
            return $getQueue;
        } else {
            return [];
        }
    }



    public function del($id)
    {

        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ip/hotspot/user/profile/remove', array(
                '.id' => '*' . $id,
            ));
            return redirect()->route('hotspot.profile');
        }
    }

    public function showAdd()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $json = json_encode($hotspotuser);
            // echo $json;

            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,

            ];

            return view('hotspot/add', $data);
        } else {

            return redirect('failed');
        }
    }

    public function showGenerate()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $json = json_encode($hotspotuser);
            // echo $json;

            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $hotspotuser,
                'server' => $server,
                'profile' => $profile,

            ];

            return view('hotspot/generate', $data);
        } else {

            return redirect('failed');
        }
    }
}
error_reporting(0);
