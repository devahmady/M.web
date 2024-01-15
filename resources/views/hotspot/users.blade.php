{{-- @dd($hotspotuser) --}}
@extends('app.main')
@section('header')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <a href="#" class="btn btn-primary d-sm-none btn-icon m-1" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="12" r="9"></circle>
                <line x1="9" y1="12" x2="15" y2="12"></line>
                <line x1="12" y1="9" x2="12" y2="15"></line>
             </svg>
            </a>
            {{-- <a href="#" class="btn btn-primary d-none d-sm-inline-block m-1" data-bs-toggle="modal" data-bs-target="#modal-report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
              Add
            </a> --}}
            {{-- <a href="#" class="btn btn-primary d-sm-none btn-icon m-1" data-bs-toggle="modal" data-bs-target="#modal-users" aria-label="Create new report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
             </svg>
            <a href="#" class="btn btn-primary d-none d-sm-inline-block m-1" data-bs-toggle="modal" data-bs-target="#modal-users">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
             Generate
            </a> --}}
            <a href="#" class="btn btn-primary d-none d-sm-inline-block m-1" data-bs-toggle="modal" data-bs-target="#modal-users">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                <rect x="7" y="13" width="10" height="8" rx="2"></rect>
             </svg>
             Print
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
  
  // function angkaAja($bytes, $decimal = null){
  //   $satuan =['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
  //   $i = 0;
  //   while ($bytes > 1024 ){
  //     $bytes /= 1024;
  //     $i++;
  //   }
  //   return round($bytes, $decimal);
  // } 
?>   
<div class="col-12 mt-2">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
          <thead>
            <tr>
              <th>[ {{ $totalhotspotuser }} ]</th>
              <th>No</th>
              {{-- <th>Server</th> --}}
              <th>Name</th>
              <th>Password</th>
              <th>Profile</th>
              <th>Server</th>
              <th>Up Time</th>
              <th>Bytes In</th>
              <th>Bytes Out</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hotspotuser as $no => $data)
            <tr>
              <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
              <td>
                <a href=" {{ route('dell', $id)}} ">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="4" y1="7" x2="20" y2="7"></line>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
              </a>
            </td>
              <td>{{ $no + 1 }}</td>
              <td>{{ $data['name'] }}</td>       
              <td>{{ $data['password'] ??''}}</td>       
              <td>{{ $data['profile'] ?? ''}}</td>       
              <td>{{ $data['server'] ?? ''}}</td>       
              <td>{{ \App\Helpers\RouterOs::formatUptime($data['uptime']) }}</td>      
              <td>{{ \App\Helpers\RouterOs::bytes($data['bytes-in'],2)}}</td>       
              <td>{{ \App\Helpers\RouterOs::bytes($data['bytes-out'],2)}}</td>       
              <td>{{ $data['comment'] ?? '' }} - {{ $currentDate }}</td>

      
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection