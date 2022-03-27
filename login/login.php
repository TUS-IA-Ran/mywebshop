<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com</title>
</head>
<body>
<?php
    require_once "../my_library.php";
    echo "<h1>Webshop.com 会員ページ</h1>";
    if(empty($_POST['id']) || empty($_POST['pass'])){
        echo "ユーザーIDとパスワードを入力してください。";
        exit();
    }

    $pdo = connect_mysql();
    $sql = "SELECT id,name FROM myuser WHERE id='" .
        $_POST['id'] . "' AND pass='" . $_POST['pass'] . "'";
    $result = $pdo->query($sql);
    if(!$result){
        echo "データが取得できませんでした。";
        exit();
    }

    $uid = null;
    $uname = null;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $uid = $row['id'];
        $uname = $row['name'];

    }
   

    if($uname != null){  #入っていないわけじゃなかったら（入ってたら）
        echo "<hr> ログイン認証成功!";
    session_name("logintest");
    session_start();
    $_SESSION["logintest_id"] = $_POST['id'];
    $_SESSION["logintest_user"] = $uname;
      echo "<hr><a href='mypage.php'>マイページ</a>";
    }else{
        echo "<hr> ログイン認証失敗: ユーザー名かパスワードが正しくありません。";
        exit();
    }

   
?>
</body>
</html>