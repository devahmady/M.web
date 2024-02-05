@extends('app.main')
@section('header')
    <div class="row row-cards">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form class="card" accept="{{ route('generate') }}" method="POST" id="profileForm">
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Generate Users</h3>
                    <div class="row row-cards">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="pilih" value="1" class="form-selectgroup-input"
                                    checked="">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Username =
                                            Password</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="pilih" value="2" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Username &
                                            Password</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Jumlah Users</label>
                            <input name="jumlah" id="jumlah" type="text" class="form-control ps-0"
                                autocomplete="off">
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Karakter</label>
                                <select class="form-select" name="karakter" id="karakter">
                                    <?php
                                    for ($b = 1; $b <= 10; $b++) {
                                        echo " <option> $b </option>  ";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Karakter</label>
                                <select class="form-select" name="pilihan_karakter" id="pilihan_karakter">
                                    <option value="1">Angka saja</option>
                                    <option value="2">Huruf besar dan kecil</option>
                                    <option value="3">Huruf besar, huruf kecil, dan angka</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Server</label>
                                <select id="server" name="server" class="form-select">
                                    @foreach ($server as $data)
                                        <option selected>{{ $data['name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Profile</label>
                                <select id="profile" name="profile" class="form-select">
                                    @foreach ($profile as $data)
                                        <option selected>{{ $data['name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Validity</label>
                                <input id="timelimit" name="timelimit" type="text" class="form-control ps-0"
                                    autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Comment</label>
                                <input id="comment" name="comment" type="text" class="form-control ps-0"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Generate Users</button>
                    <div id="loading" class="d-none text-center mt-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-primary mt-2">Menambahkan...</p>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
