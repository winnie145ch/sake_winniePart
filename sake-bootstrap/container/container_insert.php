<?php require __DIR__ . '.\..\parts\__connect_db.php';

$title = '新增酒器資料';
$pageName = 'insert_container';
?>

<?php include __DIR__ . '.\..\parts\__head.php'?>
<?php include __DIR__ . '.\..\parts\__navbar.html'?>
<?php include __DIR__ . '.\..\parts\__sidebar.html'?>

<?php include __DIR__ . '.\..\parts\__main_start.html'?>

<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header py-3">酒器新增</h5>
                <div class="card-body">
                    <form>
                        <div class="form-group mb-3">
                            <label for="containerName" class="mb-2">酒器名稱</label>
                            <input
                                type="text"
                                class="form-control"
                                id="containerName"
                                placeholder="純錫富士山風情杯"
                            />
                            <!-- <div class="alert alert-dark mt-2" role="alert">如果有警告或是備註文字可以用這個～～</div> -->
                        </div>
                        <div class="form-group mb-3">
                            <label for="containerImg" class="mb-2">酒器圖片</label>
                            <input
                                type="text"
                                class="form-control"
                                id="containerImg"
                                placeholder="Number-o.jpg(檔名+副檔名)"
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1" class="mb-2">酒器禮盒圖片</label>
                            <input
                                type="text"
                                class="form-control"
                                id="containerShd"
                                placeholder="Number-s.jpg(檔名+副檔名)"
                            />
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary w-25">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '.\..\parts\__main_end.html'?>

<!-- 如果要 modal 的話留下面的結構 -->
<?php include __DIR__ . '.\..\parts\__modal.html'?>

<?php include __DIR__ . '.\..\parts\__script.html'?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
     const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    //  modal.show() 讓 modal 跳出
</script>
<?php include __DIR__ . '.\..\parts\__foot.html'?>