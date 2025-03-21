<?php
require_once __DIR__ . '/BaseModel.php';

class Club extends BaseModel{
   
public function getAllClubs() {
    $stmt = $this->db->query("SELECT * FROM clubs");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function update($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2) {
    
     $query = "UPDATE clubs 
     SET nom = ?, description = ?, date_creation = ?, facebook_link = ?, instagram_link = ?, 
         nb_membre = ?, nb_partenaires = ?, logo = ?, img_slide1 = ?, img_slide2 = ? 
     WHERE id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
        $nom, $description, $date_creation, $facebook_link, $instagram_link, 
        $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2, $clubId
    ]);
    return $stmt->rowCount() > 0;
}
public function getClubById($clubId) {
    $query1 = "SELECT * FROM clubs WHERE id = ?";
    $stmt1 = $this->db->prepare($query1);
    $stmt1->execute([$clubId]);
    $club = $stmt1->fetch(PDO::FETCH_ASSOC);
    
    if ($club) {
        $query2 = "SELECT COUNT(*) as nb_evenements FROM club_events WHERE club_id = ?";
        $stmt2 = $this->db->prepare($query2);
        $stmt2->execute([$clubId]);
        $events = $stmt2->fetch(PDO::FETCH_ASSOC);
        $club['nb_evenements'] = $events['nb_evenements'];
    }
    
    return $club ?: [];
}


public function getClubs() {
    try {
        $query = "SELECT * FROM clubs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $clubs ?: []; 
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des clubs : " . $e->getMessage());
    }
}



public function createClub($nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $img_slide1, $img_slide2, $logoName) {
    $sql = "SELECT COUNT(*) FROM clubs WHERE nom = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$nom]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return "Le club avec ce nom existe déjà.";
    } else {
        $sql = "INSERT INTO clubs (nom, description, date_creation, facebook_link, instagram_link, nb_membre, nb_partenaires, img_slide1, img_slide2, logo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $img_slide1, $img_slide2, $logoName]);
        return null;
    }
}
    
    
    public function countClubs() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM clubs");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    public function updateClub($id, $nom, $description, $date_creation, $logo) {
        $stmt = $this->db->prepare("
            UPDATE clubs 
            SET nom = :nom, description_courte = :description, date_creation = :date_creation, logo = :logo 
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
            'date_creation' => $date_creation,
            'logo' => $logo
        ]);
    }
    public static function deleteClub($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM clubs WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    public static function handleFileUpload($file) {
        if ($file['error'] == 0) {
            $upload_dir = 'uploads/';
            $file_name = basename($file['name']);
            $file_path = $upload_dir . $file_name;
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_extensions = ['pdf', 'doc', 'docx'];

            if (in_array($file_extension, $allowed_extensions)) {
                if (move_uploaded_file($file['tmp_name'], $file_path)) {
                    return $file_path;  
                } else {
                    throw new Exception("Failed to upload CV.");
                }
            } else {
                throw new Exception("Invalid file type. Only PDF, DOC, and DOCX are allowed.");
            }
        } else {
            throw new Exception("Error in file upload.");
        }
    }
   
}
?>



