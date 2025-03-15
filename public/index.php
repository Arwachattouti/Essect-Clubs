<?php
session_start();
define('BASE_PATH', dirname(__DIR__)); 
$files = [
    BASE_PATH . '/config/database.php',   
    BASE_PATH . '/app/core/Router.php'    
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        die("❌ Erreur critique : Le fichier <b>$file</b> est introuvable !");
    }
    require_once $file;  
}

$page = isset($_GET['page']) ? trim($_GET['page']) : 'home';
if (!class_exists('Router')) {
    die("❌ Erreur : La classe <b>Router</b> est introuvable !");
}

$router = new Router();
$router->handle($page); 
?>













