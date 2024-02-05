<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

            $hotspotuser = $API->comm('/ip/hotspot/user/print');
            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $json = json_encode($hotspotuser);
            $hotspotusers = collect($hotspotuser);
            $perPage = 15;
            $currentPage = request()->get('page') ?: 1;
            $pagination = new LengthAwarePaginator(
                $hotspotusers->forPage($currentPage, $perPage),
                $hotspotusers->count(),
                $perPage,
                $currentPage,
                ['path' => route('hotspot.users')] // Adjust the route name accordingly
            );
            
            $data = [
                'totalhotspotuser' => count($hotspotuser),
                'hotspotuser' => $pagination,
                'server' => $server,
                'profile' => $profile,
            ];
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
            $usermode = ($request->input('name') == $request->input('password')) ? 'vc-' : 'up-';
            $timelimit = $request->input('timelimit', '0');
            $comment = $usermode . $request->input('comment');
            $API->comm('/ip/hotspot/user/add', [
                'name' => $request->input('user'),
                'password' => $request->input('password'),
                'server' => $request->input('server'),
                'profile' => $request->input('profile'),
                'limit-uptime' => $timelimit,
                'comment' => $comment,
            ]);
            return redirect('hotspot/users')->with('success', 'Selamat Anda berhasil menambahkan pengguna Hotspot');
        } else {
            return redirect('failed')->with('error', 'Gagal terhubung ke router MikroTik');
        }
    }

    public function generate(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        $pilihanKarakter = $request->input('pilihan_karakter', 1); // Default ke 1 jika tidak ada nilai yang diterima
        if ($API->connect($ip, $user, $password)) {
            $usermode = ($request->input('name') == $request->input('password')) ? 'vc-' : 'up-';
            $comment = $usermode . $request->input('comment');
            $jumlah =  $request->jumlah;
            $karakter = $request->karakter;
            $nilai = [];
            $stringSpace = '';
            if ($pilihanKarakter == 1) {
                $stringSpace = '0123456789';
            } elseif ($pilihanKarakter == 2) {
                $stringSpace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            } elseif ($pilihanKarakter == 3) {
                $stringSpace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            }
    
            if ($API->connect($ip, $user, $password)) {
                for ($i = 0; $i < $jumlah; $i++) {
                    $stringLength = strlen($stringSpace);
                    $string = str_repeat($stringSpace, ceil($karakter / $stringLength));
                    $shuffledString = str_shuffle($string);
                    $shuffledString2 = str_shuffle($string);
                    $randomString = substr($shuffledString, 1, $karakter);
                    $randomString2 = substr($shuffledString2, 1, $karakter);
                    array_push($nilai, $randomString);
                    if ($request->pilih == 1) {
                        $randomString2 = $randomString;
                    }
                    $timelimit = ($request['timelimit'] == '') ? '0' : $request['timelimit'];
                    $API->comm('/ip/hotspot/user/add', array(
                        'name' => $randomString,
                        'password' => $randomString2,
                        'server' => $request['server'],
                        'profile' => $request['profile'],
                        'limit-uptime' => $timelimit,
                        'comment' => $comment,
                    ));
                }
                return redirect()->route('hotspot.users')->with('success', 'Berhasil menambahkan pengguna.');
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
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $profileDetails = [];
            foreach ($profile as $prof) {
                $data = $prof['name'];
                $getprofile = $API->comm("/ip/hotspot/user/profile/print", array("?name" => "$data"));
                if (!empty($getprofile)) {
                    $profiledetalis = $getprofile[0];
                    $profileDetails[] = [
                        'id' => $profiledetalis['.id'], 
                        'name' => $profiledetalis['name'],
                        'address-pool' => $profiledetalis['address-pool'] ?? 'none',
                        'status-autorefresh' => $profiledetalis['status-autorefresh'],
                        'shared-users' => $profiledetalis['shared-users'],
                        'parent-queue' => $profiledetalis['parent-queue'] ?? 'none',
                        'rate-limit' => $profiledetalis['rate-limit'],
                    ];
                }
            }
            $addressPools = $this->getAddressPools();
            $API->disconnect();

            return view('hotspot.profile', ['profileDetails' => $profileDetails, 'addressPools' => $addressPools]);
        } else {
            return redirect('failed');
        }
    }


   
    public function showProfile($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $getprofile = $API->comm("/ip/hotspot/user/profile/print", [
                '.id' => $id,
            ]);
            if (!isset($getprofile['!trap'])) {
                $API->disconnect();
                return view('hotspot/profiledetails', ['profileDetails' => $getprofile]);
            } else {
                $API->disconnect();
                return redirect()->back()->with('error', 'Data profile tidak ditemukan');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal terhubung ke router MikroTik');
        }
    }
    



    public function addProfile(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $addressPools = $this->getAddressPools($API);
            $name = $request->input('name');
            $rateLimit = $request->input('rate-limit');
            $sharedUsers = $request->input('shared-users');
            $pool = $request->input('ppool');
            $parentq = $request->input('parentqq');
            $API->comm("/ip/hotspot/user/profile/add", [
                "name" => $request->input('name'),
                "address-pool" => $request->input('ppool'),
                "rate-limit" => $request->input('ratelimit'),
                "shared-users" => $request->input('sharedusers'),
                "status-autorefresh" => "1m",
                "parent-queue" => $request->input('parentqq'),
            ]);
            return redirect('hotspot/profile');
        }
    }





    private function convertToMikroTikTime($input)
    {
        preg_match_all('/(\d+)([a-zA-Z]+)/', $input, $matches, PREG_SET_ORDER);

        $totalHours = 0;

        foreach ($matches as $match) {
            $value = (int) $match[1];
            $unit = strtolower($match[2]);

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
            }
        }

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



    public function delprofile($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ip/hotspot/user/profile/remove', [
                '.id' => $id, // Menggunakan ID profil sebagai parameter untuk menghapus
            ]);
        } else {
        }

        $API->disconnect();
        return redirect()->route('hotspot.profile');
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
