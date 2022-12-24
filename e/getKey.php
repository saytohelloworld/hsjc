<?php
/**
 * 获取 SHA256 加密后的 key 内容
 */

include('fn.php');

if (!isset($_GET['s'])) {
    exit(ret(1, '未设置必要参数'));
}

if (!empty($_GET['s'])) {
    echo strtoupper(hash("sha256", $_GET['s']));
} else {
    echo(ret(2, '参数不能为空'));
}