<?php
$p = explode('/', $_SERVER['REQUEST_URI']);
$projectpath = '/';
foreach ($p as $item) {
    $item = str_replace("%20", " ", $item);
    if (!empty($item)) {
        $projectpath .= $item . '/';
    }
    if ($item === basename(dirname($_SERVER['SCRIPT_FILENAME']))) {
        break;
    }
}
define("APP_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $projectpath);
define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . $projectpath);
