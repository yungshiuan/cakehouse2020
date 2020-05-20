<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../../connection/connection.php'); ?>
<?php
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT"){
  //判斷是否有資料夾
  if (!file_exists('../../uploads/products')) {
    mkdir('../../uploads/products', 0755, true);
  }
  //print_r($_FILES['picture']);
  //圖片上傳程式碼
  if(isset($_FILES['picture']['name'])){
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/products/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = null;
  }
  //end 圖片上傳程式碼
  $sql= "UPDATE products SET picture=:picture,name_date=:name_date,description=:description ,	price=:price,updated_at=:updated_at WHERE productID=:productID";

  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":name_date", $_POST['name_date'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":productID", $_POST['productID'], PDO::PARAM_INT);
  $sth ->execute();

  header('Location: list.php?categoryID='.$_POST['product_categoryID']);
}else{
  $query = $db->query("SELECT * FROM products WHERE productID=".$_GET['gproductID']);
  $products = $query->fetch(PDO::FETCH_ASSOC);
}
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
                <li class="breadcrumb-item"><a href="list.php?categoryID=<?php echo $_GET['categoryID']; ?>">產品分類管理</a></li>
                <li class="breadcrumb-item active">新增一筆</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="list.php?categoryID=<?php echo $_GET['categoryID']; ?>">回上一頁</a></div>
              </div>
              <form id="EditForm" class="text-right" method="post" action="edit.php" enctype="multipart/form-data">
              <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">產品名稱</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="name_date" name="name_date" value="<?php echo $products['name_date']; ?>"> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label" contenteditable="true">產品圖片</label>
                  <div class="col-10">
                    <img id="pic" src="" alt="" width="200" style="margin-botton:20px;">

                    <img src="../../uploads/products/<?php echo $products['picture']; ?>" alt="">
                    <input type="file" class="form-control-file" id="picture" name="picture" value="<?php echo $products['picture']; ?>"> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label" contenteditable="true">內容</label>
                  <div class="col-10">
                  <textarea rows="5" class="form-control" name="description"><?php echo $products['description']; ?></textarea> </div>
                </div>
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label">價錢</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $products['price']; ?>"> </div>
                    <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="EditForm" value="EDIT">
                    <input type="hidden" name="productID" value="<?php echo $_GET['gproductID']; ?>">
                    <input type="hidden" name="product_categoryID" value="<?php echo $_GET['categoryID']; ?>">
                </div>
                <button type="submit" class="btn mr-3 btn-primary">取消並回上一頁</button><button type="submit" class="btn btn-secondary">確定送出</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('../layouts/footer.php'); ?>
  <script>
  
  $(function(){
    $( "#published_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  //套用ckeditor編輯器
  CKEDITOR.replace( 'description' );
  </script>
</body>

</html>