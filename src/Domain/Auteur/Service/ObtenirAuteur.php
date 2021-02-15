<?php


namespace App\Domain\Auteur\Service;

use App\Domain\Auteur\Repository\ObtenirAuteurRepository;
use App\Exception\ValidationException;

/**
 * Classe ObtenirAuteur.
 * @package App\Domain\Auteur\Service
 */
class ObtenirAuteur
{

	/**
	 * @var ObtenirAuteurRepository
	 */
	private $repository;

	/**
	 * Le constructeur.
	 *
	 * @param ObtenirAuteurRepository $repository Le répertoire des données des auteurs.
	 */
	public function __construct(ObtenirAuteurRepository $repository)
	{
		$this->repository = $repository;
	}

	function tous(): Array
	{
		return $this->repository->obtenirTousLesAuteurs();
	}

	function avec_id($id): Array
	{
		return $this->repository->obtenirUnLivre($id);
	}
}