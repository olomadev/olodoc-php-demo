<?php

declare(strict_types=1);

namespace App\Handler;

use Olodoc\DocumentManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class SearchHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new SearchHandler(
            $container->get(DocumentManagerInterface::class),
            $container->get(Translator::class)
        );
    }
}
