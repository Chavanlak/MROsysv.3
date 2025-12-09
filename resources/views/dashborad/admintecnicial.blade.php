<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Technician Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { background-color: #f8f9fa; font-family: "Prompt", sans-serif; }
    .navbar { z-index: 1030; }

    /* Content */
    .content {
      padding-top: 90px;
      padding-left: 260px;
      transition: all 0.3s ease;
    }

    /* Sidebar Desktop */
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      padding-top: 60px;
    }

    .sidebar a {
      color: #adb5bd;
      display: block;
      padding: 12px 20px;
      text-decoration: none;
      border-radius: 6px;
      transition: 0.2s;
    }

    .sidebar a:hover, .sidebar a.active {
      background-color: #495057;
      color: #fff;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
      .sidebar { display: none; }
      .content { padding-left: 0; padding-top: 70px; }
    }

    /* Status box */
    .status-box {
      border-radius: 10px;
      background: white;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      height: 100%;
    }

    .status-btn {
      width: 100%;
      border-radius: 8px;
      font-weight: 500;
    }

    .date-label {
      font-size: 0.9rem;
      color: #6c757d;
    }
    /* .status-btn { border-left: 5px solid #0684d8; } */
    .status-fail { border-left: 5px solid #0684d8; }
    .status-complete { border-left: 5px solid #28a745; }
    .status-pending { border-left: 5px solid #ffc107; }
    /* .status-fail { border-left: 5px solid #dc3545; } */
    

    /* Offcanvas Mobile Sidebar */
    .offcanvas-start {
      width: 75%;
      max-width: 300px;
      background-color: #343a40 !important;
      padding-top: 20px;
    }

    .offcanvas-body a {
      display: flex;
      align-items: center;
      padding: 10px 15px;
      margin-bottom: 6px;
      border-radius: 8px;
      color: #adb5bd;
      font-weight: 500;
      text-decoration: none;
    }

    .offcanvas-body a:hover {
      background-color: #495057;
      color: #fff;
    }

    .offcanvas-body a.active {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>

  <!-- 🔹 Navbar -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Mobile Sidebar Toggle -->
      <button class="btn btn-outline-light d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
        ☰
      </button>
      <a class="navbar-brand ms-2" href="#">Technician Dashboard</a>

      <div class="dropdown ms-auto">
        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
          👤 Admin
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Login</a></li>
          <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 🔹 Sidebar Desktop -->
  <div class="sidebar d-none d-md-block">
    <a href="#" class="active">🏠 Dashboard</a>
    <a href="#">👨‍🔧 Technician Jobs</a>
    <a href="#">📦 Supplier</a>
    <a href="#">📊 Reports</a>
    <a href="#">⚙️ Settings</a>
  </div>

  <!-- 🔹 Offcanvas Mobile Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-white">Menu</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <a href="#" class="active">🏠 Dashboard</a>
      <a href="#">👨‍🔧 Technician Jobs</a>
      <a href="#">📦 Supplier</a>
      <a href="#">📊 Reports</a>
      <a href="#">⚙️ Settings</a>
    </div>
  </div>

  <!-- 🔹 Content -->
  <div class="content container-fluid">
    <h4 class="mb-4 fw-bold">Technician Job Status</h4>

    <div class="row g-3">
      <div class="col-md-4">
        <div class="status-box status-fail">
          <h5>📦 รับของจากสาขา</h5>
          <button class="btn btn-primary status-btn mt-2" onclick="updateReceiveDate()" id="receiveBtn">กดรับ</button>
          <p class="mt-2 date-label" id="receiveDate">ยังไม่ได้อัปเดต</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="status-box status-pending">
          <h5>🚚 ส่งของให้ Supplier</h5>
          <button class="btn btn-warning status-btn mt-2" onclick="updateDate('sentDate')">ส่ง Sub</button>
          <p class="mt-2 date-label" id="sentDate">ยังไม่ได้อัปเดต</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="status-box status-complete">
          <h5>🔧 Supplier ซ่อมเสร็จ</h5>
          <button class="btn btn-success status-btn mt-2" onclick="updateDate('completeDate')">เรียบร้อย</button>
          <p class="mt-2 date-label" id="completeDate">ยังไม่ได้อัปเดต</p>
        </div>
      </div>
    </div>

    <div class="mt-4 text-end">
      <button class="btn btn-primary px-4" onclick="saveJobData()">💾 บันทึกข้อมูล</button>
    </div>
  </div>

  <script>
    // ฟังก์ชันอัปเดตเวลา
    function updateDate(id) {
      const now = new Date();
      const formatted = now.toLocaleString('th-TH', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
      });
      document.getElementById(id).textContent = "อัปเดตเมื่อ: " + formatted;
    }

    // ฟังก์ชันเฉพาะของปุ่ม "รับของ"
    function updateReceiveDate() {
      updateDate('receiveDate');
      document.getElementById("receiveBtn").disabled = true;
    }

    // ฟังก์ชันบันทึกข้อมูล (ตัวอย่างใช้ Fetch API ส่งไป Laravel)
    function saveJobData() {
      const data = {
        receiveDate: document.getElementById('receiveDate').textContent,
        sentDate: document.getElementById('sentDate').textContent,
        completeDate: document.getElementById('completeDate').textContent,
      };

      fetch('/api/save-job-status', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}' // ใช้กับ Laravel
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(response => {
        alert("✅ บันทึกข้อมูลเรียบร้อยแล้ว!");
      })
      .catch(err => {
        alert("❌ เกิดข้อผิดพลาดในการบันทึกข้อมูล");
      });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
