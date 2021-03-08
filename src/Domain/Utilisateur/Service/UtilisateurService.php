<?php

namespace App\Domain\Utilisateur\Service;

use App\Domain\Utilisateur\Repository\UtilisateurRepository;
use App\Exception\ValidationException;
use App\Factory\LoggerFactory;

/**
 * Service.
 */
final class UtilisateurService
{
    /**
     * @var UtilisateurRepository
     */
    private $repository;
    private $logger;

    /**
     * The constructor.
     *
     * @param UtilisateurRepository $repository The Repository
     */
    public function __construct(UtilisateurRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger->addFileHandler("UtilisateurService.log")->createLogger();
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function ajouter_utilisateur(array $utilisateur): int
    {
        // Input validation
        $this->verifier_donnees_utilisateur($utilisateur);

        // Insert user
        $userId = $this->repository->ajouter_utilisateur($utilisateur);

        return $userId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     */
    private function verifier_donnees_utilisateur(array $data)
    {
        if (empty($data['identifiant']))
        {
	        throw new ValidationException('Un champ identifiant est requis. Celui-ci ne doit pas être plus grand que 255 caractères.');
        }
	    if (empty($data['mot_de_passe']))
	    {
		    throw new ValidationException('Un champ mot de passe est requis. Veuillez écrire celui-ci en clair. Votre connection est encryptée.');
	    }
        if (empty($data['courriel']))
        {
	        throw new ValidationException('Un champ courriel est requis. Celui-ci ne doit pas être plus grand que 255 caractères.');
        }
        elseif (filter_var($data['courriel'], FILTER_VALIDATE_EMAIL) === false)
        {
	        throw new ValidationException("L'adresse courrielle fournise n'est pas valide !");
        }
    }
}
