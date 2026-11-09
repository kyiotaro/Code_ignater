<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Barang</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { font-family: Arial, sans-serif; margin: 32px; color: #202124; }
    nav { display: flex; gap: 16px; margin-bottom: 24px; }
    a { color: #175cd3; }
    table { border-collapse: collapse; width: 100%; margin-top: 16px; }
    th, td { border: 1px solid #d0d5dd; padding: 10px; text-align: left; }
    th { background: #f2f4f7; }
    .aksi { display: flex; align-items: center; gap: 10px; }
    .switch { position: relative; display: inline-block; width: 42px; height: 24px; }
    .switch input { width: 0; height: 0; opacity: 0; }
    .slider { position: absolute; inset: 0; cursor: pointer; background: #98a2b3; border-radius: 24px; transition: .2s; }
    .slider:before { content: ""; position: absolute; width: 18px; height: 18px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: .2s; }
    .switch input:checked + .slider { background: #12b76a; }
    .switch input:checked + .slider:before { transform: translateX(18px); }
    button { cursor: pointer; }
  </style>
</head>
<body>
  <nav>
    <a href="<?= base_url('Beranda') ?>">Beranda</a>
    <a href="<?= base_url('Barang') ?>">Data Barang</a>
  </nav>

  <h1>Data Barang</h1>
  <p>Kelola barang dan status ketersediaannya.</p>
  <a href="<?= base_url('Barang/tambah') ?>">+ Tambah Barang</a>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($barang)): ?>
        <tr><td colspan="6">Belum ada data barang.</td></tr>
      <?php else: ?>
        <?php foreach ($barang as $index => $item): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= html_escape($item['nama']) ?></td>
            <td><?= html_escape($item['kategori']) ?></td>
            <td>Rp <?= number_format((int) $item['harga'], 0, ',', '.') ?></td>
            <td>
              <form class="status-form" action="<?= base_url('Barang/ubah_status/' . (int) $item['id']) ?>" method="post">
                <input type="hidden" name="aktif" value="<?= $item['aktif'] ? '0' : '1' ?>">
                <label class="switch" aria-label="Ubah status <?= html_escape($item['nama']) ?>">
                  <input class="status-switch" type="checkbox" <?= $item['aktif'] ? 'checked' : '' ?>>
                  <span class="slider"></span>
                </label>
                <?= $item['aktif'] ? 'Aktif' : 'Nonaktif' ?>
              </form>
            </td>
            <td class="aksi">
              <a href="<?= base_url('Barang/edit/' . (int) $item['id']) ?>">Edit</a>
              <form class="hapus-form" action="<?= base_url('Barang/hapus/' . (int) $item['id']) ?>" method="post">
                <button type="submit">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php if (!empty($pesan)): ?>
    <script>
      Swal.fire({
        icon: <?= json_encode($jenis_pesan ?: 'success') ?>,
        title: <?= json_encode($jenis_pesan === 'error' ? 'Perhatian' : 'Berhasil') ?>,
        text: <?= json_encode($pesan, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
      });
    </script>
  <?php endif; ?>
  <script>
    document.querySelectorAll('.status-form').forEach(function (form) {
      var checkbox = form.querySelector('.status-switch');
      checkbox.addEventListener('change', function () {
        var target = checkbox.checked;
        var status = target ? 'mengaktifkan' : 'menonaktifkan';
        Swal.fire({
          title: 'Ubah status barang?',
          text: 'Anda akan ' + status + ' barang ini.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, ubah',
          cancelButtonText: 'Batal'
        }).then(function (result) {
          if (result.isConfirmed) {
            form.querySelector('input[name="aktif"]').value = target ? '1' : '0';
            form.submit();
          } else {
            checkbox.checked = !target;
          }
        });
      });
    });

    document.querySelectorAll('.hapus-form').forEach(function (form) {
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
          title: 'Hapus barang ini?',
          text: 'Data yang dihapus tidak dapat dikembalikan.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus',
          cancelButtonText: 'Batal'
        }).then(function (result) {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>
</body>
</html>
