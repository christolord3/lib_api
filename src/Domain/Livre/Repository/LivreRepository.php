<?php


namespace App\Domain\Livre\Repository;

use PDO;
use PhpParser\Node\Expr\Cast\Bool_;

/**
 * Repository.
 */
class LivreRepository
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

	public function obtenir_tous_les_livres()
	{
		$sql = "SELECT * FROM livres";

		$resultat = $this->connection->query($sql);

		return $resultat->fetchAll();
	}

	public function obtenir_un_livre_avec_id($id)
	{
		$sql = "SELECT * FROM livres WHERE id=:id";

		$requete_obtenir_livre = $this->connection->prepare($sql);

		$requete_obtenir_livre->execute(array(
			"id" => $id
		));

		return $requete_obtenir_livre->fetch();
	}

	public function ajouter_un_livre( $livre )
	{
		$requete_ajout_livre = $this->connection->prepare("INSERT INTO livres(titre,isbn,genre_id) VALUES(:titre,:isbn,:genre_id)");

		$requete_ajout_livre->execute(array(
			"titre" => $livre["titre"],
			"isbn" => $livre["isbn"],
			"genre_id" => $livre["genre_id"]
		));

		return $requete_ajout_livre->rowCount();
	}

	public function verifier_genre_invalide( $genre_id )
	{
		$sql = "SELECT
				      CASE WHEN EXISTS 
				      (
				            SELECT id FROM genres WHERE id=$genre_id
				      )
				      THEN true
				      ELSE false
				   END";

		$resultat = $this->connection->query($sql)->fetchColumn(0);

		return $resultat;
	}

	public function obtenir_livre_par_auteur( $auteur_id ) : array
	{
		$sql = "SELECT * FROM livres_auteurs INNER JOIN livres ON livres.id=livre_id WHERE auteur_id=:auteur_id";

		$requete_obtenir_livre_par_auteur = $this->connection->prepare($sql);

		$requete_obtenir_livre_par_auteur->execute(array(
			"auteur_id" => $auteur_id
		));

		return $requete_obtenir_livre_par_auteur->fetchAll();
	}
}