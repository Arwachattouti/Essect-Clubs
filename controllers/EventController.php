<?php
require_once __DIR__ . '/../models/Event.php';
require_once 'BaseController.php';

class EventController extends BaseController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }
    public function affichereventbyid($id) {
        return $this->eventModel-> getEventsByClubId($id); 
    }
    public function getEventsByClubId($clubId) {
        return $this->eventModel->getEventsByClubId($clubId);
    }
    public function getEventById($id) {
        return $this->eventModel->getEventById($id);
    }
    public function update($event_id) {
        if (isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['status'], $_POST['participants'], $_POST['capacity'])) {
            $club_id = $_POST['club_id'];
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $date = $_POST['date'];
            $lieu = htmlspecialchars($_POST['lieu']);
            $status = htmlspecialchars($_POST['status']);
            $participants = intval($_POST['participants']); 
            $capacity = intval($_POST['capacity']);
            $updateSuccessful = $this->eventModel->updateEvent($event_id, $titre, $description, $date, $lieu, $status, $participants, $capacity);
            if ($updateSuccessful) {
               header("Location: manage_events.php?id=1");
                exit;
            } else {
                echo "Erreur lors de la mise à jour de l'événement.";
            }
        } else {
            echo "Tous les champs doivent être remplis.";
        }
    }
    
    
    public function create() {
        if (isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['participants'], $_POST['capacity'], $_POST['status'], $_POST['id']) && isset($_FILES['image'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $date = $_POST['date'];
            $lieu = htmlspecialchars($_POST['lieu']);
            $participants = htmlspecialchars($_POST['participants']);
            $capacity = htmlspecialchars($_POST['capacity']);
            $status = $_POST['status'];
            $id = intval($_POST['id']);
            $uploadDir = "/clubs/public/img/clubsessect/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $imageName = basename($_FILES['image']['name']);
            $imagePath = $uploadDir . $imageName;
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                die("Format d'image non autorisé.");
            }
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $eventId = $this->eventModel->createEvent($id, $titre, $description, $date, $lieu, $imagePath, $capacity, $participants, $status);
                if ($eventId) {
                    $_SESSION['success_message'] = "L'événement a été créé avec succès.";
                    header("Location: ../chef/manage_events.php?id=" . $id); // Rediriger vers la gestion des événements
                    exit();
                } else {
                    $_SESSION['error_message'] = "Une erreur est survenue lors de la création de l'événement.";
                }
            } else {
                die("Erreur de téléchargement de l'image principale.");
            }
        } else {
            echo "Veuillez remplir tous les champs du formulaire et sélectionner une image principale.";
        }
    }
    

    public function deleteEvent($event_id, $club_id) {
        if (!$event_id || !$club_id) {
            return false;
        }
        if (!$this->eventModel->checkEventOwnership($event_id, $club_id)) {
            return false; 
        }
       return $this->eventModel->deleteEvent($event_id, $club_id);
    }
    
}
?>

