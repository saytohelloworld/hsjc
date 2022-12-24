<?php
include('fn.php');

if (!isset($_GET['type'])) {
    exit(ret(1, '未设置必要参数'));
}

switch ($_GET['type']) {
    case 'md':
        if (!isset($_GET['file'])) exit(ret(2, '未设置文件名'));

        $file = $_GET['file'];

        (strpos(basename($file), '.md')) ? true : $file = $file.'.md';

        ($open_file = @fopen($file, 'r')) ? true : exit(ret(3, '该文件不存在'));

        echo fread($open_file, filesize($file));
        fclose($open_file);
        break;
    case 'mdList':
        displayDir('md');
        break;
}