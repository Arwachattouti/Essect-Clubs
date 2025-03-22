<?php
require_once __DIR__ . '/BaseModel.php';

class Statistics extends BaseModel {
    public function fetchStatistics() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM clubs");
        $totalClubs = $stmt->fetchColumn();
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'etudiant'");
        $totalStudents = $stmt->fetchColumn();
        $stmt = $this->db->query("SELECT COUNT(*) FROM adhesions WHERE statut = 'en attente'");
        $pendingAdhesions = $stmt->fetchColumn();
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_members");
        $totalMembers = $stmt->fetchColumn();
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_events");
        $totalEvents = $stmt->fetchColumn();
        $stmt = $this->db->query("SELECT COUNT(*) FROM club_bureau_members");
        $totalBureauMembers = $stmt->fetchColumn();
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
    public function getTotalEvents($club_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM club_events WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function getParticipationRate($club_id) {
        $stmt = $this->db->prepare("
            SELECT 
                COALESCE(AVG(participants / capacity) * 100, 0) AS participation_rate
            FROM club_events WHERE club_id = ?
        ");
        $stmt->execute([$club_id]);
        return round($stmt->fetch(PDO::FETCH_ASSOC)['participation_rate'], 2);
    }
    public function getTotalParticipations($club_id) {
        $stmt = $this->db->prepare("SELECT SUM(participants) AS total FROM club_events WHERE club_id = ?");
        $stmt->execute([$club_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
