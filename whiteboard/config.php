<?php
class Dbh {
    private $servername;
    private $database;
    private $username;
    private $password;
    private $charset;

    protected function connect() {
        $this->servername = "srv-mysqldev.library.tamu.edu";
        $this->database = "whiteboard";
        $this->username = "whiteapp";
        $this->password = "Dd#sxY4Fvi5j";
        $this->charset = "utf8mb4";

        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->database.';charset='.$this->charset.'', $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
            die();
        }
        
    }
};
?>