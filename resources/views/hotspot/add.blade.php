@extends('app.main')
@section('header')
    <div class="row row-cards">
        <div class="col-12">
            <form class="card" accept="{{ route('hotspot.add') }}" method="POST">
                @csrf
                <div class="card-body">
                    <h3 class="card-title">Add User</h3>
                    <div class="row row-cards">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input id="user" name="user" type="text" class="form-control ps-0"
                                            autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input id="password" name="password" type="text" class="form-control ps-0"
                                autocomplete="off">
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
                                <label class="form-label">Comment</label>
                                <input id="comment" name="comment" type="text" class="form-control ps-0"
                                autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>

    </div>
@endsection
