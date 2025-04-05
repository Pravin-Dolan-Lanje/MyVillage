<?php
class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "Siregaon_bandh");
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function verifyUser($email, $password) {
        $user = $this->getUserByEmail($email);
        
        // For development only - allows both hashed and plain text
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user; // Works with hashed passwords
            }
            if ($password === $user['password']) {
                return $user; // Works with plain text
            }
        }
        
        return false;
    }
}
?>