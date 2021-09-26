<?php
require_once("pdo_connect.php");
//全部會員資料
$sql = "SELECT * FROM db_user WHERE deleted_time IS NULL ORDER BY id";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//只取保母
$petSitter_id_sql = "SELECT * FROM db_user WHERE status=2 AND deleted_time IS NULL ORDER BY id";
$petSitter_id_stmt = $db_host->prepare($petSitter_id_sql);
$petSitter_id_stmt->execute();
$petSitter_id_rows = $petSitter_id_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert MessageBoard</title>
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
                            <h5 class="card-title">新增留言</h5>
                            <form id="insert_form" action="messageBoard-doInsert.php" method="post"
                                  enctype="multipart/form-data"> <!-- form 新增留言 -->
                                <div class="position-relative row form-group"> <!-- insert 發文者名稱 -->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">發文者名稱</label>
                                    <div class="col-sm-10">
                                        <select name="author_id" id="user_select" class="form-control">
                                            <?php foreach ($rows as $author) : ?>
                                                <option value="<?= $author["id"] ?>"><?= $author["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 標題 -->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                </div>
                                <!--只取status為2(保母)-->
                                <div class="position-relative row form-group"> <!-- insert 保母 -->
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">哪位保母？</label>
                                    <div class="col-sm-10">
                                        <select name="petSitter_id" id="petsitter_select" class="form-control test1">
                                            <?php foreach ($petSitter_id_rows as $value) : ?>
                                                <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 內容 -->
                                    <label for="exampleText" class="col-sm-2 col-form-label">內容</label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" name="content" id="exampleText" class="form-control"
                                                  placeholder="Ex：今天帶毛毛出去散步，天氣很好..."></textarea>
                                    </div>
                                </div>
                                <div class="position-relative row form-group"> <!-- insert 上傳圖片 -->
                                    <label for="exampleFile" class="col-sm-2 col-form-label">上傳圖片</label>
                                    <div class="col-sm-10">
                                        <input name="file" id="exampleFile" type="file" class="form-control"
                                               accept=".jpg, .jpeg, .png">
                                        <small class="form-text text-muted">請上傳清晰的照片，格式為 .jpg .jpeg .png。</small>
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
        let user = $("#user_select").val();
        let petsitter = $("#petsitter_select").val();
        if(user == petsitter){      //判斷是否選擇同一人
            Swal.fire({
                icon: 'error',
                title: '發文者與保母不能為同一人',
                showConfirmButton: true
            })
        }
        else{
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: '新增成功',
                showConfirmButton: false,
                timer: 2000
            })
            setTimeout(function () {
                $("#insert_form").submit();
            }, 1000);
        }
    })
</script>
</body>

</html>