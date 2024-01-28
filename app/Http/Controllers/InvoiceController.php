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

            // Get selected options from the request
            $selectedProfile = $request->input('name');
            $selectedComment = $request->input('comment');

            // Apply filters based on selected options
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

            // Get selected options from the request
            $selectedProfile = $request->input('name');
            $selectedComment = $request->input('comment');

            // Apply filters based on selected options
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

            // Disconnect from MikroTik API
            $API->disconnect();

            // Generate PDF using Laravel mPDF
            $pdfData = [
                'server' => $filteredServer,
                'comment' => $filteredComment,
            ];
            if ($request->has('print')) {
            $html = view('invoice.print', $pdfData)->render();

            // Create a new instance of Dompdf
            $dompdf = new Dompdf();

            // Load the HTML content into Dompdf
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Get the PDF content as a string
            $pdfContent = $dompdf->output();

            // Response with the PDF content
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf');
                // Kirimkan data yang dipilih ke halaman lain
            }

        }
    }

  
}
error_reporting(0);
