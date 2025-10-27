<?php
/**
 * Connecter à la base de données (Pattern Singleton)
 */
class DBConnect
{
    //propriété
    private PDO $pdo;
    // Stocke l’unique instance
    private static ?DBConnect $instance = null;
    
    //constructeur privé pour empêcher l'instanciation directe
    private function __construct()
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
    
    //méthode statique pour obtenir l'unique instance
    public static function getInstance(): DBConnect
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    //méthode pour obtenir l'instance PDO
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
    
    //empêcher le clonage
    private function __clone() {}
    
    //empêcher la désérialisation
    public function __wakeup() 
    {
        throw new Exception("Cannot unserialize singleton");//impossible de désérialiser un singleton
    }
}
