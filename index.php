
<?php
require('FileIndex.php');

$fileindex = new FileIndex();
$dir_array = $fileindex->getDirIndex();

function getDirList($dir, $dir_path)
{
    $html = null;
    foreach ($dir as $dir_name => $d) {
        if (count($d) > 0) {
            $html .= '<li>'.
                        '<i class="fas fa-folder mr-1"></i>'.
                        '<span><a href="#" class="folder" data-path="'.$dir_path. DIRECTORY_SEPARATOR .$dir_name.'">'.$dir_name.'</a>'.
                    '</li>'.
                    '<ul>'.
                        getDirList($d, $dir_path. DIRECTORY_SEPARATOR .$dir_name).
                    '</ul>';
        } else {
            $html .= '<li>'.
                        '<i class="fas fa-folder mr-1"></i>'.
                        '<span><a href="#" class="folder" data-path="'.$dir_path. DIRECTORY_SEPARATOR .$dir_name.'">'.$dir_name.'</a>'.
                    '</li>';
        }
    }
    return $html;
}
?>

<html>
    <head>
        <title>FileIndex</title>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/9228886e42.js"></script>
        <!-- StyleSheet -->
        <link rel="stylesheet" href="./style.css">
        <!-- Js -->
        <script src="./application.js"></script>
        <!-- Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <div class="container-fluid p-3">
            <div class="row">
                <!-- フォルダーブラウザー -->
                <div class="col-3">
                    <div class="card p-1">
                        <div class="card-body">
                            <ul>
                                <?php foreach ($dir_array as $dir_name => $dir): ?>
                                    <li>
                                        <i class="fas fa-folder"></i>
                                        <span>
                                            <a href="#" class="folder" data-path="<?= $dir_name ?>"><?= $dir_name ?></a>
                                        </span>
                                    </li>
                                    <?php if (count($dir) > 0): ?>
                                        <ul>
                                            <?= getDirList($dir, $dir_name) ?>
                                        </ul>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ファイルブラウザー -->
                <div class="col-9">
                    <div class="card p-1">
                        <div class="card-body">
                            <h5 class="card-title pwd"></h5>
                            <ul class="dir_index"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
