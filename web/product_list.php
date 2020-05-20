<?php require_once('../connection/connection.php'); 
session_start();
$limit = 12;
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page =1;
}

$start_from = ($page-1) * $limit;

$query = $db->query("SELECT * FROM products WHERE product_categoryID = ".$_GET['categoryID']." ORDER BY created_at DESC");  
//查詢結果=資料庫去查詢(選擇products資料表裡的所有欄位，尋找(where)product_categoryID=categoryID，用created_at進行遞減排序
$all_products = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>



</head>

<body>
<?php require_once('template/navbar.php'); ?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">首頁</a>
                        </li>
                        <li><a href="#">Ladies</a>
                        </li>
                        <li><a href="#">Tops</a>
                        </li>
                        <li>White Blouse Armani</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">產品分類</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                            <?php foreach($product_categories as $category){ ?>
                                <li>
                                    <a href="product_list.php?categoryID=<?php echo $category['product_categoryID'];?>"><?php echo $category['category']; ?><span class="badge pull-right">10</span></a>
                                    
                                </li>
                            <?php  } ?>   

                            </ul>

                        </div>
                    </div>

                    
                    

                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../img/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-sm-12">        
                        <!-- 產品圖 -->
                        <?php foreach($all_products as $products){ ?>
                        <div class="col-sm-3">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="product.php?productID=<?php echo $products['productID'];?>">
                                                <img src="../uploads/products/<?php echo $products['picture']; ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="product.php?productID=<?php echo $products['productID'];?>">
                                                <img src="../uploads/products/<?php echo $products['picture']; ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="product.php?productID=<?php echo $products['productID'];?>" class="invisible">
                                    <img src="../uploads/products/<?php echo $products['picture']; ?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="product.php?productID=<?php echo $products['productID'];?>"><?php echo $products['name_date']; ?></a></h3>
                                    <p class="price"><?php echo "$".$products['price']; ?></p>
                                </div>
                                
                                <!-- /.text -->
                               
                                    <!--<div class="ribbon new">
                                        <div class="theribbon">NEW</div>
                                        <div class="ribbon-background"></div>
                                    </div>-->
                               
                                <!-- /.ribbon -->
                                   <!-- <div class="ribbon sale">
                                        <div class="theribbon">SALE</div>
                                        <div class="ribbon-background"></div>
                                    </div>   -->
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php  } ?> 
                       <!-- 產品圖 END-->

                        
                       
                        </div>
                    </div>
                <!--頁數 -->
                    <?php
                        $query2 = $db->query("SELECT * FROM products");
                        $data = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $total_pages = ceil(count($data)/ $limit);
                    ?>
                    <ul class="pagination">
                        <li class="page-item">
                       
                        <!-- 頁數超過1，上一頁可連結 -->
                        <?php if($page == 1){ ?>
                            <a class="page-link" href="#" disabled>
                        <?php }else{ ?>
                        <a class="page-link" href="product_list.php?page=<?php echo $page-1; ?>">
                        <?php } ?>
                            <span>«</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++){?>
                        <!-- 判斷目前是否在此頁 -->
                        <?php if($page == $i){ ?>
                        <li class="page-item active">
                        <?php }else{ ?>
                        <li class="page-item">
                        <?php } ?>
                        <a class="page-link" href="product_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> 
                        </li>
                        <?php } ?>
                        <li class="page-item">
                        <?php if($page == $total_pages){ ?>
                            <a class="page-link" href="" disabled>
                        <?php }else{ ?>
                            <a class="page-link" href="product_list.php?page=<?php echo $page+1; ?>">
                        <?php } ?>   
                            <span>»</span>
                            <span class="sr-only">Next</span>
                        </a>
                       
                        </li>
                    </ul>
                <!--頁數END -->
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>





</body>

</html>