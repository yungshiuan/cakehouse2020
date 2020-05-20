<?php 
session_start();
require_once('../../connection/connection.php'); 
$query = $db->query("SELECT * FROM account WHERE account= '".$_POST['account']."' AND password='".$_POST['password']."'");  //對應資料庫項目的密碼帳號
$has_user = $query->fetch(PDO::FETCH_ASSOC);
print_r($has_user);
if($has_user > 0){                                  //如果使用者編號小於零
    $_SESSION['user'] = $has_user['account'];       //確認有無這位使用者名稱
    header('Location: ../news_categories/list.php');           //有,連到最新消息頁面
}else{
    header('Location: ../login.php?Msg=Error');   //沒有,跳出錯誤訊息
}
?>