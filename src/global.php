<?php

declare(strict_types=1);

define("PROJECT_ROOT", dirname(__DIR__));

/**
 * Get origin
 *
 * https://stackoverflow.com/questions/276516/parsing-domain-from-a-url
 * 
 * @param  string $host $server['SERVER_NAME']
 * @return string|null
 */
function getOrigin($host) {
    if (! $host) {
        return $host;
    }
    if (filter_var($host, FILTER_VALIDATE_IP)) { // IP address returned as domain
        return $host; //* or replace with null if you don't want an IP back
    }
    $domainArray = explode(".", str_replace('www.', '', $host));
    $count = count($domainArray);
    if( $count >= 3 && strlen($domainArray[$count-2])==2 ) {
        // SLD (example.co.uk)
        return implode('.', array_splice($domainArray, $count-3,3));
    } else if ($count >= 2 ) {
        // TLD (example.com)
        return implode('.', array_splice($domainArray, $count-2,2));
    }
}
/**
 * Get user real ip if proxy used
 * 
 * @param  string|null  $default default value
 * @param  integer $options filter_var options
 * @return string|null
 */
function getRealUserIp($default = null, $options = 12582912) 
{
    // 
    // clouflare support
    // 
    $HTTP_CF_CONNECTING_IP = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : getenv('HTTP_CF_CONNECTING_IP');
    $HTTP_X_FORWARDED_FOR = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : getenv('HTTP_X_FORWARDED_FOR');
    $HTTP_CLIENT_IP = isset($_SERVER["HTTP_CLIENT_IP"]) ? $_SERVER["HTTP_CLIENT_IP"] : getenv('HTTP_CLIENT_IP');
    $REMOTE_ADDR = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : getenv('REMOTE_ADDR');

    $allIps = explode(",", "$HTTP_X_FORWARDED_FOR,$HTTP_CLIENT_IP,$HTTP_CF_CONNECTING_IP,$REMOTE_ADDR");
    foreach ($allIps as $ip) {
        if ($ip = filter_var($ip, FILTER_VALIDATE_IP, $options)) {
            break;
        }
    }
    return $ip ? $ip : $default;
}
/**
 * Returns to available language links
 * 
 * @param  object $request
 * @param  object $translator
 * @return
 */
