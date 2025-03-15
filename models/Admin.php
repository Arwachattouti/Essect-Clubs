<?php

require_once __DIR__ . '/BaseModel.php';

class Admin extends BaseModel {

    // Récupérer les statistiques du site (nombre de clubs, utilisateurs, adhésions)
    public function getStatistics() {
        // Compter le nombre de clubs
        $totalClubs = $this->db->query("SELECT COUNT(*) FROM clubs")->fetchColumn();
        
        // Compter le nombre d'utilisateurs
        $totalUsers = $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        
        // Compter le nombre d'adhésions
        $totalAdhesions = $this->db->query("SELECT COUNT(*) FROM adhesions")->fetchColumn();
        
        return [
            'total_clubs' => $totalClubs,
            'total_users' => $totalUsers,
            'total_adhesions' => $totalAdhesions
        ];
    }

    // Supprimer un club par son ID
    public function deleteClub($id) {
        $stmt = $this->db->prepare("DELETE FROM clubs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Supprimer un utilisateur par son ID
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
