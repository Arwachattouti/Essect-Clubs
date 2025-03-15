<?php
require_once '../../models/suiviedemande.php';
require_once __DIR__ . '/BaseController.php';
class SuivieDemandeController {
    private $model;

    public function __construct() {
        $this->model = new Demande();
    }

    public function afficherDemandes() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: detailclub.php");
            exit();
        }

        return $this->model->getDemandesByEtudiantId($_SESSION['user_id']);
    }
}
?>