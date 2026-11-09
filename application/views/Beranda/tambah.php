<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
</head>
<body>
  <a href="<?= base_url('Beranda') ?>">Kembali ke Beranda</a>

  <h2>Tambah Siswa</h2>
  <form action="<?= base_url('Beranda/tambah') ?>" method="post">
    <div>
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>
    </div>

    <div>
      <label for="umur">Umur</label>
      <input type="number" id="umur" name="umur" min="1" max="120" required>
    </div>

    <button type="submit">Tambah</button>
  </form>
</body>
</html>
