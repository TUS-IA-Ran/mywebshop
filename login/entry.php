<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com 会員登録システム</title>
</head>
<body>
<?php
    require_once "../my_library.php";
    echo "<h1>Webshop.com 会員登録</h1>";
    if(empty($_POST["name"]) ||
        empty($_POST["nameruby"]) ||
        empty($_POST["id"]) ||
        empty($_POST["pass"]) ||
        empty($_POST["birthday"]) ||
        empty($_POST["sex"]) ||
        empty($_POST["phone"]) ||
        empty($_POST["mail"]) ||
        empty($_POST["postalcode"]) ||
        empty($_POST["adress"])){
        echo "必要な情報をすべて入力してください。";
        exit();
    }
    $pdo = connect_mysql();
    $sql = "SELECT count(*) FROM myuser WHERE id=\"" . $_POST["id"] . "\"";
    $result = $pdo->query($sql);
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $count = $row["count(*)"];
    }
    if($count > 0){
        echo "既に登録されているユーザーIDです。";
        echo "<a href='login.php'>ログインする</a><br>";
    }
    $sql = "INSERT INTO myuser VALUES(\"" .
        $_POST["name"] . "\", \"" .
        $_POST["nameruby"] . "\", \"" .
        $_POST["id"] . "\", \"" .
        $_POST["pass"] . "\", \"" .
        $_POST["birthday"] . "\", \"" .
        $_POST["sex"] . "\", \"" .
        $_POST["phone"] . "\", \"" .
        $_POST["mail"] . "\", \"" .
        $_POST["postalcode"] . "\", \"" .
        $_POST["adress"] . "\", \"" .
        0 . "\")";
    $result = $pdo->query($sql);
    if(!$result){
        echo "登録できませんでした。";
        echo "<a href='login_form.html'>ログイン</a><br>";
    }else{
        echo "登録しました。<br>";
        echo "<a href='login_form.html'>ログイン</a><br>";

   
   

   
    echo "<hr><a href='mypage.php'>マイページ</a>";
    }
?>
</body>
</html>