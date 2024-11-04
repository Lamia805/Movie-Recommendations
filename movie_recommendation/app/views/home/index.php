<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Recommendation</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to Movie Recommendation</h1>
    </header>
    <section id="search">
        <h2>Search Movies</h2>
        <form action="/search/index" method="POST">
            <input type="text" name="query" id="search-bar" placeholder="Search for a movie..." required>
            <button type="submit">Search</button>
        </form>
        <div id="suggestions" class="movies-container"></div>
    </section>
    <section id="top-movies">
        <h2>Top 10 Movies</h2>
        <div class="movies-container">
            <?php if (isset($data['topMovies']) && !empty($data['topMovies'])): ?>
                <?php foreach ($data['topMovies'] as $movie): ?>
                    <div class="movie">
                        <h3><?php echo $movie['title']; ?></h3>
                        <p>Rating: <?php echo $movie['rating']; ?></p>
                        <img src="<?php echo $movie['poster_url']; ?>" alt="<?php echo $movie['title']; ?>">
                        <a href="/search/similar/<?php echo $movie['id']; ?>">View Similar Movies</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No movies found.</p>
            <?php endif; ?>
        </div>
    </section>
    <script>
        document.getElementById('search-bar').addEventListener('input', function() {
            let query = this.value;
            if (query.length >= 2) {
                fetch('/search/suggestions?query=' + query)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);  // Debugging: log data to console
                        let suggestions = document.getElementById('suggestions');
                        suggestions.innerHTML = '';
                        data.forEach(movie => {
                            let card = document.createElement('div');
                            card.className = 'card';
                            card.innerHTML = `
                                <img src="${movie.poster_url}" alt="${movie.title}">
                                <div class="card-content">
                                    <h3>${movie.title}</h3>
                                    <p>Rating: ${movie.rating}</p>
                                    <p>${movie.description}</p>
                                    <a href="/movie/details/${movie.id}">More Info</a>
                                </div>
                            `;
                            suggestions.appendChild(card);
                        });
                    })
                    .catch(error => console.error('Error fetching suggestions:', error));
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
        });
    </script>
</body>
</html>
