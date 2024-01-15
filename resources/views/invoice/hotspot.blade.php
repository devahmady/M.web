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
                    {{-- @dd($server) --}}
                    <form action="{{ route('invoice.hotspot') }}" method="get" class="d-flex none">
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
                                @foreach ($comment as $user)
                                    <option value="{{ $user['comment'] }}">{{ $user['comment'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 p-1 d-print-none">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <!-- ... (printer icon) ... -->
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
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">Company</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ltd@example.com
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <p class="h3">Client</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ctr@example.com
                                </address>
                            </div>
                            <div class="col-12 my-5">
                                <h1>Invoice INV/001/15</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-lg-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">balehotspot <span class="card-subtitle ">Subtitle</span></h3>
                                    </div>
                                    <div class="card-body text-center">Username : tes <br>
                                        password : tes <br>
                                        masa berlaku : 2h</div>
                                </div>
                            </div>

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
