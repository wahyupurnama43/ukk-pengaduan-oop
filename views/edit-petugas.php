<?php
$id = $_GET['id'];
$p = new Petugas();

$data = $p->getBy($id);

if(isset($_POST['update'])){
    $update = $p->update($id);
    if ($update == true) {
        echo "<script>
            alert('Data Berhasil Di Update');
            window.location.href = 'index.php?page=petugas';
        </script>";
    }else{
        echo "<script>
            alert('Password lama anda salah !!');
            window.location.href = 'index.php?page=edit-petugas&id=$id';
        </script>";
    }
}
?>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Petugas</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Petugas" name="petugas" value="<?php echo $data['nama_petugas'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $data['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password lama</label>
                            <input type="password" class="form-control" id="password" placeholder="Password Lama" name="password_lama">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" placeholder="Password Baru" name="password_baru">
                        </div>
                        <div class="form-group">
                            <label for="tlp">Telpon</label>
                            <input type="number" class="form-control" id="tlp" placeholder="Telpon" name="tlp" value="<?php echo $data['telp'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Level</label>
                            <select class="form-control" name="level">
                                <option value="" selected disabled>Pilih Level</option>
                                <option value="admin" <?php echo ($data['level'] == 'admin') ? 'selected' : '' ?> >Admin</option>
                                <option value="petugas" <?php echo ($data['level'] == 'petugas') ? 'selected' : '' ?> >Petugas</option>
                            </select>
                        </div>
                      <div class="modal-footer justify-content-between">
                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                      </div>
                  </form>

            </div>
        </div>
    </div>

</div>
