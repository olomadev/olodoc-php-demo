<?php

declare(strict_types=1);

namespace App\Handler;

use Olodoc\Generator\PageGenerator;
use Olodoc\Exception\FileNotFoundException;
use Olodoc\DocumentManagerInterface;
use Mezzio\Router\RouteResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class DocumentHandler implements RequestHandlerInterface
{
    public function __construct(
        private DocumentManagerInterface $documentManager,
        private Translator $translator,
        private TemplateRendererInterface $template
    ) {
        $this->documentManager = $documentManager;
        $this->template = $template;
        $this->translator = $translator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // check user is authenticated
        //
        $data = array();
        $path = $request->getUri()->getPath();

        $routeResult = $request->getAttribute(RouteResult::class);
        $routeName = $routeResult->getMatchedRouteName();
        $routeParams = $routeResult->getMatchedParams();

        $this->documentManager->setRequest($request);
        $this->documentManager->setRouteName($routeName);
        $this->documentManager->setRouteParams($routeParams);
        try {
            $pageGenerator = new PageGenerator($this->documentManager);
            $data = $pageGenerator->generate();
        } catch (FileNotFoundException) {
            return new HtmlResponse(
                $this->template->render('error::404'),
                404
            );
        }
        $data['meta'] = $pageGenerator->getMeta();
        $data['pageFooter'] = $pageGenerator->getPagination()->generate(
            $this->translator->translate("Previous"),
            $this->translator->translate("Next")
        );
        $data['pageJavascript'] = $pageGenerator->getJs()->generate();
        $data['pageSidebarHeaderLink'] = $pageGenerator->getMenu()->getSidebarHeader(
            $this->translator->translate('Index'),
            $this->translator->translate('Go to Back')
        );
        $data['pageSearchBoxInput'] = $pageGenerator->getSearchBoxInput();
        $data['pageVersionCombobox'] = $pageGenerator->getVersionCombobox(
            $this->translator->translate('Version')
        );
        $data['version'] = $this->documentManager->getVersion();
        $data['routeName'] = $routeName;
        $data['pageContent'] = $data['html'];
        $data['pageBreadCrumbs'] = $pageGenerator->getBreadCrumb()->generate(
            $this->translator->translate("Index")
        );
        $data['pageSideNavbarLinks'] = $pageGenerator->getMenu()->getSideNavbarLinks();
        $data['documentManager'] = $this->documentManager;

        return new HtmlResponse(
            $this->template->render('app::doc', $data)
        );
    }
}
