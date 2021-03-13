<?php

class Auth extends Database
{
    private $db;
    public function __construct()
    {
        $this->db = $this->conn();
    }

    public function login()
    {
        session_start();
        // CEK AKUN di Database
        $us = mysqli_escape_string($this->db,$_POST['username']);
        $pass = mysqli_escape_string($this->db,$_POST['password']);

        $sql = "SELECT * FROM petugas WHERE username='$us'";
        $pgs = $this->db->query($sql);

        $sql2 ="SELECT * FROM masyarakat WHERE username='$us'";
        $mas = $this->db->query($sql2);

        if (!empty($pgs) && $pgs !== '')
        {
            $data  = mysqli_fetch_assoc($pgs);

            if (password_verify($pass,$data['password'])) {
                if ($data['level'] === 'admin')
                {
                    $_SESSION['level'] = '1';
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $data['username'];
                    header('Location: index.php');
                }else if($data['level'] === 'petugas')
                {

                }else{
                    return false;
                }

            }else{
                return false;
            }
        }else if(!empty($mas) && $mas !== '')
        {
            $data  = mysqli_fetch_assoc($pgs);

            if (password_verify($pass,$data['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user'] = $data['username'];
                header('Location: index.php');
            }else{
                return false;
            }
        }
    }

    public function register()
    {
        $nama = mysqli_escape_string($this->db,$_POST['nama']);
        $nik = mysqli_escape_string($this->db,$_POST['nik']);
        $username = mysqli_escape_string($this->db,$_POST['username']);
        $password = mysqli_escape_string($this->db,$_POST['password']);
        $repas = mysqli_escape_string($this->db,$_POST['re_password']);
        $tlp = mysqli_escape_string($this->db,$_POST['tlp']);

        if ($password === $repas) {
            //insert data
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO masyarakat VALUES('$nik','$nama','$username','$pass','$tlp')";
            $data = $this->db->query($sql);
            if ($data == true) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        unset($_SESSION);
        header('Location: ../login.php');
    }
}
