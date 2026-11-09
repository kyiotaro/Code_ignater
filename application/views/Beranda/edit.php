<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Siswa</title>
</head>
<body>
	<a href="<?= base_url('Beranda') ?>">Kembali ke Beranda</a>

	<h2>Edit Siswa</h2>
	<form action="<?= base_url('Beranda/edit/' . $siswa['id']) ?>" method="post">
		<div>
			<label for="nama">Nama</label>
			<input type="text" id="nama" name="nama" value="<?= html_escape($siswa['nama']) ?>" required>
		</div>

		<div>
			<label for="umur">Umur</label>
			<input type="number" id="umur" name="umur" value="<?= html_escape($siswa['umur']) ?>" min="1" max="120" required>
		</div>

		<button type="submit">Simpan Perubahan</button>
	</form>
</body>
</html>
