<?php
require_once __DIR__ . '/BaseModel.php';
class User extends BaseModel {
    public function login($username, $email, $password) {
        // Requête préparée avec vérification par nom d'utilisateur ou email
        $sql = "SELECT * FROM users WHERE (username = :username OR email = :email) LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
    
        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                return $user; // Retourner les données de l'utilisateur si la vérification du mot de passe est réussie
            }
    
        } catch (PDOException $e) {
            // Gérer l'erreur de base de données
            error_log($e->getMessage()); // Log de l'erreur pour débogage
            return false; // Retourner false si une erreur survient
        }
        return false; // Si l'utilisateur n'est pas trouvé ou si le mot de passe est incorrect
    }
    
    public function login9dima ($username, $email, $password) {
        if (!empty($username)) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
        } elseif (!empty($email)) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
        } else {
            return false;
        }
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            echo "Mot de passe stocké : " . $user['password'] . "<br>"; // Mot de passe stocké
            echo "Mot de passe fourni : " . $password . "<br>"; // Mot de passe fourni
            echo password_hash('admin123', PASSWORD_DEFAULT);
            if (password_verify($password, $user['password'])) {
                echo "Mot de passe vérifié avec succès !<br>";
                Session::set('user_id', $user['id']);
                Session::set('user_role', $user['role']);
                return true;
            } else {
                echo "Erreur : Mot de passe incorrect.<br>";
            }
        } else {
            echo "Erreur : Utilisateur non trouvé.<br>";
        }
        return false;
    }
    public function getProfilEtudiant($idEtudiant) {
        $sql = "SELECT id, username, email, phone, profile_image FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idEtudiant, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     public function mettreAJourProfil($id, $username, $email, $phone) {
        $sql = "UPDATE users SET username = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $phone, $id]);
    }



    public function register($username, $email, $password, $phone, $profile_image) {
        // Requête SQL pour insérer un nouvel utilisateur
        $query = "INSERT INTO users (username, email, password, phone, profile_image) 
                  VALUES (:username, :email, :password, :phone, :profile_image)";
        // Préparation de la requête
        $stmt = $this->db->prepare($query);
        // Bind des paramètres
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':profile_image', $profile_image);
        // Exécution de la requête et retour du résultat
        return $stmt->execute();
    }
    public function isLoggedIn() {
        return Session::exists('user_id');
    }
    public function isAdmin() {
        return $this->isLoggedIn() && Session::get('user_role') === 'admin';
    }
    public function logout() {
        Session::destroy();
        session_unset();
    }
    public static function delete($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Récupérer tous les utilisateurs
    public function fetchAllUsers() {
        $stmt = $this->db->prepare("SELECT id, username, email, role FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer un utilisateur par ID
    public function deleteUserById($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countUsers() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserById($id, $username, $email, $role, $imagePath = null) {
        if ($imagePath) {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, role = ?, profile_image = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $role, $imagePath, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $role, $id]);
        }
    }
    

    public static function getAllUsers() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer un nouvel utilisateur
    public function createUser($username, $email, $password, $phone, $birthdate, $university) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        try {
            $stmt = $this->db->prepare("INSERT INTO users (username, email, password, phone, birthdate, university) 
                                        VALUES (:username, :email, :password, :phone, :birthdate, :university)");
    
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(':university', $university, PDO::PARAM_STR);
    
            return $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>

