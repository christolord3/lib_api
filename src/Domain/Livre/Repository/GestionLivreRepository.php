<?php


namespace App\Domain\Livre\Repository;

use PDO;
use PhpParser\Node\Expr\Cast\Bool_;

/**
 * Repository.
 */
class GestionLivreRepository
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

	public function obtenir_tous_les_livres_bdd()
	{
		$sql = "SELECT * FROM livres";

		$resultat = $this->connection->query($sql);

		return $resultat->fetchAll();
	}

	public function obtenir_un_livre_avec_id_bdd($id)
	{
		$sql = "SELECT * FROM livres WHERE id=$id";

		$resultat = $this->connection->query($sql);

		return $resultat->fetchAll();
	}

	public function ajouter_un_livre_bdd( $titre, $isbn, $genre_id )
	{
		$resultat_ = Array(
			"resultat_ajouter_un_livre" => false,
		);

		$sql = "INSERT INTO livres(titre,isbn,genre_id) VALUES('$titre', '$isbn', $genre_id)";

		$requete_ajout_livre = $this->connection->query($sql);

		if($requete_ajout_livre->rowCount() > 0)
		{
			$resultat["resultat_ajouter_un_livre"] = true;
			return $resultat;
		}
		else
		{
			$resultat["resultat_ajouter_un_livre"] = true;
			return $resultat;
		}
	}

	public function verifier_genre_invalide_bdd( $genre_id )
	{
		$sql = "SELECT
				      CASE WHEN EXISTS 
				      (
				            SELECT id FROM genres WHERE id=$genre_id
				      )
				      THEN 'TRUE'
				      ELSE 'FALSE'
				   END";

		$resultat = $this->connection->query($sql)->fetchColumn(0);

		return $resultat;
	}
}