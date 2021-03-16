<?php
$pe = new Pengaduan();
$data = $pe->getData();
?>
<br>
    <table class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama Pengaduan</th>
        <th>Laporan</th>
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
                <td><?php echo  substr( $d['isi_laporan'] ,0,30)?></td>
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
