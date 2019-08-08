<?php  

    class Model extends Koneksi {

        public $conn;
        protected $table;

        public function __construct(){
            $this->conn = parent::connect();            
        }

        public static function find(int $id) {
            $db = new Self;
            $db->table = strtolower(get_called_class());            
            $res = $db->conn->query("SELECT * FROM $db->table WHERE id='$id'");

            if($res->num_rows == 1) {
                return $res->fetch_object();
            } else {
                return [];
            }

        }

        public static function get(string $where='') {
            $db = new Self;
            $db->table = strtolower(get_called_class());

            $condition = ($where != '') ? "WHERE ".trim($where) : "";
            $res = $db->conn->query("SELECT * FROM $db->table $condition");

            $result = [];
            
            while($data = $res->fetch_object()) {
                $result[] = $data;
            }

            return $result;
        }

        public static function insert(array $data) {
            $db = new Self;
            $db->table = strtolower(get_called_class());

            $sql = "INSERT INTO $db->table SET ";         

            $a = 0;
            foreach($data as $field => $res) {
                $sql .= $field . "='" . $db->conn->real_escape_string( $res ) . "'";

                if($a != count($data)-1) {
                    $sql .= ", ";
                } else {
                    $sql .= ";";
                }                
                $a++;
            }                    

            if($res = $db->conn->query($sql)) {
                return [
                    'data' => $data,
                    'id' => $db->conn->insert_id,
                    'message' => 'Success',
                    'status' => true
                ];
            } else {
                return [
                    'data' => $data,
                    'message' => 'Failed',
                    'status' => false
                ];
            }
        }

        public static function update(array $data, string $where) {
            $db = new Self;
            $db->table = strtolower(get_called_class());

            $sql = "UPDATE $db->table SET ";         

            $a = 0;
            foreach($data as $field => $res) {
                $sql .= $field . "='" . $db->conn->real_escape_string( $res ) . "'";

                if($a != count($data)-1) {
                    $sql .= ", ";
                } else {
                    $sql .= " ";
                }                
                $a++;
            }        
            
            $sql .= "WHERE " . $where;
            if($db->conn->query($sql)) {
                return [
                    'data' => $data,      
                    'where' => $where,              
                    'message' => 'Success',
                    'status' => true
                ];
            } else {
                return [
                    'data' => $data,
                    'where' => $where,
                    'message' => 'Failed',
                    'status' => false
                ];
            }
        }

        public static function delete(string $where) {
            $db = new Self;
            $db->table = strtolower(get_called_class());

            $data = Self::get($where);
            if(count($data) > 0) {
                $data = $data[0];
            } else {
                return [
                    'data' => $data,
                    'where' => $where,
                    'message' => 'Failed',
                    'status' => false
                ];
            }

            $sql = "DELETE FROM $db->table WHERE " . $where;
            if($db->conn->query($sql)) {
                return [
                    'data' => $data,      
                    'where' => $where,              
                    'message' => 'Success',
                    'status' => true
                ];
            } else {
                return [
                    'data' => $data,
                    'where' => $where,
                    'message' => 'Failed',
                    'status' => false
                ];
            }

        }



    }

?>