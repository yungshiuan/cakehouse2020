<?php
require_once('../functions/login_check.php');
require('../../connection/connection.php');
$sql = "DELETE FROM product_categories WHERE product_categoryID =".$_GET['gproduct_categoryID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
?>