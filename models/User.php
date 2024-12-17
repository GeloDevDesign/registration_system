<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validateCredentials($username, $password)
    {
        $user = $this->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if valid
        }

        return false;
    }
}
