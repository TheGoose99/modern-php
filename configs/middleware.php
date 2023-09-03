<?php

declare(strict_types = 1);

use App\Config;
use App\Enum\AppEnvironment;
use App\Middleware\CsrfFieldsMiddleware;
use App\Middleware\OldFormDataMiddleware;
use App\Middleware\StartSessionsMiddleware;
use App\Middleware\ValidationErrorsMiddleware;
use App\Middleware\ValidationExceptionMiddleware;
use Clockwork\Support\Slim\ClockworkMiddleware;
use Slim\App;
use Slim\Middleware\MethodOverrideMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Clockwork\Clockwork;

return function (Slim\App $app) {
    $container = $app->getContainer();
    $config    = $container->get(Config::class);

    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(
        (bool) $config->get('display_error_details'),
        (bool) $config->get('log_errors'),
        (bool) $config->get('log_error_details')
    );
};