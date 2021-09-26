<?php
require_once("pdo_connect.php");
//全部會員資料
$sql = "SELECT * FROM db_order WHERE deleted_time IS NULL ORDER BY id";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert Evaluation</title>
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
                            <h5 class="card-title">新增評價</h5>
                            <form id="insert_form" action="evaluation-doInsert.php" method="post" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="">訂單編號</label>
                                    <select name="order_id" id="exampleSelect" class="form-control">
                                        <?php foreach ($rows as $author) : ?>
                                            <option value="<?= $author["id"] ?>"><?= $author["id"] ?></option>
                                        <?php endforeach; ?>
                                    </select>                                </div>
                                <div class="mb-2">
                                    <label for="">留言</label>
                                    <input type="text" class="form-control" name="content" required >
                                </div>
                                <div class="mb-2">
                                    <label for="">圖片</label>
                                    <input type="file" name="file" class="form-control"  >
                                </div>
                                <div class="mb-2">
                                    <label for="">星數</label>
                                    <select class="form-select" name="star">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <!--                        <input type="select" class="form-control" name="star" >-->
                                </div>
                                <button id="create"  type="button" class="btn btn-primary submit-sweetAlert2" type="submit">送出</button>
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