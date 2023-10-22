<?php
define("SITE_NAME", "TEST Laravel");
define("SITE_DEVELOP_BY", "Hardeep Singh");

if (isset($_SERVER['REQUEST_SCHEME']))
{
    define("SITE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/");
}

define("CACHE_SEARCH_CONDITIONS_TIME", 60 * 24 * 30);
define("CACHE_MODEL_LIST_TIME", 60 * 24);
define("CACHE_MENU_TIME", 60 * 24 * 365);

define("BACKEND_CSS_JS_VERSION", "2023-10-15");