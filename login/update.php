<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com 会員登録システム</title>
</head>
<body>
<?php
    require_once "../my_library.php";
    session_name('logintest');
    session_start();
    echo "<h1>Webshop.com 会員情報の更新</h1>";
    if( empty($_POST["mail"]) ||
        empty($_POST["address"])){
        echo "必要な情報をすべて入力してください。";
        exit();
    }
    $pdo = connect_mysql();
    $sql = "UPDATE user SET mail = \"" .
        $_POST["mail"] . "\" WHERE name=\"" . $_SESSION["logintest_user"] . "\"";
    $result = $pdo->query($sql);
    if(!$result){
        echo "更新できませんでした。";
    }else{
        echo "更新しました。<br>";
        echo "<a href='mypage.php'>マイページ</a><br>";
    }
?>
</body>
</html>