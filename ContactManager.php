<?php
/**
 * Utiliser la connexion créée pour interroger la base de données
 * Son rôle est de gérer les opérations liées aux contacts : lire, créer, modifier, supprimer.
 * Elle utilise la connexion PDO (via DBConnect) pour exécuter des requêtes SQL, et elle transforme les résultats en objets Contact.
 */
require_once 'DBConnect.php';
require_once 'Contact.php';
class ContactManager
{
    // Propriété pour stocker l'instance PDO
    private PDO $pdo;
    //méthode constructeur pour initialiser l'instance PDO
    public function __construct(DBConnect $db)
    {
        $this->pdo = $db->getPDO();
    }
    // Méthode pour récupérer tous les contacts
    
    public function findAll(): array {
    $stmt = $this->pdo->query("SELECT * FROM contact");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $contacts = [];

    foreach ($rows as $row) {
        $contact = new Contact(
            (int) $row['id'],
            $row['name'],
            $row['email'],
            $row['phone_number']
        );
        $contacts[] = $contact;
    }

    return $contacts;
    }
}
