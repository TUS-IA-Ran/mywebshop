<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="UTF-8">
    <title>Webshop.com</title>
</head>
<body>

<?php
   require_once "my_library.php";
   session_name('logintest');
   session_start();
    if(isset($_SESSION["logintest_user"])){ 
       echo "<h1>";
       echo "<div align = 'center'><a href='login/mypage.php'>" .  $_SESSION['logintest_user'] . "</a>様の買い物かご</h1>";
       echo "<hr width = 10000, color = '#336699'>";
    echo "<center>";
    echo  $_SESSION["logintest_user"] . " 様の買い物かごには以下の商品が入っています<br>";
    echo "<hr width = 10000, color = '#336799'>";
    session_write_close();
    
    require_once "my_library.php";
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

    echo "現在選択中の商品: <br><br>";
    if(count($_SESSION["item"]) > 0){
        $pdo = connect_mysql();
        if(isset($pdo)){
            $total = 0;
            $totalpoint=0;
            echo "<ul>";
            for($i = 0; $i < count($_SESSION["item"]); $i++){
                $sql = "SELECT id,name,price FROM mygoods WHERE id=" . $_SESSION["item"][$i];
                $result = $pdo->query($sql);

                
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    echo "<li><br>";
                    echo "<img src='img/" . $row["id"] . ".png' width='150' height='130'>";
                    echo "商品名: " . $row["name"] . "　　　　代金: " . $row["price"] . "円<br>";
                    $total += $row["price"];
                    $point = $row["price"] * 0.01;
                    echo "   獲得予定ポイント：  " . $point . "ポイント<br><br>";
                    $totalpoint += ($row["price"] * 0.01);
                 }
           }
            echo "<form action='mycago.php' method='get'>
                  <input type='hidden' name='clear_cart'>
                  <input type='submit' value='カートを空にする'>
                  </form>";

             $tax_included= ($total * 1.08);
            echo "</ul>";
            echo "<hr>";
            echo "小計(税込み) :  " . $tax_included . "円<br>";
           if  ($tax_included >= 12000){
              echo "<font color=#FF00FF>" . "この度は本サイトで12000円以上お買い上げいただき、誠にありがとうございます。<br>";
              echo "感謝の心を込めて、この度「マスク20枚入り箱」をお一つ無料でプレゼントさせていただきます！<br>" . "</font>";
              echo "<img src='img/プレゼントマスク.png' width='150' height='130'><br><br>";
            }else{
              $remaining=(12000-$tax_included);
             echo "<font color=#FF00FF>" . "あと " . $remaining . " 円のご購入でマスク20枚入り箱プレゼントとなります。<br>ぜひこの機会にお買い求めください。<br><br>" . "</font>";
            }
           echo "獲得予定合計ポイント数 : " . $totalpoint . "ポイント<br>";
           if ($totalpoint > 2000){
             echo "ポイント割引額 : " . $totalpoint . "円<br>";
             $tax_included += $totalpoint;
              echo  "合計 : " . $tax_included . "円<br><br>";
            }else{
               echo "※今回は2000ポイントに達していないため、ポイント割引がされません。<br>";
               echo "ポイント割引額 : 0円<br>";
               echo "合計(税込み) : " . $tax_included . "円<br><br>"; 
          }
            
            
            
            echo "※ご購入商品にお間違えがないか今一度ご確認ください。<br>";
            echo "<form action='method.php' method='post'>";
            echo "<input type='submit' value='ご購入手続きへ進む'<br>";
            echo "</form>";
            echo "<hr width = 10000, color = '#324649'>";
             session_write_close();
      session_name("logintest");
    session_start();
    $_SESSION["logintest_point"] = $totalpoint;
         }else{
            echo "MySQL接続エラー";
        }

    }else{
        echo "現在、" .  $_SESSION["logintest_user"] . " 様の買い物かごには商品が入っていません。<br>";
        echo "ぜひお買い物をお楽しみください。ご利用をお待ちしております。";
    }
        echo "<div align='left'>";
     echo "～他のジャンルの商品も閲覧したい方はこちらから～<br>";
    echo "<a href='select.php'>ファッション商品の一覧を見る</a><br>";
     
     echo "<a href='select3.php'>家電製品の一覧を見る</a><br>";
     echo "<a href='select4.php'>インテリアの一覧を見る</a><br>";
     echo "<a href='select5.php'>キッズ用品の一覧を見る</a><br>";
     echo "<a href='select6.php'>食品・スイーツの一覧を見る</a><br>";
     echo "<a href='select7.php'>コスメ・健康・医薬品の一覧を見る</a><br>";
     echo "<a href='select8.php'>日用雑貨・キッチン用品の一覧を見る</a><br>";
     echo "<a href='select9.php'>クリスマス特集の一覧を見る</a><br>";
     echo "<a href='select10.php'>お正月特集の一覧を見る</a><br><br>";
       echo "～過去にご購入いただいた商品をもう一度購入したい場合は下記のリンクから直接 " .  $_SESSION["logintest_user"] . " 様の購入履歴ページへととぶことが可能です。～<br>";
         echo "<a href='login/order_log.php'>購入履歴を見る</a><br><br>"; 
        echo "</div>";   
    }
   else{
       echo "<br><br><br>";
      echo "<div align ='center'>";
      echo "<h1>本サイトでお買い物をするには必ず会員登録してください。</h1>";
      echo "※現状況ですと、商品を買い物かごに入れることができません。<br><br><br>";
      echo "すでに会員登録がお済のお客様はこちらから : ";
      echo "<form action='login/login_form.html' method='post'>";
      echo "<input type='submit' value='ログインする'<br>";
      echo "</form><br><br>";
     echo "本サイトを初めてご利用のお客様はこちらから : ";
      echo "<form action='login/entry_form.html' method='post'>";
      echo "<input type='submit' value='新規会員登録する'<br>";
      echo "</form>";
    
      echo "</div>";
    }
    echo "<br><br>";

     
?>
</body>
</html>