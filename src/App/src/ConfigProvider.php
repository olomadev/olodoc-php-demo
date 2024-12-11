<?php

declare(strict_types=1);

namespace App;

use Laminas\I18n\Translator\TranslatorInterface;
// use Laminas\EventManager\EventManagerInterface;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'input_filters' => [
                'factories' => [
                    // Common Input Filters
                    Filter\ObjectInputFilter::class => Container\ObjectInputFilterFactory::class,
                    Filter\CollectionInputFilter::class => Container\CollectionInputFilterFactory::class,
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                // Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'delegators' => [
                TranslatorInterface::class => [
                    'App\Container\TranslatorDelegatorFactory',
                ],
            ],
            'aliases' => [
                // \Mezzio\Authentication\AuthenticationInterface::class => Authentication\JwtAuthentication::class,
            ],
            'factories' => [

                // General
                // 
                // EventManagerInterface::class => Container\EventManagerFactory::class,
                Middleware\ClientMiddleware::class => Middleware\ClientMiddlewareFactory::class,
                Middleware\SetLocaleMiddleware::class => Middleware\SetLocaleMiddlewareFactory::class,

                // Handlers
                //------------------------------------------
                Handler\DocumentHandler::class => Handler\DocumentHandlerFactory::class,
                Handler\IndexHandler::class => Handler\IndexHandlerFactory::class,
                Handler\SearchHandler::class => Handler\SearchHandlerFactory::class,
            ]
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }

}