<?php

namespace App\Action;

use App\Domain\Livre\Service\LivreService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ModifierLivreAction
{
	private $livreService;

	public function __construct(LivreService $livreService)
	{
		$this->livreService = $livreService;
	}

	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response
	): ResponseInterface
	{
		// Collect input from the HTTP request
		$data = (array)$request->getParsedBody();

		// Invoke the Domain with inputs and retain the result
		$livre_id = $this->livreService->modifier_un_livre( $data );

		// Transform the result into the JSON representation
		$result = [
			'id' => $livre_id
		];

		// Build the HTTP response
		$response->getBody()->write((string)json_encode($result));

		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(200);
	}
}
