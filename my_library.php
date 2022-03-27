<?php
function connect_mysql(){
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=webshop", "root", "", array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'"
        ));
    }catch(PDOException $e){
        die($e->getMessage());
    }
    return $pdo;
}

?>