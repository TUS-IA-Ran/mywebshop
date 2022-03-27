<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com</title>
</head>
<body>
<?php
    require_once "my_library.php";
    session_name("cart");
    session_start();
    echo "<div align='center'>";
    echo "<h1>ご注文が完了されました。</h1>";
    echo  $_POST["order_name"] . "様<br>";
    echo "この度は当店をご利用いただき誠にありがとうございました。<br>"; 
    echo "<hr>";
    
  

    
    if(isset($_SESSION["item"])){
        $pdo = connect_mysql();
        if(isset($pdo)){
            for($i = 0 ; $i < count($_SESSION["item"]); $i++){
                $sql = "INSERT INTO myorder_log 
                    (order_name, order_nameruby, goods_id)  
                    VALUES(" .
                    "\"" . $_POST["order_name"] . "\", " .
                    "\"" . $_POST["order_nameruby"] . "\", " .
                    "\"" . $_SESSION["item"][$i] . "\"" . ")";

                $result = $pdo->query($sql);
                if(empty($result)){
                    echo "購入できませんでした。";
                    exit();
                }
            }
             echo "ご購入いただいた商品<br><br>";
            $total = 0;
            for($i = 0 ; $i < count($_SESSION["item"]); $i++){
                $sql = "SELECT name,price FROM mygoods WHERE id=" . $_SESSION["item"][$i];
                $result = $pdo->query($sql);
                
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo "<li>". $row["name"] . "  /  ￥" . ($row["price"] * 1.08) . "円(税込み)<br>";
                    echo "<img src='img/" . $_SESSION["item"][$i] . ".png' width='128' height='128'><br><br>";
                    $total += $row["price"];
              }
           }
                  $tax_included = ($total*1.08);
                  if  ($tax_included >= 12000){
              echo "<font color=#FF00FF>" . "プレゼントのマスクはご購入いただいた商品と一緒に梱包させていただきますのでご了承ください。" . "</font><br>";
              echo "<img src='img/プレゼントマスク.png' width='150' height='130'><br><br>"; 
            }
                
                
            
               echo "<br><br>";
          
                echo "またのご利用お待ちしております。<br><br>";
                echo "<h1>";
                echo "<a href='index.php'>トップページはこちら</a></h1>";
                echo "<a href='login/mypage.php'>マイページに戻る</a><br><br>";
              
        }
    }else{
        echo "商品が選択されていません.";
    }
?>
</body>
</html>