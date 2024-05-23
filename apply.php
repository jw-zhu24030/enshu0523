<?php

// databaseのログイン情報
$dsn = "mysql:host=localhost;dbname=enshu;charset=utf8";
$user = "testuser";
$pass = "testpass";

// 受け取りデータを処理する
$origin = []; // ここに処理前のデータが入る
if(isset($_GET)||isset($_POST)){
    $origin += $_GET;
    $origin += $_POST;
} 

// 文字コードとhtmlエンティティズの処理を繰り返し行う
foreach($origin as $key=>$value){
    // 文字コード処理
    $mb_code = mb_detect_encoding($value);
    $value = mb_convert_encoding($value, "UTF-8", $mb_code);

    // htmlエンティティズ処理
    $value = htmlentities($value,ENT_QUOTES);

    // 処理が終わったデータを$inputに入れなおします
    $input[$key] = $value;
}
// DBに接続します
try{
    $dbh = new PDO($dsn, $user, $pass); // PDO: PHP database object, PHP自带函数

    dispaly();
    

}catch(PDOException $e){
    echo "接続失敗．．．";
    echo "エラー内容：".$e->getMessage();
}



function dispaly(){
    global $dbh;
    global $input;
    if(!isset($input)){
        $sql = <<<_SQL_
            SELECT * FROM livelist WHERE flag = 1;
_SQL_;
    }elseif($input["inputsearch"] && $input["radiosearch"]){
        $keyword = $input["inputsearch"];
        $type = $input["radiosearch"];
        $sql = <<<_SQL_
            SELECT * FROM livelist WHERE flag = 1 and ({$type}='{$keyword}');
_SQL_;
    }elseif($input["date"]){
        $day = $input["date"];
        $sql = <<<_SQL_
            SELECT * FROM livelist WHERE flag = 1 and (day='{$day}');
_SQL_;
    }
    // elseif($input["checkbox"]){
        
    //     $address = $input["date"];
    //     var_dump($address);
    //     exit();
    // }
    else{
        echo "検索条件を入力してください。<br>";
        echo ' <a href="search.php">前へ戻る</a><br>';
        exit();
    }
    // echo ($dbh->query($sql));
    // prepare() methodを使って、sqlの実行結果を$stmt objectに保留、
    // fetchを使って配列を取得
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // $blockを初期化
    $block = "";

    // tmplファイルの読み込み
    $fh = fopen("apply.tmpl", "r+");
    $fs = filesize("apply.tmpl"); // file sizeを調べる（のちのfread関数で使用）
    $insert_tmpl = fread($fh, $fs); // fileの読み込みを行う
    fclose($fh); // 不必要

    // recordを一行ずつ繰り返し$blockに詰め込む
    while ($row = $stmt->fetch()){
        // var_dump($row); // 输出查询结果以供调试

        // 差し込む用tmplを初期化
        $insert = $insert_tmpl;

        // DBの値を、PHPで使用する値として変数に入れ直す
        $id = $row["id"];
        $name = $row["name"];
        $artist = $row["artist"];
        $address = $row["address"];
        $day = $row["day"];
        $daytime = $row["daytime"];
    
        // tmplファイルの文字置き換え
        $insert = str_replace("!id!",$id, $insert);
        $insert = str_replace("!name!",$name, $insert);
        $insert = str_replace("!artist!",$artist, $insert);
        $insert = str_replace("!address!",$address, $insert);
        $insert = str_replace("!day!",$day, $insert);
        $insert = str_replace("!daytime!",$daytime, $insert);
    
        // stock.htmlに差し込む変数に格納する
        $block .= $insert; // loopするために、insert_tmplの値を追加する
    
        
    }
    

    // stock.htmlの!bolck!に、$blockを差し込む
    $fh_stock = fopen("apply.html","r+");
    $fs_stock = filesize("apply.html");
    $top = fread($fh_stock, $fs_stock);
    fclose($fh_stock);

    // $top(stock.htmlのデータ)の!block!に$blockを置き換える
    $top = str_replace("!block!", $block, $top);
    
    // 全てを差し替えたデータをブラウザに表示
    echo ($top);
}

?>