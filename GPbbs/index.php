<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言墙</title>
    <meta name="author" content="LongJie"/>
    <meta name="description" content="AJAX/PHP/MySQL 练习项目"/>
    <!-- 该死的蜘蛛别爬我身上，哼 -->
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="static/style.css">
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.staticfile.org/KaTeX/0.15.6/katex.min.css">
</head>
<body>
    <header>
        <h2>留言墙</h2>
    </header>
    <div class="container-editor">
        <div class="editor-info">
            <div class="input-group" style="margin-right: 10px;">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" id="form-nickname" class="form-control" placeholder="昵称 *">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="email" id="form-email" class="form-control" placeholder="电邮">
            </div>
        </div>
        <div class="editor-content">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-header"></span></span>
                <input type="text" id="form-title" class="form-control" placeholder="标题 *" autofocus>
            </div>
            <textarea id="form-text" class="form-control" rows="5" placeholder="详细的内容 *"></textarea>
            <span class="help-block" style="text-align: right;margin: 5px;"><i>支持 Markdown 语法</i></span>
        </div>
        <div class="editor-btn">
            <button class="btn btn-primary" id="form-postBtn">发布 (Ctrl + Enter)</button>
        </div>
    </div>
    <div class="container-msg">
        <div class="msg-header">
            <span>帖子标题</span>
            <span>发布者 / 时间</span>
        </div>
        <div class="msg-list">
            <?php
                include('./function.php');
                connDB();

                updateData($conn);

                $conn->close();        
            ?>
        </div>
    </div>

    <div class="modal fade" id="readMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="msg-title"></h4>
                </div>
                <div class="modal-body" id="msg-text"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="static/script.js"></script>
    <script src="https://cdn.staticfile.org/marked/2.1.3/marked.min.js"></script>
    <script defer src="https://cdn.staticfile.org/KaTeX/0.15.6/katex.min.js"></script>
    <script defer src="https://cdn.staticfile.org/KaTeX/0.15.6/contrib/auto-render.min.js"></script>
</body>
</html>