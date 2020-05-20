<?php
require_once('../functions/login_check.php');
require('../../connection/connection.php');
$sql = "DELETE FROM members WHERE memberID=".$_GET['gmemberID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
?>