<?php

namespace App\Action;

use App\Domain\Livre\Service\GestionLivre;
use App\Domain\User\Service\UserCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AjouterLivreAction
{
	private $gestion_livre;

	public function __construct(GestionLivre $gestion_livre)
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

		// Build the HTTP response
		$response->getBody()->write((string)json_encode($resultat_ajout_livre));

		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}
}
