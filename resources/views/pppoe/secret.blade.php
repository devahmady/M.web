@extends('app.main')
@section('header')
    <div class="col-12">
        <form class="card" method="post" action="{{ route('add.secret') }}">
            @csrf
            <div class="card-body">
                <h3 class="card-title">Add Secret</h3>
                <div class="row row-cards">
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Local Address</label>
                            <input type="text" class="form-control" id="local" name="local" >
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Remote Address</label>
                            <input type="text" class="form-control" id="remote" name="remote" >
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Service</label>
                            <select name="servicee" id="servicee" class="form-select">
                                <option value="none">none</option>
                                <option value="pppoe">pppoe</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Profile</label>
                            <select name="profilee" id="profilee" class="form-select">
                                <option>none</option>
                                @foreach ($profile as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                    {{-- @dd($pool) --}}

                   
                    <div class="col-sm-12 col-md-12">
                        <div style="padding: 10px;">
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <div class="container-xl mt-2">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Remote Address </th>
                                    <th>Profile </th>
                                    <th>service </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($secret as $no => $data)
                                    <tr>
                                        <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                        <td class="text-muted">{{ $no+1 }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['password'] }}</td>
                                        <td>{{ $data['remote-address'] ?? 'none' }}</td>
                                        <td>{{ $data['profile'] }}</td>
                                        <td>{{ $data['service'] }}</td>
                                        <td>
                                            <a href="{{ route('dellsecret', ['id' => $data['.id']]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endsection
