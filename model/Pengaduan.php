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

     public function getPrint()
    {
        $sql = "SELECT * FROM pengaduan 
                INNER JOIN masyarakat using(nik)
                INNER JOIN tanggapan using(id_pengaduan)";
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

    public function getBy($us)
    {
        $sql =  "SELECT nik FROM masyarakat WHERE username='$us'";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }
    public function getById($id)
    {
        $sql =  "SELECT foto FROM pengaduan WHERE id_pengaduan='$id'";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }


    public function getDataBy($username)
    {
        $data = $this->getBy($username);
        $nik = $data['nik'];
        $sql = "SELECT * FROM pengaduan
                INNER JOIN masyarakat USING(nik) WHERE nik = '$nik' AND pengaduan.delete_at is null ";
        $data = $this->db->query($sql);
        if ($data->num_rows > 0) {
            while ($h = $data->fetch_assoc()) {
                $hasil[] = $h;
            }
        }else {
            $hasil = [];
        }
        return $hasil;
    }

    public function upload()
    {
        $nik = mysqli_escape_string($this->db,$_POST['nik']);
        $laporan = mysqli_escape_string($this->db,$_POST['laporan']);
        $date = date('Y-m-d H:i:s');
        if (isset($_FILES['foto']) || $_FILES['foto']['error'] = 0) {
            $name =  $_FILES['foto']['name']; //fungsi untuk nerima nama gambar
            $type = $_FILES['foto']['type']; // ini untuk nerima tipe gambar
            $tmp_name = $_FILES['foto']['tmp_name']; //ini untuk nerima tempat gambar
            $size = $_FILES['foto']['size']; // ini untuk nerima size
            $typeImg = ['jpg','png','jpeg']; // ini untuk tentuin file apa boleh inputkan
            $e = explode('/', $type); // fungsi untuk memisahkan nama dengan type
            $n=explode('.', $name); // fungsi untuk misahin nama dengan type

            $final = uniqid(rand()).'.'.$n[1];
            if (in_array($e[1], $typeImg)) { // ini valudasi untuk type gambar
                // cek size
                if ($size < 1000000) { // untuk mengukur size
                    // move Gambar

                    move_uploaded_file($tmp_name,'assets/gambar/'.$final);
                    // masukan data ke Database
                    $sql = "INSERT INTO `pengaduan`(`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`) VALUES ('$date','$nik','$laporan','$final','proses') ";
                    return $this->db->query($sql);
                }else{
                    echo "
                        <script>
                            alert('Gambar Terlalu Besar');
                            document.location.href='pengaduan';
                        </script>
                    ";
                }

            }else{
                echo "
                    <script>
                        alert('Gambar Harus JPG,PNG,JPEG');
                        document.location.href='?page=pengaduan';
                    </script>
                ";
            }

        }else{
            echo "
                <script>
                    alert('Gambar Harus Ada');
                    document.location.href='?page=pengaduan';
                </script>
            ";
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
        $sql = "SELECT * FROM tanggapan
        INNER JOIN petugas using(id_petugas) WHERE id_pengaduan=$id";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM pengaduan WHERE id_pengaduan ='$id'";
        return $this->db->query($sql);
    }

    public function update_delete($id)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE pengaduan SET delete_at ='$date' WHERE id_pengaduan='$id'";
        return $this->db->query($sql);
    }

    public function update($id)
    {
        $laporan = mysqli_escape_string($this->db,$_POST['laporan']);
        if (isset($_FILES) && $_FILES['foto']['error'] == 0) {

            $pengaduan = $this->getById($id);

            unlink('assets/gambar/'.$pengaduan['foto']);

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
                    $sql = "UPDATE `pengaduan` SET `isi_laporan`='$laporan',`foto`='$final' WHERE id_pengaduan=$id";
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
                echo "
                    <script>
                        alert('Gambar Harus JPG,PNG,JPEG');
                        document.location.href='?page=pengaduan';
                    </script>
                ";
            }

        }else {
            $sql = "UPDATE `pengaduan` SET `isi_laporan`='$laporan' WHERE id_pengaduan=$id";
            return $this->db->query($sql);
        }
    }
}
