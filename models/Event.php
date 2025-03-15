<?php
require_once __DIR__ . '/BaseModel.php';

class Event extends BaseModel {
 
    // Constructeur vide
    public function __construct() {
        // Pas de logique de construction ici
        parent::__construct();
    }
    public function getEventsByClubId9dima($club_id) {
        // Préparation de la requête SQL avec une jointure correcte et condition WHERE
        $stmt = $this->db->prepare("SELECT * FROM club_events ce 
                                    INNER JOIN clubs c ON ce.club_id = c.id
                                    WHERE ce.club_id = :club_id");
    
        // Exécution de la requête avec le paramètre club_id
        $stmt->execute(['club_id' => $club_id]);
    
        // Retourne tous les événements correspondants sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEventsByClubId($club_id) {
        // Préparation de la requête SQL avec une jointure correcte et condition WHERE
        $stmt = $this->db->prepare(
            "SELECT ce.*, c.nom AS club_name, c.logo AS club_logo 
            FROM club_events ce 
            INNER JOIN clubs c ON ce.club_id = c.id 
            WHERE ce.club_id = :club_id"
        );
        
        // Exécution de la requête avec le paramètre club_id
        $stmt->execute(['club_id' => $club_id]);
        
        // Retourne tous les événements correspondants sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    // Compter le nombre total d'événements
    public function countEvents() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM club_events");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['total'] : 0;
    }

    public function getEventById($id) {
        $stmt = $this->db->prepare("SELECT * FROM club_events WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $event;
    }

    // Sauvegarder un événement dans la base de données
    public function save($titre, $description, $date, $lieu, $club_id) {
        $stmt = $this->db->prepare("INSERT INTO club_events (titre, description, date, lieu, club_id) 
                                    VALUES (:titre, :description, :date, :lieu, :club_id)");
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'date' => $date,
            'lieu' => $lieu,
            'club_id' => $club_id
        ]);
        return $this->db->lastInsertId(); // Récupérer l'ID de l'événement inséré
    }
// Méthode pour créer un événement
public function createEvent($club_id, $titre, $description, $date, $lieu, $image, $capacity, $participants, $status) {
    if (is_array($image) && isset($image['name'], $image['tmp_name'])) {
        $imagePath = '/clubs/public/img/clubsessect/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    } else {
        $imagePath = $image; // Si $image est une chaîne (déjà un chemin)
    }
    
    // Requête SQL pour insérer un nouvel événement
    $sql = "INSERT INTO club_events (club_id, titre, image_principale, date, lieu, description, participants, capacity, status) 
            VALUES (:club_id, :titre, :image_principale, :date, :lieu, :description, :participants, :capacity, :status)";

    // Préparer la requête SQL
    $stmt = $this->db->prepare($sql);

    // Exécuter la requête avec les paramètres
    $stmt->execute([
        'club_id' => $club_id,
        'titre' => $titre,
        'image_principale' => $imagePath,
        'date' => $date,
        'lieu' => $lieu,
        'description' => $description,
        'participants' => $participants,
        'capacity' => $capacity,
        'status' => $status
    ]);

    // Retourner l'ID du dernier événement inséré
    return $this->db->lastInsertId();
}
public function updateEvent($event_id, $titre, $description, $date, $lieu, $status, $participants, $capacity) {
   
    // Mettre à jour les informations de l'événement dans la base de données
    $stmt = $this->db->prepare("UPDATE club_events 
                                SET titre = :titre, description = :description, date = :date, lieu = :lieu, status = :status, participants = :participants, capacity = :capacity
                                WHERE id = :id");

    // Vérifier si la requête s'exécute correctement
    if ($stmt->execute([
        'id' => $event_id,
        'titre' => $titre,
        'description' => $description,
        'date' => $date,
        'lieu' => $lieu,
        'status' => $status,  // Nouveau champ statut
        'participants' => $participants,  // Nouveau champ participants
        'capacity' => $capacity,  // Nouveau champ capacity
        
    ])) {
        return true;
    } else {
        return false; // Si l'exécution échoue
    }
}


    public function checkEventOwnership($event_id, $club_id) {
        $stmt = $this->db->prepare("SELECT id FROM club_events WHERE id = :event_id AND club_id = :club_id");
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':club_id', $club_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


    public function deleteEvent($event_id, $club_id) {
        $stmt = $this->db->prepare("DELETE FROM club_events WHERE id = :event_id AND club_id = :club_id");
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':club_id', $club_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>


