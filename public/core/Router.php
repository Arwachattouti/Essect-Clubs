<?php
// app/core/Router.php

class Router {
    
    // Gérer la page demandée
    public function handle($page) {
        // Définir les routes associées à des contrôleurs et méthodes
        $routes = [
            'home'              => 'HomeController@index',          // Méthode index du HomeController
            'login'             => 'UserController@login',          // Méthode login du UserController
            'register'          => 'UserController@register',       // Méthode register du UserController
            'profile'           => 'UserController@profile',        // Méthode profile du UserController
            'dashboard'         => 'AdminController@dashboard',     // Méthode dashboard du AdminController
            'manage_clubs'      => 'AdminController@manageClubs',   // Méthode manageClubs du AdminController
            'manage_users'      => 'AdminController@manageUsers',   // Méthode manageUsers du AdminController
            'statistics'        => 'AdminController@statistics',    // Méthode statistics du AdminController
            'manage_adhesions'  => 'AdminController@manageAdhesions', // Méthode manageAdhesions du AdminController
            'view_adhesion'     => 'AdminController@viewAdhesion',  // Méthode viewAdhesion du AdminController
            'clubs'             => 'ClubController@index',         // Méthode index du ClubController
            'create'            => 'ClubController@create',         // Méthode create du ClubController
            'events'            => 'EventController@index',        // Méthode index du EventController
            'adhesion'          => 'AdhesionController@request',   
             // Méthode request du AdhesionController
            // Ajouter d'autres routes ici si nécessaire
        ];

        // Vérifier si la page demandée existe dans les routes définies
        if (array_key_exists($page, $routes)) {
            // Récupérer la route associée (ex: "UserController@login")
            $route = $routes[$page];
            $this->dispatch($route); // Appeler la méthode dispatch pour gérer la requête
        } else {
            // Si la page n'existe pas dans les routes, afficher une page 404
            $this->redirectTo404();
        }
    }
    
    // Méthode pour dispatcher la requête vers le bon contrôleur et la méthode correspondante
    private function dispatch($route) {
        // Séparer le contrôleur et la méthode (ex: "UserController@login" devient ["UserController", "login"])
        list($controllerName, $methodName) = explode('@', $route);
        
        // Inclure le contrôleur correspondant
        $controllerFile = BASE_PATH . "/app/controllers/{$controllerName}.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        } else {
            $this->handleError("Le fichier du contrôleur {$controllerName} est introuvable.");
        }

        // Vérifier si la classe et la méthode existent
        if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
            // Instancier le contrôleur
            $controller = new $controllerName();
            // Vérifier la méthode HTTP et appeler la méthode correspondante
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && method_exists($controller, $methodName)) {
                $controller->$methodName(); // Appeler la méthode pour les requêtes POST
            } else {
                // Par défaut, on appelle la méthode pour les requêtes GET
                $controller->$methodName();
            }
        } else {
            $this->handleError("La méthode {$methodName} dans le contrôleur {$controllerName} est introuvable.");
        }
    }

    // Méthode pour gérer les erreurs et afficher un message d'erreur
    private function handleError($message) {
        // Vous pouvez loguer l'erreur ou afficher un message générique
        die("❌ Erreur : {$message}");
    }

    // Méthode pour rediriger vers une page 404
    private function redirectTo404() {
        include BASE_PATH . '/views/404.php';
        exit; // Arrêter l'exécution du script
    }
}
?>



