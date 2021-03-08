<?php

use Slim\App;

return function (App $app) {
	//PAGE DU SITE WEB

    $app->get('/', \App\Action\AccueilAction::class)->setName('Accueil');

    //USER ROUTES

    $app->post('/utilisateurs', \App\Action\AjouterUtilisateurAction::class);

    //LIVRES ROUTES

	$app->get('/livres', \App\Action\ObtenirTousLesLivresAction::class);

	$app->get('/livres/{id}', \App\Action\ObtenirLivreAction::class);

	$app->post('/livres', \App\Action\AjouterLivreAction::class);

	$app->put('/livres/{id}', \App\Action\ModifierLivreAction::class);

	$app->delete('/livres/{id}', \App\Action\SupprimerLivreAction::class);

	$app->get('/livres/auteur/{id}', \App\Action\ObtenirLivreParAuteurAction::class);

	//AUTEURS ROUTES

	$app->get('/auteurs', \App\Action\ObtenirAuteurAction::class);

	$app->post('/auteurs', \App\Action\AjouterAuteurAction::class);

	$app->post('/auteurs', \App\Action\ModifierAuteurAction::class);

	$app->delete('/auteurs', \App\Action\SupprimerAuteurAction::class);

	//DOCUMENTATION
	$app->get('/documentations', \App\Action\Docs\SwaggerUiAction::class);
};

