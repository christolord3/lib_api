<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
	//PAGE DU SITE WEB

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    //USER ROUTES

    $app->post('/utilisateurs', \App\Action\UserCreateAction::class);

	$app->post('/utilisateurs/', \App\Action\UserCreateAction::class);

    //LIVRES ROUTES

	$app->get('/livres', \App\Action\ObtenirTousLesLivresAction::class);

	$app->get('/livre/{id}', \App\Action\ObtenirLivreAction::class);

	$app->post('/ajouter/livre', \App\Action\AjouterLivreAction::class);

	$app->post('/modifier/livre', \App\Action\ModifierLivreAction::class);

	$app->post('/supprimer/livre', \App\Action\SupprimerLivreAction::class);

	//AUTEURS ROUTES

	$app->get('/auteurs', \App\Action\ObtenirAuteurAction::class);

	//DOCUMENTATION
	$app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);
};

