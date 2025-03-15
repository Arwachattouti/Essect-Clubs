<?php
require_once(dirname(__DIR__) . '/config/Session.php');
require_once(dirname(__DIR__) . '/config/database.php');
define('BASE_URL', 'http://localhost/CLUBS');
class BaseController {
    protected function render($view, $data = []) {
        extract($data); // Extrait les données sous forme de variables
        $viewPath = __DIR__ . "/../../views/$view.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("La vue $view n'existe pas !");
        }
    }
    // Vérifier si l'utilisateur est connecté
    protected function checkAuth() {
        if (!Session::get('user_id')) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }
}
?>

