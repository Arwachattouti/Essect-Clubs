<?php
require_once __DIR__ . '/../models/Event.php';
require_once 'BaseController.php';

class EventController extends BaseController {
    private $eventModel;

    public function __construct() {
        // Initialise les modèles sans passer de paramètres dans le constructeur
        $this->eventModel = new Event();
    }
    public function affichereventbyid($id) {
        return $this->eventModel-> getEventsByClubId($id); 
    }
    

    // Obtenir les événements par club_id
    public function getEventsByClubId($clubId) {
        return $this->eventModel->getEventsByClubId($clubId); // Assurez-vous que cette méthode existe dans le modèle
    }

    // Méthode pour obtenir un événement par son ID
    public function getEventById($id) {
        return $this->eventModel->getEventById($id);
    }
    public function update($event_id) {
        if (isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['status'], $_POST['participants'], $_POST['capacity'])) {
            // Récupérer les données du formulaire
            $club_id = $_POST['club_id'];
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $date = $_POST['date'];
            $lieu = htmlspecialchars($_POST['lieu']);
            $status = htmlspecialchars($_POST['status']); // Récupérer le statut de l'événement
            $participants = intval($_POST['participants']); // Récupérer le nombre de participants
            $capacity = intval($_POST['capacity']); // Récupérer la capacité de l'événement
        
           
        
            // Mettre à jour l'événement dans la base de données
            $updateSuccessful = $this->eventModel->updateEvent($event_id, $titre, $description, $date, $lieu, $status, $participants, $capacity);
            
            if ($updateSuccessful) {
                // Rediriger après la mise à jour
                header("Location: manage_events.php?id=1");
                exit;
            } else {
                // Afficher un message d'erreur en cas de problème
                echo "Erreur lors de la mise à jour de l'événement.";
            }
        } else {
            // Afficher un message d'erreur si les champs sont manquants
            echo "Tous les champs doivent être remplis.";
        }
    }
    
    
    public function create() {
        // Vérifier que toutes les données du formulaire sont présentes
        if (isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['participants'], $_POST['capacity'], $_POST['status'], $_POST['id']) && isset($_FILES['image'])) {
            
            // Assainir les entrées du formulaire
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $date = $_POST['date'];
            $lieu = htmlspecialchars($_POST['lieu']);
            $participants = htmlspecialchars($_POST['participants']);
            $capacity = htmlspecialchars($_POST['capacity']);
            $status = $_POST['status'];
            $id = intval($_POST['id']);
    
            // Gérer le téléchargement de l'image
            $uploadDir = "/clubs/public/img/clubsessect/";
    
            // Vérifier si le dossier existe, sinon le créer
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Récupérer le nom et le chemin de l'image
            $imageName = basename($_FILES['image']['name']);
            $imagePath = $uploadDir . $imageName;
    
            // Vérification de l'extension de l'image (seules les images autorisées)
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    
            // Si l'extension du fichier n'est pas autorisée, arrêter le processus
            if (!in_array($fileExtension, $allowedExtensions)) {
                die("Format d'image non autorisé.");
            }
    
            // Déplacer l'image dans le répertoire de téléchargement
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Appeler la méthode du modèle pour insérer l'événement dans la base de données
                $eventId = $this->eventModel->createEvent($id, $titre, $description, $date, $lieu, $imagePath, $capacity, $participants, $status);
    
                // Si l'événement a été créé avec succès
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
        // Vérifier que l'événement appartient bien au club avant suppression
        if (!$this->eventModel->checkEventOwnership($event_id, $club_id)) {
            return false; // L'événement ne correspond pas à ce club
        }
        // Supprimer l'événement
        return $this->eventModel->deleteEvent($event_id, $club_id);
    }
    
}
?>

