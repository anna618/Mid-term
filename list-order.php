<?php
require_once("pdo_connect.php");
//if(!isset($_SESSION["user"])){
//    header("location:login.php");
//}
$sql = "SELECT db_order.*,db_order_type.type AS order_type FROM db_order
JOIN db_order_type ON db_order.status =db_order_type.id
WHERE db_order.deleted_time IS NULL
ORDER BY db_order.id DESC";
//$sql = "SELECT (id, name, content, price) FROM product WHERE valid=1 ORDER BY id DESC ";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dateCount = $stmt->rowCount();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Order list</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
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
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">評價清單</h5>
                            <table class="mb-0 table mydatatable">
                                <thead>
                                <tr>

                                    <th>訂單編號</th>
                                    <th>寵物ID</th>
                                    <th>下定時段</th>
                                    <th>地址</th>
                                    <th>價錢</th>
                                    <th>購買ID</th>
                                    <th>賣家ID</th>
                                    <th>狀態</th>
                                    <th>訂單產生時間</th>
                                    <th>功能</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rows as $value): ?>
                                    <tr>
                                        <td><?= $value["id"] ?></td>
                                        <td><?= $value["pet_id"] ?></td>
                                        <td><?= $value["pre_time"] ?></td>
                                        <td><?= $value["address"] ?></td>
                                        <td><?= $value["price"] ?></td>
                                        <td><?= $value["buyer_id"] ?></td>
                                        <td><?= $value["seller_id"] ?></td>
                                        <td><?= $value["order_type"] ?></td>
                                        <td><?= $value["created_time"] ?></td>
                                        <td>
                                            <a type="button" class="btn btn-primary"
                                               href="order-update.php?id=<?= $value['id'] ?>"> 修改</a>
                                            <button type="button" class="btn btn-danger delete"
                                                    data-delete_number="<?= $value["id"] ?>"> 刪除
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- main end -->
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

    $('.mydatatable').DataTable({
        lengthMenu: [[-1, 5, 15, 30, 50], ["All", 5, 15, 30, 50]]
    });

    let rowsValue = <?php echo json_encode($rows); ?>;

    // 是否刪除，刪除成功
    $('.delete').on('click', function () {
        Swal.fire({
            title: '確定要刪除嗎?',
            text: "您將無法還原此內容！",
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: '取消',
            confirmButtonText: '是的，刪除!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '刪除!',
                    text: '您的文件已被刪除。',
                    icon: 'success',
                    showConfirmButton: false
                })

                let deleteNumber = $(this).data("delete_number");   // HTML不區分大小寫，所以data值不設為deleteNumber避免混亂
                console.log(deleteNumber);
                for (let i = 0; i < rowsValue.length; i++) {
                    if (rowsValue[i]["id"] == deleteNumber) {
                        setTimeout(function () {
                            window.location.href = `order-delete.php?id=${deleteNumber}`;
                        }, 1000);
                    }
                }
            }
        })
    })
</script>
</body>

</html>