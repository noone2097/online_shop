<?php

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "online_shop";

    try{ 
        $connection = new PDO("mysql: host=$serverName;dbname=$dbName", $userName, $passWord);
        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        echo "Database Connected"; 
    }catch (PDOException $e) {
        echo " Connection Failed ".$e->getMessage();
    }

?>
