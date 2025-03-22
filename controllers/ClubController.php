<?php
require_once __DIR__ . '/../models/Club.php';
require_once 'BaseController.php';
class ClubController extends BaseController {
    private $clubModel; 
    public function __construct() {
        $this->clubModel = new Club(); 
    }
    public function create() {
        $errorMessage = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clubModel = new Club();
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $date_creation = $_POST['date_creation'];
            $facebook_link = $_POST['facebook_link'] ?? null;
            $instagram_link = $_POST['instagram_link'] ?? null;
            $nb_membre = $_POST['nb_membre'] ?? 0;
            $nb_partenaires = $_POST['nb_partenaires'] ?? 0;
            $lien = $_POST['lien'];
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $logoTmpName = $_FILES['logo']['tmp_name'];
                $logoName = $_FILES['logo']['name'];
                $logoExtension = pathinfo($logoName, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array(strtolower($logoExtension), $allowedExtensions)) {
                
                    $newLogoName = uniqid('', true) . '.' . $logoExtension;
                    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/clubs/public/img/clubsessect/';
    
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0777, true); 
                    }
    
                    $uploadPath = $uploadDirectory . $newLogoName;
                    if (move_uploaded_file($logoTmpName, $uploadPath)) {
                        $img_slide1 = null;
                        $img_slide2 = null;
    
                        if (isset($_FILES['img_slide1']) && $_FILES['img_slide1']['error'] == 0) {
                            $img_slide1TmpName = $_FILES['img_slide1']['tmp_name'];
                            $img_slide1Name = $_FILES['img_slide1']['name'];
                            $img_slide1Extension = pathinfo($img_slide1Name, PATHINFO_EXTENSION);
    
                            if (in_array(strtolower($img_slide1Extension), $allowedExtensions)) {
                                $newImgSlide1Name = uniqid('', true) . '.' . $img_slide1Extension;
                                $uploadImgSlide1Path = $_SERVER['DOCUMENT_ROOT'] . '/clubs/public/img/clubsessect/' . $newImgSlide1Name;
                                if (move_uploaded_file($img_slide1TmpName, $uploadImgSlide1Path)) {
                                    $img_slide1 = $newImgSlide1Name;
                                }
                            }
                        }
    
                        if (isset($_FILES['img_slide2']) && $_FILES['img_slide2']['error'] == 0) {
                            $img_slide2TmpName = $_FILES['img_slide2']['tmp_name'];
                            $img_slide2Name = $_FILES['img_slide2']['name'];
                            $img_slide2Extension = pathinfo($img_slide2Name, PATHINFO_EXTENSION);
    
                            if (in_array(strtolower($img_slide2Extension), $allowedExtensions)) {
                                $newImgSlide2Name = uniqid('', true) . '.' . $img_slide2Extension;
                                $uploadImgSlide2Path = $_SERVER['DOCUMENT_ROOT'] . '/clubs/public/img/clubsessect/' . $newImgSlide2Name;
                                if (move_uploaded_file($img_slide2TmpName, $uploadImgSlide2Path)) {
                                    $img_slide2 = $newImgSlide2Name;
                                }
                            }
                        }
    
                        $errorMessage = $clubModel->createClub($nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $img_slide1, $img_slide2, $newLogoName);
                        if ($errorMessage === null) {
                           header("Location: ../admin/manage_clubs.php");
                            exit();
                        } else {
                            $errorMessage = "Erreur lors de l'ajout du club.";
                        }
                    } else {
                        $errorMessage = "Erreur lors de l'upload de l'image du logo.";
                    }
                } else {
                    $errorMessage = "Seules les images (jpg, jpeg, png, gif) sont autorisées pour le logo.";
                }
            } else {
                $errorMessage = "Veuillez télécharger une image pour le logo.";
            }
        }
    
        $this->render('create_club', ['errorMessage' => $errorMessage]);
    }
    public function getClubById($id) {
        return $this->clubModel->getClubById($id);
    }
    public function handleFileUpload($fileName, $currentFile = null) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/clubs/public/img/clubsessect/";
        $filePath = $uploadDir . basename($_FILES[$fileName]['name']);
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $filePath)) {
                return basename($_FILES[$fileName]['name']);
            } else {
                $_SESSION['error_message'] = "Erreur lors du téléchargement de l'$fileName.";
            }
        } else {
            $_SESSION['error_message'] = "Type de fichier non autorisé pour $fileName.";
        }
        return $currentFile; 
    }

    public function updateClub($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2) {
        $logo = $this->handleFileUpload('logo', $logo);
        $img_slide1 = $this->handleFileUpload('img_slide1', $img_slide1);
        $img_slide2 = $this->handleFileUpload('img_slide2', $img_slide2);
        
        $clubModel = new Club();
        if ($clubModel->update($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2)) {
            header("Location: ../admin/manage_clubs.php");
            exit();
        }
    }   
    public function updateClubchef($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2) {
   
        $logo = $this->handleFileUpload('logo', $logo);
        $img_slide1 = $this->handleFileUpload('img_slide1', $img_slide1);
        $img_slide2 = $this->handleFileUpload('img_slide2', $img_slide2);
        
        $clubModel = new Club();
        if ($clubModel->update($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2)) {
            $_SESSION['success_message'] = "Le club a été mis à jour avec succès.";
            header("Location: ../chef/manage_club.php?id=".$clubId);
         exit();
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du club.";
        }
    }
    
     public function index() {
        $clubs = $this->clubModel->getAllClubs();
        $this->render('admin/manage_clubs', ['clubs' => $clubs]);
    }
    public function manageClubs() {
     $clubs = $this->clubModel->getAllClubs(); 
    
    return $clubs;
}
    public function afficherClubs() {
        return  $this->clubModel->getClubs();
    }
    public function afficherClubById($id) {
        return  $this->clubModel->getClubById($id);
    }
    
    public function edit($id) {
        $club = $this->clubModel->getClubById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description_courte'];
            $date_creation = $_POST['date_creation'];
            $logo = $_POST['logo'];

            $this->clubModel->updateClub($id, $nom, $description, $date_creation, $logo);
            header("Location: /admin");
        }

        $this->render('club/edit', ['club' => $club]);
    }

    public function delete($id) {
        if ($this->clubModel->deleteClub($id)) {
            $_SESSION['success_message'] = "Le club a été supprimé avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la suppression du club.";
        }
    
        header("Location: ../admin/manage_clubs.php");
        exit(); 
    }
    

}
?>

