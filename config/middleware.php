<?php

use App\Middleware\AutorisationMiddleware;
use App\Middleware\CorsMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app)
{
	// Parse json, form data and xml
	$app->addBodyParsingMiddleware();

	// Add the Slim built-in routing middleware
	$app->addRoutingMiddleware();

	// Add cors middleware
	$app->add(CorsMiddleware::class);

	// Add autorisation middleware
	$app->add(AutorisationMiddleware::class);

	//Add Twig middleware
	$app->add(TwigMiddleware::class);

    // Add app base path
    $app->add(BasePathMiddleware::class);

    // Catch exceptions and errors
    $loggerFactory = $app->getContainer()->get(\App\Factory\LoggerFactory::class);
    $logger = $loggerFactory->addFileHandler("error.log")->createLogger();
    $app->addErrorMiddleware(true, true ,true, $logger);
};
