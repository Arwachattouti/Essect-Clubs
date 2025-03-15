<?php

if (!class_exists('Database')) {
    class Database {
        private static $instance = null;
        private $conn;

        private function __construct() {
            try {
                $this->conn = new PDO("mysql:host=localhost;dbname=finalclubsessect", "root", "");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance;
        }

        public function getConnection() {
            return $this->conn;
        }
    }
}
?>




