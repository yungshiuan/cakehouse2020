<?php require_once('../functions/login_check.php'); ?>   <!--要登入才可以進入頁面(擋沒有帳密的使用者)-->
<?php require_once('../../connection/connection.php'); ?>
<?php
$limit = 5;                   //一頁要呈現幾筆資料
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
$start_form = ($page-1) * $limit; //從第0筆資料開始 
$query = $db->query("SELECT * FROM products WHERE product_categoryID = ".$_GET['categoryID']." ORDER BY picture DESC LIMIT ".$start_form.",".$limit);  
$all_products = $query->fetchAll(PDO::FETCH_ASSOC);

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
              <h1>產品分類管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item"> <a href="../product_categories/list.php">產品分類管理</a> </li>
                <li class="breadcrumb-item active">產品管理</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="create.php?categoryID=<?php echo $_GET['categoryID'];?>">新增一筆</a></div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th scope="col" >產品名稱</th>
                      <th scope="col" >產品圖片</th>
                      <th scope="col" >產品內容</th> 
                      <th scope="col" >價錢</th>
                      <th scope="col" width="20%">操作</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($all_products as $products){ ?>
                    <tr>

                   
                      <th scope="row" width="15%"><?php echo $products['name_date']; ?></th>
                      <td scope="row" width="18%"><img src="../../uploads/products/<?php echo $products['picture']; ?>" alt="" width="150"></td>
                      <td scope="row" ><?php echo $products['description']; ?></td>
                      <td scope="row"><?php echo $products['price']; ?></td>
                      <td>
                        <a class="btn btn-secondary" href="edit.php?categoryID=<?php echo $_GET['categoryID'];?>&gproductID=<?php echo $products['productID'];?>"><i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;編輯</a>
                        <a class="btn btn-secondary ml-2" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};" href="delete.php?categoryID=<?php echo $_GET['categoryID'];?>&gproductID=<?php echo $products['productID']; ?>"><i class="fa fa-fw fa-trash-o"></i>&nbsp;刪除</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php
               $query2 = $db->query("SELECT * FROM products");
               $date =  $query2->fetchAll(PDO::FETCH_ASSOC);
               $total_pages = ceil(count($date)/$limit); /*總項目除以 單頁顯示項目(3)*/ 
              ?>
                  <ul class="pagination my-3 justify-content-center">
                    <li class="page-item"> <a class="page-link" href="list.php?categoryID=<?php echo $_GET['categoryID'];?>&page=<?php echo $page-1; ?>"> <span>«</span></a> </li>
                    <?php for($i = 1;$i <= $total_pages; $i++){ ?> <!--頁數迴圈-->
                    <!--判斷是否在此頁-->
                    <?php if ($page ==$i) {?>
                       <li class="page-item active">  <!--在此頁有顏色-->
                    <?php }else{?>
                      <li class="page-item">          <!--不在此頁無顏色-->
                    <?php }?>
                    <a class="page-link" href="list.php?categoryID=<?php echo $_GET['categoryID'];?>&page=<?php echo $i; ?>"><?php echo $i ;?></a> </li>
                    <?php } ?>
                   
                    <li class="page-item"> <a class="page-link" href="list.php?categoryID=<?php echo $_GET['categoryID'];?>&page=<?php echo $page+1;?>"> <span>»</span></a> </li>
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