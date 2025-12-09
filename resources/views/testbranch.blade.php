{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($branches as $bb)
      <p>{{$bb->MBranchInfo_Code }}</p>
      <p>{{$bb->MBranchInfo_Name }}</p>
  @endforeach
</body>
</html> --}}
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
<div class="card">
    <div class="card-header">
      เลือกสาขาที่คุณต้องการ
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>กรุณาเลือกสาขา</p>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
              สาขา
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
              <li><a class="dropdown-item active" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
    </div>
    {{-- <div class="form-group my-3">
        <label for="branches" class="required">กรุณาเลือกสาขาที่คุณใช้บริการในครั้งนี้</label>
       
        <select name="branches" id="branches">
          
            @foreach ($branch as $bb)
                <option value="{{ $bb->MBranchInfo_Code }}">{{ $bb->Location }}</option>
            @endforeach
        </select>
    </div> --}}
        {{-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer> --}}
      </blockquote>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>กรุณาเลือกโซน</p>
          <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                zone
              </button>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item active" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>
      </div>
          {{-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer> --}}
        </blockquote>
      </div>
  </div>

   

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
