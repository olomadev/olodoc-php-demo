<?php

declare(strict_types=1);

namespace App\Middleware;

use Mezzio\Router\RouteResult;
use Mezzio\Router\RouterInterface as Router;
use Olodoc\DocumentManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\I18n\Translator\TranslatorInterface;

class VersionValidateMiddleware implements MiddlewareInterface
{
    protected $router;
    protected $translator;
    protected $documentManager;

    /**
     * Constructor
     *
     * @param Router     $router     router
     * @param Translator $translator translator
     * @param DocumentManager $documentManager
     */
    public function __construct(
        Router $router,
        TranslatorInterface $translator,
        DocumentManagerInterface $documentManager
    )
    {
        $this->router = $router;
        $this->translator = $translator;
        $this->documentManager = $documentManager;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $routeResult = $request->getAttribute(RouteResult::class);
        $params = $routeResult->getMatchedParams();
        $locale = $this->translator->getLocale();
        $this->documentManager->setLocale($locale);
        $rootPath = $this->documentManager->getRootPath();
        $htmlPath = $this->documentManager->getHtmlPath();

        if (empty($params['version'])) {
            return $handler->handle($request);
        }
        if ($params['version'] == 'latest') {
            $params['version'] = $this->documentManager->getDefaultVersion();
        }
        $htmlFile = $rootPath.'/'.$htmlPath.'/'.$params['version'].'/'.$locale.'/index.html';
        if (false == is_file($htmlFile)) {
            $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>'.$this->translator->translate('Version Not Found').'</title>
            <style>
            body { margin:0 !important; padding:20px !important; font-family:Arial,Verdana,sans-serif !important;font-weight:normal;  }
            h1, h2, h3, h4 {
                margin: 0;
                padding: 0;
                font-weight: normal;
                line-height:48px;
            }
            </style>
            </head>
            <body>
            <h1>'.$this->translator->translate('Version Not Found').'</h1>
            <h3>'.$this->translator->translate('Documentation version could not be found').'</h3>
            </body>
            </html>';
            return new HtmlResponse($html, 404);
        }
        return $handler->handle($request);
    }
}