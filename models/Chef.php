<?php
require_once __DIR__ . '/BaseModel.php';

class Chef extends BaseModel {
    public function assignChefMember($club_id, $member_id) {
        $stmt = $this->db->prepare("SELECT * FROM club_bureau_members WHERE  club_id = ? AND  id = ?");
        $stmt->execute([ $club_id ,$member_id]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$member) {
            $_SESSION['error_message'] = "Membre introuvable.";
            return;
        }
    
        $newUsername = 'chef_' . $member['username'];
        $newEmail = 'chef_' . $member['email'];
    
        $defaultPassword = password_hash("default_password", PASSWORD_BCRYPT);
    
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role, club_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$newUsername, $newEmail, $defaultPassword, 'chef', $club_id]);
    
        $_SESSION['success_message'] = "Le membre {$member['username']} est maintenant chef du club.";
    }
    
     public function isClubExists($club_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM clubs WHERE id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function isClubHasChef($club_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE club_id = ? AND role = 'chef'");
        $stmt->execute([$club_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function isEmailExists($email, $exclude_user_id = null) {
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$email];

       if ($exclude_user_id) {
            $query .= " AND id != ?";
            $params[] = $exclude_user_id;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function isUsernameExists($username, $exclude_user_id = null) {
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $params = [$username];

        if ($exclude_user_id) {
            $query .= " AND id != ?";
            $params[] = $exclude_user_id;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
    public function addOrUpdateChef($username, $email, $password, $phone, $club_id) {
        if (!$this->isClubExists($club_id)) {
            return "Le club spécifié n'existe pas.";
        }
        if ($this->isClubHasChef($club_id)) {
            return "Ce club a déjà un chef. Un chef ne peut être attribué qu'à un seul club.";
        }
    
        $stmt = $this->db->prepare("SELECT id, role FROM users WHERE username = ? AND club_id = ?");
        $stmt->execute([$username, $club_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if ($user['role'] === 'chef') {
                return "Cet utilisateur est déjà un chef dans ce club.";
            } else {
                $stmt = $this->db->prepare("UPDATE users SET role = 'chef' WHERE id = ?");
                if ($stmt->execute([$user['id']])) {
                    return "Le rôle de l'utilisateur a été mis à jour en tant que chef.";
                } else {
                    return "Une erreur s'est produite lors de la mise à jour du rôle.";
                }
            }
        } else {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existingUser) {
                return "Le nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
            }
    
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("INSERT INTO users (username, email, password, phone, club_id, role) VALUES (?, ?, ?, ?, ?, 'chef')");
            if ($stmt->execute([$username, $email, $hashedPassword, $phone, $club_id])) {
                return "Le chef a été ajouté avec succès.";
            } else {
                return "Une erreur s'est produite lors de l'ajout du chef.";
            }
        }
    }
    
    
    

    // Récupérer tous les chefs avec leurs clubs
    public function getAllChefs() {
        $stmt = $this->db->query("SELECT users.id, users.username, users.email,users.password, users.phone,clubs.nom, users.profile_image, users.club_id
                                  FROM users 
                                  LEFT JOIN clubs ON users.club_id = clubs.id
                                  WHERE users.role = 'chef'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Modifier un chef
    public function updateChef($id, $username, $email, $phone, $club_id) {
        if (!$this->isClubExists($club_id)) {
            return "Le club spécifié n'existe pas.";
        }

        // Vérifier si l'email existe déjà dans la base de données
        if ($this->isEmailExists($email)) {
            return "L'email est déjà pris. Veuillez en choisir un autre.";
        }

        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, phone = ?, club_id = ? WHERE id = ? AND role = 'chef'");
        if ($stmt->execute([$username, $email, $phone, $club_id, $id])) {
            return "Le chef a été mis à jour avec succès.";
        } else {
            return "Une erreur s'est produite lors de la modification du chef.";
        }
    }

    // Supprimer un chef
    public function deleteChef($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ? AND role = 'chef'");
        return $stmt->execute([$id]);
    }

    // Récupérer un chef par ID
    public function getChefById($id) {
        // Préparer la requête SQL
        $query = "SELECT * FROM users WHERE role = 'chef' and id = :id";

        // Préparer l'exécution de la requête
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        // Récupérer le résultat
        $chef = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourner le chef ou null si non trouvé
        return $chef ? $chef : null;
    }
}
?>

