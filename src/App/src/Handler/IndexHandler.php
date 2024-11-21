<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

/**
* FLAG ICONS
* 
* https://github.com/lipis/flag-icons/tree/main/flags/1x1
*/
class IndexHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template
    ) {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = array();
        //
        // check user is authenticated
        // 
        $user = $request->getAttribute(UserInterface::class);
        $data['user'] = $user;
        return new HtmlResponse(
            $this->template->render('app::home', $data)
        );
    }

}
