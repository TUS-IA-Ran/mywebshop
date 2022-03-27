<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com</title>
</head>
<body>
<center>
<h1><font color=#000FF>お支払方法とお届け先確認ページ</font> </h1>
<?php 
            echo "<hr>";
            echo "<font color=#FF00FF>" . "お支払い方法" . "</font><br><br>";
            echo "<form action='confirm.php' method='post'>";
            echo "クレジットカード" . "<input type='radio' name='delivery' value='クレジットカード'><br>";
            echo "後払い(コンビニ・郵便局・銀行)" . "<input type='radio' name='delivery' value='後払い(コンビニ・郵便局・銀行)'><br>";
            echo "Paidy翌月払い(コンビニ/銀行)" . "<input type='radio' name='delivery' value='Paidy翌月払い(コンビニ/銀行)' size ='20'><br>";
            echo "ソフトバンクケータイ支払い" . "<input type='radio' name='delivery' value='ソフトバンクケータイ支払い' size='20'><br>";
            echo "auかんたん決済" . "<input type='radio' name='delivery' value='auかんたん決済'size ='20'><br>";
            echo "ドコモケータイ払い" . "<input type='radio' name='delivery' value='ドコモケータイ払い' size='20'><br>";
            echo "代金引換" . "<input type='radio' name='delivery' value='代金引換'size ='20'><br>";
            echo "楽天ペイ" . "<input type='radio' name='delivery' value='楽天ペイ' size='20'><br>";
            
            


            require_once "my_library.php";
            session_name("logintest");
            session_start();
            echo "<hr>";
          
         $pdo = connect_mysql();
         if(isset($pdo)){
            $name = ""; $nameruby = ""; $postalcode = ""; $adress = ""; $phone = "";
            if(isset($_SESSION["logintest_id"])){
                $sql = "SELECT * FROM myuser WHERE id =\"" . $_SESSION["logintest_id"] . "\"";
                $result = $pdo->query($sql);
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $name = $row["name"];
                    $nameruby = $row["nameruby"];
                    $postalcode = $row["postalcode"];
                    $address = $row["address"];
                    $phone = $row["phone"];
                    $mail = $row["mail"];
                }
            }
        }
            echo "<font color=#FF00FF>" . "お届け先" . "</font><br><br>";
           
            echo "氏名: <br><input type='text' name='customer_name' value=" . $name . ">" . "様<br><br>";
            echo "氏名(フリガナ）: <br><input type='text' name='customer_nameruby' value=" . $nameruby . ">" . "様<br><br>";
            echo "電話番号: <br><input type='text' name='customer_phone' value='" . $phone . "'><br><br>";
            echo "メールアドレス: <br><input type='text' name='customer_mail' value=" . $mail . "><br><br>";
  
          
           echo "※ご住居地域によって配送料が異なります。<br>";
            echo "ご住居地域" . "<select name='delivery_area'>";
            echo "<option value='北海道'>北海道</option>" . 
                 "<option value='東北地方'>東北地方</option>" . 
                 "<option value='関東地方'>関東地方</option>" . 
                 "<option value='中部地方'>中部地方</option>" . 
                 "<option value='近畿地方'>近畿地方</option>" . 
                 "<option value='中国地方'>中国地方</option>" . 
                 "<option value='四国地方'>四国地方</option>" . 
                 "<option value='九州地方'>九州地方</option></select>"; 
            echo "<br><br>";
            echo "郵便番号: <br><input type='text' name='customer_postalcode' value='" . $postalcode . "'><br><br>";
            echo "住所: <br><input type='text' name='customer_address' value='" . $address . "'><br><br>";
          
  
            echo "<br>";
            echo "<font color=#FF00FF>" . "配送指定 : " . "</font>" . "<select name='delivery_method'>";
            echo "<option value='宅配便'>宅配便</option>" . 
                 "<option value='メール便(ポスト投函)'>メール便(ポスト投函)</option></select>";
            echo "<br><br>";
            echo "<font color=#FF00FF>" . "配送希望日 : " . "</font>" . "<select name='delivery_day'>";
            echo "<option value='指定なし'>指定なし</option>" . 
                 "<option value='２日後'>２日後</option>" . 
                 "<option value='３日後'>３日後</option>" . 
                 "<option value='４日後'>４日後</option>" . 
                 "<option value='５日後'>５日後</option></select>"; 
            echo "<br><br>";
            echo "※上記のご記入にお間違えがないか再度ご確認ください。<br>";
            echo "<input type='submit' value='ご注文内容の最終確認へ進む'>";
            echo "</form><br><br>";
            echo "<form action='mycago.php' method='post'>";
            echo "<input type='submit' value='商品を選択し直す'>";
            echo "</form><br><br>";
            echo "<hr width = 10000, color = '#336699'>";
            echo "<a href='index.php'>トップページに戻る</a><br>";
            echo "<a href='select.php'>ファッション商品一覧を見る</a><br>";
            echo "<a href='select2.php'>ファッション小物商品一覧を見る</a><br>";
            echo "<a href='select3.php'>電化製品一覧を見る</a><br>";
           
       
?>
</body>
</html>