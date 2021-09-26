<?php
require_once("pdo_connect.php");
$id = $_GET["id"]; //抓要編輯的那個id

$sql = "SELECT * FROM db_user WHERE deleted_time is NULL AND id=? ORDER BY id DESC";
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
    <title>Edit user</title>
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
                                    <h5 class="card-title">編輯會員資料</h5>
                                    <form  id="edit_form" action="user-edit.php" method="post" enctype="multipart/form-data"> <!-- form 編輯使用者資料 -->
                                        <?php foreach ($rows as $value): ?>
                                        <input type="hidden" name="id" value="<?= $value["id"] ?>">
                                        <div class="position-relative row form-group"> <!-- edit 帳號(email) -->
                                            <label for="exampleEmail" class="col-sm-2 col-form-label">帳號(email)</label>
                                            <div class="col-sm-10">
                                                <input name="account" id="exampleEmail" type="email" class="form-control" value="<?= $value["account"] ?>">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 密碼 -->
                                            <label for="examplePassword" class="col-sm-2 col-form-label">密碼</label>
                                            <div class="col-sm-10">
                                                <input name="password" id="examplePassword" type="password" class="form-control" value="<?= $value["password"] ?>">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 姓名 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">姓名</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" value="<?= $value["name"] ?>">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 性別 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">性別</label>
                                            <div class="col-sm-10">
                                                <select name="gender" id="exampleSelect" class="form-control">
                                                    <option value="male">男</option>
                                                    <option value="female">女</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 地址 -->
                                            <label for="exampleText" class="col-sm-2 col-form-label">地址</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" name="address" id="exampleText" class="form-control" ><?= $value["address"] ?></textarea>
                                        </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 生日 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">生日</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="DOB" value="<?= $value["DOB"] ?>">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 電話 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">電話</label>
                                            <div class="col-sm-10">
                                                <input type="tel" class="form-control" name="phone" value="<?= $value["phone"] ?>">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 請上傳大頭貼 -->
                                            <label for="exampleFile" class="col-sm-2 col-form-label">請上傳大頭貼</label> 
                                            <div class="col-sm-10">
                                                目前圖片:
                                                <div class="ratio ratio-1x1 product-picture mb-2">
                                                    <div>
                                                        <img class="cover-fit " src="users-images/<?=$value["images"]?>" alt="">
                                                    </div>
                                                </div>
                                                <input name="image" id="exampleFile" type="file" class="form-control" accept=".jpg, .jpeg, .png" <?= $value["images"] ?>>
                                                <small class="form-text text-muted">請上傳清晰的大頭貼照片，格式為 .jpg .jpeg .png。</small>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- edit 權限 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">權限</label>
                                            <div class="col-sm-10">
                                                <select name="status" id="exampleSelect" class="form-select" >
                                                    <option value="1" <?php if($value["status"] == 1)echo "selected";?> >一般會員</option>
                                                    <option value="2" <?php if($value["status"] == 2)echo "selected";?> >保母會員</option>
                                                </select>
                                             </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <div class="position-relative row form-check">
                                            <div class="col-sm-10 offset-sm-2" style="padding: 0px;">
                                                <button type="button" class="btn btn-primary" id="update">修改</button>
                                            </div>
                                        </div>
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