<?php 
session_start();
require_once('../connection/connection.php'); 
$_SESSION['Receiver']['name_date'] = $_POST['name_date'];
$_SESSION['Receiver']['phone'] = $_POST['phone'];
$_SESSION['Receiver']['address'] = $_POST['zipcode'].$_POST['county'].$_POST['district'].$_POST['address'];
$_SESSION['Receiver']['email'] = $_POST['email'];
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
                        <li>結帳 - Delivery method</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout3.php">
                            <h1>結帳 - Delivery method</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>填寫收件者資料</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-truck"></i><br>選擇取貨方式</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>選擇付款方式</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>訂單確認</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>宅配</h4>

                                            <p>本店使用黑貓宅配送，蛋糕類採用冷藏配送</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="100" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>超商取貨付款</h4>

                                            <p>選擇超商與指定門市收貨</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="150">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>貨到付款</h4>

                                            <p>貨到付款需要備註說明送達時段</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="200">
                                                <input type="hidden" name="delivery_name" value="宅配" id="delivery_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout1.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>上一步</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">繼續<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>訂單總計</h3>
                        </div>
                        <p class="text-muted">購物滿2000免運費，只限台灣本島，離島需加上稅金與運費</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>商品總計</td>
                                        <th>$NT <?php echo $_SESSION['TotalPrice']; ?></th>
                                    </tr>
                                    <tr>
                                        <td>運費</td>
                                        <?php if ($_SESSION['TotalPrice'] > 2000){ ?>
                                            <th>$NT 0 </th> 
                                        <?php }else{ ?>
                                            <th class="shipping">$NT 0</th> 
                                        <?php } ?>
                                    </tr>
                                   
                                    <tr class="total">
                                        <td>總金額</td>
                                        <th id="totalprice">$NT 100</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>           
                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

       <?php require_once('template/footer.php'); ?>
        <script>
        $(function(){
            var shipping1 = $('input[name="delivery"]:checked').val()
            $('.shipping').html("$NT " + shipping1);
            var price = <?php echo $_SESSION['TotalPrice']; ?>;
            var sum = parseInt(price) + parseInt(shipping1);
            $('#totalprice').html("$NT " + sum);

            $('input[name="delivery"]').change(function(){
                var totalprice = <?php echo $_SESSION['TotalPrice']; ?>;
                var shipping = $(this).val();
                $('.shipping').html("$NT " + shipping);
                var total = parseInt(totalprice) + parseInt(shipping);
                $('#totalprice').html("$NT " + total);
                if (shipping == 100)
                    $('delivery_name').val("宅配");
                else if (shipping == 150)
                    $('delivery_name').val("超商取貨");
                else
                    $('delivery_name').val("貨到付款");

                //console.log("運費="+shipping);
            });
        });
        </script>





</body>

</html>