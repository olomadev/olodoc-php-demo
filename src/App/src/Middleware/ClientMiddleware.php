<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Olobase\Mezzio\Exception\BodyDecodeException;

class ClientMiddleware implements MiddlewareInterface
{
    /**
     * Process
     *
     * @param  ServerRequestInterface  $request request
     * @param  RequestHandlerInterface $handler request handler
     *
     * @return object|exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $env = getEnv("APP_ENV");
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        $server = $request->getServerParams();
        $currentOrigin = getOrigin($server['SERVER_NAME']);
        $sslOn = empty($server['HTTPS']) ? false : true;
        $httpPrefix = empty($server['HTTPS']) ? 'http://' : 'https://';

        define('SSL_ON', $sslOn);
        define('HTTP_METHOD', $method);
        define('HTTP_PREFIX', $httpPrefix);
        define('CURRENT_ORIGIN', $currentOrigin);
        //
        // Inject parsed body
        //
        $contentType = empty($headers['content-type'][0]) ? null : current($headers['content-type']);
        if ($contentType 
            && strpos($contentType, 'application/json') === 0) {
            $contentBody = $request->getBody()->getContents();
            $post = json_decode($contentBody, true);
            $lastError = json_last_error();
            if ($lastError != JSON_ERROR_NONE) {
                throw new BodyDecodeException($lastError);
            }
        }
        switch ($method) {
            case 'POST':
            case 'PUT':
            case 'OPTIONS':
                $post = empty($post) ? $request->getParsedBody() : $post;
                $request = $request->withParsedBody($post);
                break;
        }        
        return $handler->handle($request);
    }

}
