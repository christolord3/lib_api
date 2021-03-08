<?php

namespace App\Action;

use App\Domain\Livre\Service\LivreService;
use App\Domain\Utilisateur\Service\UtilisateurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AjouterLivreAction
{
	private $gestion_livre;

	public function __construct(LivreService $gestion_livre)
	{
		$this->gestion_livre = $gestion_livre;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface
	{
		// Collect input from the HTTP request
		$data = (array)$request->getParsedBody();

		// Invoke the Domain with inputs and retain the result
		$resultat_ajout_livre = $this->gestion_livre->ajouter_un_livre($data);

		if($resultat_ajout_livre)
		{
			// Build the HTTP response
			$response->getBody()->write((string)json_encode($data));

			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus(201);
		}
		else
		{
			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus(409);
		}
	}
}
