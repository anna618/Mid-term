<?php
require_once("pdo_connect.php");
//if(!isset($_SESSION["user"])){
//    header("location:login.php");
//}
$id = $_GET["id"];

$sql = "SELECT * FROM db_order WHERE deleted_time IS NULL AND id=? ORDER BY id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Order</title>
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
            <div class="app-main__inner"><!--start your code-->
                <div class="tab-content">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">修改訂單</h5>
                            <form id="edit_form" class="" action="order-edit.php" method="post" enctype="multipart/form-data">
                                <?php foreach ($rows
                                               as $value): ?>
                                    <!-- form 修改訂單資料 -->
                                    <input type="hidden" name="id" value="<?= $value["id"] ?>">
                                    <div class="position-relative row form-group"> <!-- insert 新寵物ID-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">寵物ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pet_id" placeholder="2"
                                                   value="<?= $value["pet_id"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 新時段-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">時段</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pre_time"
                                                   placeholder="2021-09-07 11:37:11" value="<?= $value["pre_time"] ?>"
                                                   required>

                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 新地址-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">地址</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address" placeholder="路邊"
                                                   value="<?= $value["address"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 新價錢-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">價錢</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="price" placeholder="900"
                                                   value="<?= $value["price"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 新購買ID-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label"> 購買ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="buyer_id" placeholder="5"
                                                   value="<?= $value["buyer_id"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert  新賣家ID-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">賣家ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="seller_id" placeholder="6"
                                                   value="<?= $value["seller_id"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert  新狀態-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">狀態</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status"
                                                   value="<?= $value["status"] ?>">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 當初訂單建立時間-->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">建立時間</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="created_time"
                                                   readonly="readonly" placeholder=" 2021-09-07 11:37:57 "
                                                   value="<?= $value["created_time"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-check">
                                        <div class="col-sm-10 offset-sm-2" style="padding: 0px;">
                                            <button type="button" id="update" class="btn btn-primary">送出</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end your code-->
        </div>
    </div>
</div>
<?php require_once("./assets/scripts/sweetAlert2.php") ?>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script>
    $('#update').on('click', function () {
        Swal.fire({
            showDenyButton: true,
            showConfirmButton: true,
            showCancelButton: false,
            title: '是否要儲存更改？',
            icon: 'question',
            confirmButtonText: 'Yes',
            denyButtonText: 'No'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({
                    showConfirmButton: false,
                    title: '儲存成功!',
                    icon: 'success'
                })
                setTimeout(function () {
                    $("#edit_form").submit();
                }, 1000);
            } else if (result.isDenied) {
                Swal.fire({
                    showConfirmButton: true,
                    title: '儲存取消!',
                    icon: 'warning'
                })
            }
        })
    })
</script>
</body>

</html>