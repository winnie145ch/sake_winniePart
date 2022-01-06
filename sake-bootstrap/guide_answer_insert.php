<?php require __DIR__ . '/parts/__connect_db.php';
$title = "新增指南答案";
$pageName = "guide_answer_insert";
?>
<?php include __DIR__ . '/parts/__head.php'?>
<?php include __DIR__ . '/parts/__navbar.html'?>
<?php include __DIR__ . '/parts/__sidebar.html'?>

<?php include __DIR__ . '/parts/__main_start.html'?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header py-3">新增指南答案選項</h5>
                <div class="card-body">
                    <form name="form_a" onsubmit="sendData();return false;">
                        <div class="form-group mb-3">
                            <label for="q_id" class="mb-2">對應問題id</label>
                            <input
                                type="number"
                                class="form-control"
                                id="q_id"
                                placeholder="1"
                            />
                            <div class="alert alert-dark mt-2" role="alert"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1" class="mb-2">答案選項</label>
                            <input
                                type="text"
                                class="form-control"
                                id="a_item"
                                placeholder="清酒"
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


<?php include __DIR__ . '/parts/__main_end.html'?>

<!-- 如果要 modal 的話留下面的結構 -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">訊息</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/__script.html'?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
    const qId = document.querySelector('#q_id');
    
     const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    //  modal.show() 讓 modal 跳出
</script>
<?php include __DIR__ . '/parts/__foot.html'?>