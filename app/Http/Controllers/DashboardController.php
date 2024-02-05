<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Helpers\RouterOs;

class DashboardController extends Controller
{
    public function index()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');
        if ($API->connect($ip, $user, $pass)) {
            $identitas = $API->comm('/system/identity/print');
            $routermodel = $API->comm('/system/routerboard/print');
            $versi = $API->comm('/system/resource/print');
            $cpu = $API->comm('/system/resource/print');
            $freeM = $API->comm('/system/resource/print');
            $freeH = $API->comm('/system/resource/print');
            $hdd = $API->comm('/system/resource/print');
            $hdd1 = $API->comm('/system/resource/print');
            $time = $API->comm('/system/resource/print');
            $tim = $API->comm('/system/resource/print');
            $frequency = $API->comm('/system/resource/print');
            $ppp_active = $API->comm("/ppp/active/print");
            $ppp_user = $API->comm("/ppp/secret/print");
            $hotspot_user = $API->comm("/ip/hotspot/user/print");
            $hotspot_active = $API->comm("/ip/hotspot/active/print");
            $ntp = $API->comm("/system/clock/print");
            $ethertrafik = $API->comm("/interface/print");
            $address = $API->comm("/ip/address/print");
            $arp = $API->comm("/ip/arp/print");
            // $logs = $API->comm("/log/print");
            $ether1 = $API->comm("/interface/print");
            $ipAddresses = [];
            $monitoring = $API->comm('/interface/monitor-traffic', array(
                'interface' => 'ether1',
                'once' => '',
            ));
            $getlog = $API->comm("/log/print", array(
                "?topics" => "hotspot,info,debug"
            ));
            $logs = array_reverse($getlog);
            $rx = $monitoring[0]['rx-bits-per-second'];
            $tx = $monitoring[0]['tx-bits-per-second'];
        } else {
            return 'koneksi gagal';
        }
        $data = [
            'rx' => $monitoring[0]['rx-bits-per-second'],
            'ether1' => $ether1,
            'tx' => $monitoring[0]['tx-bits-per-second'],
            'identitas' => $identitas[0]['name'],
            'router' => $routermodel[0]['model'],
            'versi' => $versi[0]['version'],
            'cpu' => $cpu[0]['cpu-load'],
            'frequency' => $frequency[0]['cpu-frequency'],
            'memory' => $freeM[0]['free-memory'],
            'memory1' => $freeH[0]['total-memory'],
            'hdd' => $hdd[0]['free-hdd-space'],
            'hdd1' => $hdd1[0]['total-hdd-space'],
            'time' => $time[0]['build-time'],
            'tim' => RouterOs::formatUptime($tim[0]['uptime']),
            "ppp_active" => count($ppp_active),
            "ppp_user" => count($ppp_user),
            "hotspot_user" => count($hotspot_user),
            "hotspot_active" => count($hotspot_active),
            "ntp" => $ntp[0]['time-zone-name'],
            "address" => $address,
            "ethertrafik" => $ethertrafik,
            "arp" => $arp,
            "log" => $logs,
            "ipAddresses" => $ipAddresses,
        ];
        // dd($pppactive);
        return view('dashboard', $data);
    }

    public function graf($interfaceName)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');
        if ($API->connect($ip, $user, $pass)) {
            $monitoring = $API->comm('/interface/monitor-traffic', array(
                'interface' => $interfaceName,
                'once' => '',
            ));
        }
        $rows = array();
        $rows2 = array();
        $rx = $monitoring[0]['rx-bits-per-second'];
        $tx = $monitoring[0]['tx-bits-per-second'];
        $rows['name'] = 'Tx';
        $rows['data'][] = $tx;
        $rows2['name'] = 'Rx';
        $rows2['data'][] = $rx;

        $API->disconnect();

        $result = array();

        array_push($result, $rows);
        array_push($result, $rows2);

        return $result;
    }


}
error_reporting(0);
