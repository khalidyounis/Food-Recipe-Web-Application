<?php

use CNZ\Helpers\Arr as arr;
use CNZ\Helpers\Dev as dev;
use CNZ\Helpers\Str as str;
use CNZ\Helpers\Util as util;
use CNZ\Helpers\Yml as yml;



/**
 * Function to generate random string.
 */
function randomString($n)
{

    $generated_string = "";

    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    $len = strlen($domain);

    // Loop to create random string
    for ($i = 0; $i < $n; $i++) {
        // Generate a random index to pick characters
        $index = rand(0, $len - 1);

        // Concatenating the character
        // in resultant string
        $generated_string = $generated_string . $domain[$index];
    }

    return $generated_string;
}

/**
 *
 */
function getSecureRandomToken()
{
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

/**
 * Clear Auth Cookie
 */
function clearAuthCookie()
{

    unset($_COOKIE['series_id']);
    unset($_COOKIE['remember_token']);
    unset($_COOKIE['email']);
    setcookie('series_id', null, -1, '/');
    setcookie('remember_token', null, -1, '/');
    setcookie('email', null, -1, '/');
}
/**
 *
 */
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function paginationLinks($current_page, $total_pages, $base_url)
{

    if ($total_pages <= 1) {
        return false;
    }

    $html = '';

    if (!empty($_GET)) {
        // We must unset $_GET[page] if previously built by http_build_query function
        unset($_GET['page']);
        // To keep the query sting parameters intact while navigating to next/prev page,
        $http_query = "?" . http_build_query($_GET);
    } else {
        $http_query = "?";
    }

    $html = '<ul class="pagination text-center">';

    if ($current_page == 1) {

        $html .= '<li class="disabled"><a>First</a></li>';
    } else {
        $html .= '<li><a href="' . $base_url . $http_query . '&page=1">First</a></li>';
    }

    // Show pagination links

    //var i = (Number(data.page) > 5 ? Number(data.page) - 4 : 1);

    if ($current_page > 5) {
        $i = $current_page - 4;
    } else {
        $i = 1;
    }

    for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
        ($current_page == $i) ? $li_class = ' class="active"' : $li_class = '';

        $link = $base_url . $http_query;

        $html = $html . '<li' . $li_class . '><a href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';

        if ($i == $current_page + 4 && $i < $total_pages) {

            $html = $html . '<li class="disabled"><a>...</a></li>';
        }
    }

    if ($current_page == $total_pages) {
        $html .= '<li class="disabled"><a>Last</a></li>';
    } else {

        $html .= '<li><a href="' . $base_url . $http_query . '&page=' . $total_pages . '">Last</a></li>';
    }

    $html = $html . '</ul>';

    return $html;
}

/**
 * to prevent xss
 */
function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    } while ($old_data !== $data);

    // we are done...
    return $data;
}

// @group(Device)

if (!function_exists('is_mobile')) {
    /**
     * Detects if the current device is a mobile device (Smartphone/Tablet/Handheld).
     *
     * @return bool
     */
    function is_mobile()
    {
        return dev::isMobile();
    }
}

if (!function_exists('is_smartphone')) {
    /**
     * Determes if the current device is a smartphone.
     *
     * @return bool
     */
    function is_smartphone()
    {
        return dev::isSmartphone();
    }
}

if (!function_exists('is_tablet')) {
    /**
     * Determes if the current device is a tablet.
     *
     * @return bool
     */
    function is_tablet()
    {
        return dev::isTablet();
    }
}

if (!function_exists('is_desktop')) {
    /**
     * Determes if the current device is a desktop computer.
     *
     * @return bool
     */
    function is_desktop()
    {
        return dev::isDesktop();
    }
}

if (!function_exists('is_robot')) {
    /**
     * Determes if the current device is a bot/crawler/spider.
     *
     * @return bool
     */
    function is_robot()
    {
        return dev::isRobot();
    }
}

if (!function_exists('is_ios')) {
    /**
     * Determes if the current device is running an iOS operating system.
     *
     * @return bool
     */
    function is_ios()
    {
        return dev::isIOS();
    }
}

if (!function_exists('is_android')) {
    /**
     * Determes if the current device is running an Android operating system.
     *
     * @return bool
     */
    function is_android()
    {
        return dev::isAndroid();
    }
}

if (!function_exists('is_iphone')) {
    /**
     * Determes if the current device is an iPhone.
     *
     * @return bool
     */
    function is_iphone()
    {
        return dev::isIphone();
    }
}

if (!function_exists('is_samsung')) {
    /**
     * Determes if the current device is from Samsung.
     *
     * @return bool
     */
    function is_samsung()
    {
        return dev::isSamsung();
    }
}

// @endgroup(Device)

// @group(Array)

