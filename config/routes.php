<?php

use App\Middleware\AutorisationMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app)
{
	//V2 path
	$app->group("/v2", function() use ($app)
	{
		//ACCUEIL
		$app->get('/', \App\Action\AccueilAction::class)->setName('Accueil');

		//DOCUMENTATION

		$app->get('/documentations', \App\Action\Docs\SwaggerUiAction::class);

		//UTILISATEURS ROUTES

		$app->post('/utilisateurs', \App\Action\AjouterUtilisateurAction::class);

		//Livres

		$app->group("/livres", function(RouteCollectorProxy $group) {

			$group->get( '/', \App\Action\ObtenirTousLesLivresAction::class );

			$group->get( '/{id}', \App\Action\ObtenirLivreAction::class );

			$group->post( '/', \App\Action\AjouterLivreAction::class );

			$group->put( '/{id}', \App\Action\ModifierLivreAction::class );

			$group->delete( '/{id}', \App\Action\SupprimerLivreAction::class );

			$group->get( '/auteur/{auteur_id}', \App\Action\ObtenirLivreParAuteurAction::class );

		})->add(AutorisationMiddleware::class);;

		//AUTEURS

		$app->group("/auteurs", function(RouteCollectorProxy $group)
		{

			$group->get('/', \App\Action\ObtenirTousLesAuteursAction::class);

			$group->get('/{auteur_id}', \App\Action\ObtenirAuteurAction::class);

			$group->post('/', \App\Action\AjouterAuteurAction::class);

			$group->put('/{auteur_id}', \App\Action\ModifierAuteurAction::class);

			$group->delete('/{auteur_id}', \App\Action\SupprimerAuteurAction::class);


		})->add(AutorisationMiddleware::class);
	});
};

