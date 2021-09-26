<?php
require_once("pdo_connect.php");
//if(!isset($_SESSION["user"])){
//    header("location:login.php");
//}
$id = $_GET["id"];

$sql = "SELECT * FROM db_evaluation WHERE  id=? ORDER BY id DESC";
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
    <title>Edit Evaluation</title>
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
            <div class="app-main__inner">
                <div class="tab-content">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">修改評價</h5>
                            <form id="edit_form" action="evaluation-edit.php" method="post" enctype="multipart/form-data">
                                <?php foreach ($rows

                                               as $value): ?>
                                    <input type="hidden" name="id" value="<?= $value["id"] ?>">

                                    <div class="mb-2">
                                        <label for="">訂單編號</label>
                                        <input type="text" class="form-control" name="order_id" value="<?= $value["order_id"] ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">評價內容</label>
                                        <input type="text" class="form-control" name="content" value="<?= $value["content"] ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">圖片</label>
                                        <input type="file" class="form-control" name="file" value="<?= $value["images"] ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">整體評分</label>
                                        <!--                    <select class="form-select" name="star" value="--><?//= $value["star"] ?><!--">-->
                                        <!--                        <option value="1">1</option>-->
                                        <!--                        <option value="2">1</option>-->
                                        <!--                        <option value="3">3</option>-->
                                        <!--                        <option value="4">4</option>-->
                                        <!--                        <option value="5">5</option>-->
                                        <!--                    </select>-->
                                        <input type="text" class="form-control" name="star" value="<?= $value["star"] ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label for="">建立時間</label>

                                        <input type="text" class="form-control" name="created_time" value=" <?= $value["created_time"] ?> "
                                               readonly="readonly">
                                    </div>

                                <?php endforeach; ?>
                                <button class=" btn btn-primary" type="button" id="update"> 送出 </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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