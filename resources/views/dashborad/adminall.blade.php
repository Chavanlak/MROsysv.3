@extends('layout.adminlayout')
@section('title','รายการซ่อม')

@section('content')

    <h5 class="fw-bold text-dark mb-3">
        <p>Admin</p>
        @if (Auth::check())
            <span class="text-primary small fw-normal">{{ Auth::user()->staffname ?? 'ผู้ดูเเลระบบ'}}</span>
        @endif
    </h5>
    {{-- <hr class="my-5"> --}}

    <h3 class="mb-3"><i class="bi bi-table"></i>รายการการเเจ้งซ่อมทั้งหมด</h3>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>NotirepairId</th>
                    <th>equipmentId</th> 
                    <th>วันที่เเจ้งซ่อม</th>
                    <th>รายละเอียดการเเจ้งซ่อม</th>
                    <th>emailZone</th>
                    <th>emailสาขา</th>
                </tr>
            </thead>
            <tbody>
           
                @foreach($notirepairList as $item)
                <tr>
                    <td>{{ $item->NotirepairId}}</td> 
                    {{-- <td>{{ $item->equipmentId}}</td> --}}
                    <td value="{{ $item->equipmentId}}">{{ $item->equipmentName}}</td>
                    <td>{{ $item->DateNotirepair}}</td>
                    <td>{{ $item->DeatailNotirepair}}</td>
                    <td>{{ $item->zone}}</td>
                    <td>{{ $item->branch}}</td>
                
                </tr>
                @endforeach
    
          
            </tbody>
        </table>
    </div>

  
@endsection