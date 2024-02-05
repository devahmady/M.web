{{-- add user hotspot --}}
{{-- <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hotspot.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <div class="input-group input-group-flat">
                                        <input id="user" name="user" type="text" class="form-control ps-0"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat">
                                        <input id="password" name="password" type="text" class="form-control ps-0"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Server</label>
                                <select id="server" name="server" class="form-select">
                                    @foreach ($server as $data)
                                        <option selected>{{ $data['name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Profile</label>
                                <select id="profile" name="profile" class="form-select">
                                    @foreach ($profile as $data)
                                        <option selected>{{ $data['name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Comentar</label>
                                <input id="comment" name="comment" type="text" class="form-control ps-0"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">add</button>
                </div>
        </div>
        </form>
    </div>
</div> --}}
{{-- end --}}

{{-- add user generate --}}
{{-- <div class="modal modal-blur fade" id="modal-users" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('generate') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="form-selectgroup-boxes row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="pilih" value="1"
                                            class="form-selectgroup-input" checked="">
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
                                        <input type="radio" name="pilih" value="2"
                                            class="form-selectgroup-input">
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
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Users</label>
                                    <select class="form-select" name="jumlah" id="jumlah">
                                        <?php
                                        for ($i = 1; $i <= 255; $i++) {
                                            echo " <option> $i </option>  ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Server</label>
                                <select id="server" name="server" class="form-select">
                                    @foreach ($server as $data)
                                        <option selected>{{ $data['name'] ?? '' }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Profile</label>
                                <select id="profile" name="profile" class="form-select">
                                    @foreach ($profile as $data)
                                        <option selected>{{ $data['name'] ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Comentar</label>
                                <input id="comment" name="comment" type="text" class="form-control ps-0"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">add</button>
                </div>
        </div>
        </form>
    </div>
</div> --}}
{{-- end --}}
<div class="modal modal-blur fade" id="modal-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add.profile') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>

                                   
                                    <div class="mb-3">
                                        <label class="form-label">Address Pool</label>
                                        <select name="ppool" id="ppool" class="form-select">
                                            <option>none</option>
                                            @foreach ($addressPools as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Shared Users</label>
                                        <input type="text" name="sharedusers" id="sharedusers" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rate Limit</label>
                                        <input type="text" name="ratelimit" id="ratelimit" class="form-control">
                                    </div>

                                   
                                    <div class="mb-3">
                                        <label class="form-label">Parent Queue</label>
                                        <select name="parentqq" id="parentqq" class="form-select">
                                            <option>none</option>
                                            @foreach ($parentq as $data)
                                                <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