function getAvailableLanguageLinks($request, $translator)
{
    /**
     * FLAG ICONS
     * 
     * https://github.com/lipis/flag-icons/tree/main/flags/1x1
     */
    $locale = $translator->getLocale();
    $server = $request->getServerParams();
    $httpPrefix = empty($server['HTTPS']) ? 'http://' : 'https://';
    $hostname = $server['SERVER_NAME'];
    $origin = ltrim($hostname, $locale.".");
    $path = $request->getUri()->getPath();
    $defaultLanguage = "en";
    $languages = ['en', 'tr'];
    $labels = array();
    $labels['en'] = 'English';
    $labels['tr'] = 'Türkçe';
    $enLabels = array();
    $enLabels['en'] = 'English';
    $enLabels['tr'] = 'Turkish';
    $host = preg_replace('#^('.implode('|', $languages).')\.#', '', $hostname);
    $languageLinks = '';
    $l = 0;
    $svg = array();
    $svg['en'] = '<svg xmlns="http://www.w3.org/2000/svg" class="grayscale" width="24" height="24" id="flag-icons-en" style="border-radius: 50%;" viewBox="0 0 512 512">
          <path fill="#bd3d44" d="M0 0h512v512H0"/>
          <path stroke="#fff" stroke-width="40" d="M0 58h512M0 137h512M0 216h512M0 295h512M0 374h512M0 453h512"/>
          <path fill="#192f5d" d="M0 0h390v275H0z"/>
          <marker id="us-a" markerHeight="30" markerWidth="30">
            <path fill="#fff" d="m15 0 9.3 28.6L0 11h30L5.7 28.6"/>
          </marker>
          <path fill="none" marker-mid="url(#us-a)" d="m0 0 18 11h65 65 65 65 66L51 39h65 65 65 65L18 66h65 65 65 65 66L51 94h65 65 65 65L18 121h65 65 65 65 66L51 149h65 65 65 65L18 177h65 65 65 65 66L51 205h65 65 65 65L18 232h65 65 65 65 66z"/>
        </svg>';
    $svg['tr'] = '
<svg xmlns="http://www.w3.org/2000/svg" class="grayscale" width="24" height="24" id="flag-icons-tr" style="border-radius: 50%;" viewBox="0 0 512 512">
  <g fill-rule="evenodd">
    <path fill="#e30a17" d="M0 0h512v512H0z"/>
    <path fill="#fff" d="M348.8 264c0 70.6-58.3 127.9-130.1 127.9s-130.1-57.3-130.1-128 58.2-127.8 130-127.8S348.9 193.3 348.9 264z"/>
    <path fill="#e30a17" d="M355.3 264c0 56.5-46.6 102.3-104.1 102.3s-104-45.8-104-102.3 46.5-102.3 104-102.3 104 45.8 104 102.3z"/>
    <path fill="#fff" d="m374.1 204.2-1 47.3-44.2 12 43.5 15.5-1 43.3 28.3-33.8 42.9 14.8-24.8-36.3 30.2-36.1-46.4 12.8z"/>
  </g>
</svg>
';
    foreach ($languages as $key) {
        ++$l;
        if ($key == $defaultLanguage) {
            $url = $httpPrefix.$key.'.'.$origin.$path."?set=1";
        } else {
            $url = $httpPrefix.$key.'.'.$host.$path."?set=1";
        }
        $onmouseover = "onMouseOverFlag('".$key."')";
        $onmouseout  = "onMouseOutFlag('".$key."')";
        $languageLinks.= '<a class="list-group-item" href="'.$url.'" onmouseover="'.$onmouseover.'" onmouseout="'.$onmouseout.'">
            <!-- Icon -->
            <div class="icon icon-sm">
              '.$svg[$key].'
            </div>
            <!-- Content -->
            <div class="ms-4">
              <!-- Heading -->
              <p class="fs-sm text-primary mb-0 fw-bold display-9">
                '.$labels[$key].'
              </p>
              <!-- Text -->
              <p class="fs-sm mb-0">
                '.$translator->translate("Navigate in ".$enLabels[$key]).'
              </p>
            </div>
        </a>';
    }
    return $languageLinks;
}
/**
 * Removes image prefix "data:image/png;base64, ...."
 * 
 * @param  string $value image string with prefix
 * @return string
 */
function cleanBase64Image($value) {
    if (strpos($value, ",") > 0) {
        $exp = explode(",", $value);
        return trim($exp[1]);
    }
    return $value;
}
/**
 * Debugable json decode
 * 
 * @param  string $data data
 * @return mixed
 */
function jsonDecode($data)
{
    if (empty($data)) {
        return array();
    }
    $decodedValue = json_decode($data, true);
    $lastError = json_last_error();
    $jsonErrors = array(
        JSON_ERROR_DEPTH => 'Maximum heap size exceeded',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
        JSON_ERROR_SYNTAX => 'Syntax error',
    );
    if (! empty($jsonErrors[$lastError])) {
        throw new Exception(
            sprintf($jsonErrors[$lastError].'. Related data : '.print_r($data, true))
        );
    }
    return $decodedValue;
}
/**
 * Generate secure random integer (8-16 characters)
 * 
 * start value = 10000000
 * end value = 9223372036854775
 * 
 * @return int
 */
function generateRandomInt()
{
    $randomInteger = random_int(10000000, PHP_INT_MAX / 1000);
    return intval($randomInteger);
}
/**
 * Generate random alfabetic string
 *
 * @param  integer $length length
 * @return string
 */
function generateRandomAlpha($length = 10)
{
    return generateRandom('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length);
}
/**
 * Generate random string
 *
 * @param  integer $length length
 * @return string
 */
function generateRandomStringUpperCase($length = 10)
{
    return generateRandom('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $length);
}
/**
 * Generate random string
 *
 * @param  integer $length length
 * @return string
 */
function generateRandomString($length = 10)
{
    return generateRandom('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length);
}
/**
 * Returns to random numbers
 *
 * @return string
 */
function generateRandomNumber($length = 10)
{
    return generateRandom('0123456789', $length);
}
/**
 * Private function to generate characters
 *
 * @param  string $characters characters
 * @param  integer $length
 * @return string
 */
function generateRandom(string $characters, int $length)
{
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}