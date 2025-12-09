{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>อัปโหลดไฟล์</h2>

   
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="files" class="form-label">เลือกไฟล์ (รองรับ jpg, jpeg, png, pdf):</label>
            <input class="form-control" type="file" name="files[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">อัปโหลด</button>
    </form>
</div>
</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>อัปโหลดไฟล์ (รองรับ jpg, jpeg, png, pdf)</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="files" class="form-label">เลือกไฟล์:</label>
            <input class="form-control" type="file" name="files[]" id="files" multiple required>
        </div>

        <button type="submit" class="btn btn-primary">อัปโหลด</button>
    </form>
</div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>
    <h3>Drophere</h3>
    <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data" id="image-upload" class="dropzone">
    @csrf
    </form>
</body>
<script type="text/javascript">
new Dropzone("#image-upload",{
    thumbnailswidth:200,
    maxFilesize:2, // MB
    acceptedFiles:".jpeg,.jpg,.png,.gif,.pdf",
})
</script>
</html>
