<?php
/**
 * Connecter à la base de données 
 */
class DBConnect
{
    //propriété
    private PDO $pdo;
    //constructeur appelé automatiquement lors de l'instanciation de la classe
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=agenda;charset=utf8mb4',
                'root',
                ''
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    //méthode pour obtenir l'instance PDO
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
