@extends('app.main')
@section('header')
    <div class="col-12">
        <form class="card" method="post" action="{{ route('add.profile.pppoe') }}">
            @csrf
            <div class="card-body">
                <h3 class="card-title">Add Profile</h3>
                <div class="row row-cards">
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    {{-- @dd($pool) --}}

                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Local Address</label>
                            <input type="text" list="pool_list" class="form-control" id="local" name="local"
                                placeholder="Enter or select" autocomplete="new_name">
                            <datalist id="pool_list">
                                <!-- Opsi dari select dropdown -->
                                @foreach ($pool as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Local Address</label>
                            <input type="text" list="pool_list" class="form-control" id="remote" name="remote"
                                placeholder="Enter or select" autocomplete="new_name">
                            <datalist id="pool_list">
                                <!-- Opsi dari select dropdown -->
                                @foreach ($pool as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Parent Queue</label>
                            <select name="parentqq" id="parentqq" class="form-select">
                                <option>none</option>
                                @foreach ($parent as $data)
                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Rite Limit (rx/tx)</label>
                            <input type="text" class="form-control" id="ratelimit" name="ratelimit">
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
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
                                    <th>Local Address</th>
                                    <th>Remote Address </th>
                                    <th>parent queue</th>
                                    <th>Rite Limit (rx/tx)</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($profile) > 0)
                                    @foreach ($profile as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td class="text-muted">{{ $no + 1 }}</td>
                                            <td>{{ $data['name'] }}</td>
                                            <td>{{ $data['local-address'] ?? 'none' }}</td>
                                            <td>{{ $data['remote-address'] }}</td>
                                            <td>{{ $data['parent-queue'] ?? 'none' }}</td>
                                            <td>{{ $data['rate-limit'] }}</td>
                                            <td>
                                                <a href="{{ route('dellprofile', ['id' => $data['.id']]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-trash" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7">
                                                        </line>
                                                        <line x1="10" y1="11" x2="10" y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14" y2="17">
                                                        </line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">profile not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endsection
