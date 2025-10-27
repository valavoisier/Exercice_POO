<?php
/**
 * ROOTER
 * Fichier principal pour exécuter le programme de gestion des contacts.
 */

// Autoload simple pour charger automatiquement les classes 
//// Classes chargées uniquement à la demande quand nécessaires et pas toutes ensembles!
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("Classe $className introuvable dans $file");
    }
});

//instances principales - utilisation du singleton
$manager = new ContactManager(); //gestionnaire des contacts (utilise le singleton DBConnect)
$command = new Command($manager); //logique métier

//entrée dans une boucle infinie qui attend une commande utilisateur.  
//La fonction `readline()` lit une ligne depuis le terminal.
while (true) {
    $line = readline("Entrez votre commande (help, list, detail [id], create [name, email, phone_number], modify [id, name, email, phone_number], delete [id], quit)  : ");
    
    // Traiter la commande et vérifier si on doit continuer
    if (!$command->processCommand($line)) {
        break; // Quitte la boucle si processCommand retourne false
    }
}

