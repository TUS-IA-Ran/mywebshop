<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com 会員登録システム</title>
</head>
<body>
<?php
    require_once "../my_library.php";
    session_name("logintest");
    session_start();
    
    echo "<h1>Webshop.com 退会</h1>";
    $pdo = connect_mysql();
    $sql = "DELETE FROM myuser WHERE id = \"" . $_SESSION["logintest_id"] . "\"";
    $result = $pdo->query($sql);
    if(!$result){
        echo "退会できませんでした。";
    }else{
        echo "退会しました。<br>";
        echo "ご利用ありがとうございました。<br>";
        echo "<a href='login_form.html'>ログイン</a><br>";
    }
?>
</body>
</html>