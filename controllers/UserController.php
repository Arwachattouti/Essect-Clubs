<?php
require_once __DIR__ . '/../models/User.php';
require_once 'BaseController.php';

class UserController extends BaseController {
    private $userModel;

    public function __construct() {
         $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            if (empty($username) && empty($email)) {
                $_SESSION['error'] = "L'email ou le nom d'utilisateur est requis.";
                header("Location: login.php");
                exit();
            }
    
            if (empty($password)) {
                $_SESSION['error'] = "Le mot de passe est requis.";
                header("Location: login.php");
                exit();
            }
    
            $user = $this->userModel->login($username, $email, $password);
    
            if ($user) {
                $userRole = $user['role'];
                $clubId = isset($user['club_id']) ? $user['club_id'] : null;
                $userId = $user['id'];
    
                Session::set('user_role', $userRole);
                Session::set('user_id', $userId);
                Session::set('club_id', $clubId);
    
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
                header("Location: login.php");
                exit();
            }
        } else {
            include __DIR__ . '/../views/visiteur/login.php';
        }
    }

    public function register() {
        $error = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $profile_image = $_FILES['profile_image'] ?? null;
            $consent = $_POST['consent'] ?? '';
    
            if (empty($username) || empty($email) || empty($password) || empty($consent)) {
                $error = 'Veuillez remplir tous les champs obligatoires.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Veuillez entrer un email valide.';
            }
    
            if ($profile_image && $profile_image['error'] === UPLOAD_ERR_OK) {
                $image_path = $this->handleFileUpload('profile_image');
            } else {
                $image_path = '';
            }
    
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
    
        return $error;
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
                $_SESSION['error_message'] = "Erreur lors du téléchargement de $fileName.";
            }
        } else {
            $_SESSION['error_message'] = "Type de fichier non autorisé pour $fileName.";
        }
        return $currentFile;
    }
    
    public function getAllUsers() {
        return $this->userModel->fetchAllUsers();
    }

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
    
    public function logout() {
        Session::destroy();
        header("Location: " . BASE_URL . "/login");
        exit();
    }
    
    public function afficherProfil($id) {
        return $this->userModel->getProfilEtudiant($id);
    }
    
    public function mettreAJourProfil($id, $username, $email, $phone) {
        return $this->userModel->mettreAJourProfil($id, $username, $email, $phone);
    }
}?>
