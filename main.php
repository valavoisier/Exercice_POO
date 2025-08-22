<?php
/**
 * Fichier principal pour exécuter le programme de gestion des contacts.
 */
require_once 'DBConnect.php';
require_once 'ContactManager.php';
//require_once 'Contact.php'; //incluse dans ContactManager.php et Command.php
require_once 'Command.php';

$db = new DBConnect();
$manager = new ContactManager($db);
$command = new Command($manager);
while (true) {
    $line = readline("Entrez votre commande (help, list, detail [id], create [name, email, phone_number], modify [id, name, email, phone_number], delete [id], quit)  : ");
    // echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        $command->list();
    }
    if (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {
        $id = (int) $matches[1];
        $command->detail($id);
    }
    if (preg_match('/^create\s+([^,]+),([^,]+),([^,]+)$/', $line, $matches)) {
        $name = trim($matches[1]);
        $email = trim($matches[2]);
        $phone = trim($matches[3]);
        $command->create($name, $email, $phoneNumber);
    }
    if (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {
        $id = (int) $matches[1];
        $command->delete($id);
    }
    if (preg_match('/^modify\s+(\d+),([^,]+),([^,]+),([^,]+)$/', $line, $matches)) {
        $id = (int) $matches[1];
        $name = trim($matches[2]);
        $email = trim($matches[3]);
        $phone = trim($matches[4]);
        $command->modify($id, $name, $email, $phoneNumber);
    }
    if ($line === "help") {
        $command->help();
    }

    if ($line === "quit") {
        break;
    }
}
