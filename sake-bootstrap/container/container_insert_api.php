<?php require __DIR__ . '.\..\parts\__connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$container_img = $_POST['container_img'] ?? '';
$container_shadow = $_POST['container_shadow'] ?? '';
$container_name = $_POST['container_name'] ?? '';

if (empty($containerName)) {
    $output['code'] = 405;
    $output['error'] = '請輸入正確的酒器名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `product_container`(`container_name`) VALUES (?)`";
$stmt = $pdo->prepare($sql);
$stmt -> execute([
    $containerName,
]);

$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

$upload_folder = __DIR__ . '\..\img\container';

$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif'
];

if (!empty($_FILES['container_img'])) {
    $ext01 = $exts[$_FILES['container_img']['type']];

    if (!empty($ext)) {
        $filename = $_FILES['container_img']['name'] . $ext;
        $target = $upload_folder . "\\" . $filename;

        if (move_uploaded_file($_FILES['container_img']['tmp_name'], $target)) {

            $sql01 = "INSERT INTO `product_container`(`container_img`) VALUES (?)`";
            $stmt01 = $pdo->prepare($sql01);
            $stmt01->execute([
                $filename,
            ]);

            $output['success'] = true;
            $output['filename01'] = $filename;
        } else {
            $output['error'] = '無法移動檔案';
        }
    } else {
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
}


if(! empty($_FILES['container_shadow'])){
    $ext = $exts[$_FILES['container_shadow']['type']] ;

    if(! empty($ext)){
        $filename = $_FILES['container_shadow']['name'].$ext;
        $target = $upload_folder."\\".$filename;

        if(move_uploaded_file($_FILES['container_shadow']['tmp_name'],$target)){

            $sql02 = "INSERT INTO `product_container`(`container_shadow`) VALUES (?)`";
            $stmt02 = $pdo->prepare($sql02);
            $stmt02->execute([
                $filename,
            ]);
            $output['success'] = true;
            $output['filename02'] = $filename;
        }else{
            $output['error'] = '無法移動檔案';
        }
    }else{
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
