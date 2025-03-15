<?php
require_once __DIR__ . '/BaseModel.php';

class Statistics extends BaseModel {
    public function fetchStatistics() {
        // Nombre total de clubs
        $stmt = $this->db->query("SELECT COUNT(*) FROM clubs");
        $totalClubs = $stmt->fetchColumn();

        // Nombre total d'étudiants
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'etudiant'");
        $totalStudents = $stmt->fetchColumn();

        // Nombre de demandes d'adhésion en attente
        $stmt = $this->db->query("SELECT COUNT(*) FROM adhesions WHERE statut = 'en attente'");
        $pendingAdhesions = $stmt->fetchColumn();

        // Nombre total de membres des clubs
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_members");
        $totalMembers = $stmt->fetchColumn();

        // Nombre total d'événements organisés par tous les clubs
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_events");
        $totalEvents = $stmt->fetchColumn();

        // Nombre total de membres du bureau des clubs
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_bureau_members");
        $totalBureauMembers = $stmt->fetchColumn();

        // Statistiques par club
        $stmt = $this->db->query("
            SELECT 
                c.nom, 
                (SELECT COUNT(*) FROM club_members cm WHERE cm.club_id = c.id ) AS nb_membres,
                (SELECT COUNT(*) FROM club_events ce WHERE ce.club_id = c.id) AS nb_evenements
            FROM clubs c
        ");
        $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total_clubs' => $totalClubs,
            'total_students' => $totalStudents,
            'pending_adhesions' => $pendingAdhesions,
            'total_members' => $totalMembers,
            'total_events' => $totalEvents,
            'total_bureau_members' => $totalBureauMembers,
            'clubs' => $clubs
        ];
    }
    public function getTotalMembers($club_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM club_members WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Récupérer le nombre total de demandes d'adhésion avec état
    public function getAdhesionRequests($club_id) {
        $stmt = $this->db->prepare("
            SELECT 
                SUM(CASE WHEN statut = 'acceptée' THEN 1 ELSE 0 END) AS accepted,
                SUM(CASE WHEN statut = 'en attente' THEN 1 ELSE 0 END) AS pending,
                SUM(CASE WHEN statut = 'refusée' THEN 1 ELSE 0 END) AS refused
            FROM adhesions WHERE club_id = ?
        ");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer le nombre total d'événements organisés par le club
    public function getTotalEvents($club_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM club_events WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Récupérer le taux moyen de participation aux événements
    public function getParticipationRate($club_id) {
        $stmt = $this->db->prepare("
            SELECT 
                COALESCE(AVG(participants / capacity) * 100, 0) AS participation_rate
            FROM club_events WHERE club_id = ?
        ");
        $stmt->execute([$club_id]);
        return round($stmt->fetch(PDO::FETCH_ASSOC)['participation_rate'], 2);
    }

    // Récupérer le nombre total de participations aux événements
    public function getTotalParticipations($club_id) {
        $stmt = $this->db->prepare("SELECT SUM(participants) AS total FROM club_events WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
