<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use Olodoc\DocumentManagerInterface;
use Olodoc\Search\DocumentSearch;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class SearchHandler implements RequestHandlerInterface
{
    public function __construct(
        private DocumentManagerInterface $documentManager,
        private Translator $translator
    ) {
        $this->documentManager = $documentManager;
        $this->translator = $translator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $documentSearch = new DocumentSearch($this->documentManager);
        $hLiteOpenTag = $documentSearch->getHliteOpenTag();
        $hLiteCloseTag = $documentSearch->getHliteCloseTag();

        $get = $request->getQueryParams();
        $results = array();
        $response = array();
        $response['data']['title'] = "No Result Found";
        $response['data']['resultText'] = "0 items found";
        $response['data']['error'] = "";
        $response['data']['results'] = $results;

        if (! empty($get['q'])) {
            try {
                $results = $documentSearch->search($get['q']);
                $keyword = $documentSearch->getQueryString();
                $errorMessage = "";
                if (count($results) > 0) {
                    $response['data']['title'] = "Search Results";
                    $response['data']['resultText'] = count($results)." items found for ".$hLiteOpenTag.$keyword.$hLiteCloseTag." keyword search";
                    $response['data']['results'] = $results;
                }
            } catch (Exception $e) {
                $response['data']['error'] = "An error occurred: " . $e->getMessage();
            }
        }
        return new JsonResponse($response);
    }

}
