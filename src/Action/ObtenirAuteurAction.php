<?php


namespace App\Action;

use App\Domain\Auteur\Service\AuteurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ObtenirAuteurAction
{
	private $obtenirAuteur;

	public function __construct(AuteurService $obtenirAuteur)
	{
		$this->obtenirAuteur = $obtenirAuteur;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface {

		// Invoke the Domain with inputs and retain the result
		$resultat = $this->obtenirAuteur->tous();

		// Build the HTTP response
		$response->getBody()->write((string)json_encode($resultat));

		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(201);
	}
}