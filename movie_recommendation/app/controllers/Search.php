<?php

class Search extends Controller {
    public function index() {
        $movieModel = $this->model('Movie');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = $_POST['query'];
            $results = $movieModel->searchMovies($query);

            $this->view('search/index', ['results' => $results]);
        } else {
            $this->view('search/index');
        }
    }

    public function suggestions() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            $query = $_GET['query'];
            $movieModel = $this->model('Movie');
            $results = $movieModel->getSuggestions($query);

            // Log the results to check the response
            error_log(json_encode($results));

            echo json_encode($results);
        }
    }
}
?>
