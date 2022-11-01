<?php
    global $conn;

    class myDB extends SQLite3 {
        function __construct() {
            $this->open('Proenwords.db');
        }
    }

    $conn = new myDB();

    if(!$conn) { echo $conn->lastErrorMsg(); }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1000 Type B English Words</title>
    <link href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
    <style>
        body {padding: 0 20px;}
        .container {
            max-width: 65rem;
            overflow: auto;
            padding: 0;
        }
        a.btn {
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="margin: 60px 0 30px;">1000 Type B English Words</h2>    
        <p>These students already submitted the words：</p>
    </div>
    <div class="container" style="margin-bottom: 30px;overflow: initial;">
        <?php
            $result = $conn->query(<<<EOF
                SELECT DISTINCT supporter FROM Proenwords;
            EOF);

            while($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo '<a href="?s='.$row['supporter'].'" class="btn btn-primary" role="button">'.$row['supporter'].'</a>';
            }
        ?>
        <br/><br/>
        <a href="?s=all" class="btn btn-warning" role="button">All</a>
        <a href="/1000Proenwords.sql" class="btn btn-success" role="button">Download SQL</a>
    </div>
    <p class="container" style="font-size: small;margin-bottom: 0;"><i>(Click on the student to view the submitted words)</i></p>
    <p class="container" style="font-size: small;"><i>(You can swipe left or right to view the overflow content)</i></p>
    <div class="container">
        <?php

            if(isset($_GET["s"])) {
                echo '<table class="table"><thead><tr><th>i</th><th>short_words</th><th>long_words</th><th>trans_cn</th><th>supporter</th><th>type</th></tr></thead><tbody>';

                $s = $_GET["s"];
                $i = 1;

                if ($s != 'all') {
                    $result = $conn->query(<<<EOF
                        SELECT * FROM Proenwords WHERE supporter='$s';
                    EOF);
                } else {
                    $result = $conn->query(<<<EOF
                        SELECT * FROM Proenwords;
                    EOF);
                }

                while($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    echo '<tr><td>'.$i++.'</td><td>'.$row["short_words"].'</td><td>'.$row["long_words"].'</td><td>'.$row["trans_cn"].'</td><td>'.$row["supporter"].'</td><td>'.$row["type"].'</td></tr>';
                }
                echo '</tbody></table>';
            }
        ?>
    </div>
    <div class="container" style="margin-top: 30px;margin-bottom: 30px;">
        <span style="display: block;text-align: center;">广告位</span>
        <div class="mt-4 p-5 bg-secondary text-white rounded" style="margin-top: 5px!important;padding: 2rem 2rem 1rem!important;">
            <h3>计算机网络应用专业强基计划</h3> 
            <p>学习，就像5元的停车费，再便宜都觉得贵，突然有一张罚单贴在玻璃上让交200元违章停车罚款的时候，真后悔，早知道就给5元停车费了！</p>
            <p>学的不仅是技术，更是梦想！！！</p>
            <p>如果你不想后悔的！只需付出你口袋里 <span class="badge bg-warning">￥5</span> 零花钱，再加上努力，就能学到混口饭吃的技能了！</p>
            <p>想学习请联系 XXX 老师：110119120 进行咨询</p>
            <p>活动发起人：XJC</p>
        </div>
    </div>
</body>
</html>
<?php
    $conn->close();
?>