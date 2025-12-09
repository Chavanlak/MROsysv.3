<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Icons (MDI) -->
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
            border: none;
        }

        .card-header {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .form-label i {
            color: #0d6efd;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        .btn-primary {
            font-weight: 500;
            font-size: 1.05rem;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            {{-- <a class="navbar-brand text-primary fw-bold" href="#">
            <i class="mdi mdi-wrench-outline"></i> MaintenanceRepairSystem
        </a> --}}
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('images/MROlogo.png') }}" alt="MRO Logo"
                 style="max-height: 50px; width: auto; margin-right: 8px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link d-flex align-items-center btn btn-link text-danger p-0">
                                <span class="mdi mdi-logout mdi-24px"></span>
                                <span class="ms-1">Logout</span>
    
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0"><i class="mdi mdi-clipboard-text"></i> ฟอร์มแจ้งซ่อม</h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- old --}}
                        {{-- <form action="/repair/submit" method="POST" onsubmit="return validateForm();"
                            enctype="multipart/form-data"> --}}
                        <form action="/repair/submit" method="POST" onsubmit="return disableSubmitButton(event);" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="submission_token" value="{{ $submissionToken }}">
                            {{-- <input type="hidden" name="branchname" value="{{ $branchname }}"> --}}
                            {{-- <input type="hidden" name="zonename" value="{{ $zonename }}"> --}}
                            <input type="hidden" name="branchid" value="{{ $branchid }}">
                            <input type="hidden" name="branch" value="{{ $branchname }}">
                            {{-- <input type="hidden" name="branchname" value="{{ $branchname}}"> --}}
                            <input type="hidden" name="zone" value="{{ $zonename }}">

                            {{-- <input type="hidden" name="name" value="{{ $name }}"> --}}

                            <!-- อุปกรณ์ -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-tools"></i> เลือกอุปกรณ์ที่ต้องการแจ้งซ่อม <span class="text-danger">*</span>
                                </label>
                                <select name="category" id="category" class="form-select" required>
                                    <option value="">-- เลือกอุปกรณ์ --</option>
                                    @foreach ($equipment as $eqm)
                                        <option value="{{ $eqm->equipmentId }}">{{ $eqm->equipmentName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- รายละเอียด -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-note-text-outline"></i> รายละเอียดแจ้งซ่อม <span class="text-danger">*</span>
                                </label>
                                <textarea name="detail" class="form-control" placeholder="ระบุรายละเอียด..." required></textarea>
                            </div>

                            <!-- อีเมลสาขา -->
                            {{-- <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="mdi mdi-email-outline"></i> เลือกอีเมลสาขา
                            </label>
                            <select name="email1" class="form-select" required>
                                <option value="">-- เลือกอีเมลสาขา --</option>
                                @foreach ($branchmail as $mail1)
                                    <option value="{{ $mail1->email }}">{{ $mail1->email }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                            {{-- ใช้อันนี้เมลสาขา --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-email-outline"></i> อีเมลสาขา
                                </label>
                                <!-- แสดงอีเมลที่ส่งมาจาก Controller โดยอัตโนมัติ -->

                                @if ($branchEmail === null)
                                    <input type="hidden" name="email1" value="example@mail.com">
                                    <p class="form-control-plaintext">ไม่มีอีเมลสาขา</p>
                                @else
                                    <input type="hidden" name="email1" value="{{ $branchEmail }}">
                                    <p class="form-control-plaintext">{{ $branchEmail }}</p>
                                @endif
                                <!-- ซ่อนค่าอีเมลไว้ใน hidden input เพื่อส่งข้อมูลไปกับฟอร์ม -->
                                {{-- <input type="hidden" name="email1" value="{{ $branchEmail}}"> --}}
                            </div>

                            <!-- อีเมลโซน -->
                            {{-- <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="mdi mdi-email-multiple-outline"></i> เลือกอีเมลโซน
                            </label>
                            <select name="email2" class="form-select" required>
                                <option value="">-- เลือกอีเมลโซน --</option>
                                @foreach ($zoneEmail as $mail2)
                                    <option value="{{ $mail2->email }}">{{ $mail2->email }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-email-multiple-outline"></i> อีเมลโซน
                                </label>
                                <!-- แสดงอีเมลที่ส่งมาจาก Controller โดยอัตโนมัติ -->
                                <p class="form-control-plaintext">{{ $zoneEmail }}</p>
                                <!-- ซ่อนค่าอีเมลไว้ใน hidden input เพื่อส่งข้อมูลไปกับฟอร์ม -->
                                <input type="hidden" name="email2" value="{{ $zoneEmail }}">
                            </div>

                            <!-- อีเมลแจ้งซ่อม -->
                            {{-- <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="mdi mdi-email-alert-outline"></i> เมลแจ้งซ่อม
                            </label>
                            <select name="email3" class="form-select" required>
                                <option value="">-- เลือกเมลแจ้งซ่อม --</option>
                                <option value="tanadesign.service@gmail.com">tanadesign.service@gmail.com - ตกแต่งภายใน</option>
                                <option value="pm2storetana@gmail.com">pm2storetana@gmail.com - เมลสโต</option>
                                <option value="chavanlak1806@gmail.com">chavanlak1806@gmail.com - dummy</option>
                            </select>
                        </div> --}}
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-email-alert-outline"></i> เมลแจ้งซ่อม
                                </label>
                                <!-- แสดงอีเมลที่ดึงมาโดยอัตโนมัติ -->
                                <p class="form-control-plaintext">{{ $emailRepair->emailRepair }}</p>
                                <!-- ซ่อนค่าอีเมลไว้ใน hidden input เพื่อส่งข้อมูลไปกับฟอร์ม -->
                                <input type="hidden" name="email3" value="{{ $emailRepair->emailRepair }}">
                            </div>

                            <!-- อัพโหลดไฟล์ -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="mdi mdi-file-image"></i> แนบรูปภาพ / วิดิโอ (ถ้ามี) <span
                                        class="text-danger">ไม่เกิน 5 ไฟล์</span>
                                </label>
                                <input type="file" name="filepic[]" class="form-control" multiple>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>

                            <!-- ปุ่ม -->
                            {{-- <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="mdi mdi-send"></i> ส่งข้อมูลแจ้งซ่อม
                            </button>
                        </div> --}}
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="/backtorepair" class="btn btn-secondary me-2">
                                    <i class="mdi mdi-arrow-left"></i> ย้อนกลับ
                                </a>
                                {{-- เพิ่ม id ตรงปุ่ม submit เพื่อป้องกันการส่งซ้ำของ javascript --}}
                                <button type="submit" id="submitBtn" class="btn btn-primary">
                                    <i class="mdi mdi-send"></i> ส่งข้อมูลแจ้งซ่อม
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h4>กำลังส่งข้อมูล กรุณารอ...</h4>
                    <p class="text-muted">อย่าปิดหรือรีเฟรชหน้านี้ในระหว่างที่ระบบกำลังประมวลผล</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- old --}}
    {{-- <script>
        function validateForm() {
            const category = document.getElementById('category').value;
            if (!category) {
                alert('กรุณาเลือกอุปกรณ์ที่ต้องการแจ้งซ่อม');
                return false;
            }
            return true;
        }
    </script> --}}

    {{-- ป้องกันการส่งซ้ำ มีปุ่มเเสดงกำลังส่ง--}}
    {{-- <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');

        function disableSubmitButton(event) {
           const category = document.getElementById('category').value;
            if (!category) {
                alert('กรุณาเลือกอุปกรณ์ที่ต้องการแจ้งซ่อม');
                event.preventDefault(); // ป้องกันการส่งฟอร์ม
                return false;
            }

            // ปิดการใช้งานปุ่ม submit เพื่อป้องกันการคลิกซ้ำ
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> กำลังส่ง...';

            return true; // อนุญาตให้ส่งฟอร์ม
        }
    </script> --}}
    {{-- ป้องกันการส่งซ้ำขึ้น popup  --}}
    {{-- <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
    
        function disableSubmitButton(event) {
            const category = document.getElementById('category').value;
            if (!category) {
                alert('กรุณาเลือกอุปกรณ์ที่ต้องการแจ้งซ่อม');
                event.preventDefault();
                return false;
            }
    
            // 💡 เรียก Bootstrap Modal ให้แสดงขึ้นมา
            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
                backdrop: 'static',
                keyboard: false
            });
            loadingModal.show();
    
            // ปิดการใช้งานปุ่ม Submit และเปลี่ยนข้อความ
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> กำลังส่ง...';
    
            return true;
        }
    </script> --}}
    <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
    
        // ฟังก์ชันสำหรับป้องกันการส่งซ้ำ
        function disableSubmitButton(event) {
            const category = document.getElementById('category').value;
            const detail = document.querySelector('[name="detail"]').value;
    
            // ตรวจสอบความถูกต้องของข้อมูลก่อน
            if (!category || !detail) {
                alert('กรุณาเลือกอุปกรณ์และระบุรายละเอียด');
                event.preventDefault();
                return false;
            }
    
            // แสดง Modal
            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
            loadingModal.show();
    
            // ปิดการใช้งานปุ่มและเปลี่ยนข้อความ
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> กำลังส่ง...';
    
            return true;
        }
    
        // เคลียร์ข้อมูลฟอร์มเมื่อรีเฟรชหน้า
        window.addEventListener('load', function() {
            form.reset();
        });
    </script>
</body>

</html>