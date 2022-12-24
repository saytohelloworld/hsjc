<?php
$ico_dir = '<svg t="1668003184187" class="icon" viewBox="0 0 1260 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6571" width="20" height="20"><path d="M1171.561 157.538H601.797L570.814 61.44A88.222 88.222 0 0 0 486.794 0H88.747A88.747 88.747 0 0 0 0 88.747v846.506A88.747 88.747 0 0 0 88.747 1024H1171.56a88.747 88.747 0 0 0 88.747-88.747V246.285a88.747 88.747 0 0 0-88.747-88.747z m-1082.814 0V88.747h398.047l22.055 68.791z" p-id="6572" fill="#333333"></path></svg>';
$ico_file = '<svg t="1668003050279" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4498" width="20" height="20"><path d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326z m1.8 562H232V136h302v216c0 23.2 18.8 42 42 42h216v494z" p-id="4499" fill="#333333"></path><path d="M429 481.2c-1.9-4.4-6.2-7.2-11-7.2h-35c-6.6 0-12 5.4-12 12v272c0 6.6 5.4 12 12 12h27.1c6.6 0 12-5.4 12-12V582.1l66.8 150.2c1.9 4.3 6.2 7.1 11 7.1H524c4.7 0 9-2.8 11-7.1l66.8-150.6V758c0 6.6 5.4 12 12 12H641c6.6 0 12-5.4 12-12V486c0-6.6-5.4-12-12-12h-34.7c-4.8 0-9.1 2.8-11 7.2l-83.1 191-83.2-191z" p-id="4500" fill="#333333"></path></svg>'; 
$ico_newFile = '<svg t="1668005610880" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2678" width="20" height="20"><path d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326z m1.8 562H232V136h302v216c0 23.2 18.8 42 42 42h216v494z" p-id="2679" fill="#515151"></path></svg>';

function displayDir($path) {
    $dirHandle = opendir($path);

    while ($file = readdir($dirHandle)) {
        if ($file != '.' && $file != '..') {
            $filepath = $path."/".$file;

            global $ico_dir,$ico_file;

            if (filetype($filepath) == 'dir') {
                echo "<a href='".$filepath."' class='".filetype($filepath)."'>".$ico_dir.$file."</a>";
            } else {
                $file = explode(".", $file);
                echo "<a href='".$filepath."' class='".filetype($filepath)."'>".$ico_file.$file[1].".md</a>";
            }
        }
    }
    closedir($dirHandle);
}

function ret($code, $msg) {
    return json_encode(['status'=>$code, 'msg'=>$msg], JSON_UNESCAPED_UNICODE);
}