if (!function_exists('array_get')) {
    /**
     * Gets a value in an array by dot notation for the keys.
     *
     * @param string $key
     * @param array  $array
     *
     * @return mixed
     */
    function array_get($key, $array)
    {
        return arr::get($key, $array);
    }
}

if (!function_exists('array_set')) {
    /**
     * Sets a value in an array using the dot notation.
     *
     * @param string $key
     * @param mixed  $value
     * @param array  $array
     *
     * @return bool
     */
    function array_set($key, $value, &$array)
    {
        return arr::set($key, $value, $array);
    }
}

if (!function_exists('array_first')) {
    /**
     * Returns the first element of an array.
     *
     * @param array $array
     *
     * @return mixed $value
     */
    function array_first($array)
    {
        return arr::first($array);
    }
}

if (!function_exists('array_last')) {
    /**
     * Returns the last element of an array.
     *
     * @param array $array
     *
     * @return mixed $value
     */
    function array_last($array)
    {
        return arr::last($array);
    }
}

if (!function_exists('to_array')) {
    /**
     * Converts a string or an object to an array.
     *
     * @param string|object $var
     *
     * @return array|null
     */
    function to_array($var)
    {
        return arr::dump($var);
    }
}

if (!function_exists('to_object')) {
    /**
     * Converts an array to an object.
     *
     * @param array $array
     *
     * @return object|null
     */
    function to_object($array)
    {
        return arr::toObject($array);
    }
}

if (!function_exists('is_assoc')) {
    /**
     * Detects if the given value is an associative array.
     *
     * @param array $array
     *
     * @return bool
     */
    function is_assoc($array)
    {
        return arr::isAssoc($array);
    }
}

// @endgroup(Array)

// @group(String)

if (!function_exists('str_before')) {
    /**
     * Get the portion of a string before a given value.
     *
     * @param string $search
     * @param string $string
     *
     * @return string
     */
    function str_before($search, $string)
    {
        return str::before($search, $string);
    }
}

if (!function_exists('str_after')) {
    /**
     * Return the remainder of a string after a given value.
     *
     * @param string $search
     * @param string $string
     *
     * @return string
     */
    function str_after($search, $string)
    {
        return str::after($search, $string);
    }
}

if (!function_exists('str_after_last')) {
    /**
     * Return the remainder of a string after the last occurrence of a search value.
     *
     * @param string $search
     * @param string $string
     *
     * @return string
     */
    function str_after_last($search, $string)
    {
        return str::afterLast($search, $string);
    }
}

if (!function_exists('str_between')) {
    /**
     * Return the content in a string between a left and right element.
     *
     * @param string $left
     * @param string $right
     * @param string $string
     *
     * @return array
     */
    function str_between($left, $right, $string)
    {
        return str::between($left, $right, $string);
    }
}

if (!function_exists('str_insert')) {
    /**
     * Inserts one or more strings into another string on a defined position.
     *
     * @param array  $keyValue
     * @param string $string
     *
     * @return string
     */
    function str_insert($keyValue, $string)
    {
        return str::insert($keyValue, $string);
    }
}

if (!function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string. Put value of $end to the string end.
     *
     * @param  string $string
     * @param  int    $limit
     * @param  string $end
     *
     * @return string
     */
    function str_limit($string, $limit = 100, $end = '...')
    {
        return str::limit($string, $limit, $end);
    }
}

if (!function_exists('str_limit_words')) {
    /**
     * Limit the number of words in a string. Put value of $end to the string end.
     *
     * @param  string $string
     * @param  int    $limit
     * @param  string $end
     *
     * @return string
     */
    function str_limit_words($string, $limit = 10, $end = '...')
    {
        return str::limitWords($string, $limit, $end);
    }
}

if (!function_exists('str_contains')) {
    /**
     * Tests if a string contains a given element
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_contains($needle, $haystack)
    {
        return str::contains($needle, $haystack);
    }
}

if (!function_exists('str_icontains')) {
    /**
     * Tests if a string contains a given element. Ignore case sensitivity.
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_icontains($needle, $haystack)
    {
        return str::containsIgnoreCase($needle, $haystack);
    }
}

if (!function_exists('str_starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_starts_with($needle, $haystack)
    {
        return str::startsWith($needle, $haystack);
    }
}

if (!function_exists('str_istarts_with')) {
    /**
     * Determine if a given string starts with a given substring. Ignore case sensitivity.
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_istarts_with($needle, $haystack)
    {
        return str::startsWithIgnoreCase($needle, $haystack);
    }
}

if (!function_exists('str_ends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_ends_with($needle, $haystack)
    {
        return str::endsWith($needle, $haystack);
    }
}

if (!function_exists('str_iends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string|array $needle
     * @param string       $haystack
     *
     * @return bool
     */
    function str_iends_with($needle, $haystack)
    {
        return str::endsWithIgnoreCase($needle, $haystack);
    }
}

