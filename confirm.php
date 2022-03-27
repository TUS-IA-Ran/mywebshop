<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com</title>
</head>
<body>
<center>
<h1><font color=#000FF>ご注文内容の最終確認ページ</font> </h1><br><br>

<?php
    require_once "my_library.php";

     if(empty($_POST["customer_name"]) ||
        empty($_POST["customer_nameruby"]) ||
        empty($_POST["customer_postalcode"]) ||
        empty($_POST["customer_address"]) ||
        empty($_POST["customer_phone"]) ||
        empty($_POST["customer_mail"]) ||
        empty($_POST["delivery_method"]) ||
        empty($_POST["delivery"]) ||
        empty($_POST["delivery_area"]) ||
        empty($_POST["delivery_day"])){
        echo "必要な情報をすべて入力してください。";
        echo "<form action='method.php' method='post'>";
            echo "<input type='submit' value='訂正する'<br>";
            echo "</form>";
        exit();
    }
    session_name("cart");
    session_start();
    
    if(isset($_GET["clear_cart"])){
        $_SESSION["item"] = array();
    }
    if(isset($_GET["item"])){
        if(!isset($_SESSION["item"])){
            $_SESSION["item"] = array();
        }
        array_push($_SESSION["item"], $_GET["item"]);
    }
    echo "<font color=#FF00FF>" . "注文内容" . "</font><br><br>";
    if(count($_SESSION["item"]) > 0){
        $pdo = connect_mysql();
        if(isset($pdo)){
            $total = 0;
            echo "<ul>";
            for($i = 0; $i < count($_SESSION["item"]); $i++){
                $sql = "SELECT id,name,price FROM mygoods WHERE id=" . $_SESSION["item"][$i];
                $result = $pdo->query($sql);

                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo "<li>". $row["name"] . "  /  ￥" . ($row["price"] * 1.08) . "円(税込み)<br>";
                    echo "<img src='img/" . $row["id"] . ".png' width='150' height='130'><br><br>";
                    $total += $row["price"];
                   
                 }
           }
            session_write_close();
            session_name("logintest");
            session_start();
            
            if(isset($pdo)){
        $sql = "SELECT * FROM delivery_price where area=\"" . $_POST['delivery_area'] . "\"";
        $result = $pdo->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $delivery_price = $row["price"];
        
           if(isset($pdo)){
        $sql = "SELECT * FROM pay_price where method=\"" . $_POST['delivery'] . "\"";
        $result = $pdo->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
             $pay_price = $row["price"];
       
     
            
            $tax_included= ($total * 1.08);
           $sum = 0;
            echo "</ul>";
            echo "小計(税込み) :  ￥" . $tax_included . "<br>";
            echo "配送料金:  " . $delivery_price . "円<br>";
            echo "決済手数料:  " . $pay_price . "円<br>";
           
            if  ($tax_included >= 12000){
              echo "<font color=#FF00FF>" . "この度は本サイトで12000円以上お買い上げいただき、誠にありがとうございます。<br>";
              echo "感謝の心を込めて、この度「マスク20枚入り箱」をお一つ無料でプレゼントさせていただきます！<br>" . "</font>";
              echo "<img src='img/プレゼントマスク.png' width='150' height='130'><br><br>";
            }else{
              $remaining=(12000-$tax_included);
             echo "<font color=#FF00FF>" . "あと " . $remaining . " 円のご購入でマスク20枚入り箱プレゼントとなります。<br>ぜひこの機会にお買い求めください。<br><br>" . "</font>";
            }
              echo "獲得合計ポイント数 : " . $_SESSION["logintest_point"] . "ポイント<br>";
            if ($_SESSION["logintest_point"] > 2000){
             echo "ポイント割引額 : " . $_SESSION["logintest_point"] . "円<br>";
             $sum = $tax_included + $delivery_price + $pay_price - $_SESSION["logintest_point"];
              echo  "合計 : " . $sum . "円<br><br>";
            }else{
               echo "※今回は2000ポイントに達していないため、ポイント割引がされません。<br>";
               echo "ポイント割引額 : 0円<br>";
               $sum = $tax_included + $delivery_price + $pay_price;
               echo "合計(税込み) : " . $sum . "円<br><br>"; 
          }
           
            echo "<a href='mycago.php'>購入する商品を変更する</a>";
        }
     }
   }
  }
            
            
            echo "<hr>";
            echo "<font color=#FF00FF>" . "本人情報とお届け先" . "</font><br><br>";
           
            $customer_name = $_POST["customer_name"];
            $customer_nameruby = $_POST["customer_nameruby"];
            $customer_postalcode = $_POST["customer_postalcode"];
            $customer_address = $_POST["customer_address"];
            $customer_phone = $_POST["customer_phone"];
            $customer_mail = $_POST["customer_mail"];
            $delivery_method = $_POST["delivery_method"];
            $delivery_day = $_POST["delivery_day"];
            $delivery = $_POST["delivery"];
            $delivery_area = $_POST["delivery_area"];
           
             echo "<form action='pay.php' method='post'>";
            echo "氏名: " .  $customer_name . "様<br>" . "<input type='hidden' name='order_name' value=" . $customer_name . ">";
           echo "氏名(フリガナ): " . $customer_nameruby . "様<br>" . "<input type='hidden' name='order_nameruby' value=" . $customer_nameruby . ">";
            echo "電話番号: " . $customer_phone . "<br>";
            echo "メールアドレス: " . $customer_mail . "<br>";
            echo "ご住居地域: " . $delivery_area . "<br>";
            echo "郵便番号: " . $customer_postalcode . "<br>";
            echo "住所: " . $customer_address . "<br><br><br>";
           
          
           
            echo "<font color=#FF00FF>" . "お支払方法 : " . "</font>" . $delivery . "<br><br>";
            echo "<font color=#FF00FF>" . "配送方法 : " . "</font>" . $delivery_method . "<br><br>";
            echo "<font color=#FF00FF>" . "配送希望日 : " . "</font>" . $delivery_day . "<br><br>";
           
           echo "<a href='method.php'>変更する</a>";
            echo "<hr>";
        }else{
            echo "MySQL接続エラー";
        }

    }else{
        echo "なし<br>";
    }
            
          
            echo "※ご購入商品にお間違えがないか今一度ご確認ください。<br>";
           
            echo "<input type='submit' value='ご購入確定ボタン'<br>";
            echo "</form>";
            echo "<a href='select.php'>ファッション商品一覧を見る</a><br>";
            echo "<a href='select2.php'>ファッション小物商品一覧を見る</a><br>";
            echo "<a href='select3.php'>電化製品一覧を見る</a><br>";
?>
</body>
</html>