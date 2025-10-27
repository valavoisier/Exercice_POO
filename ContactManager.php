<?php

/**
 * CRUD
 * MODEL: responsable de l'accès aux données. 
 * Utiliser la connexion créée pour interroger la base de données
 * Son rôle est de gérer les opérations liées aux contacts : lire, créer, modifier, supprimer.
 * Elle utilise la connexion PDO (via DBConnect) pour exécuter des requêtes SQL, et elle transforme les résultats en objets Contact.
 */

//CRUD
class ContactManager
{
    // Propriété pour stocker l'objet PDO / instance
    private PDO $pdo;

    //méthode constructeur pour initialiser l'instance PDO
    public function __construct()
    {
        $db = DBConnect::getInstance(); //Récupération de l'instance unique
        $this->pdo = $db->getPDO(); //Le constructeur utilise l'instance singleton de DBConnect
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
    
    // méthode pour récupérer un contact par son identifiant
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

    // méthode pour créer un nouveau contact
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

    // méthode pour supprimer un contact par son identifiant
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM contact WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // méthode pour modifier un contact existant
    public function update(Contact $contact): void
    {
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
