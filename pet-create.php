<?php
require_once("pdo_connect.php");
$sql="SELECT * FROM db_pet ";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 從db_user抓user的id,供db_pet的user_id使用
$sql="SELECT id FROM db_user WHERE deleted_time is NULL";
$stmt = $db_host->prepare($sql);
$stmt->execute($id);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert pet</title>
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
                                    <h5 class="card-title">新增寵物資料</h5>
                                        <form id="insert_form" action="pet-doInsert.php" method="post" enctype="multipart/form-data"> <!-- form 新增寵物資料 -->
                                        <div class="position-relative row form-group"> <!-- insert 會員編號 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">會員編號</label>
                                            <div class="col-sm-10">
                                                <select name="user_id" id="exampleSelect" class="form-control">
                                                    <option value="0">請選擇會員編號</option>
                                                    <?php foreach($rows as $value): ?>
                                                        <option value="<?=$value["id"]?>"><?=$value["id"]?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 寵物姓名 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">寵物姓名</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" placeholder="小黑" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 寵物性別 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">寵物性別</label>
                                            <div class="col-sm-10">
                                                <select name="gender" id="exampleSelect" class="form-control">
                                                    <option value="male">公</option>
                                                    <option value="female">母</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 寵物生日 -->
                                            <label for="exampleSelect" class="col-sm-2 col-form-label">寵物生日</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="DOB" >
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 寵物詳細資訊 -->
                                            <label for="exampleText" class="col-sm-2 col-form-label">寵物詳細資訊</label>
                                        <div class="col-sm-10">
                                            <textarea rows="2" name="content" id="exampleText" class="form-control" placeholder="Ex：活潑、親人..."></textarea>
                                        </div>
                                        </div>
                                        <div class="position-relative row form-group"> <!-- insert 上傳寵物大頭貼 -->
                                            <label for="exampleFile" class="col-sm-2 col-form-label">上傳寵物大頭貼</label> 
                                            <div class="col-sm-10">
                                                <input name="image" id="exampleFile" type="file" class="form-control" accept=".jpg, .jpeg, .png">
                                                <small class="form-text text-muted">請上傳清晰的寵物照片，格式為 .jpg .jpeg .png。</small>
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