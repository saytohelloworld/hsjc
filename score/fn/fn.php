<?php
function connDB() {
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_passwd = 'Admin233';
    $db_table = 'dorm_score';
    
    global $conn;
    $conn = new mysqli($db_host, $db_user, $db_passwd, $db_table);

    if ($conn->connect_error) {
        die(" [ 数据库连接失败 ]: " . $conn->connect_error);
    }

    $conn->query('set names utf8');
}

function sql2json($queryRet) {
    $arr = array();

    while ($row = $queryRet->fetch_assoc()) {
        $count = count($row);

        for ($i = 0; $i < $count; $i++) {
            unset($row[$i]);
        }

        array_push($arr, $row);
    }

    return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

// 评分记录
function newScore($conn, $name, $dorm_type, $floor, $score) {
    $nowTime = date('Y-m-d H:i');

    $insert = "INSERT INTO data (name, dorm_type, floor, score, date)
                VALUES ('$name', '$dorm_type', '$floor', '$score', '$nowTime')";

    if ($conn->query($insert) === TRUE) {
        return json_encode(array('status'=>1,'msg'=>'评分已记录'), JSON_UNESCAPED_UNICODE);
    } else {
        return $conn->error;
    }
}

// 评分查询
function queryScore($conn, $dorm_type, $date) {
    $query = "SELECT * FROM data WHERE dorm_type='$dorm_type' AND date LIKE '%$date%'";
    
    $queryRet = $conn->query($query);

    class ScoreData {
        public $name;
        public $date;
        public $dormType;
        public $floor;
        public $score;
    }

    $data = array();

    while ($row = $queryRet->fetch_assoc()) {
        $a = new ScoreData();
        $a->name = $row["name"];
        $a->date = $row["date"];
        $a->dormType = $row["dorm_type"];
        $a->floor = $row["floor"];
        $a->score = json_decode($row["score"]);
        $data[] = $a;
    }
    // return sql2json($queryRet);

    return json_encode($data, JSON_UNESCAPED_UNICODE);
}

// 列出时间点
function listDate($conn, $dorm_type) {
    $query = "SELECT floor, date FROM data WHERE dorm_type='$dorm_type'";
    $queryRet = $conn->query($query);
    
    return sql2json($queryRet);
}

// 列出排名
function listRank($conn, $dorm_type, $date, $num) {
    $scoreSet = json_decode(queryScore($conn, $dorm_type, $date));
    $len = count($scoreSet);
    $ret=array();

    for ($i = 0; $i < $len; $i++)
    {
        for ($ii = 0; $ii < count($scoreSet[$i]->score); $ii++)
        {
            Array_push($ret, $scoreSet[$i]->score[$ii]);
        }
    }

    array_multisort(array_column($ret, 'scoreNum'), SORT_DESC, $ret);

    return json_encode(array_splice($ret, 0, $num));
}