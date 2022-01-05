<?php require __DIR__ . '\parts\__connect_db.php';
$title = "禮盒酒器";
$pageName = "container_list";
?>

<?php

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: container.php');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM product_container";
// 總比數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) {
    header('Location: container.php?page=' . $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM product_container ORDER BY container_id LIMIT %s, %s",($page-1)*$perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll()

?>

<?php include __DIR__ . '\parts\__head.php' ?>
<?php include __DIR__ . '\parts\__navbar.html' ?>
<?php include __DIR__ . '\parts\__sidebar.html' ?>

<?php include __DIR__ . '\parts\__main_start.html' ?>
<!-- 主要的內容放在 __main_start 與 __main_end 之間 -->

<div class="d-flex justify-content-between mt-5">
    <div >
        <button type="button" class="btn btn-secondary btn-sm">刪除選擇項目</button>
        <button type="button" class="btn btn-secondary btn-sm"><a href="./container_insert.php" style="color:#fff; text-decoration: none;">新增酒器資料</a></button>
    </div>
    <!--這邊是頁數的 Btn  -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- 跳到最前面的 Btn -->
            <li class="page-item <?= 1==$page ? 'disabled' : ''?>">
                <a class="page-link" href="?page=<?= $page==1 ?>"><i class="fas fa-angle-double-left"></i></a>
            </li>
            <!-- 往前一頁的 Btn -->
            <li class="page-item <?= 1==$page ? 'disabled' : ''?>">
                <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fas fa-angle-left"></i></a>
            </li>
            <?php for($i=$page-2; $i<=$page+2; $i++) 
            if($i>=1 && $i<=$totalPages): ?>
            <li class="page-item <?= $i==$page ? 'active' : ''?>"><a class="page-link"
                    href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endif; ?>
            <!-- 往後一頁的 Btn -->
            <li class="page-item <?= $totalPages==$page ? 'disabled' : ''?>">
                <a class="page-link" href="?page=<?= $page+1 ?>""><i class=" fas fa-angle-right"></i></a>
            </li>
            <!-- 跳到最後面的 Btn -->
            <li class="page-item <?= $totalPages==$page ? 'disabled' : ''?>" >
                <a class="page-link" href="?page=<?= $page=$totalPages ?>"><i class="fas fa-angle-double-right"></i></a>
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
                <th>圖片</th>
                <th>禮盒圖片</th>
                <th>酒器名稱</th>
                <th>
                    <a href="#"><i class="fas fa-pen"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $r): ?>
            <tr>
                <td>
                    <input class="form-check-input" type="checkbox" value="" />
                </td>
                <td>
                    <a href="#"><i class="fas fa-trash"></i></a>
                </td>
                <td><?= $r['container_id'] ?></td>
                <td><img src="./img/container/<?= $r['container_img'] ?>" alt="" class="container-img" style="height: 15vh;"></td>
                <td><img src="./img/container/<?= $r['container_shadow'] ?>" alt="" class="container-img" style="height: 15vh;"></td>
                <td><?= htmlentities($r['container_name']) ?></td>
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