{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($picPathList as $file)
      
        @if (Str::endsWith($file->filepath, ['.mp4', '.mov', '.avi']))
            <video width="400" height="auto" controls>
                <source src="{{ Storage::url($file->filepath) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ Storage::url($file->filepath) }}" width="400" height="auto" style="object-fit: cover; max-width: 100%; max-height: 100%;" alt="Image">
        @endif
        <br/>
    @endforeach
</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column; /* เรียงจากบนลงล่าง */
            align-items: center; /* จัดให้อยู่ตรงกลางแนวนอน */
            justify-content: center; /* จัดให้อยู่ตรงกลางแนวตั้ง (ถ้ามีความสูงเต็มหน้าจอ) */
            padding: 20px;
        }

        .media {
            width: 100%;
            max-width: 400px; /* ขนาดสูงสุด */
            margin-bottom: 20px; /* เว้นระยะห่างระหว่าง media */
        }

        .media img,
        .media video {
            width: 100%;
            height: auto; /* รักษาสัดส่วน */
            display: block;
            object-fit: cover; /* ภาพเต็มกรอบ */
        }

        @media (max-width: 480px) {
            .media {
                max-width: 100%; /* สำหรับมือถือ ให้เต็มความกว้าง */
            }
        }
    </style>
</head>
<body>
    @foreach ($picPathList as $file)
        <div class="media">
            @if (Str::endsWith($file->filepath, ['.mp4', '.mov', '.avi']))
                <video controls>
                    <source src="{{ Storage::url($file->filepath) }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ Storage::url($file->filepath) }}" alt="Image">
            @endif
        </div>
    @endforeach
</body>
</html> --}}
{{-- ตรงกลาง --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column; /* เรียงจากบนลงล่าง */
            align-items: center; /* จัดให้อยู่ตรงกลางแนวนอน */
            justify-content: center; /* จัดให้อยู่ตรงกลางแนวตั้ง (ถ้ามีความสูงเต็มหน้าจอ) */
            padding: 20px;
        }

        .media {
            width: 100%;
            max-width: 400px; /* ขนาดสูงสุด */
            margin-bottom: 20px; /* เว้นระยะห่างระหว่าง media */
        }

        .media img,
        .media video {
            width: 100%;
            height: auto; /* รักษาสัดส่วน */
            display: block;
            object-fit: cover; /* ภาพเต็มกรอบ */
        }

        @media (max-width: 480px) {
            .media {
                max-width: 100%; /* สำหรับมือถือ ให้เต็มความกว้าง */
            }
        }
    </style>
</head>
<body>
    @foreach ($picPathList as $file)
        <div class="media">
            @if (Str::endsWith($file->filepath, ['.mp4', '.mov', '.avi']))
                <video controls>
                    <source src="{{ Storage::url($file->filepath) }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ Storage::url($file->filepath) }}" alt="Image">
            @endif
        </div>
    @endforeach
</body>
</html>
