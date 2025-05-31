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
        $query = "SELECT ID, username, email, name, address, phone, password, role 
              FROM " . $this->table_name . " 
              WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        if (!$stmt->execute()) {
            error_log("SQL Error in login: " . json_encode($stmt->errorInfo()));
            return false;
        }
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            // Remove password from the returned data
            unset($user['password']);
            return $user;
        }
        error_log("Login failed for username: $username. User found: " . ($user ? 'yes' : 'no'));
        return false;
    }

    public function updateUserById($id, $email, $name, $address, $password, $phone)
    {
        $query = "UPDATE " . $this->table_name . " 
              SET email = :email, name = :name, address = :address, password = :password, phone = :phone 
              WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            error_log("SQL Error in updateUserById: " . json_encode($stmt->errorInfo()));
            return false;
        }
        return $stmt->rowCount() > 0;
    }

    public function updateUserByIdWithoutPassword($id, $email, $name, $address, $phone)
    {
        $query = "UPDATE " . $this->table_name . " 
              SET email = :email, name = :name, address = :address, phone = :phone 
              WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            error_log("SQL Error in updateUserByIdWithoutPassword: " . json_encode($stmt->errorInfo()));
            return false;
        }
        return $stmt->rowCount() > 0;
    }

    public function userExists($email)
    {
        $query = "SELECT 1 FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

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
    public function updateUser($email, $name, $address, $password, $phone)
    {
        $query = "UPDATE " . $this->table_name . " 
              SET name = :name, address = :address, password = :password, phone = :phone 
              WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);

        if (!$loi = $stmt->execute()) {
            error_log("SQL Error: " . json_encode($stmt->errorInfo()));
            return false;
        }
        return $stmt->rowCount() > 0;
    }

    public function updateUserWithoutPassword($email, $name, $address, $phone)
    {
        $query = "UPDATE " . $this->table_name . " 
              SET name = :name, address = :address, phone = :phone 
              WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            error_log("SQL Error: " . json_encode($stmt->errorInfo()));
            return false;
        }
        return $stmt->rowCount() > 0;
    }


    public function getById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByUser($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateAccount($id, $username, $email, $password = null, $role, $name = null, $address = null, $phone = null)
    {
        // Start building the query
        $query = "UPDATE " . $this->table_name . " SET 
              username = :username, 
              email = :email, 
              role = :role,
              name = :name,
              address = :address,
              phone = :phone";

        // Add password to the query if it's provided
        if ($password !== null) {
            $query .= ", password = :password";
        }

        $query .= " WHERE ID = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);

        // Bind password if it's provided
        if ($password !== null) {
            $stmt->bindParam(':password', $password);
        }

        return $stmt->execute();
    }
    public function deleteAccount($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
    public function getUserById($id)
    {
        $query = "SELECT ID, username, email, role, created_at, name, address, phone 
              FROM " . $this->table_name . " 
              WHERE ID = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if (!$stmt->execute()) {
            error_log("SQL Error in getUserById: " . json_encode($stmt->errorInfo()));
            return null;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function searchAccounts($search = '')
    {
        $search = "%$search%";

        $query = "SELECT ID, username, email, role, created_at, name, address, phone 
                  FROM " . $this->table_name . " 
                  WHERE username LIKE ? 
                     OR email LIKE ? 
                     OR role LIKE ? 
                     OR name LIKE ?
                     OR CAST(created_at AS CHAR) LIKE ?
                  ORDER BY ID";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$search, $search, $search, $search, $search]);

        if (!$stmt) {
            error_log("SQL Error in searchAccounts: " . json_encode($this->conn->errorInfo()));
            return [];
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
