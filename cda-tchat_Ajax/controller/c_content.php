<?php

$files =  'view/v_' . $loc . '.php';
if (file_exists($files)) {
    include $files;
} else {
    echo "Error in controller content";
}
