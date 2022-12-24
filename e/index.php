<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仓库</title>
    <link rel="stylesheet" href="dist/index.css">
    <script src="dist/index.min.js"></script>
    <link rel="stylesheet" href="static/style.css">
    <link rel="stylesheet" href="static/TGTool/index.css">
</head>
<body>
    <div class="main">
        <div class="menu">
            <div class="btn">
                <a href="" class="file new" style="padding-left: 10%;">
                    <svg t="1668234852941" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3437" width="20" height="20"><path d="M863.328 482.56l-317.344-1.12L545.984 162.816c0-17.664-14.336-32-32-32s-32 14.336-32 32l0 318.4L159.616 480.064c-0.032 0-0.064 0-0.096 0-17.632 0-31.936 14.24-32 31.904C127.424 529.632 141.728 544 159.392 544.064l322.592 1.152 0 319.168c0 17.696 14.336 32 32 32s32-14.304 32-32l0-318.944 317.088 1.12c0.064 0 0.096 0 0.128 0 17.632 0 31.936-14.24 32-31.904C895.264 496.992 880.96 482.624 863.328 482.56z" p-id="3438" fill="rgb(0 0 0 / 30%)"></path></svg>
                    New File
                </a>
                <a href="" class="file save" style="padding-left: 20%;">
                    <svg t="1668235906023" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4578" width="20" height="20"><path d="M893.3 293.3L730.7 130.7c-7.5-7.5-16.7-13-26.7-16V112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V338.5c0-17-6.7-33.2-18.7-45.2zM384 184h256v104H384V184z m456 656H184V184h136v136c0 17.7 14.3 32 32 32h320c17.7 0 32-14.3 32-32V205.8l136 136V840z" p-id="4579" fill="rgb(0 0 0 / 30%)"></path><path d="M512 442c-79.5 0-144 64.5-144 144s64.5 144 144 144 144-64.5 144-144-64.5-144-144-144z m0 224c-44.2 0-80-35.8-80-80s35.8-80 80-80 80 35.8 80 80-35.8 80-80 80z" p-id="4580" fill="rgb(0 0 0 / 30%)"></path></svg>
                    保存
                </a>
            </div>
            <div id="mdList">
            <?php
                include('fn.php');
                displayDir('md');
            ?>
            </div>
        </div>
        <div id="vditor" class="vditor"></div>
    </div>

    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="static/script.js"></script>
    <script src="static/TGTool/index.js"></script>
</body>
</html>
