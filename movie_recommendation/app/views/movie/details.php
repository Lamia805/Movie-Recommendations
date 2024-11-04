<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['movie']['title']; ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1><?php echo $data['movie']['title']; ?></h1>
    </header>
    <section id="movie-details">
        <div class="movie-poster">
            <img src="https://image.tmdb.org/t/p/original<?php echo $data['movie']['poster_path']; ?>" alt="<?php echo $data['movie']['title']; ?>">
        </div>
        <div class="movie-info">
            <h2>Rating: <?php echo $data['movie']['vote_average']; ?></h2>
            <p><?php echo $data['movie']['overview']; ?></p>
            <p>Release Date: <?php echo $data['movie']['release_date']; ?></p>
            <a href="/home">Back to Home</a>
        </div>
    </section>
</body>
</html>
