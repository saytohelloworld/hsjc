<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G3 Simple Search</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <div class="container search-box">
        <h3>G3 Simple Search</h3>
        <div class="search-from">
            <div class="input-group mb-3">
                <input type="text" id="searchKey" class="form-control" placeholder="Search">
                <button type="submit" id="toSearch" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z" fill="rgba(255,255,255,1)"/></svg>
                </button>
                            
            </div>
            <ul id="searchCorrelative" class="search-correlative list-group"></ul>
        </div>
    </div>

    <div class="container box">
        <div id="searchResult" class="search-result"></div>
        <div class="sidebar" style="display: none;">
            <div class="mt-4 p-5 bg-light rounded">
                <h1>提交链接</h1> 
                <p>如果你的网站也想被搜索引擎收录的话，可以向我们提交你网站的链接，做好 SEO 工作即可。</p>
                <p>后续，我们的网络爬虫（蜘蛛）会从所有提交的网站中收录优质的网站。</p>
                <p>提交入口：[ OFF ]</p>
            </div>
            <div class="mt-4 p-5 bg-light rounded">
                <h1>广告位招租</h1> 
                <p>新产品试运营，<span class="badge bg-danger">1折</span> 起售只需 <span class="badge bg-success">￥10</span> 就能拥有这个广告位啦！</p>
                <p>心动不如行动，赶紧购买吧！</p>
                <p>购买联系：19965974455</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <script src="static/script.js"></script>
</body>
</html>