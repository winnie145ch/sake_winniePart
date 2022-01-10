<?php require __DIR__ . './../parts/__connect_db.php';
$title = "新增指南答案";
$pageName = "guide_answer_insert";
?>
<?php include __DIR__ . './../parts/__head.php' ?>
<?php include __DIR__ . './../parts/__navbar.html' ?>
<?php include __DIR__ . './../parts/__sidebar.html' ?>

<?php include __DIR__ . './../parts/__main_start.html' ?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header py-3">新增指南答案選項</h5>
                <div class="card-body">
                    <form name="form_a" onsubmit="sendData(); return false;">
                        <div class="form-group mb-3">
                            <label for="q_id" class="mb-2">對應問題id</label>
                            <input type="number" class="form-control" id="q_id" placeholder="1" name="q_id" />
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="a_item" class="mb-2">答案選項</label>
                            <input type="text" class="form-control" id="a_item" placeholder="清酒" name="a_item" />
                            <div class="form-text"></div>
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
<?php include __DIR__ . './../parts/__main_end.html' ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">資料錯誤</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . './../parts/__script.html' ?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
    const qId = document.querySelector('#q_id');
    const aItem = document.querySelector('#a_item');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    //  modal.show() 讓 modal 跳出
    function sendData(){
        qId.nextElementSibling.innerHTML = '';
        aItem.nextElementSibling.innerHTML = '';
        let isPass = true;

        if(qId.value < 1){
            isPass = false;
            qId.nextElementSibling.innerHTML = '請輸入正確的對應問題id';
        }
        if(aItem.value.length < 2){
            isPass = false;
            aItem.nextElementSibling.innerHTML = '請輸入正確的答案選項';
        }

        if(isPass){
            const fd = new FormData(form_a);

            fetch('guide_anwser_insert_api.php', {
                method: 'POST',
                body: fd,
            }).then(r=>r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    location.href = 'guide_answer.php';
                } else {
                    document.querySelector('.modal-body').innerHTML = obj.error || '資料新增發生錯誤';
                    modal.show();
                }
            })
        }
    }
</script>
<?php include __DIR__ . './../parts/__foot.html' ?>