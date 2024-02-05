<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $selectedProfile = $request->input('name');
            $selectedComment = $request->input('comment');
            $filteredServer = [];
            foreach ($server as $profile) {
                if ($selectedProfile === null || $profile['name'] === $selectedProfile) {
                    $filteredServer[] = $profile;
                }
            }

            $filteredComment = [];
            foreach ($comment as $user) {
                if ($selectedComment === null || $user['comment'] === $selectedComment) {
                    $filteredComment[] = $user;
                }
            }

            $API->disconnect();

            return view('invoice.hotspot', [
                'server' => $filteredServer,
                'comment' => $filteredComment,
            ]);
        }
    }

    public function print(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $server = $API->comm('/ip/hotspot/user/profile/print');
            $comment = $API->comm('/ip/hotspot/user/print');
            $selectedProfile = $request->input('name');
            $selectedComment = $request->input('comment');
            $filteredServer = [];
            foreach ($server as $profile) {
                if ($selectedProfile === null || $profile['name'] === $selectedProfile) {
                    $filteredServer[] = $profile;
                }
            }
            $filteredComment = [];
            foreach ($comment as $user) {
                if ($selectedComment === null || $user['comment'] === $selectedComment) {
                    $filteredComment[] = $user;
                }
            }
            $API->disconnect();
            $pdfData = [
                'server' => $filteredServer,
                'comment' => $filteredComment,
            ];
            if ($request->has('print')) {
            $html = view('invoice.print', $pdfData)->render();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $pdfContent = $dompdf->output();
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf');
            }

        }
    }

  
}
error_reporting(0);
