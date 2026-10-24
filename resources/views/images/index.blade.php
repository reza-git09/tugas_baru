
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara 31 - Manipulasi Gambar</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1, h2 {
            color: #173f7a;
        }

        button {
            background: #2675d8;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        input {
            margin: 15px 0;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
        }

        .error {
            color: #dc2626;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .gallery img {
            width: 200px;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laravel Image Manipulation</h1>
        <p>Praktikum Acara 31 - Manipulasi Gambar</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2>Upload dan Resize Gambar</h2>

        <form action="{{ route('images.upload') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <label for="photo">Pilih gambar:</label><br>

            <input
                type="file"
                id="photo"
                name="photo"
                accept=".jpg,.jpeg,.png"
                required
            >

            <br>

            <button type="submit">Upload dan Resize</button>
        </form>

        <hr>

        <h2>Hasil Manipulasi Gambar</h2>

        <div class="gallery">
            @forelse ($files as $file)
                <div class="item">
                    <img
                        src="{{ asset('storage/' . $file) }}"
                        alt="Hasil manipulasi gambar"
                    >

                    <p>{{ basename($file) }}</p>
                </div>
            @empty
                <p>Belum ada gambar yang di-upload.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
