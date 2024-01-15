@extends('app.main')
@section('header')
<div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users Online</h3>
              </div>
          <div class="card-body">
            <div id="table-default" class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th><button class="table-sort" data-sort="sort-name">No</button></th>
                    <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                    <th><button class="table-sort" data-sort="sort-type">Server</button></th>
                    <th><button class="table-sort" data-sort="sort-score">Address</button></th>
                    <th><button class="table-sort" data-sort="sort-score">Mac-Address</button></th>
                    <th><button class="table-sort" data-sort="sort-date">Uptime</button></th>
                    <th><button class="table-sort" data-sort="sort-quantity">Rx Rate</button></th>
                    <th><button class="table-sort" data-sort="sort-progress">TX Rate</button></th>
                    <th><button class="table-sort" data-sort="sort-progress">Status</button></th>
                  </tr>
                </thead>
                <?php 
                // function formatBytes($bytes, $decimal = null){
                //   $satuan =['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
                //   $i = 0;
                //   while ($bytes > 1024 ){
                //     $bytes /= 1024;
                //     $i++;
                //   }
                //   return round($bytes, $decimal) . $satuan[$i];
                // } 
                
                // function angkaAja($bytes, $decimal = null){
                //   $satuan =['Bytes', 'Kb', 'Mb', 'Gb', 'Tb'];
                //   $i = 0;
                //   while ($bytes > 1024 ){
                //     $bytes /= 1024;
                //     $i++;
                //   }
                //   return round($bytes, $decimal);
                // } 
                
              ?>   
                <tbody class="table-tbody">
                    @foreach ($hotspotactive as $no => $data)
                    <tr>
                        <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                        <td> {{ $no+1 }} </td>
                        <td> {{ $data['user']}} </td>
                        <td> {{ $data['server']}} </td>
                        <td> {{ $data['address']}} </td>
                        <td> {{ $data['mac-address']}} </td>
                        <td> {{ \App\Helpers\RouterOs::formatUptime($data['uptime'])}} </td>
                        <td>{{  \App\Helpers\RouterOs::bytes($data['bytes-in'],2)}}</td>       
                        <td>{{  \App\Helpers\RouterOs::bytes($data['bytes-out'],2)}}</td>      
                        <td> 
                        <span class="status status-green">
                            Active
                        </span></td>
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
  </div>
@endsection