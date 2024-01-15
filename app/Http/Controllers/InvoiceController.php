<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    public function index(Request $request)
{
    $ip = session()->get('ip');
    $user = session()->get('user');
    $password = session()->get('password');
    $API = new MikrotikApi();
    $API->debug = false;

    if ($API->connect($ip, $user, $password)) {
        $server = $API->comm('/ip/hotspot/user/profile/print');
        $comment = $API->comm('/ip/hotspot/user/print');

        // Get selected options from the request
        $selectedProfile = $request->input('name');
        $selectedComment = $request->input('comment');

        // Apply filters based on selected options
        $filteredServer = array_filter($server, function ($profile) use ($selectedProfile) {
            return $selectedProfile === null || $profile['name'] === $selectedProfile;
        });

        $filteredComment = array_filter($comment, function ($user) use ($selectedComment) {
            return $selectedComment === null || $user['comment'] === $selectedComment;
        });

        $API->disconnect();

        return view('invoice.hotspot', [
            'server' => $filteredServer,
            'comment' => $filteredComment,
        ]);
    }
}

   
    
}
error_reporting(0);
