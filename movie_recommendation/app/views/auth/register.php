<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <form action="/auth/register" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="/auth/login">Login here</a></p>
    <?php if (isset($data['error'])): ?>
        <p><?php echo $data['error']; ?></p>
    <?php endif; ?>
</body>
</html>
