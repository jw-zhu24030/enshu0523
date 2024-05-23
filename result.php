<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>抽選結果</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20%;
        }
        .result {
            font-size: 2em;
            padding: 20px;
            border: 2px solid #ccc;
            display: inline-block;
            margin-top: 20px;
        }
        .success {
            color: red;
        }
        .failure {
            color: black;
        }
    </style>
</head>
<body>
    <?php
    // 生成一个0到99的随机数
    $random = rand(0, 99);

    // 20%的概率为成功（0到19），80%的概率为失败（20到99）
    if ($random < 20) {
        $message = "当選<br>";
        $message2 = "お申し込みいただき誠にありがとうございました。<br>
        厳正なる抽選の結果、当選されましたのでお知らせいたします。";
        $class = "success";
    } else {
        $message = "落選<br>";
        $message2 = "お申し込みいただき誠にありがとうございました。<br>
        厳正に抽選させていただいた結果、誠に残念ですが落選となりました。";
        $class = "failure";
    }
    ?>
    <div class="result <?php echo $class; ?>">
        <?php echo $message; ?>
    </div>
    <div>
        <?php echo $message2; ?>
    </div>
    <div>
        <a href="homepage.html">ホームページへ戻る</a>
    </div>
</body>
</html>
