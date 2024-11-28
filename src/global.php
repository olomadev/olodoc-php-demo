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