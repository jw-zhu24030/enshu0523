<?php

if (isset($_COOKIE["name"])) {
    echo"こんにちは、{$_COOKIE["name"]}さん。";
    // header("Location:search.html");
    // exit();
    // echo 'ログアウト';

}else{
    // クッキーがない場合はログインを促すメッセージを表示して終了します
    echo "<p>ログインしてください</p>";
    echo ' <a href="homepage.html">ホームページへ戻る</a><br>';
    echo ' <a href="login.html">ログイン</a>';
    exit();

}


function clearCookie(){
    if (isset($_COOKIE['name'])) {
        unset($_COOKIE['name']); 
        setcookie('remember_user', '', -1, '/'); 
        return true;
    } else {
        return false;
    }
}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ライブを探す</title>
</head>
<body>
        <section>
            
            <a href="apply.php"><h4>公演一覧より確認する</h4></a>
        </section>
        <p>-------------------------------------------</p>
        <form action="apply.php" method="get">
            <section>
                <h4>番号またはキーワードより探す</h4>
                <input type="text" name="inputsearch" value=""><br>
                <input type="radio" value="id" name="radiosearch">番号
                <input type="radio" value="name" name="radiosearch">公演名
                <input type="radio" value="artist" name="radiosearch">アーティスト名<br>
                <input type="submit" value="検索" >
            </section>
        <!-- </form> -->
        <p>-------------------------------------------</p>
        <!-- <form action="apply.php" method="get"> -->
            <section>
                <h4>日付より探す</h4>
                日付<input type="date" name="date" value="date"><br>
                <input type="submit" value="検索" >
            </section>
        <!-- </form> -->
        <p>-------------------------------------------</p>
        <!-- <form action="apply.php" method="get"> -->
            <!-- <section>
                <h4>場所より探す</h4>
                場所<input type="checkbox" name="check[]" value="東京都">東京都
                <input type="checkbox" name="check[]" value="神奈川">神奈川<br>
                <input type="submit" value="検索" >
            </section> -->
        </form>
    <!-- <input type="button" value="前画面に戻る" onclick="history.back()"> -->
    <a href="homepage.html">ホームページへ戻る</a>
</body>
</html>

