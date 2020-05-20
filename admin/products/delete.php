<?php
require_once('../functions/login_check.php');
require('../../connection/connection.php');
$sql = "DELETE FROM products WHERE productID=".$_GET['gproductID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php?categoryID='.$_GET['categoryID']);
?>