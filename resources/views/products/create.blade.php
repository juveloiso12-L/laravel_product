<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    @vite(['resources/js/app.js'])
</head>
<body style="padding: 20px; font-family: Arial;">

    <h2>Form Tambah Produk</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Wajib menggunakan enctype="multipart/form-data" untuk form upload file -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>Nama Produk: <br><input type="text" name="name" required></p>
        <p>SKU Produk: <br><input type="text" name="sku" required></p>
        <p>Harga: <br><input type="number" name="price" required></p>
        <p>Stok: <br><input type="number" name="stock" required></p>
        <p>Deskripsi: <br><textarea name="description"></textarea></p>
        <p>Gambar (Maks 2MB): <br><input type="file" name="image" accept="image/*"></p>
        <button type="submit">Simpan Produk</button>
    </form>

    <script type="module">
    // Menggunakan ID user 1 sebagai contoh karena belum ada sistem login
    window.Echo.channel('user.1')
        .listen('.order.placed', (e) => {
            alert('Order #' + e.order_id + ' telah ditempatkan! Total: Rp ' + e.total);
            console.log('Order Placed:', e);
        });
</script>

</body>
</html>