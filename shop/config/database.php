<?php
class Database
{
    private $host = "localhost";
    private $dbname = "shop_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    // Phương thức kiểm tra kết nối
 
}

