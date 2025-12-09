


<!DOCTYPE html>
<html lang="th">
<head>
    
    <meta charset="UTF-8">
    <title>หน้ารายการแจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        /* body {
            font-family: 'Inter', sans-serif;
            padding: 30px;
        } */
        body {
            font-family: 'Inter', sans-serif;
            padding: 30px;
            background-color: white;
        }

        .nav-item img {
            width: 30px;
            height: 30px;
            object-fit: cover;
        }

        .dropdown-menu {
            min-width: 200px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
        }

        .dropdown-item i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    {{-- <div class="container text-center">
        <h2>ยินดีต้อนรับ คุณ {{ session('staffname') }}</h2>
        <p>คุณเข้าสู่ระบบแล้ว</p>
        <a href="/logout" class="btn btn-danger mt-3">ออกจากระบบ</a>
    </div> --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo or Brand -->
            <a class="navbar-brand" href="#">MantananceRepairSystem</a>
    
            <!-- Responsive Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                
            </button>
    
            <!-- Navbar Links + User Icon -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="/logout" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/user.png" alt="User" class="rounded-circle">
                            
                        </a>
                        {{-- <a href="/logout"><span class="mdi mdi-logout"></span></a> --}}
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MDI Icon -->
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">MRS</a>

        <!-- Hamburger Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Nav Items -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Repair</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">History</a>
                </li>
            </ul>

            <!-- Right Icon -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="/logout" title="Logout">
                        <span class="mdi mdi-logout mdi-24px"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap 5 JS (include Popper!) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> --}}
