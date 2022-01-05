<?php require __DIR__ . '\parts\__connect_db.php';
$title = "禮盒細節";
$pageName = "gift_detail_list";
?>

<?php

$perPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: gift_detail.php');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM product_gift_d";
// 總比數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) {
    header('Location: gift_detail.php?page=' . $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM product_gift_d ORDER BY gift_d_id LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll()

?>

<?php include __DIR__ . '\parts\__head.php' ?>
<?php include __DIR__ . '\parts\__navbar.html' ?>
<?php include __DIR__ . '\parts\__sidebar.html' ?>

<?php include __DIR__ . '\parts\__main_start.html' ?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->

<div class="d-flex justify-content-between mt-5">
    <button type="button" class="btn btn-secondary btn-sm">刪除選擇項目</button>
    <!--這邊是頁數的 Btn  -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a>
            </li>
            <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i></a>
            </li>
            <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                if ($i >= 1 && $i <= $totalPages) : ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endif; ?>
            <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>""><i class=" fas fa-angle-right"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
            </li>
        </ul>
    </nav>
</div>
<!-- 這邊是 table的內容 -->
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
                <th>id</th>
                <th>禮盒種類</th>
                <th>圖片</th>
                <th>禮盒顏色</th>
                <th>對應商品編號</th>
                <th>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox" value="" />
                    </td>
                    <td>
                        <a href="#"><i class="fas fa-trash"></i></a>
                    </td>
                    <td><?= $r['gift_d_id'] ?></td>
                    <td><?= $r['gift_id'] ?></td>
                    <td><img src="./img/gift/<?= $r['gift_img'] ?>" alt="" class="gift-img" style="height:20vh;"></td>
                    <td><?= $r['box_color'] ?></td>
                    <td><?= $r['gift_pro'] ?></td>
                    <td>
                        <a href="#"><i class="fas fa-pen"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
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