<?php 
session_start();
require_once('../connection/connection.php'); 
$query = $db->query("SELECT * FROM members WHERE email= '".$_POST['email']."' AND password='".$_POST['password']."'");  //對應資料庫項目的密碼帳號
$has_user = $query->fetch(PDO::FETCH_ASSOC);
print_r($has_user);
if($has_user > 0){                                  //如果使用者編號小於零
    $_SESSION['member'] = $has_user;       //確認有無這位使用者名稱
    header('Location: customer-account.php');           //有,連到
}else{
    header('Location: ../login_error.php?Msg=Error');   //沒有,跳出錯誤訊息 
}
?>