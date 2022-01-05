<?php require __DIR__ . '\parts\__connect_db.php';

$output = ['success' => false,
    'code' => 0,
    'error' => '',];

$containerImg = $_POST['container_img'] ?? '';
$containerShd = $_POST['container_shadow'] ?? '';
$containerName = $_POST['container_name'] ?? '';

if(empty($containerImg)){
    $output['code'] = 401;
    $output['error'] = '請輸入正確的檔名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($containerShd)){
    $output['code'] = 403;
    $output['error'] = '請輸入正確的檔名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($containerName)){
    $output['code'] = 405;
    $output['error'] = '請輸入正確的酒器名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `product_container(`container_img`,`container_shadow`,`container_name`) VALUES (?,?)`";
$stmt = $pdo->prepare($sql);
$stmt -> execute([
    $containerImg,
    $containerShd,
    $containerName,
]);

$output['success'] = $stmt -> rowCount()==1;
$output['rowCount'] = $stmt -> rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
