<?php
require_once 'DBConnect.php';

$db = new DBConnect();
while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit)  : ");
   // echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        $stmt = $db->getPDO()->query("SELECT * FROM contact");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Liste des contacts :\n";
        echo "id, name, email, phone number\n";
        foreach ($contacts as $contact) {
            echo "{$contact['id']}, {$contact['name']}, {$contact['email']}, {$contact['phone_number']}\n";
        }
    }
}
