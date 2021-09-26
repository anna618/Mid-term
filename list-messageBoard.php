<?php
require_once("pdo_connect.php");
$sql = "SELECT * FROM db_message_board WHERE deleted_time IS NULL ORDER BY id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dataCount = $stmt->rowCount();

$sqlImage = "SELECT message_board_id,image_name FROM db_message_board_images WHERE deleted_time IS NULL ORDER BY id DESC";
$stmtImage = $db_host->prepare($sqlImage);
$stmtImage->execute();
$rowsImage = $stmtImage->fetchAll(PDO::FETCH_ASSOC);

$sqlUser = "SELECT id, name FROM db_user WHERE deleted_time IS NULL ORDER BY id DESC";
$stmtUser = $db_host->prepare($sqlUser);
$stmtUser->execute();
$rowsUser = $stmtUser->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MessageBoard list</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <meta name="msapplication-tap-highlight" content="no">
    <?php require_once("./assets/css/css.php") ?>
    <link href="./assets/css/main.css" rel="stylesheet">
    <style>
        tr th{
            padding: 8px 10px !important;
        }
    </style>
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php require_once("main-header.php") ?>
    <div class="app-main">
        <?php require_once("main-menu.php") ?>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <!-- main start -->
                <div class="tab-content">
                    <h5 class="card-title" style="padding-left: 20px;">共 <?= $dataCount ?> 筆留言</h5>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">留言板明細</h5>

                            <table class="mb-0 table table-striped mydatatable">
                                <!-- table 留言板明細 -->
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>PetSitter</th>
                                    <th>Message content</th>
                                    <th>image</th>
                                    <th>Postingtime</th>
                                    <th>Function</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rows as $value) : ?>
                                    <tr>
                                        <td><?= $value["id"] ?></td>    <!--編號-->

                                        <?php foreach ($rowsUser as $author) : ?>   <!--發文者名稱-->
                                            <?php if ($value["user_id"] == $author["id"]) : ?>
                                                <td> <?= $author["name"] ?> </td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <td><?= $value["title"] ?></td>     <!--標題-->

                                        <?php foreach ($rowsUser as $petSitter) : ?>    <!--保母名稱-->
                                            <?php if ($value["petSitter_id"] == $petSitter["id"]) : ?>
                                                <td> <?= $petSitter["name"] ?> </td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <td><?= $value["content"] ?></td>   <!--內容-->

                                        <td>
                                            <div class="ratio ratio-1x1 product-picture me-2">  <!--圖片-->
                                                <?php foreach ($rowsImage as $image) : ?>
                                                    <?php if ($value["id"] == $image["message_board_id"]) : ?>
                                                        <div>
                                                            <img class="cover-fit"
                                                                 src="messageBoard-images/<?php echo $image["image_name"]; ?>"
                                                                 alt="">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>

                                        <td><?= $value["created_time"] ?></td>  <!--創建時間-->

                                        <td>        <!--功能-->
                                            <a href="messageBoard-update.php?id=<?= $value["id"] ?>"
                                               class="mb-2 mr-2 btn btn-primary">修改</a>
                                            <!--HTML不區分大小寫，所以data值不設為deleteNumber避免混亂-->
                                            <!--因為有很多個刪除按鈕，所以不要設id為delete，而是使用class-->
                                            <button data-delete_number="<?= $value["id"] ?>" type="button"
                                                    class="mb-2 mr-2 btn btn-danger delete">刪除
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
            <div class="app-wrapper-footer">
                <!-- footer start -->
                <div class="app-footer">
                    <div class="app-footer__inner"></div>
                </div>
            </div> <!-- footer end -->
        </div>
    </div>
</div>
<?php require_once("assets/scripts/sweetAlert2.php") ?>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script>
    $('.mydatatable').DataTable({
        lengthMenu:[[-1, 5, 15, 30, 50 ], ["All", 5, 15, 30, 50 ]],
        "order": [[ 0, "desc" ]]
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
                            window.location.href = `messageBoard-delete.php?id=${deleteNumber}`;
                        }, 1000);
                    }
                }
            }
        })
    })
</script>
</body>
</html>