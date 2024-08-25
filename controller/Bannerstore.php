<?php

session_start();

$title = $_REQUEST['title'];
$detail = $_REQUEST['detail'];
$ctaTitle = $_REQUEST['ctaTitle'];
$ctaLink = $_REQUEST['ctaLink'];
$videoLink = $_REQUEST['videoLink'];
$bannerImage = $_FILES['bannerImage'];
$extension = pathinfo($bannerImage['name'])['extension'] ?? null;
$acceptedExtension = ['png','jpg','svg'];

$errors = [];

//Title validation
if(empty($title)){
    $errors['title_error'] = 'Title is missing!'; 
}

//detail validation
if(empty($detail)){
    $errors['detail_error'] = 'Detail is missing!';
}

//Photo validation
if($bannerImage['size'] == 0){
    $errors['bannerImage_error'] = "Image is missing";
}
else if(!in_array($extension,$acceptedExtension)){
    $errors['bannerImage_error'] = "$extension is not acceptable. Accepted type are " . join(',',$acceptedExtension);
}
if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: ../dashboard/banner.php");
}
else{
    $fileName = 'Banner-' .uniqid() . '.' . $extension;
    move_uploaded_file($bannerImage['tmp_name'], '../uploads/'.$fileName);
    $uploadPath = "uploads/$fileName";

    include "../database/env.php";

    $query = "INSERT INTO banners(title, detail, cta_title, cta_link, video_link, banner_img) VALUES ('$title','$detail','$ctaTitle','$ctaLink','$videoLink','$uploadPath')";
    $res = mysqli_query($conn, $query);

    if($res){
        $_SESSION['success'] = true;
        header("Location: ../dashboard/banner.php");
    }

}