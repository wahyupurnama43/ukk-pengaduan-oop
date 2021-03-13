<?php

class Petugas extends Database
{
    private $db;
    public function __construct()
    {
        $this->db = $this->conn();
    }

    public function getData()
    {
        $sql = "SELECT * FROM petugas";
        $data = $this->db->query($sql);
        if ($data->num_rows > 0) {
            while ($d = $data->fetch_assoc()) {
                $hasil[] = $d;
            }
            return $hasil;
        }
    }

    public function getBy($id)
    {
        $sql = "SELECT * FROM petugas WHERE id_petugas = $id";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }

    public function upload()
    {
        $petugas = mysqli_escape_string($this->db,$_POST['petugas']);
        $username = mysqli_escape_string($this->db,$_POST['username']);
        $tlp = mysqli_escape_string($this->db,$_POST['tlp']);
        $level = mysqli_escape_string($this->db,$_POST['level']);
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql = "INSERT INTO `petugas` (`nama_petugas`, `username`, `password`, `telp`, `level`) VALUES ('$petugas','$username','$pass','$tlp','$level')";
        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM petugas WHERE id_petugas = $id";
        return $this->db->query($sql);
    }

    public function update($id)
    {
        $data = $this->getBy($id);
        $petugas = mysqli_escape_string($this->db,$_POST['petugas']);
        $username = mysqli_escape_string($this->db,$_POST['username']);
        $tlp = mysqli_escape_string($this->db,$_POST['tlp']);
        $level = mysqli_escape_string($this->db,$_POST['level']);
        $pass_la = $_POST['password_lama'];
        $pass_ba = $_POST['password_baru'];
        if ($pass_la !== '' && $pass_ba !== '') {
            if (password_verify($pass_la, $data['password'])) {
                $pass = password_hash($pass_ba,PASSWORD_DEFAULT);
                $sql = "UPDATE `petugas` SET `nama_petugas`='$petugas',`username`='$username',`password`='$pass',`telp`='$tlp',`level`='$level' WHERE id_petugas = $id";
                return $this->db->query($sql);
            }else{
                return false;
            }
        }else{
            $sql = "UPDATE `petugas` SET `nama_petugas`='$petugas',`username`='$username',`telp`='$tlp',`level`='$level' WHERE id_petugas = $id";
            return $this->db->query($sql);
        }
    }

}
