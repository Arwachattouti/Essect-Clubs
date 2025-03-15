<?php
require_once __DIR__ . '/BaseModel.php';

class Member extends BaseModel {

  // Récupérer tous les membres d'un club spécifique
public function getAllMembers($id) {
    $sql = "SELECT 
                m.id, 
                u.username, 
                u.email, 
                d.nom AS departement, 
                c.nom AS club, 
                m.date_adhesion, 
                m.statut_membre 
            FROM club_members m
            JOIN users u ON m.user_id = u.id
            JOIN departements d ON m.departement_id = d.id
            JOIN clubs c ON m.club_id = c.id
            WHERE m.club_id = ?"; // Correction ici: ajout de l'alias "m" devant club_id

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$id]); // Correction ici: Passage du paramètre $id dans execute()
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Ajouter un membre
    public function addMember($user_id, $club_id, $adhesion_id, $departement_id, $statut_membre = 'actif') {
        $sql = "INSERT INTO club_members (user_id, club_id, adhesion_id, departement_id, statut_membre) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$user_id, $club_id, $adhesion_id, $departement_id, $statut_membre]);
    }
    public function addMembera($user_id, $club_id, $adhesion_id, $departement_id) {
        // Vérifier si le département existe dans la table departements
        $query = "SELECT id FROM departements WHERE id = :departement_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':departement_id' => $departement_id]);
    
        if ($stmt->rowCount() == 0) {
            die("Le département spécifié n'existe pas.");
        }
    
        // Si le département existe, ajouter le membre
        $query = "INSERT INTO club_members (user_id, club_id, adhesion_id, departement_id) 
                  VALUES (:user_id, :club_id, :adhesion_id, :departement_id)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id,
            ':club_id' => $club_id,
            ':adhesion_id' => $adhesion_id,
            ':departement_id' => $departement_id
        ]);
        ;
    }
    
    

    // Supprimer un membre
    public function deleteMember($id) {
        $sql = "DELETE FROM club_members WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    } 
    public function getMemberById($id) {

        $query = "SELECT m.*, u.username, u.email, d.nom AS departement, d.id AS departement_id
        FROM club_members m
        JOIN users u ON m.user_id = u.id
        JOIN departements d ON m.departement_id = d.id
       
        WHERE m.id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function afficherProfilMember($id) {
        $query = "SELECT m.*, u.username, u.email, d.nom AS departement, d.id AS departement_id, c.nom AS club_nom
                  FROM club_members m
                  JOIN users u ON m.user_id = u.id
                  JOIN departements d ON m.departement_id = d.id
                  JOIN clubs c ON m.club_id = c.id
                  WHERE m.user_id = :id"; // Utilisation de m.user_id pour correspondre avec l'utilisateur
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateMember($id, $username, $email, $departement, $statut) {
        try {
            $this->db->beginTransaction(); // Démarrer une transaction
            
            // 1️⃣ Mettre à jour `username` et `email` dans `users`
            $queryUser = "UPDATE users SET username = :username, email = :email 
                          WHERE id = (SELECT user_id FROM club_members WHERE id = :id)";
            $stmtUser = $this->db->prepare($queryUser);
            $stmtUser->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtUser->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtUser->execute();
            
            // 2️⃣ Mettre à jour `statut_membre` et `departement_id` dans `club_members`
            $queryMember = "UPDATE club_members 
                            SET departement_id = :departement, statut_membre = :statut 
                            WHERE id = :id";
            $stmtMember = $this->db->prepare($queryMember);
            $stmtMember->bindParam(':id', $id, PDO::PARAM_INT);
           
            $departementId = intval($departement);
$stmtMember->bindParam(':departement', $departementId, PDO::PARAM_INT);

            $stmtMember->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmtMember->execute();
    
            $this->db->commit(); // Valider la transaction
            return true;
        } catch (Exception $e) {
            $this->db->rollBack(); // Annuler si erreur
            return false;
        }
    }
    
    

}
