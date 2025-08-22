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

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM contact");
        //obtenir toutes les lignes de la table contact dans un tableau associatif
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

    public function findById(int $id): ?Contact
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contact WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Contact(
            (int) $row['id'],
            $row['name'],
            $row['email'],
            $row['phone_number']
        );
    }
    public function create(Contact $contact): void
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO contact (name, email, phone_number)
        VALUES (:name, :email, :phone_number)
    ");

        $stmt->execute([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone_number' => $contact->getPhoneNumber()
        ]);
    }
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM contact WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function update(Contact $contact): void {
    $stmt = $this->pdo->prepare("
        UPDATE contact
        SET name = :name, email = :email, phone_number = :phone_number
        WHERE id = :id
    ");

    $stmt->execute([
        'id' => $contact->getId(),
        'name' => $contact->getName(),
        'email' => $contact->getEmail(),
        'phone_number' => $contact->getPhoneNumber()
    ]);
}

}
