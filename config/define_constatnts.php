<?php
define("SITE_NAME", "TEST Laravel");
define("SITE_DEVELOP_BY", "Hardeep Singh");

if (isset($_SERVER['APP_URL']))
{
    $domain = $_SERVER['APP_URL'];

    if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'])
    {
        $domain .= ":" . $_SERVER['SERVER_PORT'];
    }

    define("SITE_URL", $domain . "/");
}

define("CACHE_SEARCH_CONDITIONS_TIME", 60 * 24 * 30);
define("CACHE_MODEL_LIST_TIME", 60 * 24);
define("CACHE_MENU_TIME", 60 * 24 * 365);

define("BACKEND_CSS_VERSION", "03-Nov-2023");
define("BACKEND_JS_VERSION", "03-Nov-2023");
