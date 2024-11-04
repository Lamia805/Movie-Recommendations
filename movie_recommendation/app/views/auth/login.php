<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <form action="/auth/login" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="remember_me">
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember Me
        </label>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="/auth/register">Register here</a></p>
    <?php if (isset($data['error'])): ?>
        <p><?php echo $data['error']; ?></p>
    <?php endif; ?>
</body>
</html>
