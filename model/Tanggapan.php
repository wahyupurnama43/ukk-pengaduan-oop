<?php

class Tanggapan extends Database
{
    private $db;
    function __construct()
    {
        $this->db = $this->conn();
    }

    public function getData()
    {
        $sql = "SELECT * FROM tanggapan
                INNER JOIN pengaduan USING(id_pengaduan)
                INNER JOIN petugas USING(id_petugas)
                INNER JOIN masyarakat USING(nik)";
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
    public function getBy($us)
    {
        $sql =  "SELECT nik FROM masyarakat WHERE username='$us'";
        $data = $this->db->query($sql);
        return $data->fetch_assoc();
    }
    public function getDataBy($username)
    {
        $data = $this->getBy($username);
        $nik = $data['nik'];
        $sql = "SELECT * FROM tanggapan
                INNER JOIN pengaduan USING(id_pengaduan)
                INNER JOIN petugas USING(id_petugas)
                INNER JOIN masyarakat USING(nik) WHERE nik = '$nik'";
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
}
