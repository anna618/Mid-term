<?php
require_once("pdo_connect.php");
$sql = "SELECT * FROM db_user WHERE deleted_time IS NULL AND status=2 ORDER BY id";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlx = "SELECT * FROM db_user WHERE deleted_time IS NULL  ORDER BY id";
$stmtx = $db_host->prepare($sqlx);
$stmtx->execute();
$rowsx = $stmtx->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <meta name="msapplication-tap-highlight" content="no">
    <?php require_once("./assets/css/css.php") ?>
    <link href="./assets/css/main.css" rel="stylesheet">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php require_once("./main-header.php") ?>
    <div class="app-main">
        <?php require_once("./main-menu.php") ?>
        <div class="app-main__outer">
            <div class="app-main__inner"><!-- main start -->
                <div class="tab-content">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">新增訂單</h5>
                            <form id="insert_form" class="" action="order-doInsert.php" method="post" enctype="multipart/form-data"> <!-- form 新增訂單資料 -->

                                <div class="position-relative row form-group"> <!-- insert 時段-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">時段</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" name="pre_time" placeholder="下訂時段" required>
                                    </div>
                                        <div class="col-sm-5">
                                        <select  class="form-control" name="pre_time_1" placeholder="下訂時段" required>
                                            <option value="08:00-12:00">08:00-12:00</option>
                                            <option value="12:00-16:00">12:00-16:00</option>
                                            <option value="16:00-20:00">16:00-20:00</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 地址-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address" placeholder="見面地址" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 價錢-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">價錢</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="price" placeholder="價錢" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 購買ID-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label"> 購買ID</label>
                                    <div class="col-sm-10">
                                        <select type="text" class="form-control" name="buyer_id" placeholder="買家ID" required>
                                            <?php foreach ($rowsx as $authorx) : ?>
                                                <option value="<?= $authorx["id"] ?>"><?= $authorx["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 寵物ID-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">寵物ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pet_id" placeholder="寵物ID" required>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert  賣家ID-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">賣家ID</label>
                                    <div class="col-sm-10">
                                        <select  class="form-control" name="seller_id" placeholder="賣家ID" required>
                                            <?php foreach ($rows as $author) : ?>
                                                <option value="<?= $author["id"] ?>"><?= $author["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert  狀態-->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">狀態</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="exampleSelect" class="form-control">

                                            <option value="1">交易進行中</option>
                                            <option value="2">完成交易</option>
                                            <option value="3">取消交易</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-check">
                                    <div class="col-sm-10 offset-sm-2" style="padding: 0px;">
                                        <button id="create" type="button" class="btn btn-primary" >送出</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- main end -->
            <div class="app-wrapper-footer"> <!-- footer start -->
                <div class="app-footer">
                    <div class="app-footer__inner"></div>
                </div>
            </div> <!-- footer end -->
        </div>
    </div>
</div>
<?php require_once("./assets/scripts/sweetAlert2.php") ?>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script>
    $('#create').on('click', function () {
        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '新增成功',
            showConfirmButton: false,
            timer: 1500
        })
        setTimeout(function () {
            $("#insert_form").submit();
        }, 1000);
    })
</script>
</body>

</html>