<?php
class Database
{
    private $host = "192.168.113.3";
    private $db_name = "dubinin";
    private $username = "dubinin";
    private $password = "1234";
    public $conn;
    public function getConnection(){
        $this->conn = null;
        try
        {
            $dsn= "pgsql:host=$this->host;port=5432;dbname=$this->db_name;user=$this->username;
                            password=$this->password";
            $this->conn = new PDO($dsn);
        }
        catch (PDOException $e) {
            echo "Ошибка подключения:".$e->getMessage();
        }
        return $this->conn;
    }
}