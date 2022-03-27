<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com 購入履歴</title>
</head>
<body>
<?php
    session_name('logintest');
    session_start();
    require_once "../my_library.php";
     if(isset($_SESSION["logintest_user"])){
     $pdo = connect_mysql();
       $sql = "SELECT * FROM myorder_log
                WHERE order_name =\"" . $_SESSION["logintest_user"] . "\"";
       $result = $pdo->query($sql);
    echo "<center>";
    echo "<h1>" . $_SESSION["logintest_user"] . "様のご購入履歴ページ</h1>";
   echo "いつも当店をご利用いただき誠にありがとうございます。<br><br>";
  echo  "もう一度購入したい商品がございましたら、その商品画像をタップしてください。<br>お客様の買い物かごに追加されます。<br>";
  echo "またご購入いただいた商品について、もしよろしければレビューも書いてくださると光栄です!<br><br>";
    echo "<a href='mypage.php'>マイページに戻る場合はこちらから</a><br>";
    $bought_time = 0;
    $price_total = -1;
   echo "</center>";
     echo "<hr>";
       echo "配送先" . "<br>";
       $address = "";
            if(isset($_SESSION["logintest_id"])){
                $sql = "SELECT * FROM myuser WHERE id=\"" . $_SESSION["logintest_id"] . "\"";
                $result = $pdo->query($sql);
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $address = $row["address"];
                }
        }
       echo "住所: " . $address ;
        echo "<br>";
       echo "氏名: " . $_SESSION["logintest_user"];

       $pdo = connect_mysql();
       $sql = "SELECT * FROM myorder_log
                WHERE order_name =\"" . $_SESSION["logintest_user"] . "\"";
       $result = $pdo->query($sql);
      
    echo "<hr>";
    echo "<center>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        if($bought_time != $row["time"]){
            if($price_total > -1)
            echo "<hr>";
            echo "購入日時: ". $row["time"] . "<br><br>";
            $price_total = 0;
            echo "ご購入いただいた商品<br><br>";
        }
        $bought_time = $row["time"];
        $sql = "SELECT name, price FROM mygoods WHERE id=" . $row["goods_id"];
        $result_goods = $pdo->query($sql);

        while($row_goods = $result_goods->fetch(PDO::FETCH_ASSOC)){

            echo "<li>注文番号 : " . $row['number'] . "<br>";
            echo "受取人 : ". $row['order_name'] . " 様<br>";
             echo "商品名 : " . $row_goods["name"] . "<br>";
            echo "商品単価 :  " . $row_goods["price"] . "円<br>";
             echo "<a href='../mycago.php?item=" . $row["goods_id"] . "'>" . "<img src='../img/" . $row["goods_id"] . ".png' width='150' height='130'></a><br><br>";
             echo "<form action='../mycago.php?item=" . $row["goods_id"] .  "method='post'>";         
            echo "<input type='submit' value='この商品をもう一度購入する'>";
            echo "</form><br><br>";
            echo "<form action='../simpleMB/mb_form.html' method='post'>";         
            echo "<input type='submit' value='この商品についてレビューを書く'>";
            echo "</form><br><br>";
        }
    }
   }else{
       echo "<br><br><br>";
      echo "<div align ='center'>";
      echo "<h1>本サイトでお買い物をするには必ず会員登録してください。</h1>";
      echo "※現状況ですと、お客様のご購入履歴をご確認いただくことができません。<br><br><br>";
      echo "すでに会員登録がお済のお客様はこちらから : ";
      echo "<form action='login_form.html' method='post'>";
      echo "<input type='submit' value='ログインする'<br>";
      echo "</form><br><br>";
     echo "本サイトを初めてご利用のお客様はこちらから : ";
      echo "<form action='entry_form.html' method='post'>";
      echo "<input type='submit' value='新規会員登録する'<br>";
      echo "</form>";
  }
?>
</body>
</html>