<?php

/**
 * stocker en mémoire  un contact qui est récupéré de la base de données.
 * objet $contact est instancié en mémoire vive, c’est-à-dire dans la RAM du serveur pendant l’exécution du script PHP.
 * Il existe temporairement, tant que le script tourne.
 */
class Contact
{
    //propriétés
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phoneNumber = null;

    //constructeur pour initialiser les propriétés
    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $phoneNumber = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
    // Méthodes pour obtenir les valeurs des propriétés
    /* ----------Assesseurs (getters)-----------------*/
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /*------------- Mutateurs (setters)---------------*/
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /*---------Méthode toString pour affichage--------*/
    public function __toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phoneNumber}";
    }
    /*public function toString(): string
    {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->phoneNumber}";
    }*/
}
