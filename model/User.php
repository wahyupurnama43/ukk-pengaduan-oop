<?php

class User extends Database
{

    private $db;
    public function __construct()
    {
        $this->db = $this->conn();
    }

    public function getData()
    {
        $sql = "SELECT * FROM masyarakat";
        $data = $this->db->query($sql);

        if ($data->num_rows > 0) {
            // code...
            // masukkan ke array
            while ($h = $data->fetch_assoc()) {
                $hasil[] = $h;
            }
            return $hasil;
        }else{
            return $hasil = [];
        }

    }

    public function getBy($nik)
    {
        $sql =  "SELECT * FROM masyarakat WHERE nik=$nik";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }

    public function getByUser($u)
    {
        $sql =  "SELECT nik FROM masyarakat WHERE username='$u'";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }

    public function upload()
    {

        $nik = mysqli_escape_string($this->db,$_POST['nik']);
        $nama = mysqli_escape_string($this->db,$_POST['nama']);
        $username = mysqli_escape_string($this->db,$_POST['username']);
        $tlp = mysqli_escape_string($this->db,$_POST['tlp']);
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);

        //cek Nik

        $data = $this->getBy($nik);
        if ($data !== null && $nik == $data['nik']) {
            return false;
        }else{
            $sql = "INSERT INTO `masyarakat`(`nik`, `nama`, `username`, `password`, `telp`) VALUES ('$nik','$nama','$username','$pass','$tlp')";
            return $this->db->query($sql);
        }

    }

    public function delete($id)
    {
        $sql = "DELETE FROM masyarakat WHERE nik=$id";
        return $this->db->query($sql);
    }

    public function update($id)
    {
        $nama = mysqli_escape_string($this->db,$_POST['nama']);
        $nik = mysqli_escape_string($this->db,$_POST['nik']);
        $username = mysqli_escape_string($this->db,$_POST['username']);
        $tlp = mysqli_escape_string($this->db,$_POST['tlp']);
        $password_lm = $_POST['password_lama'];
        $password_br = $_POST['password_baru'];
        if ($password_lm != '' && $password_br != '') {
            $data = $this->getBy($id);
            if (password_verify($password_lm, $data['password'])) {
                $pass = password_hash($_POST['password_baru'],PASSWORD_DEFAULT);
                $sql = "UPDATE `masyarakat` SET `nik`='$nik',`nama`='$nama',`username`='$username',`password`='$pass',`telp`='$tlp' WHERE nik = '$id'";
                return $this->db->query($sql);
            }else{
                return false;
            }
        }else{
            $pass = password_hash($_POST['password_baru'],PASSWORD_DEFAULT);
            $sql = "UPDATE `masyarakat` SET `nik`='$nik',`nama`='$nama',`username`='$username',`telp`='$tlp' WHERE nik = '$id'";
            return $this->db->query($sql);
        }
    }
}
