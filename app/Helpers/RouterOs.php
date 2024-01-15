<?php

namespace App\Helpers;

class RouterOs
{
    public static function formatUptime($uptime)
    {
        // Pisahkan jam, menit, dan detik
        list($hours, $minutes, $seconds) = explode(":", $uptime);

        // Format ulang waktu dengan menambahkan 0 di depan jika perlu
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    public static function bytes($bytes, $decimal = null)
    {
        $satuan = ['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
        $i = 0;
        while ($bytes > 1024) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, $decimal) . $satuan[$i];
    }
}
