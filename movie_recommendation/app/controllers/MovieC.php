<?php

class MovieC extends Controller {
    public function details($id) {
        $movieModel = $this->model('MovieC');
        $movieDetails = $movieModel->getMovieDetails($id);

        $this->view('movie/details', ['movie' => $movieDetails]);
    }
}
?>
