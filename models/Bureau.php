<?php
require_once __DIR__ . '/BaseModel.php';

class Bureau extends BaseModel {
      
       
    public function getBureauMemberById($id) {
        $stmt = $this->db->prepare("SELECT * FROM club_bureau_members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, username FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBureau($id, $user_id, $responsabilite) {
        $stmt = $this->db->prepare("UPDATE club_bureau_members SET user_id = ?, responsabilite = ? WHERE id = ?");
        return $stmt->execute([$user_id, $responsabilite, $id]);
    }
       
        public function getBureauMembersByClubId($club_id) {
            $query = "SELECT *
                      FROM club_bureau_members bm
                      JOIN users u ON bm.user_id = u.id
                      WHERE bm.club_id = :club_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':club_id', $club_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Ajouter un membre du bureau
        public function addBureauMember($user_id, $club_id, $responsabilite) {
            $query = "INSERT INTO club_bureau_members (user_id, club_id, responsabilite) 
                      VALUES (:user_id, :club_id, :responsabilite)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':club_id', $club_id);
            $stmt->bindParam(':responsabilite', $responsabilite);
            return $stmt->execute();
        }
    }
    ?>
    
