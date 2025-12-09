<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>รายละเอียดแจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <h3>รายละเอียดแจ้งซ่อม</h3>

    <table class="table table-bordered mb-4">
        <tr>
            <th>รหัสแจ้งซ่อม</th>
            <td>{{$recivenoti->NotirepairId}}</td>
        </tr>
        <tr>
            <th>อุปกรณ์</th>
            <td>{{$recivenoti->equipmentId}}</td>
        </tr>
        <tr>
            <th>รายละเอียด</th>
            <td>{{$recivenoti->DeatailNotirepair}}</td>
        </tr>
        <tr>
            <th>วันที่แจ้ง</th>
            <td>{{$recivenoti->DateNotirepair}}</td>
        </tr>
        <tr>
            <th>สถานะ</th>

            <td><a href={{"/recive/".$recivenoti->NotirepairId}}>ยืนยัน</a></td>
        </tr>
    </table>
    <hr>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{url()->previous()}}" class="btn btn-secondary">ย้อนกลับ</a>
    </table>


</body>

</html>