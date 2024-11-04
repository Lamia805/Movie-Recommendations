<?php

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';

// Autoload models
spl_autoload_register(function ($className) {
    require_once 'models/' . $className . '.php';
});
?>
