{{-- @dd($hotspotuser) --}}
@extends('app.main')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <!-- Page title actions -->
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Hotspot Users
                        </div>
                        <h2 class="page-title text-white">
                            List Users
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="{{ route('show.add') }}" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    </svg>
                                    Add
                                </a>
                            </span>
                            <a href="{{ route('show.generate') }}" class="btn btn-info">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-plus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                </svg>
                                Generate
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-report" aria-label="Create new report">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                            </a>
                        </div>
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
                            <th>Mac Address</th>
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
                                    <a href=" {{ route('dell', $id) }} ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                                <td>{{ $data['password'] ?? '' }}</td>
                                <td>{{ $data['profile'] ?? '' }}</td>
                                <td>{{ $data['server'] ?? '' }}</td>
                                <td>{{ $data['mac-address'] ?? '' }}</td>
                                <td>{{ \App\Helpers\RouterOs::formatUptime($data['uptime']) }}</td>
                                <td>{{ \App\Helpers\RouterOs::bytes($data['bytes-in'], 2) }}</td>
                                <td>{{ \App\Helpers\RouterOs::bytes($data['bytes-out'], 2) }}</td>
                                <td>{{ $data['comment'] ?? '' }} - {{ $currentDate }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
