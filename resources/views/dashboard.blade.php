{{-- @dd($arp); --}}
@extends('app.main')
@section('header')
    <div class="container-xl">
        <div class="row row-deck row-cards mt-2 ">
            <div class="col-lg-4  ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"> <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-rotate-clockwise" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                                </svg> system date & time</div>
                        </div>



                        <div class=" mb-1">
                            <div>Time & date : {{ $time }} </div>
                            <span>Uptime : {{ $tim }} </span>
                            <div>Time Zone : {{ $ntp }} </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"> <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-info-circle" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                </svg> Info</div>
                        </div>
                        <div class=" mb-1">
                            <div>Name : {{ $identitas }} </div>
                            <div>Model : {{ $router }} </div>
                            <div>Router OS : {{ $versi }} </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" />
                                <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                <path d="M5 15v1m0 -8v1" />
                                <div class="subheader">Sales</div>
                            </svg>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-1">Rp. 20.000.00</div>
                        <div class="d-flex mb-2">
                            <div>Income</div>

                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"> <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-cpu-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="1" y="1" width="1000" height="1000"></rect>
                                    <path d="M8 10v-2h2m6 6v2h-2m-4 0h-2v-2m8 -4v-2h-2"></path>
                                    <path d="M3 10h2"></path>
                                    <path d="M3 14h2"></path>
                                    <path d="M10 3v2"></path>
                                    <path d="M14 3v2"></path>
                                    <path d="M21 10h-2"></path>
                                    <path d="M21 14h-2"></path>
                                    <path d="M14 21v-2"></path>
                                    <path d="M10 21v-2"></path>
                                </svg> Sysytem & Date</div>
                        </div>
                        <div class=" mb-1">
                            <span class="">CPU Load : 

                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                                  </div>
                            </span>
                            <div>Free Memory : {{ \App\Helpers\RouterOs::bytes($memory, 2) }} </div>
                            <div>Free HDD : {{ \App\Helpers\RouterOs::bytes($memory1, 2) }} </div>

                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2">RouterBoard</p>
                        <div class="progress progress-separated mb-2">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $cpu }}%; ">{{ $cpu }}% - {{ $frequency }} MHz</div>
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ \App\Helpers\RouterOs::bytes3($memory, 2) }}%;">
                                {{ \App\Helpers\RouterOs::bytes($memory, 2) }}</div>
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ \App\Helpers\RouterOs::bytes3($hdd, 2) }}%;">
                                {{ \App\Helpers\RouterOs::bytes($hdd, 2) }}</div>

                        </div>
                        <div class="row">
                            <div class="col-auto d-flex align-items-center pe-2">
                                <span class="legend me-2 bg-primary"></span>
                                <span>Cpu Load</span>
                                <span
                                    class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ $cpu }}%</span>
                            </div>
                            <div class="col-auto d-flex align-items-center px-2">
                                <span class="legend me-2 bg-info"></span>
                                <span>Free Memory</span>
                                <span
                                    class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ \App\Helpers\RouterOs::bytes($memory, 2) }}</span>
                            </div>
                            <div class="col-auto d-flex align-items-center px-2">
                                <span class="legend me-2 bg-warning"></span>
                                <span>free Hdd</span>
                                <span
                                    class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ \App\Helpers\RouterOs::bytes($hdd, 2) }}</span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="row row-cards">

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wifi"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                            <path d="M9.172 15.172a4 4 0 0 1 5.656 0"></path>
                                            <path d="M6.343 12.343a8 8 0 0 1 11.314 0"></path>
                                            <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsup">
                                        {{ $hotspot_active }}
                                    </div>
                                    <div class="text-muted">
                                        Hotspot Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium" id="hsuser">
                                        {{ $hotspot_user }}
                                    </div>
                                    <div class="text-muted">
                                        Users Hotspot
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('show.add') }}">
                                        <span
                                            class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-user-plus" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16v6" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        Add User
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('show.generate') }}">
                                        <span
                                            class="bg-dark text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-users-group" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        Generate users
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-7">
        <div class="card ">
            <div class="card-body">
                <select name="interface" id="interface" onchange="requestData()">
                    @foreach ($ether1 as $item)
                        <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
                <div id="graph">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="nilaiRX" value="{{ \App\Helpers\RouterOs::bytes($rx, 2) }}">
    <input type="hidden" id="nilaiTX" value="{{ \App\Helpers\RouterOs::bytes($tx, 2) }}">

    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="h5 m-0">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter" style="height: 400px; display: inline-block; width: 100%; overflow: auto;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Address</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($log as $data)
                                @php
                                    $mess = explode(":", $data['message']);
                                    $time = $data['time'];
                                @endphp
                                @if (substr($data['message'], 0, 2) == "->")
                                    <tr>
                                        <td>{{ $time }}</td>
                                        <td>
                                            @if (count($mess) > 6)
                                                {{ $mess[1] . ":" . $mess[2] . ":" . $mess[3] . ":" . $mess[4] . ":" . $mess[5] . ":" . $mess[6] }}
                                            @else
                                                {{ $mess[1] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (count($mess) > 6)
                                                {{ str_replace("trying to", "", $mess[7] . " " . $mess[8] . " " . $mess[9] . " " . $mess[10]) }}
                                            @else
                                                {{ str_replace("trying to", "", $mess[2] . " " . $mess[3] . " " . $mess[4] . " " . $mess[5]) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>
@endsection