<?php

class Home extends Controller {
    public function index() {
        $movieModel = $this->model('Movie');
        $searchModel = $this->model('MovieSearch'); // Updated to use MovieSearch

        $topMovies = $movieModel->getTop10Movies();
        $recommendedMovies = [];

        if (isset($_SESSION['user_id'])) {
            $searchHistory = $searchModel->getUserSearchHistory($_SESSION['user_id']);
            if (!empty($searchHistory)) {
                foreach ($searchHistory as $search) {
                    $recommendations = $movieModel->getRecommendedMovies($search['query']);
                    $recommendedMovies = array_merge($recommendedMovies, $recommendations);
                }
                // Remove duplicates and limit the number of recommendations
                $recommendedMovies = array_unique($recommendedMovies, SORT_REGULAR);
                $recommendedMovies = array_slice($recommendedMovies, 0, 10);
            }
        }

        $this->view('home/index', ['topMovies' => $topMovies, 'recommendedMovies' => $recommendedMovies]);
    }
}
?>
