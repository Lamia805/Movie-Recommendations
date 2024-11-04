<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Movies</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1>Search Movies</h1>
    </header>
    <form action="/search/index" method="POST">
        <input type="text" name="query" id="query" placeholder="Search for a movie..." required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
