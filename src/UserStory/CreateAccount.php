<?php

namespace App\UserStory;

use App\Entity\User;
use Doctrine\ORM\EntityManager;


class CreateAccount
{
    protected EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        // L'entity manager est injecté par dependance
        $this->entityManager = $entityManager;
    }

    // Cette methode permettra d'éxecuter la users story
    public function execute(string $pseudo, string $email, string $password) : User
    {
        // Verifier que des données sont presentent
        // Si tel n'est pas le cas lancé une exception
        if (empty($pseudo )|| empty($email) || empty($password)){
            throw new \Exception("aucune données rentrée");
        }

        // Verifier si l'email est valide
        // Si tel n'est pas le cas lancé une exception
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       throw new \Exception("L'adresse email $email n'est pas valide");
    }
        // Verifier si la longueur du pseudo est entre 2 et 50 caracteres
        // Si tel n'est pas le cas lancé une exception
        $longueur = strlen($pseudo);
        if ($longueur > 50 || $longueur <2){
            throw new \Exception("Le Pseudo doit faire 2 et 50 caracteres");
        }

        // Verifier si le mot de passe est securise
        // Si tel n'est pas le cas lancé une exception

        // Verifier l'unicite de l'email
        // Si tel n'est pas le cas lancé une exception


        //Inserer les données dans la base de données

        // 1. Hasher le mot de passe

        // 2. Cree une instance de la classe User avec l'email, le pseudo et le mot de passe hasher
        $user= new User();

        // 3. Je persiste l'instance en utilisant l'entity manager
        $this->entityManager->persist($user);

        // 3.1 Flush
        $this->entityManager->flush();

        // 4. Envoi du mail de confirmation
        echo "un email de confirmation a etait envoyé";
        return $user;
    }


}