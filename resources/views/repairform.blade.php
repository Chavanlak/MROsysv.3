<!-- resources/views/repair/form.blade.php -->
@extends('layout')

@section('content')
    <div class="container mt-4">
        <h3>แบบฟอร์มแจ้งซ่อม</h3>
        <p>สาขา: {{ session('selected_branch') }}</p>
        <p>Zone: {{ session('selected_zone') }}</p>
        <p>หมวดหมู่: {{ session('selected_category') }}</p>
        {{-- เพิ่มฟอร์มแจ้งซ่อมจริงต่อจากนี้ --}}
    </div>
@endsection
