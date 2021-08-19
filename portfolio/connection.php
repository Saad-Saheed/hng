<?php 

class Connection {

    private $conn ="";


    public function connect()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=portfolio', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_PERSISTENT, true);
            return $this->conn;
        } catch (PDOException $ex) {

            echo "Connection failed". $ex->getMessage();
        }
        
    }


    public function disConnect()
    {
        $this->$this = null;
    }
}

?>