<?php

declare(strict_types=1);

namespace App\Handler;

use Olodoc\DocumentManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Router\RouterInterface as Router;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class DocumentHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new DocumentHandler(
            $container->get(DocumentManagerInterface::Class),
            $container->get(Translator::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
