<?php
require_once __DIR__ . '/BaseModel.php';

class Adhesion extends BaseModel {
    public function create($user_id, $club_id, $full_name, $birthdate, $email, $phone, $gender, $skills, $hobbies, $reason, $cv_path) {
        // Prepare the SQL insert statement
        $stmt = $this->db->prepare("
            INSERT INTO adhesions (user_id, club_id, full_name, birthdate, email, phone, gender, skills, hobbies, reason, cv_pdf_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$user_id, $club_id, $full_name, $birthdate, $email, $phone, $gender, $skills, $hobbies, $reason, $cv_path]);
    }
    public function checkDepartementExists($departement_id) {
        $sql = "SELECT id FROM departements WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $departement_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false; // Retourne true si trouvé, sinon false
        } else {
            return false;
        }
    }
    public function getAdhesionsByuserId($id) {
        $sql = "SELECT * FROM adhesions WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
    public function getAdhesionById($adhesion_id) {
        $sql = "SELECT * FROM adhesions WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $adhesion_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // On récupère une seule adhésion
    }
    public function updateStatut($id, $statut) {
        $sql = "UPDATE adhesions SET statut = :statut WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo "Statut mis à jour avec succès pour l'ID: $id";
        } else {
            print_r($stmt->errorInfo()); // afficher les erreurs SQL
        }
        
    }
    
    // Supprimer une adhésion
    public function deleteAdhesion($id) {
        $sql = "DELETE FROM adhesions WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        var_dump($stmt->execute());
        return $stmt->execute();
    }
    public function saveAdhesion($full_name, $email, $birthdate, $phone, $gender, $club_id, $skills, $hobbies, $reason, $cvPath) {
        $stmt = $this->db->prepare("INSERT INTO adhesions (full_name, email, birthdate, phone, gender, club_id, skills, hobbies, reason, cv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $birthdate, $phone, $gender, $club_id, $skills, $hobbies, $reason, $cvPath]);
    }
    
    public function countAdhesions() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM adhesions");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        // Requête pour récupérer les adhésions avec les informations des clubs et des utilisateurs
        $stmt = $db->query("
            SELECT a.*, c.nom AS club_nom, u.username 
            FROM adhesions a
            JOIN clubs c ON a.club_id = c.id
            JOIN users u ON a.user_id = u.id
        ");

        // Exécuter la requête et retourner le résultat sous forme de tableau
        return $stmt->fetchAll(PDO::FETCH_ASSOC);}

        public function getAdhesionsByClubId($club_id) {
            $query = "SELECT * FROM adhesions WHERE club_id = :club_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':club_id' => $club_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourner toutes les adhésions sous forme de tableau
        }
}
?>
