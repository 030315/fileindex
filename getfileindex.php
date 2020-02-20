<?php
require('FileIndex.php');

if (isset($_GET['dir_path'])) {
    $dir_path = $_GET['dir_path'];
    $fileindex = new FileIndex();
    $index = $fileindex->index($dir_path);
    echo json_encode($index);
}

