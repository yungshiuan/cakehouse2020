<?php require_once('../functions/login_check.php'); ?>
<?php require_once('../../connection/connection.php'); ?>
<?php
if(isset($_POST['EditForm']) && $_POST['EditForm'] == "EDIT"){
  //判斷是否有資料夾
  if (!file_exists('../../uploads/news_category')) {
    mkdir('../../uploads/news_category', 0755, true);
  }
  //print_r($_FILES['picture']);
  //圖片上傳程式碼
  if(isset($_FILES['picture']['name'])){
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/news_category/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = null;
  }
  //end 圖片上傳程式碼
  $sql= "UPDATE news_categories SET  category=:category, updated_at=:updated_at WHERE news_categoryID=:news_categoryID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":news_categoryID", $_POST['news_categoryID'], PDO::PARAM_INT);
  $sth ->execute();

  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM news_categories WHERE news_categoryID=".$_GET['gnews_categoryID']);
  $news_category = $query->fetch(PDO::FETCH_ASSOC);
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
              <h1>最新消息分類管理</h1>
            </div>
            <div class="card-body">
              <ul class="breadcrumb mb-2">
                <li class="breadcrumb-item"> <a href="#">首頁</a> </li>
                <li class="breadcrumb-item"><a href="#">最新消息分類管理</a></li>
                <li class="breadcrumb-item active">新增一筆</li>
              </ul>
              <div class="row">
                <div class="col-md-12 my-3"><a class="btn btn-primary" href="list.php">回上一頁</a></div>
              </div>
              <form id="EditForm" class="text-right" method="post" action="edit.php" enctype="multipart/form-data">
                
                <div class="form-group row"> <label for="inputpasswordh" class="col-2 col-form-label" contenteditable="true">標題</label>
                  <div class="col-10">
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $news_category['category']; ?>"> </div>
                </div>
                
                 
                
             
                   
                    <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <input type="hidden" name="EditForm" value="EDIT">
                    <input type="hidden" name="news_categoryID" value="<?php echo $_GET['gnews_categoryID']; ?>">
                
                <button type="submit" class="btn mr-3 btn-primary">取消並回上一頁</button><button type="submit" class="btn btn-secondary">確定送出</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('../layouts/footer.php'); ?>
  
</body>

</html>