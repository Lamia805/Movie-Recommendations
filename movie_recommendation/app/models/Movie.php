<?php

class Movie {
    private $db;
    private $movieList;

    public function __construct() {
        $this->db = new Database();

        // Load movie list
        $this->movieList = $this->loadCsv(__DIR__ . '/../../movie_list.csv');
    }

    private function loadCsv($filename) {
        $csv = array_map('str_getcsv', file($filename));
        $header = array_shift($csv);
        $csv = array_map(function($row) use ($header) {
            return array_combine($header, $row);
        }, $csv);

        return $csv;
    }

    public function getTop10Movies() {
        $this->db->query('SELECT * FROM movies ORDER BY rating DESC LIMIT 10');
        return $this->db->resultSet();
    }

    public function getMovieDetails($movie_id) {
        $api_url = "https://api.themoviedb.org/3/movie/{$movie_id}?api_key=8265bd1679663a7ea12ac168da84d2e8&language=en-US";
        $movie_details = file_get_contents($api_url);
        return json_decode($movie_details, true);
    }

    public function searchMovies($query) {
        $this->db->query('SELECT * FROM movies WHERE title LIKE :query');
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function getSuggestions($query) {
        $basicResults = $this->searchMovies($query);
        $suggestions = [];

        // Collect similar movies for each basic result
        foreach ($basicResults as $movie) {
            $suggestions[] = [
                'id' => $movie['movie_id'],
                'title' => $movie['title'],
                'poster_url' => $movie['poster_url'],
                'rating' => $movie['rating'],
                'description' => $movie['description']
            ];
        }

        return $suggestions;
    }
    public function getRecommendedMovies($userId) {
        // This is a placeholder function, replace it with your actual logic to get recommended movies
        $this->db->query('SELECT * FROM movies ORDER BY rating DESC LIMIT 10');
        return $this->db->resultSet();
    }
}
?>
