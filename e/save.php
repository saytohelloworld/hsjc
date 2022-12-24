<?php
/**
 * 文件内容更改保存
 * 参数:
 *   key     验证密钥
 *   file    文件路径
 *   mdBody  文件内容
 * 
 * 错误代码:
 *   0  仅支持POST请求
 *   1  操作验证密钥错误
 *   10 文件保存失败
 *   11 文件保存成功
 */

include('fn.php');

$_SERVER['REQUEST_METHOD'] != 'POST' ? exit(ret(0, 'only allow POST request.')) : true ;


// 文件保存操作验证
ini_set('date.timezone', 'Asia/Shanghai');

$now = date('YmdHi');
$enKey = hash("sha256", ($now.'<->longjie'));

if (isset($_POST['key']) && $_POST['key'] != strtoupper($enKey)) {
    exit(ret(1, 'cannot operate, please check the key.'));
}


$file = $_POST['file'];
$mdBody = $_POST['mdBody'];
$open_file = @fopen($file, 'w');

if (!strpos(basename($file), '.md')) {
    $file = $file.'.md';
}

// 创建不存在的文件夹
if (!$open_file) {
    if (!file_exists($file)){
        mkdir(dirname($file), 0757, true);
        
        $open_file = @fopen($file, 'w');
    }
}


// 数据写入
if (fwrite($open_file, $mdBody)) {
    echo ret(11, 'file saved successfully.');
} else {
    echo ret(10, 'file saving failure.');
}

fclose($open_file);