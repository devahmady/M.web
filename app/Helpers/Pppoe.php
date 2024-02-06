<?php

namespace App\Helpers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;

class Pppoe
{
    public static function show()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            $pprofile = $API->comm('/ppp/profile/print');
            $server = $API->comm('/interface/pppoe-server/server/print');
            $data = [
                'interface' => $interface,
                'server' => $server,
                'pprofile' => $pprofile,
            ];
        } else {
            return 'koneksi gagal';
        }

        return $data;
    }

    public static function addserver(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $service = $request->input('service');
            $name = $request->input('name');
            $monid = $request->input('monid');
            // Lakukan pemanggilan API untuk menambahkan server PPPoE

            if (empty($monid)) {
                $API->comm('/interface/pppoe-server/server/add', [
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            } else {
                $API->comm('/interface/pppoe-server/server/set', [
                    '.id' => $monid,
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            }
        } else {
            return 'koneksi gagal';
        }
        return redirect()->route('pppoe.server');
    }

    public static function delserver($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/interface/pppoe-server/server/remove', [
                '.id' => $id, // Menggunakan ID profil sebagai parameter untuk menghapus
            ]);
        }

        $API->disconnect();
    }

    public static function profile()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print');
            $pool = $API->comm('/ip/pool/print');
            $parent = $API->comm('/queue/simple/print');
            $filteredProfiles = array_filter($pprofile, function ($profile) {
                return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            });

            $data = [
                'pool' => $pool,
                'parent' => $parent,
                'profile' => $filteredProfiles,
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function addProfile($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $name = $request->input('name');
            $local = $request->input('local');
            $remote = $request->input('remote');
            $parentqq = $request->input('parentqq');
            $ratelimit = $request->input('ratelimit');
            $API->comm('/ppp/profile/add', [
                'name' =>  $name,
                "local-address" => $local,
                "remote-address" => $remote,
                "parent-queue" => $parentqq,
                "rate-limit" => $ratelimit,
                "only-one" => "yes",
            ]);
            $API->disconnect();
            return true;
        } else {
            return false;
        }
    }

    public static function dellprofile($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/profile/remove', [
                '.id' => $id, // Menggunakan ID profil sebagai parameter untuk menghapus
            ]);
            $API->disconnect();
            return true;
        } else {
            return false;
        }
    }

    public static function secret()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print');
            $secret = $API->comm('/ppp/secret/print');
            $filteredProfiles = array_filter($pprofile, function ($profile) {
                return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            });

            $data = [
                'secret' => $secret,
                'profile' => $filteredProfiles,
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function addsecret($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $name = $request->input('name');
            $pass = $request->input('pass');
            $profile = $request->input('profilee');
            $service = $request->input('servicee');
            $data = [];
            if ($request->filled('local')) {
                $data["local-address"] = $request->input('local');
            }
            if ($request->filled('remote')) {
                $data["remote-address"] = $request->input('remote');
            }
            $API->comm('/ppp/secret/add', [
                'name' =>  $name,
                'password' =>  $pass,
                'profile' => $profile,
                'service' => $service,
            ] + $data);
            $API->disconnect();
            return true;
        } else {
            return false;
        }
    }

    public static function dellsecret($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/secret/remove', [
                '.id' => $id,
            ]);
            $API->disconnect();
            return true;
        } else {
            return false;
        }
    }

    public static function active()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $active = $API->comm('/ppp/active/print');
            $data = [
                'active' => $active,
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }
}
