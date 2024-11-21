<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Mezzio\Template\TemplateRendererInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ClientMiddlewareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ClientMiddleware;
    }
}