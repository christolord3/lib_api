<?php


namespace App\Action;

use App\Domain\Livre\Service\GestionLivre;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ObtenirTousLesLivresAction
{
	private $obtenirLivre;

	public function __construct(GestionLivre $obtenirLivre)
	{
		$this->obtenirLivre = $obtenirLivre;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface {

	// Invoke the Domain with inputs and retain the result
	$resultat = $this->obtenirLivre->obtenir_tous_les_livres();

	// Build the HTTP response
	$response->getBody()->write((string)json_encode($resultat));

	return $response
		->withHeader('Content-Type', 'application/json')
		->withStatus(201);
	}
}