@extends('app.main')
@section('header')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none ">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Invoice
                        </h2>
                    </div>
                    <form action="{{ route('print') }}" method="post" class="d-flex none" id="printForm">
                        @csrf
                        <div class="col-3 p-1 d-print-none">
                            <select name="name" id="name" class="form-control">
                                <option value="">Pilih Profile</option>
                                @foreach ($server as $profile)
                                    <option value="{{ $profile['name'] }}">{{ $profile['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 p-1 d-print-none">
                            <select name="comment" id="comment" class="form-control">
                                <option value="">Pilih Comment</option>
                                @php $displayedComments = []; @endphp
                                @foreach ($server as $profile)
                                    @foreach ($comment as $user)
                                        @if ($user['profile'] == $profile['name'] && !in_array($user['comment'], $displayedComments))
                                            <option value="{{ $user['comment'] }}" data-profile="{{ $user['profile'] }}">{{ $user['comment'] }}</option>
                                            @php $displayedComments[] = $user['comment']; @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-3 p-1 d-print-none">
                            <button type="submit" class="btn btn-primary" name="print" id="printButton">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                    </path>
                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                    </path>
                                </svg>
                                Print
                            </button>
                        </div>
                    </form>
                    
                    


                </div>
            </div>

        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="col-auto ms-auto d-print-none">
                          
                          </div>
                        <div class="row">
                            @if ($server && $comment)
                                <!-- Tampilkan hanya jika ada data yang dipilih -->
                                @foreach ($server as $profile)
                                    @foreach ($comment as $user)
                                        @if ($user['profile'] == $profile['name'])
                                            <div class="col-md-5 col-lg-3 p-1">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">{{ $profile['name'] }} <span
                                                                class="card-subtitle ">no</span></h3>
                                                    </div>
                                                    <div class="card-body text-center">Username : {{ $user['name'] }} <br>
                                                        Password : {{ $user['password'] }} <br>
                                                        Masa Berlaku : {{ $user['limit-uptime'] }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif <!-- Akhir kondisional -->


                            <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We
                                look
                                forward to working with
                                you again!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
