<?php


namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as Psr7Response;
use App\Domain\Authentification\Service\AuthentificationService;


class AutorisationMiddleware
{
	private $authentificationService;

	public function __construct(AuthentificationService $authentificationService)
	{
		$this->authentificationService = $authentificationService;
	}

	public function __invoke(Request $request, RequestHandler $request_handler) : Response
	{
		$response = $request_handler->handle($request);

		if($request->getUri() != "http://localhost/libapi/v2/documentations")
		{
			$credentiels_base_64 = explode(" ", $request->getHeader("Authorization")[0]);

			$tableau_credentiels = explode(" ", base64_decode($credentiels_base_64[1]));

			$statut_authentification = $this->authentificationService->verifier_utilisateur($tableau_credentiels[0], $tableau_credentiels[1]);

			if(!$statut_authentification)
			{
				$new_response = new Psr7Response();
				return $new_response->withStatus(401);
			}
		}

		return $response;
	}
}