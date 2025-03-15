<?php
require_once __DIR__ . '/../models/Statistics.php';
require_once 'BaseController.php';
class StatisticsController extends BaseController {
    public function getStatisticsadmin() {
        $statisticsModel = new Statistics();
        return $statisticsModel->fetchStatistics();
    }
    private $model;

    public function __construct() {
        $this->model = new Statistics();
    }
    
    
    public function getStatisticschef($club_id) {
        return [
            'total_members' => $this->model->getTotalMembers($club_id),
            'accepted_requests' => $this->model->getAdhesionRequests($club_id)['accepted'],
            'pending_requests' => $this->model->getAdhesionRequests($club_id)['pending'],
            'rejected_requests' => $this->model->getAdhesionRequests($club_id)['refused'],
            'total_events' => $this->model->getTotalEvents($club_id),
            'total_participations' => $this->model->getTotalParticipations($club_id),
            'participation_rate' => $this->model->getParticipationRate($club_id)
        ];
    }
}
