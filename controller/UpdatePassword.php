<?php
session_start();

if(!isset($_SESSION['auth'])){
    session_unset();
    header("Location: ../index.php");
}


$user_id = $_SESSION['auth']['id'];
$oldPassword = $_REQUEST["old_password"];
$newPassword = $_REQUEST["new_password"];
$confirmPassword = $_REQUEST["confirm_password"];

$errors= [];

if(empty($oldPassword)) {
    $errors["old_password_error"] = "Old Password is Required";
}

if(empty($newPassword)) {
    $errors["new_password_error"] = "New Password is Required";
} else if(strlen($newPassword) < 8){
    $errors['new_password_error'] = 'Password should be greater or equal to 8 char!';
} else if($newPassword !== $confirmPassword){
    $errors['confirm_password_error'] = 'Password should be greater or equal to 8 char!';
}


if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header('Location: ../dashboard/profile.php');
    exit();
} else{
    include "../database/env.php";
    $query = "SELECT * FROM users WHERE id= '$user_id'";
    $result = mysqli_query($conn,$query);

    if($result->num_rows > 0){
        $res = mysqli_fetch_assoc($result);
        $encPassword = $res['password'];

        if(password_verify($oldPassword, $encPassword)){
            $newEncPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $query = "UPDATE users SET password='$newEncPassword' WHERE id='$user_id'";
            $res = mysqli_query($conn, $query);
            if($res){
                $_SESSION['success'] = true;
                header('Location: ../dashboard/profile.php');
                exit();
            } else {
                $errors['update_error'] = 'Failed to update password!';
                $_SESSION['errors'] = $errors;
                header('Location: ../dashboard/profile.php');
                exit();
            }
        }else{
            $errors['old_password_error'] = 'Invalid Password!';
            $_SESSION['errors'] = $errors;
            header('Location: ../dashboard/profile.php');
            exit();
        }
    }else {
        $errors['user_not_found'] = 'User not found!';
        $_SESSION['errors'] = $errors;
        header('Location: ../dashboard/profile.php');
        exit();
    }
}







?>



