<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Tech Test</title>
</head>
<body>
    <h1>รายการแจ้งซ่อม</h1>

    {{-- เพิ่มส่วนแสดงข้อความแจ้งเตือน (Success/Error) จาก Controller --}}
    @if (session('success'))
        <div style="color: white; background-color: green; padding: 10px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="color: white; background-color: red; padding: 10px; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- **จุดที่แก้ไข:** เปลี่ยน $notirepair เป็น $notirepairs เพื่อให้ตรงกับ Controller --}}
    @foreach ($notirepairs as $item)
        <div>
            <p>ID แจ้งซ่อม: **{{ $item->NotirepairId }}**</p>
            <p>สถานะปัจจุบัน: **{{ $item->ReciveStateFromBranch }}**</p>
            {{-- ใช้ Carbon Format สำหรับวันที่ หาก dateReceiveFromBranch ไม่ใช่ null --}}
            <p>วันที่ได้รับของจากสาขา: **
                @if ($item->dateReceiveFromBranch)
                    {{ \Carbon\Carbon::parse($item->dateReceiveFromBranch)->format('d/m/Y H:i:s') }}
                @else
                    ยังไม่ได้รับ
                @endif
            **</p>
            
            {{-- เงื่อนไข: แสดงปุ่ม "กดรับ" เฉพาะเมื่อสถานะยังเป็น 'ยังไม่ได้รับของ' --}}
            @if ($item->ReciveStateFromBranch == 'ยังไม่ได้รับของ')
                {{-- Form สำหรับส่งข้อมูลไปยัง Controller method submitRepair --}}
                <form action="{{ url('/submit-repair') }}" method="POST" style="display: inline;">
                    @csrf
                    
                    {{-- ส่ง NotirepairId ของรายการปัจจุบันไปด้วย --}}
                    <input type="hidden" name="NotirepairId" value="{{ $item->NotirepairId }}">
                    
                    <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; cursor: pointer;">**กดรับและเปลี่ยนสถานะเป็น "ได้รับของแล้ว"**</button>
                </form>
            @else
                <p style="color: green;">✅ ได้รับของแล้ว</p>
            @endif
        </div>
        <hr>
    @endforeach
    
</body>
</html>