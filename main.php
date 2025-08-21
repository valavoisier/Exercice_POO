<?php
require_once 'DBConnect.php';
require_once 'ContactManager.php';
require_once 'Contact.php';

$db = new DBConnect();
$manager = new ContactManager($db);
while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit)  : ");
    // echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        $contacts = $manager->findAll();
        echo "Liste des contacts :\n";
        echo "id, name, email, phone number\n";
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }
    if ($line === "quit") {
        break;
    }
}
