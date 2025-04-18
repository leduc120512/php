<?php
class User
{
    private $conn;
    private $table_name = "users"; // Tên bảng trong cơ sở dữ liệu

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // So sánh trực tiếp plain text
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            echo "Đăng nhập thành công!<br>";
            return $user;
        } else {
            echo "Tài khoản hoặc mật khẩu không đúng!<br>";
            return false;
        }
    }

    // public function register($username, $email, $password)
    // {
    //     $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
    //     $stmt = $this->conn->prepare($query);

    //     // Băm mật khẩu trước khi lưu
    //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':password', $hashed_password); // Lưu mật khẩu đã băm

    //     return $stmt->execute();
    // }
    public function register($username, $email, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Lưu trực tiếp plain text

        return $stmt->execute();
    }
    public function findByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updatePassword($email, $newPassword)
    {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':password', $newPassword); // Lưu trực tiếp plain text
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
