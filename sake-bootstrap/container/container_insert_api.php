<?php require __DIR__ . './../parts/__connect_db.php';

$upload_folder = __DIR__ .'/img';

$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif'
];
$output = ['success' => false,
    'code' => 0,
    'error' => '',];

$container_img = $_POST['container_img'] ?? '';
$container_shadow = $_POST['container_shadow'] ?? '';
$container_name = $_POST['container_name'] ?? '';

// if(empty($containerImg)){
//     $output['code'] = 401;
//     $output['error'] = '請輸入正確的檔名';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// if(empty($containerShd)){
//     $output['code'] = 403;
//     $output['error'] = '請輸入正確的檔名';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
if(empty($containerName)){
    $output['code'] = 405;
    $output['error'] = '請輸入正確的酒器名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// header('Content-Type: application/json');

if(! empty($_FILES['container_img'])){
    $ext01 = $exts[$_FILES['container_img']['type']] ;

    if(! empty($ext01)){
        $filename01 = $_FILES['container_img']['name'].$ext01;
        $target = $upload_folder.'/'.$filename01;

        if(move_uploaded_file($_FILES['container_img']['tmp_name'],$target)){
            $output['success'] = true;
            $output['filename'] = $filename01;
            
        }else{
            $output['error'] = '無法移動檔案';
        }
    }else{
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
}

if(! empty($_FILES['container_shadow'])){
    $ext02 = $exts[$_FILES['container_shadow']['type']] ?? '';

    if(! empty($ext02)){
        $filename02 = $_FILES['container_shadow']['name'].$ext02;
        $target = $upload_folder.'/'.$filename02;

        if(move_uploaded_file($_FILES['container_shadow']['tmp_name'],$target)){
            $output['success'] = true;
            $output['filename'] = $filename02;
        }else{
            $output['error'] = '無法移動檔案';
        }
    }else{
        $output['error'] = '不合法的檔案類型';
    }
} else {
    $output['error'] = '沒有上傳檔案';
}

$sql = "INSERT INTO `product_container`(`container_img`,`container_shadow`,`container_name`) VALUES (?,?,?)`";
$stmt = $pdo->prepare($sql);
$stmt -> execute([
    $filename01,
    $filename02,
    $containerName,
]);

$output['success'] = $stmt -> rowCount()==1;
$output['rowCount'] = $stmt -> rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
