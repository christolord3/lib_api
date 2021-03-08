<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AccueilAction
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        
        $result = json_encode([
        	'nom_api' => "LibAPI",
            'auteur' => "Christopher Boisvert",
            'version' => '1.0.0'
        ]);
        
        $response->getBody()->write($result);

        return $response->withHeader('Content-Type', 'application/json');
    }
}
