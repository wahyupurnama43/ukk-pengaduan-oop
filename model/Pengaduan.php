<?php

class Pengaduan extends Database
{
    private $db;
    function __construct()
    {
        $this->db = $this->conn();
    }

    public function getData()
    {
        $sql = "SELECT * FROM pengaduan INNER JOIN masyarakat using(nik)";
        $data = $this->db->query($sql);
        if ($data->num_rows == 0) {
            $hasil = [];
        }else{
            while ($h = $data->fetch_assoc()) {
                $hasil[] = $h;
            }
        }
        return $hasil;
    }


    public function upload()
    {
        $nik = mysqli_escape_string($this->db,$_POST['nik']);
        $laporan = mysqli_escape_string($this->db,$_POST['laporan']);
        $date = date('Y-m-d H:i:s');
        if (isset($_FILES['foto'])) {
            $name =  $_FILES['foto']['name'];
            $type = $_FILES['foto']['type'];
            $tmp_name = $_FILES['foto']['tmp_name'];
            $size = $_FILES['foto']['size'];
            $typeImg = ['jpg','png','jpeg'];
            $e = explode('/', $type);
            $n=explode('.', $name);
            $final = uniqid(rand()).'.'.$n[1];
            if (in_array($e[1], $typeImg)) {
                // cek size
                if ($size < 1000000) {
                    // move Gambar
                    move_uploaded_file($tmp_name,'/home/wahyu/Documents/htdocs/ukk-2021/assets/gambar/'.$final);
                    // masukan data ke Database
                    $sql = "INSERT INTO `pengaduan`(`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`) VALUES ('$date','$nik','$laporan','$final','proses') ";
                    return $this->db->query($sql);
                }else{
                    echo "
                        <script>
                            alert('Gambar Terlalu Besar');
                            document.location.href='?page=pengaduan';
                        </script>
                    ";
                }
            }else{
                var_dump('kosong');die;
            }

        }else{
            var_dump('kosong');die;
        }
    }

    public function detail($id)
    {
        $sql = "SELECT * FROM pengaduan INNER JOIN masyarakat using(nik) WHERE id_pengaduan = $id";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }

    public function tanggap($id,$data,$petugas)
    {
        $sql1 = "SELECT * FROM petugas WHERE username='$petugas'";
        $q = $this->db->query($sql1);
        $p = $q->fetch_assoc();
        $id_pgs = $p['id_petugas'];


        $tanggapan = mysqli_escape_string($this->db,$data['tanggapan']);
        $date = date('Y-m-d H:i:s');

        $sql2 = "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan=$id";
        $this->db->query($sql2);

        $sql = "INSERT INTO `tanggapan`(`id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES ('$id','$date','$tanggapan','$id_pgs')";
        return $this->db->query($sql);
    }

    public function tanggapan($id)
    {
        $sql = "SELECT * FROM tanggapan WHERE id_pengaduan=$id";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM pengaduan WHERE id_pengaduan ='$id'";
        return $this->db->query($sql);
    }
}
