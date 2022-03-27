<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com ログアウト</title>
</head>
<body>
<?php
    session_name("logintest");
    session_start();

    $_SESSION = array();
   echo "<center>";
    echo "<h1>Webshop.com 会員ページ</h1>";
    echo "ログアウトが完了しました";
    echo "<hr><a href='login_form.html'>ログイン</a><br><br>";
   echo "<a href='../index.php'>トップページはこちら</a>";
?>
</body>
</html>
