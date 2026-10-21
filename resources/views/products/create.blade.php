
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar Produk</title>
</head>
<body>
    <h1>Praktikum Acara 29</h1>
    <h2>Upload dan Manipulasi Gambar Produk</h2>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
        <p>Nama produk: {{ session('nama_produk') }}</p>
        <img
            src="{{ asset('storage/products/' . session('gambar')) }}"
            alt="Gambar produk"
            width="300"
        >
    @endif

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <p>
            <label>Nama Produk</label><br>
            <input type="text" name="nama_produk"
                   value="{{ old('nama_produk') }}" required>
        </p>

        <p>
            <label>Gambar Produk</label><br>
            <input type="file" name="gambar"
                   accept="image/*" required>
        </p>

        <button type="submit">Upload Gambar</button>
    </form>
</body>
</html>
