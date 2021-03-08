<?php


namespace App\Domain\Auteur\Service;

use App\Domain\Auteur\Repository\AuteurRepository;

/**
 * Classe AuteurService.
 * @package App\Domain\Auteur\Service
 */
class AuteurService
{

	/**
	 * @var AuteurRepository
	 */
	private $repository;

	/**
	 * Le constructeur.
	 *
	 * @param AuteurRepository $repository Le répertoire des données des auteurs.
	 */
	public function __construct(AuteurRepository $repository)
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