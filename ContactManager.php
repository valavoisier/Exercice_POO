<?php
/* 
Utiliser la connexion créée pour interroger la base de données
Son rôle est de gérer les opérations liées aux contacts : lire, créer, modifier, supprimer.
*/
require_once 'DBConnect.php';
class ContactManager {
    private PDO $pdo;

    public function __construct(DBConnect $db) {
        $this->pdo = $db->getPDO();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM contact");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $contacts;
    }
}