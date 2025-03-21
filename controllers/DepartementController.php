<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Departement.php';

class DepartementController extends BaseController {
    private $departementModel;

    public function __construct() {
        $this->departementModel = new Departement();
    }
    public function getDepartementsByClubId($club_id) {
    
        return $this->departementModel->getDepartementsByClubId($club_id);
   
    }
    public function getAllDepartementss(){
       return  $this->departementModel->getAllDepartements();

    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars($_POST['nom']);
            $club_id = intval($_POST['club_id']);
            $description = htmlspecialchars($_POST['description']);
            if (empty($nom) || empty($club_id) || empty($description)) {
                die("Tous les champs sont obligatoires !");
            }
            return $this->departementModel->createDepartement($nom, $club_id, $description);
        }
    }
    

   
    public function edit($id) {
        $departement = $this->departementModel->getDepartementById($id);
        if (!$departement) {
            die("Département non trouvé !");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $nom = $_POST['nom'];
            $club_id = $_POST['club_id'];
            $description = $_POST['description']; 

            return $this->departementModel->updateDepartement($id, $nom, $description);
        }
    }


     public function delete($id) {
        if ($this->departementModel->deleteDepartement($id)) {
            header("Location: " . BASE_URL . "/departement/list");
        } else {
            die("Erreur lors de la suppression.");
        }
    }
    
    public function getDepartementById($id) {
        return $this->departementModel->getDepartementById($id);
    }
}  

?>


