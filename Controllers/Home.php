<?php

    class Home {
        public function api_get() {
            header("Content-Type: application/json");
            $mapel = Load::model('Mapel')->get();

            echo json_encode($mapel);
        }

        public function index() {
            Load::view('index', [
                'mapel' => Load::model('Mapel')->get(),
                'no' => 1
            ]);
        }
    }

?>