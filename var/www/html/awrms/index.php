<?php
session_start();
// Simple routing
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($path,'/awrms') === 0) {
    include __DIR__.'/home.php';
    exit;
}
http_response_code(404);
echo 'Not Found';
