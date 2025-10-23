<?php
session_start();
if (!isset($_SESSION['user'])) { http_response_code(403); echo 'Forbidden'; exit; }
if (!isset($_FILES['audio'])) { echo 'No file'; exit; }
$allowed = ['audio/mpeg','audio/mp3','audio/ogg','audio/aac'];
if (!in_array($_FILES['audio']['type'],$allowed)) {
    echo 'Unsupported format: '.$_FILES['audio']['type'];
    exit;
}
$dstdir = __DIR__.'/media';
if (!is_dir($dstdir)) mkdir($dstdir,0775,true);
$fn = basename($_FILES['audio']['name']);
$dst = $dstdir.'/'.$fn;
move_uploaded_file($_FILES['audio']['tmp_name'],$dst);
header('Location: /awrms/');
