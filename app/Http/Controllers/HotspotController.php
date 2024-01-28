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

            // // Gunakan UptimeHelper untuk memformat waktu uptime
            // foreach ($hotspotuser as $user) {
            //     $formattedUptime = RouterOs::formatUptime($user['uptime']);
            //     // Lakukan sesuatu dengan $formattedUptime, misalnya, tambahkan ke $user['formattedUptime']
            //     $user['formattedUptime'] = $formattedUptime;
            // }

            $server = $API->comm('/ip/hotspot/print');
            $profile = $API->comm('/ip/hotspot/user/profile/print');
            $json = json_encode($hotspotuser);
            // echo $json;
            $hotspotusers = collect($hotspotuser);

            // Paginate the data
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
            $usermode = ($request->input('name') == $request->input('password')) ? 'vc-' : 'up-';

            // Ambil nilai dari input 'timelimit' dan atur ke '0' jika kosong
            $timelimit = $request->input('timelimit', '0');

            // Buat komentar dengan menggabungkan usermode dan input 'comment'
            $comment = $usermode . $request->input('comment');

            $API->comm('/ip/hotspot/user/add', [
                'name' => $request->input('user'),
                'password' => $request->input('password'),
                'server' => $request->input('server'),
                'profile' => $request->input('profile'),
                'limit-uptime' => $timelimit,
                'comment' => $comment,
            ]);

            // Tambahkan kode untuk menangani pesan sukses atau error jika diperlukan
            return redirect('hotspot/users')->with('success', 'Selamat Anda berhasil menambahkan pengguna Hotspot');
        } else {
            // Tambahkan kode untuk menangani pesan error jika koneksi gagal
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

        if ($API->connect($ip, $user, $password)) {
            $usermode = ($request->input('name') == $request->input('password')) ? 'vc-' : 'up-';
            // Buat komentar dengan menggabungkan usermode dan input 'comment'
            $comment = $usermode . $request->input('comment');
            $jumlah =  $request->jumlah;
            $karakter = $request->karakter;
            $nilai = [];


            if ($API->connect($ip, $user, $password)) {
                // $currentDate = now()->format('Y-m-d');
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
                        'comment' => $comment,

                    ));
                }
                // return ;
                // Alert::success('Success', 'Selamat anda Berhasil menambhakan user Hotspot');
                return redirect()->route('hotspot.users')->with('success', 'Berhasil menambahkan pengguna.');;
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

            // Tambahkan logika baru di sini
            $profileDetails = [];
            foreach ($profile as $prof) {
                $uprofname = $prof['name'];
                $getprofile = $API->comm("/ip/hotspot/user/profile/print", array("?name" => "$uprofname"));

                if (!empty($getprofile)) {
                    // Jika ada data pada $getprofile
                    $profiledetalis = $getprofile[0];
                    $getprice = explode(",", $profiledetalis['on-login'])[2];
                    $getsprice = explode(",", $profiledetalis['on-login'])[4];

                    if ($getprice == 0) {
                        $price = ""; // Harga tidak ditampilkan jika 0
                    } else {
                        // Format harga sesuai mata uang
                        $price = "" . $_price . "  " . $curency . " " . number_format($getprice, 0, ",", ".");
                    }

                    if ($getsprice == 0) {
                        $sprice = ""; // Harga jual tidak ditampilkan jika 0
                    } else {
                        // Format harga jual sesuai mata uang
                        $sprice = "" . $_selling_price . "  " . $curency . " " . number_format($getsprice, 0, ",", ".");
                    }

                    // Tambahkan informasi ke array
                    $profileDetails[] = [
                        'id' => $profiledetalis['.id'], // Tambahkan ID ke dalam array
                        'name' => $profiledetalis['name'],
                        'address-pool' => $profiledetalis['address-pool'] ?? 'none',
                        'validity' => explode(",", $profiledetalis['on-login'])[3],
                        'status-autorefresh' => $profiledetalis['status-autorefresh'],
                        'shared-users' => $profiledetalis['shared-users'],
                        'parent-queue' => $profiledetalis['parent-queue'] ?? 'none',
                        'rate-limit' => $profiledetalis['rate-limit'],
                        'price' => $price,
                        'selling_price' => $sprice,
                        'lock' => "" . $_lock_user . " " . explode(",", $profiledetalis['on-login'])[6],
                    ];
                }
            }
            // dd($profileDetails);
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
            // Ambil data profile berdasarkan ID
            $getprofile = $API->comm("/ip/hotspot/user/profile/print", [
                '.id' => $id,
            ]);
    
            // Pastikan bahwa data profile ditemukan
            if (!isset($getprofile['!trap'])) {
                // Tampilkan data profil
                $API->disconnect();
                return view('hotspot/profiledetails', ['profileDetails' => $getprofile]);
            } else {
                // Handle jika tidak ada data yang ditemukan
                // Misalnya, redirect ke halaman lain atau tampilkan pesan kesalahan
                $API->disconnect();
                return redirect()->back()->with('error', 'Data profile tidak ditemukan');
            }
        } else {
            // Handle jika koneksi gagal
            // Misalnya, redirect ke halaman gagal atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Gagal terhubung ke router MikroTik');
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
            $expmode = $request->input('expmode');
            $validity = $request->input('validity');
            $pool = $request->input('ppool');
            $parentq = $request->input('parentqq');
            $getprice = $request->input('price');
            $getsprice = $request->input('sprice');

            $price = empty($getprice) ? "0" : $getprice;
            $sprice = empty($getsprice) ? "0" : $getsprice;

            $getlock = $request->input('lockunlock');
            $lock = ($getlock == 'Enable') ? ';[:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]' : '';
            $randstarttime = now()->setTime(rand(1, 5), rand(10, 59), rand(10, 59))->format('H:i:s');
            $randinterval = now()->setTime(0, 2, rand(10, 59))->format('H:i:s');

            $record = '; :local mac $"mac-address"; :local time [/system clock get time ]; /system script add name="$date-|-$time-|-$user-|-' . $price . '-|-$address-|-$mac-|-' . $validity . '-|-' . $name . '-|-$comment" owner="$month$year" source="$date" comment="mikhmon"';
            $onlogin = ':put (",' . $expmode . ',' . $price . ',' . $validity . ',' . $sprice . ',,' . $getlock . ',"); {:local comment [ /ip hotspot user get [/ip hotspot user find where name="$user"] comment]; :local ucode [:pic $comment 0 2]; :if ($ucode = "vc" or $ucode = "up" or $comment = "") do={ :local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ]; /sys sch add name="$user" disable=no start-date=$date interval="' . $validity . '"; :delay 5s; :local exp [ /sys sch get [ /sys sch find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pic $exp 0 6]; :local t [:pic $exp 7 16]; :local s ("/"); :local exp ("$d$s$year $t"); /ip hotspot user set comment="$exp" [find where name="$user"];}; :if ($getxp = 8) do={ /ip hotspot user set comment="$date $exp" [find where name="$user"];}; :if ($getxp > 15) do={ /ip hotspot user set comment="$exp" [find where name="$user"];};:delay 5s; /sys sch remove [find where name="$user"]';


            if ($expmode == "rem") {
                $onlogin = $onlogin . $lock . "}}";
                $mode = "remove";
            } elseif ($expmode == "ntf") {
                $onlogin = $onlogin . $lock . "}}";
                $mode = "set limit-uptime=1s";
            } elseif ($expmode == "remc") {
                $onlogin = $onlogin . $record . $lock . "}}";
                $mode = "remove";
            } elseif ($expmode == "ntfc") {
                $onlogin = $onlogin . $record . $lock . "}}";
                $mode = "set limit-uptime=1s";
            } elseif ($expmode == "0" && $price != "") {
                $onlogin = ':put (",,' . $price . ',,,noexp,' . $getlock . ',")' . $lock;
            } else {
                $onlogin = "";
            }


            $bgservice = ':local dateint do={:local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:local month ($monthint + 1);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];} else={:return [:tonum ("$year$month$days")];}}; :local timeint do={ :local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ]; :return ($hours * 60 + $minutes) ; }; :local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date] ; :local curtime [$timeint t=$time] ; :foreach i in [ /ip hotspot user find where profile="' . $name . '" ] do={ :local comment [ /ip hotspot user get $i comment]; :local name [ /ip hotspot user get $i name]; :local gettime [:pic $comment 12 20]; :if ([:pic $comment 3] = "/" and [:pic $comment 6] = "/") do={:local expd [$dateint d=$comment] ; :local expt [$timeint t=$gettime] ; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ [ /ip hotspot user ' . $mode . ' $i ]; [ /ip hotspot active remove [find where user=$name] ];}}}';

            // Tambahkan profil
            $API->comm("/ip/hotspot/user/profile/add", [
                "name" => $request->input('name'),
                "address-pool" => $request->input('ppool'),
                "rate-limit" => $request->input('ratelimit'),
                "shared-users" => $request->input('sharedusers'),
                "status-autorefresh" => "1m",
                "on-login" => $onlogin,
                "parent-queue" => $request->input('parentqq'),
            ]);

            // $expmode = $request->input('expmode');
            $monid = $request->input('monid');
            // $name = $request->input('name');
            // $bgservice = $request->input('bgservice');

            // Eksekusi perintah "on-login" script
            if ($expmode != "0") {
                if (empty($monid)) {
                    $API->comm("/system/scheduler/add", [
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $bgservice,
                        "disabled" => "no",
                        "comment" => "Monitor Profile $name",
                    ]);
                } else {
                    $API->comm("/system/scheduler/set", [
                        ".id" => $monid,
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $bgservice,
                        "disabled" => "no",
                        "comment" => "Monitor Profile $name",
                    ]);
                }
            } else {
                $API->comm("/system/scheduler/remove", [
                    ".id" => $monid,
                ]);
            }

            $getprofile = $API->comm("/ip/hotspot/user/profile/print", [
                "?name" => $name,
            ]);
            $pid = $getprofile[0]['.id'];
            return redirect('hotspot/profile')->with('pid', $pid);
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
            // Handle error jika koneksi gagal
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
