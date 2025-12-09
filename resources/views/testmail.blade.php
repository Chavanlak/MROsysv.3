{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>email</title>
</head>
<style>
    body{
        font-family: 'Inter',sans-serif;
        padding: 30px;
        background-color:white;
    }
    .citrianer{
        text-align: :center;
        font-size:20px;
        color:#000011;
        font-weight:600;
    }
    .box{
        width:100%;
        height:100%;
        background-color:#white;
        padding:20px;
        border-radius:10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top:20px;
        margin-bottom:20px;
        text-align:center;
        font-size;18px;
        color:#000011;
    }
    
</style>
<body>
    <p>select yout  email </p>
    <div class="box">
        <p class="citrianer">ยินดีต้อนรับ คุณ {{ session('staffname') }}</p>
        <p>คุณเข้าสู่ระบบแล้ว</p>
        <a href="/logout" class="btn btn-danger mt-3">ออกจากระบบ</a>
    </div>
    <div>
        <p class="citrianer">This is a test email</p>
        <p>Thank you for using our service.</p>
        <p>Best regards,</p>
        <p>Your Company Name</p>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </body>

</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($branches as $mn)
      <p>{{$mn->email }}</p>
   
  @endforeach
</body>
</html> --}}
<div class="mb-3">
    <label for="category" class="form-label fw-bold">
        <i class="mdi mdi-wrench-outline"></i> เลือกอุปกรณ์ที่ต้องการเเจ้งซ่อม
    </label>
    <select name="category" id="category" class="form-select" required>
        <option value="">-- เลือกเมลสาขา--</option>
        
        @foreach ($branchmail as $mail)
            <option value="{{ $mail->email }}">{{ $mail->email }}</option>
        @endforeach
    </select>
</div>