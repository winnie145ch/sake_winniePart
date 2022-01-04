<?php require __DIR__ . '\parts\__connect_db.php';
$title = "選酒指南";
$pageName = "guide_list";
?>

<?php include __DIR__ . '\parts\__head.php' ?>
<?php include __DIR__ . '\parts\__navbar.html' ?>
<?php include __DIR__ . '\parts\__sidebar.html' ?>

<?php include __DIR__ . '\parts\__main_start.html' ?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->

<div class="d-flex justify-content-between mt-5">
    <button type="button" class="btn btn-secondary btn-sm">刪除選擇項目</button>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-left"></i></a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
            </li>
        </ul>
    </nav>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>
                    <input class="form-check-input" type="checkbox" value="" />
                </th>
                <th>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </th>
                <th>種類</th>
                <th>序號</th>
                <th>問題</th>
                <th>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <input class="form-check-input" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td>data</td>
                <td>placeholder</td>
                <td>text</td>
                <td>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-check-input" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td>irrelevant</td>
                <td>visual</td>
                <td>layout</td>
                <td>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-check-input" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td>rich</td>
                <td>dashboard</td>
                <td>tabular</td>
                <td>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-check-input" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td>placeholder</td>
                <td>illustrative</td>
                <td>data</td>
                <td>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<?php include __DIR__ . '\parts\__main_end.html' ?>

<!-- 如果要 modal 的話留下面的結構 -->
<?php include __DIR__ . '\parts\__modal.html' ?>

<?php include __DIR__ . '\parts\__script.html' ?>
<!-- 如果要 modal 的話留下面的 script -->
<script>
const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));
//  modal.show() 讓 modal 跳出
</script>
<?php include __DIR__ . '\parts\__foot.html' ?>