<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>UploadFile</h1>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Upload Form</div>
                    <div class="card-body">
                        <form action="/uploadfile" method="POST" enctype="multipart/form-data">
                            {{-- <form action="/uploadfile" method="GET"> --}}
                        @csrf
                        <input type="file" name="file" multiple><br><br>
                        <input type="file" name="file[]" multiple>
                        <button type="submit" class="btn btn-primary">Uptoad</button>
                    </form>
                    </div>
                </div>
            </div>
            {{-- <div style="margin-top:20px">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                
                @endif
            </div> --}}
            <div class="col-8">
                <h2>File table</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Photo</th>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th>Upload</th>
                        <th>File Location</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>