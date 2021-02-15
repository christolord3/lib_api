<?php


namespace App\Domain\Livre\Service;

use App\Domain\Livre\Repository\GestionLivreRepository;
use App\Exception\ValidationException;
use App\Factory\LoggerFactory;

/**
 * Class GestionLivre Service.
 * @package App\Domain\Livre\Service
 */
class GestionLivre
{

	/**
	 * @var GestionLivreRepository
	 */
	private $gestion_livre_repository;
	private $logger;

	/**
	 * The constructor.
	 *
	 * @param GestionLivreRepository $repository The repository
	 */
	public function __construct(GestionLivreRepository $gestion_livre_repository, LoggerFactory $logger)
	{
		$this->gestion_livre_repository = $gestion_livre_repository;
		$this->logger = $logger->addFileHandler("GestionLivre.log")->createLogger();;
	}

	function obtenir_tous_les_livres()
	{
		return $this->gestion_livre_repository->obtenir_tous_les_livres_bdd();
	}

	function obtenir_un_livre_avec_id($id)
	{
		return $this->gestion_livre_repository->obtenir_un_livre_avec_id_bdd($id);
	}

	function ajouter_un_livre($livre)
	{
		$this->verifier_format_livre($livre);

		return $this->gestion_livre_repository->ajouter_un_livre_bdd( $livre["titre"], $livre["isbn"], $livre["genre_id"] );
	}

	private function verifier_format_livre( $livre )
	{
		if(strlen($livre["titre"]) == 0 || strlen($livre["titre"]) >= 255)
		{
			throw new ValidationException("Veuillez ajouter le champ 'titre' dans votre requête JSON. Assurez-vous que celui-ci n'est pas vide et qu'il n'est pas plus grand que 255 caractères.");
		}
		if(strlen($livre["isbn"]) == 0 || strlen($livre["isbn"]) > 10)
		{
			throw new ValidationException("Veuillez ajouter le champ 'isbn' dans votre requête JSON. Assurez-vous que celui-ci n'est pas vide et qu'il n'est pas plus grand que 10 caractères.");
		}
		if($livre["genre_id"] <= 0 || $livre["genre_id"] == "")
		{
			throw new ValidationException("Veuillez ajouter le champ 'genre_id' dans votre requête JSON. Assurez-vous que celui-ci est plus grand que zéro.");
		}
		if($this->gestion_livre_repository->verifier_genre_invalide_bdd($livre["genre_id"]) == "FALSE")
		{
			throw new ValidationException("Le champ 'genre_id' contient un genre qui n'existe pas ! Veuillez vous référer à la page '/genres/' de l'API.");
		}
	}
}