// @endgroup(String)

// @group(Utils)

if (!function_exists('ip')) {
    /**
     * Returns the user ip-adresse.
     * See: https://stackoverflow.com/q/3003145/1108161
     *
     * @return string|null
     * The detected ip address, false otherwise.
     */
    function ip()
    {
        return util::ip();
    }
}

if (!function_exists('is_email')) {
    /**
     * Validate a given email address.
     *
     * @param string $email
     *
     * @return bool
     */
    function is_email($email)
    {
        return util::isEmail($email);
    }
}

if (!function_exists('dump')) {
    /**
     * Dumps the content of the given variable.
     *
     * @codeCoverageIgnore
     *
     * @param mixed $var
     */
    function dump($var)
    {
        util::dump($var);
    }
}

if (!function_exists('dd')) {
    /**
     * Dumps the content of the given variable and exits the script.
     *
     * @codeCoverageIgnore
     *
     * @param mixed $var
     */
    function dd($var)
    {
        util::dd($var);
    }
}

if (!function_exists('crypt_password')) {
    /**
     * Creates a secure hash from a given password. Uses the CRYPT_BLOWFISH algorithm.
     *
     * @param string $password
     *
     * @return string
     */
    function crypt_password($password)
    {
        return util::cryptPassword($password);
    }
}

if (!function_exists('is_password')) {
    /**
     * Verifies that a password matches a crypted password (CRYPT_BLOWFISH algorithm).
     *
     * @param string $password
     * @param string $cryptedPassword
     *
     * @return bool
     */
    function is_password($password, $cryptedPassword)
    {
        return util::isPassword($password, $cryptedPassword);
    }
}

// @endgroup(Utils)

// @group(Yml)

if (!function_exists('to_yml')) {
    /**
     * Transformes a given array to a yaml string.
     *
     * @param array|object $var
     * @param int          $indent
     * @return string|null
     */
    function to_yml($var, $indent = 2)
    {
        return yml::dump($var, $indent);
    }
}

if (!function_exists('to_yml_file')) {
    /**
     * Transformes a given array to yaml syntax and puts its content into a given file.
     *
     * @codeCoverageIgnore
     *
     * @param array|object $var
     * @param string       $filename
     * @param int          $indent
     * @return bool
     */
    function to_yml_file($var, $filename, $indent = 2)
    {
        return yml::dumpfile($var, $filename, $indent);
    }
}

if (!function_exists('yml_parse')) {
    /**
     * Transforms a given yaml string into an array.
     *
     * @param string $yml
     * @return array
     */
    function yml_parse($yml)
    {
        return yml::parse($yml);
    }
}

if (!function_exists('yml_parse_file')) {
    /**
     * Loads the content of a yaml file into an array.
     *
     * @codeCoverageIgnore
     *
     * @param $ymlFile
     * @return array
     */
    function yml_parse_file($ymlFile)
    {
        return yml::parseFile($ymlFile);
    }
}

if (!function_exists('is_yml')) {
    /**
     * Loads the content of a yaml file into an array.
     *
     * @param $string
     * @return bool
     */
    function is_yml($string)
    {
        return yml::isValid($string);
    }
}

if (!function_exists('is_yml_file')) {
    /**
     * Validates if a given file contains yaml syntax.
     *
     * @codeCoverageIgnore
     *
     * @param $string
     * @return bool
     */
    function is_yml_file($string)
    {
        return yml::isValidFile($string);
    }
}

if (!function_exists('yml_get')) {
    /**
     * Gets a value in a yaml string using the dot notation.
     *
     * @param string $search
     * @param string $yml
     * @return mixed
     */
    function yml_get($search, $yml)
    {
        return yml::get($search, $yml);
    }
}

if (!function_exists('yml_get_file')) {
    /**
     * Gets a value in a yamlfile using the dot notation.
     *
     * @param string $search
     * @param string $ymlfile
     * @return mixed
     */
    function yml_get_file($search, $ymlfile)
    {
        return yml::getFile($search, $ymlfile);
    }
}

if (!function_exists('yml_set')) {
    /**
     * Sets a value in an yml string using the dot notation.
     *
     * @param string $key
     * @param mixed  $value
     * @param string $yml
     *
     * @return bool
     */
    function yml_set($key, $value, &$yml)
    {
        return yml::set($key, $value, $yml);
    }
}

if (!function_exists('yml_set_file')) {
    /**
     * Sets a value in an ymlfile using the dot notation.
     *
     * @param string $key
     * @param mixed  $value
     * @param string $ymlfile
     * @return bool
     */
    function yml_set_file($key, $value, $ymlfile)
    {
        return yml::setFile($key, $value, $ymlfile);
    }
}

// @endgroup(Yml)
