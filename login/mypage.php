<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Webshop.com 会員ページ</title>
</head>
<body>
<?php
    session_name('logintest');
    session_start();

    echo "<h1>Webshop.com 会員ページ</h1>";
    if(empty($_SESSION["logintest_id"])){
        echo "<hr>ログインされていません。<br>";
        echo "<a href='login_form.html'>ログイン</a>";
    }else{
        echo "買い物をする<br>";
        echo "<a href='../select.php'>ファッション(トップス・ボトムス・アウター)の一覧を見る</a><br>"; 
        echo "<a href='../select2.php'>ファッション小物の一覧を見る</a><br>";
        echo "<a href='../select3.php'>家電製品の一覧を見る</a><br>";
        echo "<a href='../select4.php'>インテリアの一覧を見る</a><br>";
        echo "<a href='../select5.php'>キッズ用品の一覧を見る</a><br>";
        echo "<a href='../select6.php'>食品・スイーツの一覧を見る</a><br>";
        echo "<a href='../select7.php'>コスメ・健康・医薬品の一覧を見る</a><br>";
        echo "<a href='../select8.php'>日用雑貨・キッチン用品の一覧を見る</a><br>";
        echo "<a href='../select9.php'>クリスマス特集の一覧を見る</a><br>";
        echo "<a href='../select10.php'>お正月特集の一覧を見る</a><br><br>";
       
        echo "<a href='update_form.html'>会員情報変更</a><br>";
        echo "<a href='order_log.php'>購入履歴</a><br>";
        echo "<a href='withdrawal_form.html'>退会</a><br>";
        echo "<a href='logout.php'>ログアウト</a><br>";
    }
?>
</body>
</html>