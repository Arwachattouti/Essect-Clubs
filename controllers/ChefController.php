<?php
require_once __DIR__ . '/../models/Chef.php';
require_once 'BaseController.php';


class ChefController extends BaseController{
    private $chefModel;

    public function __construct() {
        $this->chefModel = new Chef();
    }
    public function assignChefFromMember($club_id, $member_id) {
        return $this->chefModel->assignChefMember($club_id, $member_id);
    }
   


    public function listChefs() {
        return $this->chefModel->getAllChefs();
    }

    public function getChefById($id) {
        return $this->chefModel->getChefById($id); // Récupère un chef par son ID
    }

    public function createChef($username, $email, $password, $phone, $club_id) {
        // Assurez-vous que la méthode addChef existe dans le modèle Chef et fonctionne correctement.
        $result = $this->chefModel->addOrUpdateChef($username, $email, $password, $phone, $club_id);
        return $result; // Retourne true en cas de succès ou un message d'erreur
    }

    public function editChef($id, $username, $email, $phone, $club_id) {
        $result = $this->chefModel->updateChef($id, $username, $email, $phone, $club_id);
        return $result; // Retourne true ou un message d'erreur
    }

    public function removeChef($id) {
        return $this->chefModel->deleteChef($id);
    }
}

// Traitement des requêtes (POST)
$controller = new ChefController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            // Vous pouvez valider ici les données, puis les passer à la méthode createChef
            $result = $controller->createChef($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['club_id']);
            if ($result === true) {
                $_SESSION['success_message'] = "Chef ajouté avec succès.";
            } else {
                $_SESSION['error_message'] = $result;
            }
        } elseif ($_POST['action'] == 'edit') {
            $result = $controller->editChef($_POST['id'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['club_id']);
            if ($result === true) {
                $_SESSION['success_message'] = "Chef modifié avec succès.";
            } else {
                $_SESSION['error_message'] = $result;
            }
        } elseif ($_POST['action'] == 'delete') {
            $controller->removeChef($_POST['id']);
            $_SESSION['success_message'] = "Chef supprimé avec succès.";
        }
        header("Location: ../admin/manage_chef.php");
        exit();
    }
}
?>

