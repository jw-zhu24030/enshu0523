<?php
 
$inputname = $_POST["name"];
$inputmail = $_POST["mail"];
$inputtext = $_POST["text"];

$error_notes = "";
if($inputname === ""){
  $error_notes.="・名前が未入力です。<br>";
}
if($inputmail === ""){
  $error_notes.="・メールアドレスが未入力です。<br>";
}
if(isset($inputmail) && ! isEmail($inputmail)){
  $error_notes.="・正しいメールアドレスを入力してください。<br>";
}
if($inputtext === ""){
  $error_notes.="・問い合わせ内容が未入力です。<br>";
}
#エラーが存在する場合
if($error_notes !== "") {
    error($error_notes);
}

function isEmail($text){
  if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $text)){
    return TRUE;
  }else{
    return FALSE;
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

// function wordProcess($input){
// # 文字コードをUTF-8 に統一
//     $enc = mb_detect_encoding($input);
//     $input = mb_convert_encoding($input, "UTF-8", $enc);

//     # クロスサイトスクリプティング対策
//     $input = htmlentities($input, ENT_QUOTES, "UTF-8");

//     # 改行コード処理
//     $input = str_replace("\r\n", "_kaigyou_", $input);
//     $input = str_replace("\n", "_kaigyou_", $input);
//     $input = str_replace("\r", "_kaigyou_", $input);
//     return $input;
// }
// $inputname = wordProcess($inputname);
// $inputmail = wordProcess($inputmail);

// echo "ありがとうございます。";
// echo $inputpass;
?>

<html>
    <head>
        <title>お問い合わせフォーム - 確認画面</title>
    </head>
    <body>
        <h3>お問い合わせフォーム - 確認画面</h3>
        <p>以下の内容で送信します。よろしいですか？</p>
        <table>
            <tr><td>名前：</td><td><?php echo htmlspecialchars($inputname, ENT_QUOTES, 'UTF-8'); ?></td></tr>
            <tr><td>メールアドレス：</td><td><?php echo htmlspecialchars($inputmail, ENT_QUOTES, 'UTF-8'); ?></td></tr>
            <tr><td>お問い合わせ内容：</td><td><?php echo htmlspecialchars($inputtext, ENT_QUOTES, 'UTF-8'); ?></td></tr>
        </table>
        <form method="post" action="inquirysend.php">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $mail; ?>">
            <input type="hidden" name="message" value="<?php echo $text; ?>">
            <input type="submit" value="送信">
            <button type="button" onclick="history.back()">戻る</button>
        </form>
    </body>
</html>