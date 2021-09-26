<?php
require_once("pdo_connect.php");
//if(!isset($_SESSION["user"])){
//    header("location:login.php");
//}
$sql = "SELECT * FROM db_user WHERE deleted_time is NULL ORDER BY id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dataCount=$stmt->rowCount();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User list</title>
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
                        <h5 class="card-title" style="padding-left: 20px;">共 <?=$dataCount?> 筆資料</h5>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">會員資料明細</h5>
                                <table class="mb-0 table table-striped mydatatable" enctype="multipart/form-data"> <!-- table 會員資料明細 -->
                                    <thead> <!-- table 會員資料明細 -->
                                    <tr>
                                        <th>序號</th>
                                        <th>帳號(email)</th>
                                        <th>密碼</th>
                                        <th>姓名</th>
                                        <th>性別</th>
                                        <th>地址</th>
                                        <th>生日</th>
                                        <th>電話</th>
                                        <th>大頭貼</th>
                                        <th>權限</th>
                                        <th>項目更改</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rows as $value): ?>
                                    <tr>
                                        <th scope="row"><?=$value["id"]?></th> <!--序號-->
                                        <td><?=$value["account"]?></td> <!--帳號(email)-->
                                        <td><?=$value["password"]?></td> <!--密碼-->
                                        <td><?=$value["name"]?></td> <!--姓名-->
                                        <td><?=$value["gender"]?></td> <!--性別-->
                                        <td><?=$value["address"]?></td> <!--地址-->
                                        <td><?=$value["DOB"]?></td> <!--生日-->
                                        <td><?=$value["phone"]?></td> <!--電話-->
                                        <td>
                                            <div class="ratio ratio-1x1 product-picture">
                                                <div>
                                                    <img class="cover-fit" src="users-images/<?=$value["images"]?>" alt=""> <!--大頭貼-->
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php
                                            if($value["status"] == 1){
                                                echo "一般會員";
                                            }else{
                                                echo "保母會員";
                                            }?>
                                        </td> <!--權限-->
                                        <td>
                                            <a class="btn btn-info mb-2 text-white" href="list-userPet.php?id=<?=$value["id"]?>">寵物</a><br>
                                            <a class="btn btn-primary mb-2" href="user-update.php?id=<?=$value["id"]?>">修改</a><br>
                                            <button data-delete_number="<?= $value["id"] ?>" type="button" class="btn btn-danger delete">刪除</button>
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
                                window.location.href = `user-delete.php?id=${deleteNumber}`;
                            }, 1000);
                        }
                    }
                }
            })
        })
    </script>
</body>

</html>