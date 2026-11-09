<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda</title>
  <?= $no = 1 ?>
</head>
<body>
  <a href="<?= base_url('Beranda/index/Daffa/15') ?>">Beranda</a>
  <a href="<?= base_url('Beranda/Kelas/RPL/3') ?>">Kelas</a>
  <a href="<?= base_url('Beranda/alamat/Malang/Jawa_Timur') ?>">Alamat</a>
  <a href="<?= base_url('Beranda/guru/Andi/Matematika') ?>">Guru</a>
  <a href="<?= base_url('Barang') ?>">Data Barang</a>
  <a href="<?= base_url('Beranda/tambah') ?>">Tambah Siswa</a>
  <?php if (!empty($pesan)): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: <?= json_encode($pesan, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
        showConfirmButton: true
      });
    </script>
  <?php endif; ?>
  <table border="1">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Umur</th>
      <th colspan="2">Aksi</th>
    </tr>
    <?php foreach($ambilData as $data): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $data['nama'] ?></td>
      <td><?= $data['umur'] ?></td>
      <td><a href="<?= base_url('Beranda/edit/' . $data['id']) ?>">Edit</a></td>
      <td>
        <a href="<?= base_url('Beranda/hapus/' . $data['id']) ?>"
           onclick="return confirmDelete(event, this.href)">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <script>
    function confirmDelete(event, url) {
      event.preventDefault();

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat membatalkan ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });

      return false;
    }
  </script>

</body>
</html>
