<?php


namespace App\Action;

use App\Domain\Livre\Service\LivreService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ObtenirLivreAction
{
	private $gestionLivre;

	public function __construct(LivreService $gestionLivre)
	{
		$this->gestionLivre = $gestionLivre;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface {

		// Invoke the Domain with inputs and retain the result
		$resultat = $this->gestionLivre->obtenir_un_livre_avec_id($request->getAttribute("id",1));

		if($resultat)
		{
			// Build the HTTP response
			$response->getBody()->write((string)json_encode($resultat));

			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus(200);
		}
		else
		{
			return $response
				->withHeader('Content-Type', 'application/json')
				->withStatus(404);
		}
	}
}