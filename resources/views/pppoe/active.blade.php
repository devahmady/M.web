@extends('app.main')
@section('header')
    <div class="row row-cards">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-white">
                    Client Active PPPoE
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <a href="{{ route('secret.pppoe') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        New user
                    </a>
                </div>
            </div>
        </div>
        @foreach ($active as $data)
            <div class="card">
                <div class="row g-0">
                    <div class="col-auto">
                        <div class="card-body">
                            <div class="avatar avatar-md" style="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body ps-0">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0"><a href="#">{{ $data['name'] }}</a></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mt-3 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
                                        <div class="list-inline-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/building-community -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-server" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                                <path
                                                    d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                                <path d="M7 8l0 .01" />
                                                <path d="M7 16l0 .01" />
                                            </svg>
                                            {{ $data['service'] }}
                                        </div>
                                        <div class="list-inline-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/license -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6.5 7h11" />
                                                <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                                                <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                                            </svg>
                                            {{ $data['uptime'] }}

                                        </div>
                                        <div class="list-inline-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-device-ipad-horizontal-code"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M11 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7" />
                                                <path d="M9 17h2.5" />
                                                <path d="M20 21l2 -2l-2 -2" />
                                                <path d="M17 17l-2 2l2 2" />
                                            </svg>
                                            {{ $data['address'] }}
                                        </div>
                                        <div class="list-inline-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-virus" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                <path d="M12 7v-4" />
                                                <path d="M11 3h2" />
                                                <path d="M15.536 8.464l2.828 -2.828" />
                                                <path d="M17.657 4.929l1.414 1.414" />
                                                <path d="M17 12h4" />
                                                <path d="M21 11v2" />
                                                <path d="M15.535 15.536l2.829 2.828" />
                                                <path d="M19.071 17.657l-1.414 1.414" />
                                                <path d="M12 17v4" />
                                                <path d="M13 21h-2" />
                                                <path d="M8.465 15.536l-2.829 2.828" />
                                                <path d="M6.343 19.071l-1.413 -1.414" />
                                                <path d="M7 12h-4" />
                                                <path d="M3 13v-2" />
                                                <path d="M8.464 8.464l-2.828 -2.828" />
                                                <path d="M4.929 6.343l1.414 -1.413" />
                                            </svg>
                                            {{ $data['caller-id'] }}
                                        </div>
                                    </div>
                                    <div class="mt-3 list mb-0 text-muted d-block d-sm-none">
                                        <div class="list-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/building-community -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-server" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                                <path
                                                    d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                                <path d="M7 8l0 .01" />
                                                <path d="M7 16l0 .01" />
                                            </svg>
                                            {{ $data['service'] }}
                                        </div>
                                        <div class="list-item">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/building-community -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6.5 7h11" />
                                            <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                                            <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                                        </svg>
                                        {{ $data['uptime'] }}
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-device-ipad-horizontal-code"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M11 20h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7" />
                                                <path d="M9 17h2.5" />
                                                <path d="M20 21l2 -2l-2 -2" />
                                                <path d="M17 17l-2 2l2 2" />
                                            </svg>
                                            {{ $data['address'] }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-auto">
                                    <div class="mt-3 badges">
                                        <a href="#"
                                            class="badge badge-outline text-muted border fw-normal badge-pill">PHP</a>
                                        <a href="#"
                                            class="badge badge-outline text-muted border fw-normal badge-pill">Laravel</a>
                                        <a href="#"
                                            class="badge badge-outline text-muted border fw-normal badge-pill">CSS</a>
                                        <a href="#"
                                            class="badge badge-outline text-muted border fw-normal badge-pill">Vue</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
