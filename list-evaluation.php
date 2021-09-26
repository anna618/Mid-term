<?php
require_once("pdo_connect.php");
//if(!isset($_SESSION["user"])){
//    header("location:login.php");
//}
//$sql = "SELECT * FROM db_evaluation  WHERE deleted_time is NULL ORDER BY id DESC";
$sql = "SELECT db_evaluation.*,db_order.buyer_id AS buy_id FROM db_evaluation
JOIN db_order ON db_evaluation.order_id =db_order.id
WHERE db_evaluation.deleted_time is NULL
ORDER BY db_order.id DESC
";//買家
;

//$sql = "SELECT (id, name, content, price) FROM product WHERE valid=1 ORDER BY id DESC ";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dateCount = $stmt->rowCount();

$sqls = "SELECT db_evaluation.*,db_order.seller_id AS sell_id FROM db_evaluation
JOIN db_order ON db_evaluation.order_id =db_order.id
WHERE db_evaluation.deleted_time is NULL
ORDER BY db_order.id DESC";//
$stmtl = $db_host->prepare($sqls);
$stmtl->execute();
$rowsl = $stmtl->fetchAll(PDO::FETCH_ASSOC);
//$dateCountl = $stmtl->rowCount();
$situationArr = [];
foreach ($rowsl as $rowy) {
    $situationArr[$rowy["id"]] = $rowy["sell_id"];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Evaluation list</title>
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
                                    <th>評價內容</th>
                                    <th>買家</th>
                                    <th>賣家</th>
                                    <th>圖片</th>
                                    <th>整體評分</th>
                                    <th>建立時間</th>
                                    <th>功能</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rows as $value): ?>

                                    <tr>
                                        <td><?= $value["order_id"] ?></td>
                                        <td><?= $value["content"] ?></td>
                                        <td><?= $value["buy_id"] ?></td>
                                        <td><?= $situationArr[$value["id"]] ?></td>
                                        <td>
                                            <div class="ratio ratio-1x1 product-picture">
                                                <div class="ratio ratio-2x2 product-picture">
                                                    <div>
                                                        <img class="cover-fit"
                                                             src="evaluation-images/<?= $value["images"] ?>"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $value["star"] ?></td>
                                        <td><?= $value["created_time"] ?></td>
                                        <td>
                                            <a class="btn btn-primary"
                                               href="evaluation-update.php?id=<?= $value['id'] ?>"> 修改</a>
                                            <button class="btn btn-danger delete" type="button"
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
                                window.location.href = `evaluation-delete.php?id=${deleteNumber}`;
                            }, 1000);
                        }

                    }
                }
            }
        )


        })
</script>
</body>

</html>