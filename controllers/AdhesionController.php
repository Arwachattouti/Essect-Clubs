<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Adhesion.php';
require_once __DIR__ . '/../models/Member.php';
class AdhesionController extends BaseController {
    private $adhesionModel;
    private $clubMemberModel;
    public function __construct() {
        $this->adhesionModel = new Adhesion();
        $this->clubMemberModel = new Member();
    }
    public function list() {
        return $this->adhesionModel->getAll();
    }
    public function getAdhesionById($adhesion_id) {
        return $this->adhesionModel->getAdhesionById($adhesion_id);
    }
public function request($id) { 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $club_id  = filter_input(INPUT_POST, 'club_id', FILTER_VALIDATE_INT);
        $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $phone     = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender    = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $skills    = filter_input(INPUT_POST, 'skills', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hobbies   = filter_input(INPUT_POST, 'hobbies', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reason    = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $upload_dir = __DIR__ . '/../public/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $cv_path = '';
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
            $cv_name = time() . "_" . basename($_FILES['cv']['name']); // Ajouter un timestamp pour éviter les doublons
            $cv_path = $upload_dir . $cv_name;

            if (move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path)) {
                echo "✅ CV enregistré : " . $cv_path . "<br>";
            } else {
                die("❌ Erreur lors de l'enregistrement du fichier !");
            }
        } else {
            die("❌ Erreur d'upload : " . $_FILES['cv']['error']);
        }
        if (!$club_id || !$email || !$full_name) {
            die("❌ Invalid data! Veuillez remplir tous les champs requis.");
        }
        if ($this->adhesionModel->create($id, $club_id, $full_name, $birthdate, $email, $phone, $gender, $skills, $hobbies, $reason, $cv_name)) {
            header("Location: ../etudiant/listeclubs.php?id=" . $id);
            exit();
        }
    }
}

    public function afficheradhesionbyiduser($id) {
    return $this->adhesionModel->getAdhesionsByuserId($id);
    }
    public function afficheradhesionbyid($club_id) {
        return $this->adhesionModel->getAdhesionsByClubId($club_id);
    }
    public function accept($club_id, $adhesion_id, $departement_id) {
        $adhesion = $this->adhesionModel->getAdhesionById($adhesion_id);
        
        if (!$adhesion) {
            die("Adhésion introuvable.");
        }
        $user_id = $adhesion['user_id']; 
        $departement = $this->adhesionModel->checkDepartementExists($departement_id);
        var_dump($departement);
        if (!$departement) {
            die("Erreur : Le département avec ID $departement_id n'existe pas.");
        }
    
        $this->adhesionModel->updateStatut($adhesion['id'], 'accepté');
        
        $this->clubMemberModel->addMembera($user_id, $club_id, $adhesion_id, $departement_id);
    
        header("Location: manage_adhesion.php?id={$club_id}");
        exit();
    }
    public function getDepartementsByClub($club_id) {
        require_once __DIR__ . '/../models/Departement.php';
        $departementModel = new Departement();
        return $departementModel->getDepartementsByClubId($club_id);
    }
    
    public function reject($id,$club_id) {
        $adhesion = $this->adhesionModel->getAdhesionById($id);
        if (!$adhesion) {
            die("Adhésion introuvable.");
        }
        $user_id = $adhesion['user_id'];
        $this->adhesionModel->updateStatut($id, 'refusé');
        header("Location: manage_adhesion.php?id={$club_id}");
        exit();
    }
}
?>

