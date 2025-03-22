<?php

require_once __DIR__ . '/BaseModel.php';

class Admin extends BaseModel {

     public function getStatistics() {
        $totalClubs = $this->db->query("SELECT COUNT(*) FROM clubs")->fetchColumn();
        $totalUsers = $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $totalAdhesions = $this->db->query("SELECT COUNT(*) FROM adhesions")->fetchColumn();
        
        return [
            'total_clubs' => $totalClubs,
            'total_users' => $totalUsers,
            'total_adhesions' => $totalAdhesions
        ];
    }

   public function deleteClub($id) {
        $stmt = $this->db->prepare("DELETE FROM clubs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
