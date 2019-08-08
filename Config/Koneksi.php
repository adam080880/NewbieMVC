<?php

    abstract class Koneksi {
        protected $koneksi;        

        protected function connect() {
            $this->koneksi = new mysqli("localhost", "root", "", "login_sekolah");
            return $this->koneksi;
        }
    }
    
?>