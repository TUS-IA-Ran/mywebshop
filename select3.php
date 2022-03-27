<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com 商品選択ページ</title>
 <style>
    body {
      margin: 0;
      padding: 0;
    </style>
</head>
<body>
<?php
    require_once "my_library.php";
    session_name("logintest");
    session_start();
    echo "<div align='center'>";
     echo "<a href='index.php.'>"  . "<img src='img/top2.png' width='100%'>" . "</a>";
   echo "<h1><marquee width='60%'>家電製品商品ページ</marquee></h1>";
    echo "お好きな商品を選び、購入したい商品画像をタップしてください。タップされた商品は買い物カゴに入ります。<br>その際に商品詳細の情報もご参考ください。<br>";
    echo "<hr width = 10000, color = '#336699'>";

    if(isset($_SESSION["logintest_user"])){ 
       echo "<div align = 'left'>" . "<a href='login/mypage.php'>" . 
             "(". $_SESSION["logintest_user"] . ")</a>" . "様<br>" . 
                     "いつも当店をご利用いただきありがとうございます!<br>本日もごゆっくりお買い物をお楽しみください。";
       echo "</div>";
       echo "<hr width = 10000, color = '#336699'>";
    }
    echo "<br><br>";
    $pdo = connect_mysql();
    if(isset($pdo)){
        $sql = "SELECT * FROM mygoods where category='家電製品'";
        $result = $pdo->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo "<div align = 'center'>";
            echo "商品名: " . $row["name"] . "<br>";
            echo "<a href='mycago.php?item=" . $row["id"] . "'>" . "<img src='img/" . $row["id"] . ".png' width='150' height='130'></a><br>";
            echo "商品価格: " . $row["price"] . "円<br>";
            echo $row["details"] . "<br>";
            $point = $row["price"] * 0.01;
            echo $point . "ポイント還元<br><br><br>";
            echo "</div>";
        }
    }else{
        echo "MySQL接続エラー";
    }
       echo "<hr>";
       echo "<div align='left'>";
     echo "～他のジャンルの商品も閲覧したい方はこちらから～<br>";
    
      echo "<a href='select.php'>ファッション商品の一覧を見る</a><br>";
     echo "<a href='select2.php'>ファッション小物の一覧を見る</a><br>";
    
     echo "<a href='select4.php'>インテリアの一覧を見る</a><br>";
     echo "<a href='select5.php'>キッズ用品の一覧を見る</a><br>";
     echo "<a href='select6.php'>食品・スイーツの一覧を見る</a><br>";
     echo "<a href='select7.php'>コスメ・健康・医薬品の一覧を見る</a><br>";
     echo "<a href='select8.php'>日用雑貨・キッチン用品の一覧を見る</a><br>";
     echo "<a href='select9.php'>クリスマス特集の一覧を見る</a><br>";
     echo "<a href='select10.php'>お正月特集の一覧を見る</a><br>";
?>
</body>
</html>