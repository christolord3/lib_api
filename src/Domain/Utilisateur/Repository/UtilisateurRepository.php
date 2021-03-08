<?php

namespace App\Domain\Utilisateur\Repository;

use PDO;

/**
 * Repository.
 */
class UtilisateurRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function ajouter_utilisateur(array $utilisateur)
    {
        $sql = "INSERT INTO utilisateurs SET 
                identifiant=:identifiant, 
                courriel=:courriel, 
                mot_de_passe=:mot_de_passe,
                prenom=:prenom,
             	nom=:nom;";

        $requete_ajout_utilisateur = $this->connection->prepare($sql);

        $requete_ajout_utilisateur->execute(array(
	        'identifiant' => $utilisateur['identifiant'],
	        'courriel' => $utilisateur['courriel'],
	        'mot_de_passe' => password_hash($utilisateur['mot_de_passe'], PASSWORD_DEFAULT),
	        "prenom" => $utilisateur["prenom"],
	        "nom" => $utilisateur["nom"]
        ));

        return $requete_ajout_utilisateur;
    }
}

