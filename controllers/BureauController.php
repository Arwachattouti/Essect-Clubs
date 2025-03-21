<?php
require_once __DIR__ . '/../models/Bureau.php';
require_once 'BaseController.php';

class BureauController extends BaseController {
    
        private $model;
    
        public function __construct() {
            
            $this->model = new Bureau();
        }
        public function getBureauMember($id) {
            return $this->model->getBureauMemberById($id);
        }
    
        public function getUsers() {
            return $this->model->getAllUsers();
        }
    
        public function updateBureauMember($id, $user_id, $responsabilite) {
            return $this->model->updateBureau($id, $user_id, $responsabilite);
        }
       
        public function getBureauMembersByClubId($club_id) {
            return $this->model->getBureauMembersByClubId($club_id);
        }
        public function createBureauMember() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['user_id'], $_POST['club_id'], $_POST['responsabilite'])) {
                    $user_id = $_POST['user_id'];
                    $club_id = $_POST['club_id'];
                    $responsabilite = $_POST['responsabilite'];
                    if ($this->model->addBureauMember($user_id, $club_id, $responsabilite)) {
                        header("Location: ../admin/detail_club.php?id=" . $club_id);
                            exit();
                    } else {
                        $_SESSION['error_message'] ="Erreur remplir tout les champs .";
                    }
                }
            }
        }
        public function handleUpdate() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $club_id = $_POST['club_id'];
                    $user_id = $_POST['user_id'];
                    $responsabilite = $_POST['responsabilite'];
                    $result = $this->updateBureauMember($club_id, $user_id, $responsabilite);
                    if ($result) {
                        $_SESSION['success_message'] = "Membre du bureau mis à jour avec succès";
                    } else {
                        $_SESSION['error_message'] = "Échec de la mise à jour du membre du bureau";
                    }
                    header("Location: ../club/detail.php?id=" . $club_id);
                    exit;
                    
                }
            }
                }
    
    ?>
    
    

    