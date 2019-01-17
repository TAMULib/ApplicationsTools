<?php
class Dbh {
    private $servername;
    private $database;
    private $username;
    private $password;
    private $charset;

    protected function connect() {
        $this->servername = "";
        $this->database = "";
        $this->username = "";
        $this->password = "";
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