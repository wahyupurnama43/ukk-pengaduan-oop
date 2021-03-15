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



        if (!empty($pgs) && $pgs->num_rows > 0)
        {
            $data  = mysqli_fetch_assoc($pgs);
            if ($data !== null) {
                if (password_verify($pass,$data['password'])) {
                    if ($data['level'] === 'admin')
                    {
                        $_SESSION['level'] = '1';
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $data['username'];
                        header('Location: index.php');
                    }else if($data['level'] === 'petugas')
                    {
                        $_SESSION['level'] = '0';
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $data['username'];
                        header('Location: index.php');
                    }else{
                        return false;
                    }

                }else{
                    return false;
                }
            }else{
                return false;
            }

        }else if(!empty($mas) && $mas->num_rows > 0)
        {
            $data  = mysqli_fetch_assoc($mas);
            if ($data !== null) {
                if (password_verify($pass,$data['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $data['username'];
                    $_SESSION['masyarakat'] = true;
                    header('Location: index.php');
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public function getBy($nik,$val)
    {
        $sql =  "SELECT * FROM masyarakat WHERE $val='$nik'";
        $data = $this->db->query($sql);
        if ($data->num_rows == 0) {
            return $data = '';
        }else{
            return $data->fetch_assoc();
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
            $data = $this->getBy($nik,'nik');
            $data2 = $this->getBy($username,'username');
            if ($data !== '' && $nik == $data['nik'] || $data2 !== '' && $username = $data2['username']) {
                echo "
                <script>
                    alert('Data Nik atau Username Sudah Terdaftar');
                    ducument.location.href = 'login.php';
                </script>
                ";
            }
            else{
                //insert data
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO masyarakat VALUES('$nik','$nama','$username','$pass','$tlp')";
                $data = $this->db->query($sql);
                if ($data == true) {
                    return true;
                }else{
                    return false;
                }
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
