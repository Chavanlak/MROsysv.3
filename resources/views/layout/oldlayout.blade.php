<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ระบบแจ้งซ่อม')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Noto+Sans+Thai:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css"> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script> --}}
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        /* 1. Navbar: Fixed และมี z-index ปานกลาง */
        .navbar {
            background-color: #f5f7fa;
            z-index: 1000;
        }

        /* 2. Sidebar สำหรับ Desktop: แสดงถาวร (ถูกแก้ไข) */
        .sidebar {
            background-color: #ffffff;
            position: fixed;
            /* แก้ไขสำหรับ Desktop: ชิดขอบบนสุดและทับ Navbar */
            top: 0;
            left: 0;
            width: 200px;
            height: 100vh;
            /* ความสูงเต็มจอ */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-right: 1px solid #e9ecef;
            transition: all 0.3s ease;
            z-index: 1030;
            /* ทำให้ทับ Navbar (z-index: 1000) */
        }

        .sidebar .nav-link {
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 12px;
        }

        .sidebar .nav-link i {
            width: 20px;
        }

        .sidebar .nav-link.active {
            background-color: #e7f1ff;
            border-radius: 8px;
            color: #0d6efd;
        }

        /* 3. Content Area: ดันตาม Sidebar บน Desktop */
        .content-area {
            padding: 20px;
            /* ต้องมี margin-left เพื่อหลีกเลี่ยง Sidebar */
            margin-left: 200px;
            transition: margin-left 0.3s ease;
            /* เพิ่ม padding-top เพื่อหลีกเลี่ยง Navbar */
            padding-top: 80px;
        }

        /* Responsive (มือถือ/Tablet: max-width: 991px) */
        @media (max-width: 991px) {
            .content-area {
                margin-left: 0;
                padding: 15px;
                padding-top: 80px;
                /* รักษา padding-top สำหรับ Mobile ด้วย */
            }

            .sidebar {
                /* การตั้งค่า Mobile ยังคงเดิม (ทับ Navbar) */
                top: 0;
                height: 100vh;
                width: 65%;
                max-width: 230px;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
                display: none;
                z-index: 1050;
                overflow-y: auto;
            }

            /* ยกเลิกการซ่อนเมื่อ .active */
            .sidebar.active {
                display: block;
                animation: slideIn 0.3s ease forwards;
            }

            .search-container {
                /* ปกติจะซ่อนไว้บน Mobile/Tablet */
                display: none !important;
                position: absolute;
                /* กำหนดตำแหน่งให้ทับส่วนอื่นของ Navbar */
                top: 0;
                left: 0;
                width: 100%;
                padding: 0 15px;
                /* Padding ด้านข้าง */
                background-color: #f5f7fa;
                /* สีพื้นหลังเดียวกับ Navbar */
                height: 60px;
                /* ความสูงเพื่อให้ทับ Navbar */
                align-items: center;
                z-index: 999;
                /* ให้ต่ำกว่าปุ่มเมนู (1000) แต่สูงกว่าเนื้อหาอื่น */
            }

            /* คลาสที่จะใช้ JS สลับการแสดงผล */
            .search-container.active {
                display: flex !important;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1049;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* ซ่อนปุ่มค้นหา Mobile บน Desktop */
        .search-button-mobile {
            display: none !important;
        }

        /* แสดงปุ่มค้นหา Mobile บน Mobile */
        @media (max-width: 991px) {
            .search-button-mobile {
                display: block !important;
            }
        }

        /* **CSS แก้ไขตำแหน่ง Desktop Search** */
        @media (min-width: 992px) {
            .search-container {
                /* กำหนดจุดเริ่มต้นให้อยู่ด้านขวาของ Sidebar (200px) */
                margin-left: 210px !important;
                /* 200px + 10px spacing */

                /* จัดให้ช่องค้นหาอยู่ตรงกลางของพื้นที่ที่กำหนด */
                margin-right: auto !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
        <div class="container-fluid">

            {{-- ปุ่มสามขีด: d-lg-none คือ แสดงเฉพาะ Mobile/Tablet เท่านั้น --}}
            <button class="btn btn-link text-dark d-lg-none me-2" id="toggleSidebar">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>

            {{-- **ปุ่มค้นหา Mobile (แสดงเฉพาะ Mobile/Tablet)** --}}
            <button class="btn btn-link text-dark d-lg-none me-3 p-0 search-button-mobile" id="toggleSearch">
                <i class="bi bi-search" style="font-size: 1.2rem;"></i>
            </button>


            {{-- โลโก้แบรนด์ (ซ่อนโลโก้ใน Navbar เมื่อ Sidebar เปิดบน Desktop) --}}
            <a class="navbar-brand fw-bold d-flex align-items-center d-lg-none" href="{{ url('/dashboard') }}">
                {{-- <span>MRO</span> --}}
            </a>

            {{-- **ช่องค้นหา (แสดงบน Desktop และเปิดเมื่อกดปุ่มบน Mobile)** --}}
            {{-- ลบ margin-left ออก และลบ me-auto/m-auto เพื่อให้ CSS @media จัดการแทน --}}
            {{-- <div class="search-container d-none d-lg-flex" id="searchContainer">
                <form class="d-flex w-100" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="ค้นหา..." aria-label="Search"
                            style="min-width: 300px;">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    
                        <button class="btn btn-link text-dark d-lg-none" type="button" id="closeSearch">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </form>
            </div> --}}
            {{-- <div class="search-container d-none d-lg-flex" id="searchContainer">
              
                <form class="d-flex w-100" role="search" method="GET" action="{{ url('/noti') }}">
                    <div class="input-group">
                        <input class="form-control" type="search" name="search" placeholder="ค้นหา..." aria-label="Search"
                            style="min-width: 300px;" value="{{ request('search') }}"> 
                      
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        </div>
                </form>
            </div> --}}
            <div class="search-container d-none d-lg-flex" id="searchContainer">
                <form class="d-flex w-100" role="search" method="GET" action="{{ url('/noti') }}">
                    <div class="input-group">
                        <input class="form-control" type="search" name="search" placeholder="ค้นหา..." aria-label="Search"
                            style="min-width: 300px;" value="{{ request('search') }}"> 
                        
                        {{-- 1. ปุ่มค้นหา (Submit) --}}
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                        
                        {{-- 2. ปุ่มล้างการค้นหา (Clear Button) --}}
                        {{-- ปุ่มนี้จะแสดงก็ต่อเมื่อมีค่า 'search' อยู่ใน URL เท่านั้น --}}
                        @if (request('search'))
                            <a href="{{ url('/noti') }}" class="btn btn-outline-danger" title="ล้างการค้นหา">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ส่วนผู้ใช้งาน/ล็อกเอาต์ --}}
            <div class="d-flex align-items-center ms-auto">
                @auth
                    <span class="text-dark me-3 d-none d-sm-block">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i>ออกจากระบบ
                        </button>
                    </form>
                @else
                    <a href="#" class="btn btn-light btn-sm">เข้าสู่ระบบ</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="overlay" id="overlay"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar p-3" id="sidebarMenu">
                {{-- โลโก้ navbar Mobile (ถูกจัดให้อยู่ข้างใน Sidebar) --}}
                <div class="d-lg-none d-flex justify-content-between align-items-center mb-3">
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/MROlogo.png') }}" alt="TGI Logo" class="me-2" style="height: 35px;">
                    </a>

                    <button class="btn btn-link text-dark p-0" id="closeSidebar" aria-label="Close"
                        style="font-size: 1.5rem;">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                {{-- โลโก้ navbar Desktop (ถูกจัดให้อยู่ข้างใน Sidebar) --}}
                <div class="d-none d-lg-block mb-3">
                    <a class="navbar-brand fw-bold d-flex align-items-start" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/MROlogo.png') }}" alt="TGI Logo" style="height: 35px;">
                    </a>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->is('notirepair*') ? 'active' : '' }}"
                        href="{{ url('/notirepair') }}">
                        <i class="bi bi-list-task"></i> รายการแจ้งซ่อม
                    </a>
                    <a class="nav-link {{ request()->is('notirepair*') ? 'active' : '' }}"
                        href="{{ url('/notirepair') }}">
                        <i class="bi bi-clock-history"></i> ประวัติการแจ้งซ่อม
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i> ผู้ใช้งาน
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i> ตั้งค่า
                    </a>
                </nav>
            </div>

            {{-- <div class="col-lg-10 col-md-9 content-area"> --}}
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        // New elements for search functionality
        const toggleSearchBtn = document.getElementById('toggleSearch');
        const closeSearchBtn = document.getElementById('closeSearch');
        const searchContainer = document.getElementById('searchContainer');


        function toggleMenu() {
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
            }
        }
        function toggleSearch() {
            if (window.innerWidth < 992) {
                searchContainer.classList.toggle('active');

                // ซ่อน/แสดงปุ่มเมนูและโลโก้เมื่อช่องค้นหาเปิด
                const isSearchActive = searchContainer.classList.contains('active');
                toggleBtn.style.visibility = isSearchActive ? 'hidden' : 'visible';

                // ใช้ document.querySelector เพื่อหา navbar-brand ที่แสดงบน Mobile
                const mobileBrand = document.querySelector('.navbar-brand.d-lg-none');
                if (mobileBrand) {
                    mobileBrand.style.visibility = isSearchActive ? 'hidden' : 'visible';
                }

                // โฟกัส input เมื่อเปิดช่องค้นหา
                if (isSearchActive) {
                    searchContainer.querySelector('input[type="search"]').focus();
                }
            }
        }

        toggleBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
        if (closeBtn) {
            closeBtn.addEventListener('click', toggleMenu);
        }

        if (toggleSearchBtn) {
            toggleSearchBtn.addEventListener('click', toggleSearch);
        }

        if (closeSearchBtn) {
            closeSearchBtn.addEventListener('click', toggleSearch);
        }

        // รีเซ็ตการแสดงผลเมื่อปรับขนาดหน้าจอจาก Mobile ไป Desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                // ตรวจสอบและปิด search overlay หากเปิดอยู่
                if (searchContainer.classList.contains('active')) {
                    searchContainer.classList.remove('active');
                    toggleBtn.style.visibility = 'visible';
                    const mobileBrand = document.querySelector('.navbar-brand.d-lg-none');
                    if (mobileBrand) {
                        mobileBrand.style.visibility = 'visible';
                    }
                }
                // ตรวจสอบและปิด sidebar overlay หากเปิดอยู่
                if (sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
