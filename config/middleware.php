<?php

use App\Middleware\AutorisationMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app)
{
	$app->add(AutorisationMiddleware::class);

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

	$app->add(TwigMiddleware::class);

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Add app base path
    $app->add(BasePathMiddleware::class);

    // Catch exceptions and errors
    $loggerFactory = $app->getContainer()->get(\App\Factory\LoggerFactory::class);
    $logger = $loggerFactory->addFileHandler("error.log")->createLogger();
    $app->addErrorMiddleware(true, true ,true, $logger);
};
