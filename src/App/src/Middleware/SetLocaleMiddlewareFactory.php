<?php

declare(strict_types=1);

namespace App\Middleware;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class SetLocaleMiddlewareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SetLocaleMiddleware(
            $container->get('config'),
            $container->get(Translator::class)
        );
    }
}