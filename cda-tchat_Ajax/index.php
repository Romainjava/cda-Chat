<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'model/Connexion.php';
$co = new Connexion();

$loc = filter_input(INPUT_GET, 'loc', FILTER_SANITIZE_STRING);
if (!$loc) {
    $loc = 'home';
}

$files = 'controller/c_' . $loc . '.php';
if(file_exists($files)){
    include $files;
}else {
    echo "Error dans le controler general";
}

include 'view/v_template.php';