<?php
class Koneksi //extends PDO
{
    private $engine;
    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {

    }

    public function createConnection()
    {
        $this->host = 'localhost';
        $this->database = 'inventory';
        $this->user = 'admin';
        $this->password = 'admin';

        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    public function getLastInsertId()
    {
        return parent::lastInsertId();
    }
}
?>
