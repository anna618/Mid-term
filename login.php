<?php
require_once("pdo_connect.php");
if(isset($_SESSION["user"])){
    header("location:list-order.php");
}

$sql = "SELECT * FROM users WHERE deleted_time IS NULL ORDER BY id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dataCount = $stmt->rowCount();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <meta name="msapplication-tap-highlight" content="no">
    <?php require_once("./assets/css/css.php") ?>
    <link href="./assets/css/main.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow"> <!-- header start -->
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                </div>
            </div>
            <div class="app-header__mobile-menu"></div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                           class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/no-user.svg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                             class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">登入</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button"
                                            class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- header end -->
        <div class="app-main">
            <div class="scrollbar-container"></div>
                <div class="app-main__inner"> <!-- main start -->
                    <div class="tab-content">
                        <div class="col-lg-6" style="margin: 0 auto;">
                            <div class="main-card card">
                                <div class="card-body" >
                                    <h5 class="card-title text-center" style="font-size: 22px;">後台登入</h5>
                                    <form id="login_form" action="dologin.php" method="post" enctype="multipart/form-data"> <!-- form 後台登入 -->
                                            <div class="col-lg-12"> 
                                                <div class="position-relative form-group"> <!-- insert 帳號(email) -->
                                                    <label for="exampleEmail11">帳號(email)</label>
                                                    <input name="email" id="exampleEmail11" placeholder="請輸入帳號" type="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword11" class="">密碼</label>
                                                        <input name="password" id="examplePassword11" placeholder="請輸入密碼" type="password" class="form-control">
                                                    </div>
                                            </div>
                                            <div class="col-lg-12" style="margin: 0 auto">
                                                <button id="login" type="button" class="btn btn-primary" href="list-user.php">登入</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div> <!-- main end -->
        </div>
    </div>
    <?php require_once("./assets/scripts/sweetAlert2.php") ?>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    <script>
        let rowsValue = <?php echo json_encode($rows); ?>;
        console.log(rowsValue[0]["password"])
        $('#login').on('click',function(){
            if(rowsValue[0]["email"] == $("#exampleEmail11").val() && $("#examplePassword11").val() == "12345"){
                if ($("#examplePassword11").val() != ""){
                    Swal.fire({
                        icon: 'success',
                        title: '登入成功',
                        showConfirmButton: false,
                    })
                    setTimeout(function (){
                        $("#login_form").submit();
                    },1000);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '請輸入密碼',
                        showConfirmButton: false,
                    })
                    setTimeout(function (){
                        window.location.href = `login.php`;
                    },1000);
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: '登入失敗',
                    showConfirmButton: false,
                })
                setTimeout(function (){
                    window.location.href = `login.php`;
                },1000);
            }
        })
    </script>
</body>

</html>