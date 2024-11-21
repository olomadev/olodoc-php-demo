<?php

declare(strict_types=1);

namespace App\Middleware;

use Olodoc\DocumentManagerInterface;
use Psr\Container\ContainerInterface;
use Mezzio\Router\RouterInterface as Router;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class VersionValidateMiddlewareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new VersionValidateMiddleware(
            $container->get(Router::class),
            $container->get(Translator::class),
            $container->get(DocumentManagerInterface::class)
        );
    }
}