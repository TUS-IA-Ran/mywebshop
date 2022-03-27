<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com</title>
    <style>
    body {
      margin: 0;
      padding: 0;
    }
    </style>
</head>
<body>

    <center>
    <?php
      
       echo "<div align='center'><img src='img/top1.png' width='100%'><br>";
       echo "<div align='right'>";
       echo " <a href='mycago.php'><img src='img/カート.png' width='80px'></a>";
      echo " <a href='login/order_log.php'><img src='img/メモイラスト.png' width='80px'></a>";
      echo " <a href='help/help.html'><img src='img/ヘルプボタン.png' width='80px'></a><br>";
     echo "<center>";
    echo " <a href='login/login_form.html'>ログインする</a>";
   echo " または ";
    echo "<a href='login/entry_form.html'>新規会員登録する</a><br>";
       echo "<marquee width='30%'><span style='font-size:40px; color:pink;'>RAN SHOPへようこそ！！！</span></marquee><br>";
        session_name("counter");
        session_start();
        if(isset($_SESSION["count"])){
            $_SESSION["count"]++;
        }else{
            $_SESSION["count"] = 0;
        }
        
        echo "本日のご来店回数: " . $_SESSION["count"] . "<br>";
    ?>
    <img src='img/point.png' width='60%'><br><br>
   <img src='img/マスク.png' width='60%'><br><br>
     <a href='select9.php'><img src='img/クリスマス特集.png' width='60%'></a><br><br>
     <a href='select10.php'><img src='img/お正月特集.png' width='60%'></a><br><br>
     <a href='select.php'><img src='img/図1.png' width='60%'></a><br><br>
     <a href='select2.php'><img src='img/図2.png' width='60%'></a><br><br>
     <a href='select3.php'><img src='img/図3.png' width='60%'></a><br><br>
     <a href='select4.php'><img src='img/図4.png' width='60%'></a><br><br>
     <a href='select5.php'><img src='img/図5.png' width='60%'></a><br><br>
     <a href='select6.php'><img src='img/図6.png' width='60%'></a><br><br>
     <a href='select7.php'><img src='img/図7.png' width='60%'></a><br><br>
     <a href='select8.php'><img src='img/図8.png' width='60%'></a><br><br>

    </center>
</body>
</html>