<?php
require_once __DIR__ . '/../models/Member.php';
require_once 'BaseController.php';
class MemberController extends BaseController  {
    private $memberModel;

    public function __construct() {
        $this->memberModel = new Member();
    }
    public function getAllMembers($id) {
        return $this->memberModel->getAllMembers($id);
    }

    

    // Ajouter un nouveau membre
    public function createMember($user_id, $club_id, $adhesion_id, $departement_id, $statut_membre = 'actif') {
        if ($this->memberModel->addMember($user_id, $club_id, $adhesion_id, $departement_id, $statut_membre)) {
            $_SESSION['success_message'] = "Membre ajouté avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'ajout du membre.";
        }
        header("Location: ../views/admin/manage_users.php");
        exit();
    }
        // Afficher un membre spécifique
        public function getMember($id) {
            return $this->memberModel->getMemberById($id);
        }

        // Afficher un membre spécifique
        public function getprofil($id) {
            return $this->memberModel->afficherProfilMember($id);
        }
    // Mettre à jour un membre
    public function updateMember($id, $username, $email, $departement, $statut) {

        if ($this->memberModel->updateMember($id, $username, $email, $departement, $statut)) {
            $_SESSION['success_message'] = "Membre mis à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour.";
        }
    
    }

    // Supprimer un membre
    public function deleteMember($id) {
        if ($this->memberModel->deleteMember($id)) {
            $_SESSION['success_message'] = "Membre supprimé avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la suppression.";
        }

    }



}
