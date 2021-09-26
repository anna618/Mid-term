<?php
require_once("pdo_connect.php");
$sql="SELECT * FROM db_user";
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
    <title>Insert user</title>
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
                                    <h5 class="card-title">新增會員資料</h5>
                                    <form id="insert_form" action="user-doInsert.php" method="post" enctype="multipart/form-data"> <!-- form 新增寵物資料 -->
                                        <div class="position-relative row form-group"> <!-- insert 帳號(email) -->
                                            <label for="exampleEmail" class="col-sm-2 col-form-label">帳號(email)</label>
                                            <div class="col-sm-10">
                                                <input name="account" id="exampleEmail" placeholder="test@test.com" type="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 密碼 -->
                                            <label for="examplePassword" class="col-sm-2 col-form-label">密碼</label>
                                            <div class="col-sm-10">
                                                <input name="password" id="examplePassword" placeholder="請輸入6-12碼數字" type="password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 姓名 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">姓名</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" placeholder="王小明" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 性別 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">性別</label>
                                            <div class="col-sm-10">
                                                <select name="gender" id="exampleSelect" class="form-control">
                                                    <option value="male">男</option>
                                                    <option value="female">女</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 地址 -->
                                            <label for="exampleText" class="col-sm-2 col-form-label">地址</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" name="address" id="exampleText" class="form-control" placeholder="Ex：新北市蘆洲區" required></textarea>
                                        </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 生日 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">生日</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="DOB" >
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 電話 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">電話</label>
                                            <div class="col-sm-10">
                                                <input type="tel" class="form-control" name="phone" placeholder="請輸入10碼數字" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 請上傳大頭貼 -->
                                            <label for="exampleFile" class="col-sm-2 col-form-label">請上傳大頭貼</label> 
                                            <div class="col-sm-10">
                                                <input name="image" id="exampleFile" type="file" class="form-control" accept=".jpg, .jpeg, .png">
                                                <small class="form-text text-muted">請上傳清晰的大頭貼照片，格式為 .jpg .jpeg .png。</small>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-check">
                                            <div class="col-sm-10 offset-sm-2" style="padding: 0px;">
                                                <button type="button" class="btn btn-primary" id="create">新增</button>
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
        // 送出成功
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