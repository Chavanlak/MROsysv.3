
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    
    <!-- Tailwind CSS for modern styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <title>Login</title>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* background-color: #f8f9fa; */
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
        }

        .mdi {
            font-size: 48px;
            color: #0579f5;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-login {
            background-color: #0579f5;
            color: #fff;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #025fd1;
        }
    </style>
</head>

<body>
    {{-- <div class="flex justify-center items-center mt-8">
        <img src="{{ asset('images/logomro.png') }}" alt="MRO Logo" class="w-48 h-auto">
        <div class="ml-4">
            <h1 class="text-3xl font-bold text-gray-800">MRO</h1>
            <p class="text-sm text-gray-500">Maintenance & Repair Operations</p>
        </div>
    </div> --}}
    <div class="flex justify-center mt-8">
        <!-- {{-- <img src="{{ asset('images/MROlogo.png') }}" alt="MRO Logo" class="w-80 h-auto"> --}} -->
        <img src="{{ asset('images/MROlogo.png') }}" alt="MRO Logo" class="w-48 h-auto md:w-64 lg:w-80">
    </div>
    <div class="login-container">
        <span class="mdi mdi-account-box"></span>
        <h2 class="text-center mb-4  text-xl">Login</h2>
        {{-- <h2 class="text-3xl font-semibold text-gray-700">Login</h2> --}}
        <form action="/loginpoststore" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            {{-- <input type="text" class="form-control" placeholder="Username" name="staffname"  required> --}}
            <input type="text" class="form-control" placeholder="Username" name="staffcode"  required>
            <input type="password" class="form-control" placeholder="Password"  name="staffpassword" required>

            <button type="submit" class="btn btn-login mt-3">Login</button>
            @if (session('success'))
                <div class="text-success">{{session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="text-danger">{{session('error')}}</div>
            @endif
        </form>
    </div>

</body>

</html>