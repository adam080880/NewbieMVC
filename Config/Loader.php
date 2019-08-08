<?php

    class Load {

        public static function model(string $string) {
            require "./Models/$string.php";
            return new $string();
        }

        public static function view(string $path, $data) {    
            extract($data, EXTR_PREFIX_SAME, "");
            require "./Views/$path.php";
        }

        public static function public_file(string $path) {

        }

    }

?>