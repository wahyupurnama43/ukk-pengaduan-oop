<?php
$pe = new Pengaduan();
$id = $_GET['id'];
$data = $pe->detail($id);

if (isset($_POST['edit'])) {
    $update = $pe->update($id);
    if ($update == true) {
        echo "<script>
            alert('Data Berhasil Di update');
            window.location.href = 'index.php?page=pengaduan';
        </script>";
    }else {
        echo "<script>
            alert('Data Berhasil Di update');
            window.location.href = 'index.php?page=pengaduan&id=$id';
        </script>";
    }
}

?>
<br>
<div class="card">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="hidden" name="nik" value="<?php echo $data['nik'] ?>">
                <input type="text" class="form-control" id="nik" placeholder="nik" disabled  value="<?php echo $data['nik'] ?>">
            </div>
            <div class="form-group">
                <label for="laporan">Laporan</label>
                <textarea name="laporan" rows="4" class="form-control" required><?php echo $data['isi_laporan'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="foto">Foto Pengaduan</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="foto" class="custom-file-input" id="foto">
                  <label class="custom-file-label" for="foto">Choose file</label>
                </div>
              </div>
            </div>
            <img src="assets/gambar/<?php echo $data['foto'] ?>" width="300px"; alt="">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
      </div>
  </form>
    </div>
</div>
