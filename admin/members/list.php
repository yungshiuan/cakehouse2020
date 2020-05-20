<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../../connection/connection.php'); ?>
<?php
$limit = 5;                   //一頁要呈現幾筆資料
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
$start_form = ($page-1) * $limit; //從第0筆資料開始 
$query = $db->query("SELECT * FROM members   LIMIT ".$start_form.",".$limit);  
$all_members = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<?php require_once('../layouts/head.php'); ?>
<body style="">
<?php require_once('../layouts/navbar.php'); ?>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h1>會員管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item active"><a >會員管理</a></li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="create.php">新增一筆</a></div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">姓名</th>
                      <th scope="col">電話</th>
                      <th scope="col">信箱</th>
                      <th scope="col">地址</th>
                      <th scope="col">生日</th>
                      <th scope="col" width="20%">操作</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($all_members as $members){ ?>
                    <tr>
                      <th scope="row"><?php echo $members['name_date']; ?></th>
                      <td><?php echo $members['phone']; ?></td>
                      <td><?php echo $members['email']; ?></td>
                      <td><?php echo $members['address']; ?></td>
                      <td><?php echo $members['birthday']; ?></td>
                      <td>
                        <a class="btn btn-secondary" href="edit.php?gmemberID=<?php echo $members['memberID'];?>"><i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;編輯</a>
                        <a class="btn btn-secondary ml-2" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};" href="delete.php?gmemberID=<?php echo  $members['memberID']; ?>"><i class="fa fa-fw fa-trash-o"></i>&nbsp;刪除</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php
               $query2 = $db->query("SELECT * FROM members");
               $date =  $query2->fetchAll(PDO::FETCH_ASSOC);
               $total_pages = ceil(count($date)/$limit); /*總項目除以 單頁顯示項目(3)*/ 
              ?>
                  <ul class="pagination my-3 justify-content-center">
                    <li class="page-item"> <a class="page-link" href="list.php?page=<?php echo $page-1; ?>"> <span>«</span></a> </li>
                    <?php for($i = 1;$i <= $total_pages; $i++){ ?> <!--頁數迴圈-->
                    <!--判斷是否在此頁-->
                    <?php if ($page ==$i) {?>
                       <li class="page-item active">  <!--在此頁有顏色-->
                    <?php }else{?>
                      <li class="page-item">          <!--不在此頁無顏色-->
                    <?php }?>
                    <a class="page-link" href="list.php?page=<?php echo $i; ?>"><?php echo $i ;?></a> </li>
                    <?php } ?>
                   
                    <li class="page-item"> <a class="page-link" href="list.php?page=<?php echo $page+1; ?>"> <span>»</span></a> </li>
                  </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('../layouts/footer.php'); ?>
</body>

</html>