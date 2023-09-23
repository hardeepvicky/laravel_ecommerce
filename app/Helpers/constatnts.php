<?php
define("SITE_NAME", "Seven Rocks International");
if (isset($_SERVER['REQUEST_SCHEME']))
{
    define("SITE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/");
}
define("PAGINATION_LIMIT", 10);

define("CACHE_SEARCH_CONDITIONS_TIME", 60 * 24 * 30);
define("CACHE_MODEL_LIST_TIME", 60 * 24);
define("CACHE_MENU_TIME", 60 * 24 * 365);