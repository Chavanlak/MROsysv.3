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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
   


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
            top: 0;
            left: 0;
            width: 200px;
            height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-right: 1px solid #e9ecef;
            transition: all 0.3s ease;
            z-index: 1030;
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
            margin-left: 200px;
            transition: margin-left 0.3s ease;
            padding-top: 80px;
        }

        /* Responsive (มือถือ/Tablet: max-width: 991px) */
        @media (max-width: 991px) {
            .content-area {
                margin-left: 0;
                padding: 15px;
                padding-top: 80px;
            }

            .sidebar {
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
                display: none !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 0 15px;
                background-color: #f5f7fa;
                height: 60px;
                align-items: center;
                z-index: 999;
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

        /* CSS แก้ไขตำแหน่ง Desktop Search */
        @media (min-width: 992px) {
            .search-container {
                margin-left: 210px !important;
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

            {{-- ปุ่มค้นหา Mobile (แสดงเฉพาะ Mobile/Tablet) --}}
            <button class="btn btn-link text-dark d-lg-none me-3 p-0 search-button-mobile" id="toggleSearch">
                <i class="bi bi-search" style="font-size: 1.2rem;"></i>
            </button>


            {{-- โลโก้แบรนด์ --}}
            <a class="navbar-brand fw-bold d-flex align-items-center d-lg-none" href="{{ url('/dashboard') }}">
                {{-- <span>MRO</span> --}}
            </a>

            {{-- ช่องค้นหา (แสดงบน Desktop และเปิดเมื่อกดปุ่มบน Mobile) --}}
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
                        @if (request('search'))
                            <a href="{{ url('/noti') }}" class="btn btn-outline-danger" title="ล้างการค้นหา">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif

                        {{-- 3. ปุ่มปิดช่องค้นหา (Mobile only) --}}
                        <button class="btn btn-link text-dark d-lg-none" type="button" id="closeSearch">
                            <i class="bi bi-x-lg"></i>
                        </button>

                    </div>
                </form>
            </div>

            {{-- ส่วนผู้ใช้งาน/ล็อกเอาต์ --}}
            <div class="d-flex align-items-center ms-auto">
                @auth
                    {{-- Dropdown สำหรับผู้ใช้งานที่ล็อกอินแล้ว --}}
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center border" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="userProfileDropdown">
                            {{-- Icon และชื่อผู้ใช้ (ซ่อนชื่อบน Mobile เล็ก) --}}
                            <i class="bi bi-person-circle me-1" style="font-size: 1.2rem;"></i>
                            <span class="d-none d-sm-block">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userProfileDropdown">
                            {{-- ส่วนหัวข้อมูลผู้ใช้: ใช้ staffname หากมี หรือใช้ name --}}
                            <li>
                                <div class="px-3 pt-2 pb-1 text-muted small">
                                    เข้าสู่ระบบในชื่อ: <br>
                                    {{-- **จุดแก้ไข: ให้ใช้ staffname หากมี, ถ้าไม่มีให้ใช้ name** --}}
                                    <strong class="text-dark">
                                        {{ Auth::user()->staffname ?? Auth::user()->name }}
                                    </strong>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            {{-- รายการเมนู --}}
                            <li><a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>โปรไฟล์ของฉัน
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i>ตั้งค่าบัญชี
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            {{-- ปุ่มออกจากระบบ --}}
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>ออกจากระบบ
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Dropdown สำหรับ Guest (ตามที่ผู้ใช้ร้องขอ) --}}
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center border" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="guestProfileDropdown">
                            {{-- Icon และชื่อผู้ใช้ (ซ่อนชื่อบน Mobile เล็ก) --}}
                            <i class="bi bi-person-circle me-1 text-secondary" style="font-size: 1.2rem;"></i>
                            <span class="d-none d-sm-block">ชวัลลักษณ์ เพชรอย่างดี</span>
                            {{-- <span class="d-none d-sm-block">staffname</span> --}}
                            {{-- <input type="hiddien" class="" name> --}}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="guestProfileDropdown">
                            <li>
                                <div class="px-3 pt-2 pb-1 text-muted small">
                                    สถานะ: <br>
                                    <strong class="text-dark">Admin(IT)</strong>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item fw-bold text-danger" href="{{ route('logout') ?? url('/logout') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>ออกจากระบบ
                            </a></li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="overlay" id="overlay"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar p-3" id="sidebarMenu">
                {{-- โลโก้ navbar Mobile --}}
                <div class="d-lg-none d-flex justify-content-between align-items-center mb-3">
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/MROlogo.png') }}" alt="TGI Logo" class="me-2" style="height: 35px;">
                    </a>

                    <button class="btn btn-link text-dark p-0" id="closeSidebar" aria-label="Close"
                        style="font-size: 1.5rem;">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                {{-- โลโก้ navbar Desktop --}}
                <div class="d-none d-lg-block mb-3">
                    <a class="navbar-brand fw-bold d-flex align-items-start" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/MROlogo.png') }}" alt="TGI Logo" style="height: 35px;">
                    </a>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->is('notirepair') ? 'active' : '' }}"
                        href="{{ url('/notirepair') }}">
                        <i class="bi bi-list-task"></i> รายการแจ้งซ่อม
                    </a>
                    <a class="nav-link {{ request()->is('notirepair/history') ? 'active' : '' }}"
                        href="{{ url('/notirepair/history') }}">
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