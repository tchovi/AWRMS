<?php
$cfg = include __DIR__.'/config.php';
try {
    $db = new PDO('mysql:host='.$cfg['db']['host'].';dbname='.$cfg['db']['name'].';charset=utf8mb4', $cfg['db']['user'], $cfg['db']['pass']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $db = null;
}
