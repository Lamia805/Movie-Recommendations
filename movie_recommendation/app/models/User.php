<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        return $this->db->execute();
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}
?>
