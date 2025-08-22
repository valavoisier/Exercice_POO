<?php
/**
 * Stocke toute la logique d’exécution de chaque commande (help, list, detail, create, delete, quit). 
 */
class Command
{
    // Propriété pour stocker l'instance de ContactManager
    private ContactManager $manager;

    // Constructeur pour initialiser l'instance de ContactManager
    public function __construct(ContactManager $manager)
    {
        $this->manager = $manager;
    }
    // Méthode pour exécuter la commande 'list'
    public function list(): void
    {
        $contacts = $this->manager->findAll();
        echo "Liste des contacts :\n";
        echo "id, name, email, phone number\n";
        foreach ($contacts as $contact) {
            //echo $contact->toString() . "\n";
            echo $contact . "\n";
        }
    }
    public function detail(int $id): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé avec l'ID $id.\n";
        } else {
            echo "Détail du contact :\n";
            echo "id, name, email, phone number\n";
            echo $contact . "\n";
        }
    }
    public function create(string $name, string $email, string $phoneNumber): void
    {
        $contact = new Contact(null, $name, $email, $phoneNumber);
        $this->manager->create($contact);
        echo "Contact créé avec succès :\n";
        echo $contact . "\n";
    }
    public function delete(int $id): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé avec l'ID $id. Suppression impossible.\n";
        } else {
            $this->manager->delete($id);
            echo "Contact supprimé :\n";
            echo $contact . "\n";
        }
    }
    public function help(): void
    {
        echo "Commandes disponibles :\n";
        echo "list                                → Affiche tous les contacts\n";
        echo "detail [id]                         → Affiche un contact par son identifiant\n";
        echo "create [name,email,phone_number]    → Crée un nouveau contact\n";
        echo "delete [id]                         → Supprime un contact\n";
        echo "modify [id,name,email,phone_number] → Modifie un contact existant\n";
        echo "help                                → Affiche cette aide\n";
        echo "quit                                → Quitte le programme\n";
    }
    public function modify(int $id, string $name, string $email, string $phoneNumber): void
    {
        $contact = $this->manager->findById($id);

        if ($contact === null) {
            echo "Aucun contact trouvé avec l'ID $id. Modification impossible.\n";
            return;
        }

        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);

        $this->manager->update($contact);
        echo "Contact mis à jour :\n";
        echo $contact . "\n";
    }
}
