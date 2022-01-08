<?php require __DIR__ . './../parts/__connect_db.php';

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

header('Content-Type: application/json');
$upload_folder = __DIR__.'./../img/container';

$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

if(! empty($_FILES['myfile01'])){
    $ext01 = $exts[$_FILES['myfile01']['type']] ?? '';

    if(! empty($ext01)){
        $filename01 = $_FILES['myfile01']['name'].$ext01;
        $target = $upload_folder.'/'.$filename;

        if(move_uploaded_file($_FILES['myfile01']['tmp_name'],$target)){
            $output['success'] = true;
            $output['filename'] = $filename;
        }else{
            $output['error'] = '無法移動檔案';
        }
    }else{
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
}
if(! empty($_FILES['myfile02'])){
    $ext02 = $exts[$_FILES['myfile02']['type']] ?? '';

    if(! empty($ext02)){
        $filename02 = $_FILES['myfile02']['name'].$ext02;
        $target = $upload_folder.'/'.$filename;

        if(move_uploaded_file($_FILES['myfile02']['tmp_name'],$target)){
            $output['success'] = true;
            $output['filename'] = $filename;
        }else{
            $output['error'] = '無法移動檔案';
        }
    }else{
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
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
