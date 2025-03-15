<?php
require_once __DIR__ . '/BaseModel.php';

class Departement extends BaseModel {

    public function getAllDepartements() {
        $stmt = $this->db->query("SELECT * FROM departements ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDepartement($nom, $club_id, $description) {
        $stmt = $this->db->prepare("INSERT INTO departements (nom, club_id, description) VALUES (:nom, :club_id , :description)");
        return $stmt->execute([
            'nom' => $nom,
            'club_id' => $club_id,
            'description'=>$description
        ]);
    }
    public function getDepartementsByClubId($club_id) {


        $stmt = $this->db->prepare("SELECT * FROM departements WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDepartementById($id) {
        $stmt = $this->db->prepare("SELECT * FROM departements WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDepartement($id, $nom, $description) {
        $stmt = $this->db->prepare("UPDATE departements SET nom = :nom, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
        ]);
    }
    

    public function deleteDepartement($id) {
        // Vérifier s'il y a des dépendances avant suppression
        //$stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE departement_id = :id");
        //$stmt->execute(['id' => $id]);
        //if ($stmt->fetchColumn() > 0) {
            //return false; // Impossible de supprimer
        //}

        $stmt = $this->db->prepare("DELETE FROM departements WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }


    
}
?>

