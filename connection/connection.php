<?php
define('DB_SERVER', "localhost");//連結資料庫伺服器
define('DB_USER', "cake_house");//資料庫使用者
define('DB_PASSWORD', "admin");//資料庫使用者密碼
define('DB_DATABASE', "cake_house");//資料庫名稱
define('DB_DRIVER', "mysql");//連線方式

//$connection = new PDO('mysql:host=localhost;dbname=cake_house;charset=utf8', 'cake_house', 'admin');


$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

date_default_timezone_set("Asia/Taipei");//伺服器連線時區為台北


 ?>
