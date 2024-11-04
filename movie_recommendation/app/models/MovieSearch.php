<?php

class MovieSearch {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserSearchHistory($user_id) {
        $this->db->query('SELECT * FROM search_history WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 10');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function saveUserSearch($user_id, $query) {
        $this->db->query('INSERT INTO search_history (user_id, query) VALUES (:user_id, :query)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':query', $query);
        $this->db->execute();
    }
}
?>

