<?php


namespace App\Domain\Authentification\Repository;

use PDO;

/**
 * Classe AuthentificationRepository
 * @package App\Middleware\Autorisation\Repository
 */
class AuthentificationRepository
{
	private $connection;

	function __construct(PDO $connection)
	{
		$this->connection = $connection;
	}

	public function verifier_utilisateur( $identifiant, $mot_de_passe )
	{
		$sql = "SELECT mot_de_passe FROM utilisateurs WHERE identifiant=:identifiant";

		$requete_authentification_utilisateur = $this->connection->prepare($sql);

		$requete_authentification_utilisateur->execute(array(
			'identifiant' => $identifiant
		));

		if($requete_authentification_utilisateur->columnCount())
		{
			$donnees = $requete_authentification_utilisateur->fetch();

			if(password_verify($mot_de_passe, $donnees["mot_de_passe"]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}