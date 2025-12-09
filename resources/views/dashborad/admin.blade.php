@extends('layout.adminlayout') {{-- 💡 เปลี่ยนมาใช้ Layout ใหม่ที่กำหนด staffname และ Logout --}}

@section('title', 'รายการแจ้งซ่อม')

@section('content')

    <h5 class="fw-bold text-dark mb-3">
        {{-- <i class="bi bi-list-task"></i> ADMIN --}}
        <p>Admin</p>
        {{-- ✅ เพิ่มการแสดงชื่อผู้ใช้งานในส่วน Content ตามคำขอ --}}
        @if (Auth::check())
            <span class="text-primary small fw-normal">({{ Auth::user()->staffname ?? 'ผู้ดูแลระบบ' }})</span>
        @endif
    </h5>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Desktop View --}}
    {{-- <div>

        <a href="/addemail" class="btn btn-primary btn-lg">
            <span class="mdi mdi-plus"></span> เพิ่ม Email
        </a>
        <input type="text">
     
    </div> --}}
    <form action="/emailpost" method="POST">
        @csrf {{-- อย่าลืม CSRF Token สำหรับ Laravel --}}
        
        <div class="mb-3">
            <label for="emailRepair">อีเมล:</label>
            {{-- ชื่อของ Input ต้องตรงกับที่เราเรียกใช้ใน Controller (emailRepair) --}}
            
            <input type="email" name="emailRepair" id="emailRepair" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">บันทึกอีเมล</button>
    </form>
    <form action="/typenamepost" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">ชื่อประเภทอุปกรณ์</label>
            <input type="text" name="typeName" id="typeName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="emailRepairId" class="form-lable">ผูกกับอีเมล</label>
            <select name="emailRepairId" id="emailRepairId" class="form-select" required>
                <option value="">-- กรุณาเลือกอีเมล --</option>
                @foreach ($emails as $email)
                    {{-- <option value="{{$email->emailRepairId}}">{{$email->emailRepairId}}</option> --}}
                    <option value="{{$email->emailRepairId}}">{{$email->emailRepair}}</option>

                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">บันทุึกประเภทอุปกรณ์</button>
    </form>

    <form action="/equipmentpost" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">ชื่ออุปกรณ์</label>
            <input type="text" name="equipment" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="" class="">ผูกประเภทอุปกรณ์</label>
            {{-- ส่งข้อมูลไปบันทึก name ต้องตรงกับ ใน controller getEquipmentByAdmin  $typeId = $request->typeId; --}}
            {{-- Blade (name="typeId") ---> ส่งไป ---> Controller ($request->typeId) --}}
            <select name="typeId" id="typeId" class="form-select" required>
                <option value="">-- กรุณาเลือกประเภทอุปกรณ์ --</option>
                    @foreach ($types as $type)
                    {{-- มากจาก controller showemail --}}
                    {{-- Database (TypeId) ---> ส่งไป ---> Blade ($type->TypeId) --}}
                        <option value="{{$type->TypeId}}">{{$type->TypeName}}</option>
                    @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">บันทึกอุปกรณ์</button>
    </form>
    <hr class="my-5">

    <h3 class="mb-3"><i class="bi bi-table"></i> รายการอุปกรณ์ทั้งหมด</h3>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th style="width: 20px;">ID</th>
                    <th style="width: 150px;">ชื่ออุปกรณ์</th>
                    <th style="width: 150px;">ประเภท (TypeName)</th>
                    <th style="width: 50px;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                {{-- วนลูปข้อมูล $equipments ที่ส่งมาจาก Controller --}}
                @foreach($equipments as $item)
                <tr>
                    <td>{{ $item->equipmentId }}</td>
                    <td>{{ $item->equipmentName }}</td>
                    
                    {{-- ตรงนี้โชว์ชื่อประเภทได้ เพราะเรา Join มาแล้ว --}}
                    <td>
                        <span class="badge bg-info text-dark">{{ $item->TypeName}}</span>
                    </td>
                    
                    <td>
                        {{-- ปุ่มลบ (ตามที่เราคุยกันเมื่อกี้) --}}
                        <a href="/deleteequipment/{{ $item->equipmentId }}" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('ยืนยันที่จะลบ {{ $item->equipmentName}} หรือไม่?');">
                            ลบ
                        </a>
                        <a href="" 
                            class="btn btn-warning btn-sm"
                            onclick="return confirm('ยืนยันที่จะเเก้ไข {{ $item->equipmentName}} หรือไม่?');">
                             เเก้ไข
                         </a>
                    </td>
                </tr>
                @endforeach
    
                {{-- กรณีไม่มีข้อมูล --}}
                @if($equipments->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-muted">ไม่พบข้อมูลอุปกรณ์</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection
