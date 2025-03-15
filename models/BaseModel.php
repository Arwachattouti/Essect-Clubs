<?php 
require_once(dirname(__DIR__) . '/config/database.php');
require_once(dirname(__DIR__) . '/config/Session.php');
class BaseModel {
    protected  $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
}
?>