<?php


namespace App\Action;

use App\Domain\Livre\Service\LivreService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ObtenirLivreParAuteurAction
{
	private $livreService;

	public function __construct(LivreService $livreService)
	{
		$this->livreService = $livreService;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface {

		// Invoke the Domain with inputs and retain the result
		$resultat = $this->livreService->obtenir_livre_par_auteur($request->getAttribute("auteur_id",1));

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