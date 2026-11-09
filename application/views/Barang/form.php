<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= html_escape($judul) ?></title>
</head>
<body>
  <a href="<?= base_url('Barang') ?>">Kembali ke Data Barang</a>
  <h1><?= html_escape($judul) ?></h1>
  <form action="<?= base_url($action) ?>" method="post">
    <div>
      <label for="nama">Nama Barang</label>
      <input type="text" id="nama" name="nama" maxlength="100" value="<?= html_escape($item['nama']) ?>" required>
    </div>
    <div>
      <label for="kategori">Kategori</label>
      <input type="text" id="kategori" name="kategori" maxlength="60" value="<?= html_escape($item['kategori']) ?>" required>
    </div>
    <div>
      <label for="harga">Harga (Rp)</label>
      <input type="number" id="harga" name="harga" min="0" max="999999999" step="1" value="<?= html_escape($item['harga']) ?>" required>
    </div>
    <button type="submit">Simpan</button>
  </form>
</body>
</html>
