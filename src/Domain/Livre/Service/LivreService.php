<?php


namespace App\Domain\Livre\Service;

use App\Domain\Livre\Repository\LivreRepository;
use App\Exception\LivreException;
use App\Factory\LoggerFactory;
use http\Exception;

/**
 * Class LivreService Service.
 * @package App\Domain\Livre\Service
 */
class LivreService
{

	/**
	 * @var LivreRepository
	 */
	private $livreRepository;
	private $logger;

	/**
	 * The constructor.
	 *
	 * @param LivreRepository $Repository The Repository
	 */
	public function __construct(LivreRepository $livreRepository, LoggerFactory $logger)
	{
		$this->livreRepository = $livreRepository;
		$this->logger = $logger->addFileHandler("LivreService.log")->createLogger();
	}

	function obtenir_tous_les_livres()
	{
		return $this->livreRepository->obtenir_tous_les_livres();
	}

	function obtenir_un_livre_avec_id($id)
	{
		try
		{
			$resultat = $this->livreRepository->obtenir_un_livre_avec_id($id);
		}
		catch(Exception $e)
		{
			throw new LivreException($e->getMessage());
		}

		if(!$resultat)
		{
			throw new LivreException("Le livre que vous avez demandé n'a pas été trouvé.");
		}

		return $resultat;
	}

	function ajouter_un_livre($livre)
	{
		$this->verifier_format_livre($livre);

		$resultat = $this->livreRepository->ajouter_un_livre( $livre );

		if(!$resultat)
		{
			throw new LivreException("Le livre que vous avez demandé d'ajouter n'a pas été ajouté.");
		}

		return $resultat;
	}

	private function verifier_format_livre( $livre )
	{
		if(strlen($livre["titre"]) == 0 || strlen($livre["titre"]) >= 255)
		{
			throw new LivreException("Veuillez ajouter le champ 'titre' dans votre requête JSON. Assurez-vous que celui-ci n'est pas vide et qu'il n'est pas plus grand que 255 caractères.");
		}
		if(strlen($livre["isbn"]) == 0 || strlen($livre["isbn"]) > 10)
		{
			throw new LivreException("Veuillez ajouter le champ 'isbn' dans votre requête JSON. Assurez-vous que celui-ci n'est pas vide et qu'il n'est pas plus grand que 10 caractères.");
		}
		if($livre["genre_id"] <= 0 || $livre["genre_id"] == "")
		{
			throw new LivreException("Veuillez ajouter le champ 'genre_id' dans votre requête JSON. Assurez-vous que celui-ci est plus grand que zéro.");
		}
		if($this->livreRepository->verifier_genre_invalide($livre["genre_id"]) == false)
		{
			throw new LivreException("Le champ 'genre_id' contient un genre qui n'existe pas ! Veuillez vous référer à la page '/genres/' de l'API.");
		}
	}

	public function obtenir_livre_par_auteur( $auteur_id ): array
	{
		return $this->livreRepository->obtenir_livre_par_auteur( $auteur_id );
	}
}