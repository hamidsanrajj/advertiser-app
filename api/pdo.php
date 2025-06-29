<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

 /**
    * Database Connection
    */
    class DbConnect {
        private $server = 'localhost';
        private $dbname = 'test';
        private $user = 'root';
        private $pass = '';
        public function connect() {
            try {
                $conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (\Exception $e) {
                echo "Database Error: " . $e->getMessage();
            }
        }

    }


    $conn = new DbConnect();
    $db = $conn->connect();
    $method = $_SERVER['REQUEST_METHOD'];
    switch($method) {
        case 'POST':
            $user = json_decode(file_get_contents('php://input'));
            $sql = "INSERT INTO record(name) values(:name)";
            $stmt = $db->prepare($sql);
            $date = date('Y-m-d');
            $stmt->bindParam(':name', $user->name);
            if($stmt->execute()) {
                $data = ['status' => 1, 'message' => "Record successfully created"];
            } else {
                $data = ['status' => 0, 'message' => "Failed to create record."];
            }
            echo json_encode($data);
            break;
        }

?>