<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1>Search Results</h1>
        <a href="/">Home</a>
    </header>
    <section id="search-results">
        <div class="movies-container">
            <?php if (isset($data['results']) && !empty($data['results'])): ?>
                <?php foreach ($data['results'] as $movie): ?>
                    <div class="movie">
                        <h3><?php echo $movie['title']; ?></h3>
                        <p>Rating: <?php echo $movie['rating']; ?></p>
                        <?php if (!empty($movie['poster_url'])): ?>
                            <img src="<?php echo $movie['poster_url']; ?>" alt="<?php echo $movie['title']; ?>">
                        <?php else: ?>
                            <img src="/path/to/placeholder-image.jpg" alt="No Image Available">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
