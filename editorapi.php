<?php

$errors = [];
$data = [];

if (!empty($_POST['file'])) {
    for($i=0; $i<count($_FILES['file']['name']); $i++){
        $target_path = "uploads/";
        $ext = explode('.', basename( $_FILES['file']['name'][$i]));
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext)-1]; 
    
        if(!move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
            $errors['name'] =  'upload is error.';
        }
    }
}

if (empty($_POST['name'])) {
    $errors['name'] = 'name is required.';
}

if (empty($_POST['title'])) {
    $errors['title'] = 'title is required.';
}

if (empty($_POST['news'])) {
    $errors['news'] = 'news is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    file_put_contents("news/".$_POST['title'].".html", $_POST['news']);

    $data['success'] = true;
    $data['message'] = 'Success!';
}


echo json_encode($data);

?>