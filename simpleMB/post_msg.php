<html>
<head>
    <meta http-equiv="Content-Type" content="text/html";charset="UTF-8">
    <title>Message Board</title>
</head>
<body>
<?php
    require_once("my_library.php");
    if(!empty($_POST["name"]) || !empty($_POST["msg"])){
        $pdo = connect_mysql();
        $sql = "INSERT INTO board (name, message) VALUES ('". $_POST["name"] . "', '" . mb_ereg_replace("\n", "<br>", $_POST["msg"]) . "')";
        $result = $pdo->query($sql);
        if($result == true){ echo "伝言を投稿しました。<br>"; }
        else{ echo "投稿に失敗しました。<br>"; }
    }else{
        echo "正しく入力してください.<br>";
        exit(0);
    }
?>
</body>
</html>
