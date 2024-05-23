<?php
clearCookie();

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

$inputname = $input["name"];
$inputpass = $input["pass"];

setcookie("name", $inputname, time()+300);



try {
  // DBに接続します
  $dbh = new PDO($dsn, $user, $pass);
    

  $error_notes = "";
  if($inputname === ""){
    $error_notes.="・名前が未入力です。<br>";
  }
  if($inputpass === ""){
    $error_notes.="・パスワードが未入力です。<br>";
  }
  if(($inputname!="" && $inputpass!="") && !isUser($dbh,$inputname,$inputpass)){
    $error_notes.="・名前またはパスワードが間違えました。<br>";
  }
  #エラーが存在する場合
  if($error_notes !== "") {
      error($error_notes);
  }elseif(isManager($inputname,$inputpass)){
    header("Location:manage.php");
    exit();
  }else{
  
  $inputname = wordProcess($inputname);
  $inputpass = wordProcess($inputpass);
  echo "こんにちは、{$inputname}さん。";

  }


} catch (PDOException $e) {
  echo "接続失敗．．．";
  echo "エラー内容：" . $e->getMessage();
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

function error($err){
    global $tmpl_dir;
  
    # テンプレート読み込み
    $conf = fopen("error.tmpl","r") or die;
    $size = filesize("error.tmpl");
    $tmpl = fread($conf,$size);
    fclose($conf);
  
    # 文字置き換え
    $tmpl = str_replace("!message!",$err,$tmpl);
    # 表示
    echo $tmpl;
    exit;
  }


// ユーザー認証を行う関数
function isUser($dbh, $name, $pass) {
  $sql = "SELECT * FROM user WHERE name = :name AND pass = :pass";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':pass', $pass);
  $stmt->execute();
  
  // レコードが見つかった場合はtrueを返す
  return $stmt->fetch() !== false;
}


function isManager( $name, $pass) {

  // 管理者情報を設定します（例: aaaとpwd123）
  $manager_name = 'manager01';
  $manager_pass = 'aaa!!!123';

  // 入力された情報が管理者情報と一致するか確認します
  if($name === $manager_name && $pass === $manager_pass){
    return true;
  }else{
    return false;
  }
}


function wordProcess($input){
# 文字コードをUTF-8 に統一
    $enc = mb_detect_encoding($input);
    $input = mb_convert_encoding($input, "UTF-8", $enc);

    # クロスサイトスクリプティング対策
    $input = htmlentities($input, ENT_QUOTES, "UTF-8");

    # 改行コード処理
    $input = str_replace("\r\n", "_kaigyou_", $input);
    $input = str_replace("\n", "_kaigyou_", $input);
    $input = str_replace("\r", "_kaigyou_", $input);
    return $input;
}
?>
<html>
<br>
    <section>
        <a href="search.php">チケット申し込み</a>
    </section>
    <section>
        <a href="homepage.html">ホームページへ戻る</a>
    </section>
<!-- <br><input type="button" value="前画面に戻る" onclick="history.back()"> -->
</html>