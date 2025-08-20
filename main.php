<?php
require_once 'DBConnect.php';
$db = new DBConnect();
var_dump($db->getPDO());
while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        echo "affichage de la liste \n";
    }
}
