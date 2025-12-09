{{-- 
@extends('layout.mainlayout.blade')

@section('content')
    <div class="container mt-4">
        <h3>แบบฟอร์มแจ้งซ่อม</h3>
        <p>สาขา: {{ session('selected_branch') }}</p>
        <p>Zone: {{ session('selected_zone') }}</p>
        <p>หมวดหมู่: {{ session('selected_category') }}</p>
   
    </div>
@endsection --}}
<!-- resources/views/repair/form.blade.php -->
@extends('layout.mainlayout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>แบบฟอร์มแจ้งซ่อม</h3>
            <p>สาขา: {{ session('selected_branch') }}</p>
            <p>Zone: {{ session('selected_zone') }}</p>
            <p>หมวดหมู่: {{ session('selected_category') }}</p>

            {{-- ฟอร์มแจ้งซ่อมจะเริ่มที่นี่ --}}
            <form action="/submit-repair" method="POST" class="p-3 bg-light rounded shadow-sm w-50">
                @csrf
                {{-- เพิ่ม field ตามที่คุณต้องการ --}}
                <div class="mb-3">
                    <label for="detail" class="form-label">รายละเอียดการแจ้งซ่อม</label>
                    <textarea name="detail" id="detail" class="form-control" rows="4" required></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> ส่งแจ้งซ่อม
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
