<?php


namespace App\Domain\Authentification\Service;

use App\Domain\Authentification\Repository\AuthentificationRepository;

class AuthentificationService
{
	private $repository;

	/**
	 * Le constructeur.
	 *
	 * @param AuthentificationRepository $repository Le répertoire des données des auteurs.
	 */
	public function __construct(AuthentificationRepository $repository)
	{
		$this->repository = $repository;
	}

	public function verifier_utilisateur( $identifiant, $mot_de_passe )
	{
		return $this->repository->verifier_utilisateur($identifiant, $mot_de_passe);
	}

}