<?php
require_once("pdo_connect.php");

if (!isset($_GET["id"])) {
    echo "請從表單登入";
    exit();
}
$id = $_GET["id"];

$sql = "SELECT * FROM db_message_board WHERE id=? AND deleted_time IS NULL ORDER BY id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlUser = "SELECT * FROM db_user WHERE deleted_time IS NULL ORDER BY id";
$stmtUser = $db_host->prepare($sqlUser);
$stmtUser->execute();
$rowsUser = $stmtUser->fetchAll(PDO::FETCH_ASSOC);

//只取保母
$petSitter_id_sql = "SELECT * FROM db_user WHERE status=2 AND deleted_time IS NULL ORDER BY id";
$petSitter_id_stmt = $db_host->prepare($petSitter_id_sql);
$petSitter_id_stmt->execute();
$petSitter_id_rows = $petSitter_id_stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlImage = "SELECT message_board_id,image_name FROM db_message_board_images WHERE deleted_time IS NULL ORDER BY id DESC";
$stmtImage = $db_host->prepare($sqlImage);
$stmtImage->execute();
$rowsImage = $stmtImage->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit MessageBoard</title>
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
            <div class="app-main__inner"> <!-- main start -->
                <div class="tab-content">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">編輯留言</h5>
                            <form id="edit_form" action="messageBoard-edit.php" method="post"
                                  enctype="multipart/form-data"> <!-- form 編輯留言 -->
                                <?php foreach ($rows as $value) : ?>
                                    <input type="hidden" name="id" value="<?= $value["id"] ?>">     <!-- 抓取網址id -->
                                    <div class="position-relative row form-group"> <!-- insert 發文者名稱 -->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">發文者名稱</label>
                                        <div class="col-sm-10">
                                            <select name="author_id" id="user_select" class="form-control">
                                                <?php foreach ($rowsUser as $author) : ?>
                                                    <option value="<?= $author["id"] ?>" <?php if ($author["id"] == $value["user_id"]) echo "selected"; ?>>
                                                        <?= $author["name"] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 標題 -->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">標題</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title"
                                                   value="<?= $value["title"] ?>">
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 保母 -->
                                        <label for="exampleSelect" class="col-sm-2 col-form-label">哪位保母？</label>
                                        <div class="col-sm-10">
                                            <select name="petSitter_id" id="petsitter_select" class="form-control">
                                                <?php foreach ($petSitter_id_rows as $petSitter) : ?>
                                                    <option value="<?= $petSitter["id"] ?>" <?php if ($petSitter["id"] == $value["petSitter_id"]) echo "selected"; ?>>
                                                        <?= $petSitter["name"] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 內容 -->
                                        <label for="exampleText" class="col-sm-2 col-form-label">內容</label>
                                        <div class="col-sm-10">
                                            <textarea rows="4" class="form-control"
                                                      name="content"><?= $value["content"] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group"> <!-- insert 上傳圖片 -->
                                        <label for="exampleFile" class="col-sm-2 col-form-label">上傳圖片</label>
                                        <div class="col-sm-10">
                                            <?php foreach ($rowsImage as $image) : ?>
                                            <?php if($image["message_board_id"] == $value["id"]) : ?>
                                            <div class="ratio ratio-1x1 product-picture mb-2">
                                                <div>
                                                    <img class="cover-fit " src="messageBoard-images/<?= $image["image_name"] ?>" alt="">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <input name="file" id="exampleFile" type="file" class="form-control"
                                                   accept=".jpg, .jpeg, .png">
                                            <small class="form-text text-muted">請上傳清晰的照片，格式為 .jpg .jpeg .png。</small>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-check">
                                        <div class="col-sm-10 offset-sm-2" style="padding: 0px;">
                                            <!--type=submit會直接送出所以用button，在jQuery做submit-->
                                            <button type="button" class="btn btn-primary" id="update">修改</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </form>
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
    $('#update').on('click', function () {
        let user = $("#user_select").val();
        let petsitter = $("#petsitter_select").val();
        console.log(user)
        console.log(petsitter)
        if(user == petsitter){      //判斷是否選擇同一人
            Swal.fire({
                icon: 'error',
                title: '發文者與保母不能為同一人',
                showConfirmButton: true
            })
        }else{
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
        }
    })
</script>
</body>
</html>