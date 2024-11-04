<?php
session_start();

if (!isset($_GET['url'])) {
    // Get the request URI
    $requestUri = $_SERVER['REQUEST_URI'];

    // Remove the query string if present
    if (strpos($requestUri, '?') !== false) {
        $requestUri = strstr($requestUri, '?', true);
    }

    // Trim leading and trailing slashes
    $url = trim($requestUri, '/');

    // Filter the URL
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Set the URL parameter
    $_GET['url'] = $url;
}

require_once __DIR__ . '/../app/init.php';

$app = new App();
?>
