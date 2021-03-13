<?php

class Database
{
    private $hs = 'localhost';
    private $us = 'wahyu';
    private $pw = 'wahyup';
    private $db = 'ukk_pengaduan';

    public function conn()
    {
        $return = mysqli_connect($this->hs,$this->us,$this->pw,$this->db);
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
        }
        return $return;
    }
}
