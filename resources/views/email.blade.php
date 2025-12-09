{{-- <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Tahoma, sans-serif; line-height: 1.6; color: #333; }
        .container { padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        .title { font-size: 20px; font-weight: bold; color: #0066cc; margin-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .files { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">📢 แจ้งซ่อมอุปกรณ์</div>

        <p><span class="label">เรื่อง:</span>emmmm</p>
        @isset($senderName)
            <p><span class="label">ผู้แจ้ง:</span>ไผ</p>
        @endisset

        <p><span class="label">วันที่:</span> {{ now()->format('d/m/Y H:i') }}</p>

        <div class="files">
            <p><span class="label">ไฟล์แนบ:</span> ดูที่แนบในอีเมลนี้</p>
        </div>
    </div>
</body>
</html> --}}

<!-- resources/views/mailform.blade.php -->
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="subject" placeholder="เรื่องแจ้งซ่อม" class="form-control mb-2" required>
        <input type="text" name="from" placeholder="อีเมลผู้แจ้ง (หลายคนคั่นด้วย ,)" class="form-control mb-2" required>
        <textarea name="message" placeholder="รายละเอียดปัญหา" class="form-control mb-2" required></textarea>
        <input type="file" name="attachments[]" multiple class="form-control mb-3">
        <button type="submit" class="btn btn-primary">ส่งแจ้งซ่อม</button>
    </form>

</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Icons (MDI) -->
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">MaintenanceRepairSystem</a>

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right-side content -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="/logout" title="Logout">
                        <span class="mdi mdi-logout mdi-24px"></span>
                        <span class="ms-1 d-none d-lg-inline">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>

</nav>



</body>
</html> --}}
{{-- @extends('layout.mainlayout')

@section('content')
<div class="card">

    <div class="card-body">
        <blockquote class="blockquote mb-0">

            <form action="/repair/submit" method="POST" onsubmit="return validateForm();"
                class="p-3 bg-light rounded shadow-sm " enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="">อีเมลผู้แจ้ง</label>
                    <input type="text" name="from" placeholder="อีเมลผู้แจ้ง (หลายคนคั่นด้วย ,)" class="form-control mb-2" required>
                </div>

                <div class="mb-3">
                    <label for="">อีเมลผู้รับ</label>
                    <input type="text" name="from" placeholder="อีเมลผู้รับ (หลายคนคั่นด้วย ,)" class="form-control mb-2" required>
                </div>
                <div class="mb-3">
                    <label for="branch" class="form-label fw-bold">
                        <i class="mdi mdi-office-building-marker-outline"></i> กรุณาเลือกอีเมลผู้รับ
                    </label>
                    <select name="branch" id="branch" class="form-select" required>
                        <option value="">-- เลือกอีเมล --</option>

                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-arrow-right-bold-circle-outline"></i> ไปต่อ
                    </button>
                </div>
            </form>

    </div>
</div>
@endsection --}}

{{--
<p>From: {{ config('mail.from.address') }} ({{ config('mail.from.name') }})</p>
<p>To: repaircentertgi@gmail.com</p>

Hey {{$name}},
HI
Pol --}}

{{-- yo {{$name}},
Hi 

 --}}
 <!DOCTYPE html>
 <html lang="th">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ส่งแจ้งซ่อมเรียบร้อย</title>
 
     <!-- Bootstrap 5 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Material Design Icons -->
     <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
 
     <style>
         body {
             background-color: #f8f9fa;
         }
         .success-icon {
             font-size: 4rem;
             color: #28a745;
         }
     </style>
 </head>
 <body>
 
 <div class="container text-center mt-5">
     <div class="card shadow-sm p-4 border-0 rounded-4">
         <div class="mb-3">
             <i class="mdi mdi-check-circle-outline success-icon"></i>
         </div>
         <h2 class="text-success fw-bold">ส่งแจ้งซ่อมเรียบร้อย!</h2>
         <p class="text-muted">ระบบได้ส่งข้อมูลการแจ้งซ่อมไปยังอีเมลที่เกี่ยวข้องแล้ว</p>
         <p class="text-muted">กรุณารอการติดต่อกลับจากเจ้าหน้าที่</p>
         {{-- <div class="mt-4">
             <a href="/repair" class="btn btn-primary">
                 <i class="mdi mdi-arrow-left"></i> กลับไปหน้าแจ้งซ่อม
             </a>
             <a href="/" class="btn btn-outline-secondary">
                 <i class="mdi mdi-home"></i> กลับหน้าหลัก
             </a>
         </div> --}}
     </div>
 </div>
 
 <!-- Bootstrap 5 JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
 </body>
 </html>
 