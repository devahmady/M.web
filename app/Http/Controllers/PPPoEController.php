<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Pppoe;

class PPPoEController extends Controller
{
  public function show()
  {
    $data = Pppoe::show();
    return view('pppoe/addserv', $data);
  }

  public function addServer(Request $request)
  {
    if (Pppoe::addServer($request)) {
      return redirect()->route('pppoe.server');
    } else {
      return 'Gagal menambahkan server PPPoE.';
    }
  }

  public function delserver($id)
  {
    Pppoe::delserver($id);
    return redirect()->route('pppoe.server');
  }

  public function profile()
  {
    $data = Pppoe::profile();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe/profile', $data);
    }
  }

  public function addProfile(Request $request)
  {
    if (Pppoe::addProfile($request)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menambahkan profil PPPoE.';
    }
  }

  public function dellprofile($id)
  {
    if (Pppoe::dellprofile($id)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menghapus profil PPPoE.';
    }
  }
  public function secret()
  {
    $data = Pppoe::secret();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe/secret', $data);
    }
  }
  public function addsecret(Request $request)
  {
    if (Pppoe::addsecret($request)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }

  public function dellsecret($id)
  {
    if (Pppoe::dellsecret($id)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menghapus secret PPPoE.';
    }
  }

  public function active()
  {
    $data = Pppoe::active();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe/active', $data);
    }
  }

  public function dellactive($id)
  {
    if (Pppoe::dellactive($id)) {
      return redirect()->route('active.pppoe');
    } else {
      return 'Gagal menghapus PPPoE active.';
    }
  }
}
error_reporting(0);
