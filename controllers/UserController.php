<?php
require_once __DIR__ . '/../models/User.php';
require_once 'BaseController.php';

class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        // Remplacement de Visiteur par User
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            // Vérifier si le nom d'utilisateur ou l'email est vide
            if (empty($username) && empty($email)) {
                $_SESSION['error'] = "L'email ou le nom d'utilisateur est requis.";
                header("Location: login.php"); // Rediriger vers la page de login
                exit();
            }
    
            // Vérifier si le mot de passe est vide
            if (empty($password)) {
                $_SESSION['error'] = "Le mot de passe est requis.";
                header("Location: login.php"); // Rediriger vers la page de login
                exit();
            }
    
            // Appeler la méthode login du modèle User
            $user = $this->userModel->login($username, $email, $password);
    
            if ($user) {
                // Si l'utilisateur est trouvé, récupérer son rôle et club_id
                $userRole = $user['role'];
                $clubId = isset($user['club_id']) ? $user['club_id'] : null;
                $userId = $user['id']; // Assurez-vous que l'ID est également récupéré
    
                // Stocker les informations dans la session
                Session::set('user_role', $userRole);
                Session::set('user_id', $userId);
                Session::set('club_id', $clubId);
    
                // Redirection en fonction du rôle
                if ($userRole === 'administrateur') {
                    header("Location: ../admin/dashboard.php");
                } elseif ($userRole === 'chef' && $clubId) {
                    header("Location: ../chef/dashboard.php?id=" . $clubId);
                } else {
                    header("Location: ../etudiant/listeclubs.php?id=" . $userId);
                }
                exit();
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: login.php"); // Rediriger vers la page de login
                exit();
            }
        } else {
            // Afficher la page de login si ce n'est pas une requête POST
            include __DIR__ . '/../views/visiteur/login.php';
        }
    }
    
    
    

    public function register() {
        $error = ''; // Définit la variable d'erreur comme vide par défaut
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $profile_image = $_FILES['profile_image'] ?? null;
            $consent = $_POST['consent'] ?? '';
    
            // Vérification des champs obligatoires
            if (empty($username) || empty($email) || empty($password) || empty($consent)) {
                $error = 'Veuillez remplir tous les champs obligatoires.';
            }
            // Vérification de l'email
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Veuillez entrer un email valide.';
            }
    
            // Gestion de l'image de profil
            if ($profile_image && $profile_image['error'] === UPLOAD_ERR_OK) {
                $image_path = $this->handleFileUpload('profile_image'); // Utilisation de la méthode d'upload
            } else {
                $image_path = ''; // Si aucune image n'est téléchargée
            }
    
            // Si aucune erreur, procéder à l'enregistrement
            if (empty($error)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if ($this->userModel->register($username, $email, $hashedPassword, $phone, $image_path)) {
                    header("Location: ../visiteur/login.php");
                    exit();
                } else {
                    $error = 'Erreur lors de l\'inscription.';
                }
            }
        }
    
        return $error; // Retourne l'erreur ou vide si aucun problème
    }
    
    // Méthode de gestion des fichiers
    public function handleFileUpload($fileName, $currentFile = null) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/clubs/public/img/clubsessect/";
        $filePath = $uploadDir . basename($_FILES[$fileName]['name']);
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $filePath)) {
                return basename($_FILES[$fileName]['name']);
            } else {
                $_SESSION['error_message'] = "Erreur lors du téléchargement de $fileName.";
            }
        } else {
            $_SESSION['error_message'] = "Type de fichier non autorisé pour $fileName.";
        }
        return $currentFile; // Si l'upload échoue, retourner l'ancien fichier.
    }
    

    // Récupérer tous les utilisateurs
    public function getAllUsers() {
        return $this->userModel->fetchAllUsers();
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        return $this->userModel->deleteUserById($id);
    }

    public function getUserById($id) {
        return $this->userModel->fetchUserById($id);
    }

    public function updateUser($id, $username, $email, $role, $imagePath = null) {
        $role = ($role === 'user') ? 'student' : $role;
        return $this->userModel->updateUserById($id, $username, $email, $role, $imagePath);
    }
    

    // Déconnexion
    public function logout() {
        Session::destroy();
        header("Location: " . BASE_URL . "/login");
        exit();
    }
    public function afficherProfil($id) {
        return  $this->userModel->getProfilEtudiant($id);
      }
      public function mettreAJourProfil($id, $username, $email, $phone) {
        
      return  $this->userModel->mettreAJourProfil($id, $username, $email, $phone);

     
    }
    
}
?>
