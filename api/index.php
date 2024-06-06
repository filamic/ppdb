<?php

//IF $_SERVER['DOCUMENT_ROOT'] does not contain the public folder, add it
if (strpos($_SERVER['DOCUMENT_ROOT'], "/public") === false) {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']."/public";
    $_SERVER['SCRIPT_FILENAME'] = $_SERVER['DOCUMENT_ROOT']."/index.php";

    //get $_SERVER['REQUEST_URI']; until the first ? or # character
    $_SERVER['PATH_INFO'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $_SERVER['PHP_SELF'] = "/index.php".$_SERVER['PATH_INFO'];
}
$vercelURL = getenv('VERCEL_URL');

putenv("APP_URL=https://$vercelURL");

// Forward Vercel requests to public index.
require __DIR__ . "/" . "../public/index.php";
