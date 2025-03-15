<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Club.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Adhesion.php';
require_once __DIR__ . '/../models/Event.php';

class AdminController extends BaseController {
    private $adminModel;
    private $clubModel;
    private $userModel;
    private $adhesionModel;
    private $eventModel;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header("Location: ?page=login");
            exit();
        }

        $this->adminModel = new Admin();
        $this->clubModel = new Club();
        $this->userModel = new User();
        $this->adhesionModel = new Adhesion();
        $this->eventModel = new Event();
    
    }
     public function dashboard() {
        $stats = [
            'total_clubs' => $this->clubModel->countClubs(),
            'total_users' => $this->userModel->countUsers(),
            'total_adhesions' => $this->adhesionModel->countAdhesions(),
            'total_events' => $this->eventModel->countEvents(),
        ];

        $clubs = $this->clubModel->getAllClubs();
        $users = $this->userModel->getAllUsers();

        $this->render('admin/dashboard', [
            'stats' => $stats,
            'clubs' => $clubs,
            'users' => $users
        ]);
    }

    public function manageClubs() {
        $clubs = $this->clubModel->getAllClubs();
        $this->render('admin/manage_clubs', ['clubs' => $clubs]);
    }

    public function manageUsers() {
        $users = $this->userModel->getAllUsers();
        $this->render('admin/manage_users', ['users' => $users]);
    }

     public function manageAdhesions() {
        $adhesions = $this->adhesionModel->getAll();
        $this->render('admin/manage_adhesions', ['adhesions' => $adhesions]);
    }

    public function deleteClub($id) {
        if ($this->clubModel->deleteClub($id)) {
            header("Location: ?page=admin_dashboard");
            exit();
        } else {
            echo "Erreur lors de la suppression du club.";
        }
    }

     public function deleteUser($id) {
        if ($this->userModel->delete($id)) {
            header("Location: ?page=admin_dashboard");
            exit();
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }
}
?>


