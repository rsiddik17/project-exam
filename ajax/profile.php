<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require('../inc/sendgrid/sendgrid-php.php');

date_default_timezone_set('Asia/Jakarta');


if(isset($_POST['info-form'])) {
    $form_data = filteration($_POST);
    session_start();

    $u_exist = select("SELECT * FROM `user_crud` WHERE `phonenumber`=? AND `id`=? LIMIT 1", [$data['phonenumber'], $_SESSION['uId']], "ss");

    if(mysqli_num_rows($u_exist) != 0) {
        echo 'phone_already';
        exit;
    }

    $query = "UPDATE `user_crud` SET `name`=?, `phonenumber`=?, `dateofbirth`=?, `gender`=?, `address`=? WHERE `id`=? LIMIT 1";
    $values = [$form_data['name'], $form_data['phonenumber'], $form_data['dateofbirth'], $form_data['gender'], $form_data['address'], $_SESSION['uId']];

    if(update($query, $values, 'ssssss')) {
        $_SESSION['uName'] = $form_data['name'];
        echo 1;
    } else {
        echo 0;
    }
}

if(isset($_POST['profile-form'])) {
    $form_data = filteration($_POST);
    session_start();

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'invalid_image') {
        echo 'invalid_image';
        exit;
    } elseif ($img == 'upload_failed') {
        echo 'upload_failed';
        exit;
    }

    // fetching old image and deleting it

    $u_exist = select("SELECT `profile` FROM `user_crud` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "s");

    deleteImage($u_fetch['profile'], USERS_FOLDER);

    $query = "UPDATE `user_crud` SET `profile`=? WHERE `id`=? LIMIT 1";
    $values = [$img, $_SESSION['uId']];

    if(update($query, $values, 'ss')) {
        $_SESSION['uProfile'] = $img;
        echo 1;
    } else {
        echo 0;
    }
}

if(isset($_POST['password-form'])) {
    $form_data = filteration($_POST);
    session_start();

    if($form_data['new_password'] != $form_data['confirm_password']) {
        echo 'missmatch';
        exit;
    }

    $enc_pass = password_hash($form_data['new_password'], PASSWORD_BCRYPT);



    $query = "UPDATE `user_crud` SET `password`=? WHERE `id`=? LIMIT 1";
    $values = [$enc_pass, $_SESSION['uId']];

    if(update($query, $values, 'ss')) {
        echo 1;
    } else {
        echo 0;
    }
}