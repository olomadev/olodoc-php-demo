<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\Diactoros\Response\RedirectResponse;

class SetLocaleMiddleware implements MiddlewareInterface
{
    protected $translator;
    protected $allowedLanguages;

    /**
     * Constructor
     * 
     * @param TranslatorInterface $translator laminas translator
     * @param array               $config     laminas config
     */
    public function __construct(
        array $config, 
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
        $this->allowedLanguages = $config['translator']['available_languages'];
    }

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
        $env = getenv("APP_ENV");
        $method = $request->getMethod();
        $server = $request->getServerParams();
        $params = $request->getQueryParams();
        $path = $request->getUri()->getPath();
        $hostname = $server['SERVER_NAME'];
        $locale = substr($hostname, 0, 2);

        if (! in_array($locale, $this->allowedLanguages)) {
            $locale = null;
            if ($method == 'GET' && empty($params['provider'])) {  // do not action for socialite requests
                if (! empty($_COOKIE['lang'])  // if we have cookie set request
                    && $_COOKIE['lang'] !== "en" // if no default language
                    && in_array($_COOKIE['lang'], $this->allowedLanguages)
                ) {
                    //
                    // redirect to $lang.example.com
                    // 
                    return new RedirectResponse(HTTP_PREFIX.$_COOKIE['lang'].".".$hostname.$path);
                }
                if  (empty($server['HTTP_ACCEPT_LANGUAGE'])) {
                    $httpAcceptLang = "en";
                } else {
                    $httpAcceptLang = locale_accept_from_http($server['HTTP_ACCEPT_LANGUAGE']);
                }
                if ($httpAcceptLang == "tr" && empty($_COOKIE['lang'])) {
                    //
                    // redirect to tr.example.com
                    // 
                    return new RedirectResponse(HTTP_PREFIX."tr.".$hostname.$path);
                }
            }

        } else { // if we have correct locale

            $this->translator->setLocale($locale);
            //
            // set lang to cookie and redirect
            // 
            if ($method == 'GET' && ! empty($params['set']) &&  null != $locale) {
                if (! empty($_COOKIE['lang'])) {
                    unset($_COOKIE['lang']);
                    setcookie("lang", "", -1, "/", CURRENT_ORIGIN, SSL_ON, false);    
                }
                $options = [
                    'expires' => time() +  strtotime("+1 year"),
                    'path' => '/',
                    'domain' => CURRENT_ORIGIN,
                    'secure' => SSL_ON,
                    'httponly' => false,
                ];
                if (SSL_ON) {
                    $options['samesite'] = 'None';
                }
                setcookie(
                    "lang",
                    $locale,
                    $options
                );
                return new RedirectResponse(HTTP_PREFIX.$locale.".".CURRENT_ORIGIN.$path);
            }
        }

        if (empty($locale)) { // set default language
            $this->translator->setLocale("en");
        }
        $locale = $this->translator->getLocale();
        define('LANG_ID', $locale);
        define('AVAILABLE_LANGUAGES', getAvailableLanguageLinks($request, $this->translator));
        define('BASE_URL', ($locale == "en") ? HTTP_PREFIX.CURRENT_ORIGIN : HTTP_PREFIX.$locale.".".CURRENT_ORIGIN);
        
        return $handler->handle($request);
    }

}
