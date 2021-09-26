<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--測試預覽用-->
<!--<button class="mb-2 mr-2 btn btn-primary delete-sweetAlert2">刪除</button>-->
<!--<button class="mb-2 mr-2 btn btn-primary save-sweetAlert2">儲存</button>-->
<!--<button class="mb-2 mr-2 btn btn-primary submit-sweetAlert2">送出</button>-->
<!--<button class="mb-2 mr-2 btn btn-primary oops-sweetAlert2">錯誤訊息</button>-->
<!--<button class="mb-2 mr-2 btn btn-primary change-sweetAlert2">更改提醒</button>-->

<script>
    // 是否刪除，刪除成功
    $('.delete-sweetAlert2').on('click',function(){

        Swal.fire({
            title: '確定要刪除嗎?',
            text: "您將無法還原此內容！",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: '取消',
            confirmButtonText: '是的，刪除!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    '刪除!',
                    '您的文件已被刪除。',
                    'success'
                )
            }
        })
    })
    // 儲存成功
    $('.save-sweetAlert2').on('click',function(){

        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '儲存成功',
            showConfirmButton: false,
            timer: 1500
        })
    })
    // 送出成功
    $('.submit-sweetAlert2').on('click',function(){

        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '送出成功',
            showConfirmButton: false,
            timer: 1500
        })
    })
    // 登入成功
    $('.login-sweetAlert2').on('click',function(){

        Swal.fire({
            // position: 'top-end',
            icon: 'success',
            title: '登入成功',
            showConfirmButton: false,
            timer: 1500
        })
    })
    // 錯誤訊息
    $('.oops-sweetAlert2').on('click',function(){

        Swal.fire({
            icon: 'error',
            title: 'Oops..錯誤...',
            text: '可能出了些問題！',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    })

    // 更改提醒
    $('.change-sweetAlert2').on('click',function(){

        Swal.fire({
            title: '是否要儲存更改？',
            showDenyButton: true,
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonText: '儲存',
            denyButtonText: `不要儲存`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('儲存成功!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('更改未儲存', '', 'info')
            }
        })
    })


</script>