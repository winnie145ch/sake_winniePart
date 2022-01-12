<?php require __DIR__ . '.\..\parts\__connect_db.php';
$title = "修改禮盒資料";
$pageName = "gift_detail_edit";

if(! isset($_GET['gift_d_id'])){
    header("Location: gift_detail.php");
    exit;
}

$gift_d_id = intval($_GET['gift_d_id']);
$row = $pdo->query("SELECT * FROM `product_gift_d` WHERE gift_d_id=$gift_d_id")->fetch();
if(empty($row)){
    header('Location: gift_detail.php');
    exit;
}
?>
<?php include __DIR__ . '.\..\parts\__head.php' ?>
<?php include __DIR__ . '.\..\parts\__navbar.php'?>
<?php include __DIR__ . '.\..\parts\__sidebar.html' ?>

<?php include __DIR__ . '.\..\parts\__main_start.html' ?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->
<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header py-3">修改禮盒資料</h5>
                <div class="card-body">
                    <form name="form_g" onsubmit="sendData(); return false;" method="POST">
                    <input type="hidden" name="gift_d_id" value="<?= $row['gift_d_id'] ?>">
                        <div class="form-group mb-3">
                            <label for="gift_id" class="mb-2">禮盒種類</label>
                            <select class="form-select" aria-label="Default select example" name="gift_id" id="gift_id">
                                <option value="2">1入禮盒</option>
                                <option value="3">2入禮盒</option>
                                <option value="4">1+1禮盒</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gift_img" class="mb-2">禮盒圖片</label>
                            <input type="file" class="form-control" id="gift_img" name="gift_img"/>
                            <div class="form-text"></div>
                        </div>
                        <div class="img_div" id="img_div">
                            <?php if($row['gift_img']): ?>
                                <img id="edit_img" src="../img/gift/<?= $row['gift_img'] ?>" style="width: 100%;">
                            <?php endif ?>
                            </div>
                        <div class="img_div d_none">
                            <img src="" id="myimg" style="width: 100%;"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="box_color" class="mb-2">禮盒顏色</label>
                            <select class="form-control" aria-label="Default select example" id="box_color" name="box_color">
                                <option value="azalea">紫杜鵑色</option>
                                <option value="black">黑色</option>
                                <option value="gold">金色</option>
                                <option value="indigo">靛青色</option>
                                <option value="red">紅色</option>
                                <option value="white">白色</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gift_pro" class="mb-2">對應商品編號</label>
                            <input type="text" class="form-control" id="gift_pro"name="gift_pro" value="<?= $row['gift_pro'] ?>" />
                            <div class="form-text"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary w-25">修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '.\..\parts\__main_end.html' ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">禮盒資料修改</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">確認</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '.\..\parts\__script.html' ?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
    const giftId = document.querySelector('#gift_id');
    const giftImg = document.querySelector('#gift_img');
    const img_div = document.querySelector('#img_div');
    const d_none = document.querySelector('.d_none');
    const boxColor = document.querySelector('#box_color');
    const giftPro = document.querySelector('#gift_pro');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
    //  modal.show() 讓 modal 跳出

    //預覽圖片
    giftImg.addEventListener('change', doPreview);

    function doPreview() {
        img_div.innerHTML = '';
        d_none.style.display = 'block';
        const[file] = giftImg.files;
        if (file) {
            document.querySelector("#myimg").src = URL.createObjectURL(file);
        }
    }
    //上傳圖片
    function doUpload() {
        const fd = new FormData(document.form_g);
        fetch("gift_detail_insert_api.php", {
                method: "POST",
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                if (obj.success) {
                    document.querySelector("#myimg").src = "../img/gift/" + obj.filename;
                } else {
                    obj.error;
                }
            });
    }

    let gift_id_c = document.querySelector('#gift_id').childNodes;
    gift_id_c.forEach(el =>{
        if(el.value == "<?= $row['gift_id'] ?>"){
            el.setAttribute('selected','selected');
        }
    });
    
    let box_color_c = document.querySelector('#box_color').childNodes;
    box_color_c.forEach(el =>{
        if(el.value == "<?= $row['box_color'] ?>"){
            el.setAttribute('selected','selected');
        }
    });

    function sendData(){
        giftImg.nextElementSibling.innerHTML = '';
        boxColor.nextElementSibling.innerHTML = '';
        giftPro.nextElementSibling.innerHTML = '';
        let isPass = true;

        if(giftPro.value.length < 1){
            isPass = false;
            giftPro.nextElementSibling.innerHTML = '請輸入正確的對應商品編號';
        }

        if(isPass){
            const fd = new FormData(form_g);

            fetch('gift_detail_edit_api.php', {
                method: 'POST',
                body: fd,
            }).then(r=>r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    document.querySelector('.modal-body').innerHTML = "資料修改成功";
                    document.querySelector('.modal-footer').innerHTML = `<a href="gift_detail.php" class="btn btn-secondary">完成</a>`;
                    modal.show();
                } else {
                    document.querySelector('.modal-body').innerHTML = obj.error || '資料修改發生錯誤';
                    modal.show();
                }
            })
        }
    }
</script>
<?php include __DIR__ . '.\..\parts\__foot.html' ?>