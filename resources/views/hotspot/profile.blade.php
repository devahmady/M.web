@extends('app.main')
@section('header')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
        
           <a href="{{ route('hotspot.profile') }}" class="btn btn-primary d-none d-sm-inline-block m-1" data-bs-toggle="modal" data-bs-target="#modal-profile">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <circle cx="12" cy="12" r="9"></circle>
              <line x1="9" y1="12" x2="15" y2="12"></line>
              <line x1="12" y1="9" x2="12" y2="15"></line>
           </svg>
           Profile 
          </a>
          </h2>
          
        </div>
      </div>
    </div>
  </div>
<div class="container-xl mt-2">
    <div class="row row-cards">
        <div class="col-lg-8">
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>[ {{ $jumon }} ]</th>
                      <th>No</th>
                      <th>Name</th>
                      <th>Address Pool</th>
                      <th>Refres </th>
                      <th>Share User</th>
                      <th>parent queue</th>
                      <th>Rite Limit (rx/tx)</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($profileDetails as $no => $data)
                    <tr>
                        <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                        <td>
                          <a href="{{ route('delprofile', ['id' => $data['id']]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                            </a>
                        </td>
                       
                        <td class="text-muted">{{ $no+1 }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['address-pool'] ?? 'none' }}</td>
                        <td>{{ $data['status-autorefresh'] }}</td>
                        <td>{{ $data['shared-users'] }}</td>
                        <td>{{ $data['parent-queue'] ?? 'none' }}</td>
                        <td>{{ $data['rate-limit'] }}</td>
                    </tr>
                @endforeach
                
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h3 class="table table-vcenter card-table">Server</h3>
                <table class="table table-sm table-borderless">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>interface</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($server as $item)
                    <tr>
                      <td> {{ $item['name'] ?? ''}} </td>
                      <td> {{ $item['interface'] ?? ''}}</td>
                      <td>  <span class="status status-green">
                        Active
                            </span>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection