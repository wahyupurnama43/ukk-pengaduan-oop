<?php
require_once('init.php');
    $pe = new Pengaduan();
    $data = $pe->getPrint();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="container">
    <h1 class="text-center">Pengaduan Masyarakat</h1>
<br>
    <table class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Pengaduan</th>
        <th>Laporan</th>
        <th>Tanggapan</th>
        <th>Tanggal</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
          <?php $i = 1 ?>
          <?php foreach ($data as $d): ?>
              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $d['nama'] ?> </td>
                <td><?php echo  $d['isi_laporan']?></td>
                <td><?php echo  $d['tanggapan']?></td>
                <td><?php echo $d['tgl_pengaduan'] ?></td>
                <td>
                    <?php if ($d['status'] == 'proses'): ?>

                    <div class="bg-warning pb-1" style="border-radius:30px">
                        <?php echo $d['status'] ?>
                    </div>
                    <?php else: ?>
                        <div class="text-white bg-success pb-1" style="border-radius:30px">
                            <?php echo $d['status'] ?>
                        </div>
                <?php endif; ?>

                </td>
            </tr>
          <?php endforeach; ?>

      </tbody>
    </table>

<script>
    window.print();
</script>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
</body>
</html>