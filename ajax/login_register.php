<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../inc/sendgrid/sendgrid-php.php");

function send_mail($uemail, $name, $token)
{
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("freesidik07@gmail.com", "New Garden");
    $email->setSubject("Account Verification Link");
    $email->addTo($uemail, $name);

    $email->addContent(
        "text/html",
        "
            Click the link to confirm you email: <br>
            <a href='".SITE_URL."email_confirm.php?email_confirmation&email=$uemail&token=$token"."'>
                Click Me
            </a>
        "
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);

    try {
        $sendgrid->send($email);
        return 1;
    } catch (Exception $e){
        return 0;
    }
}


if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // match password and confirm password field

    if ($data['password'] != $data['cpassword']) {
        echo 'pass_missmatch';
        exit;
    }

    // check user exists or not

    $u_exist = select(
        "SELECT * FROM `user_crud` WHERE `email`=? OR `phonenumber`=? LIMIT 1",
        [$data['email'], $data['phonenumber']],
        'ss'
    );

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // upload user image to server

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'invalid_image') {
        echo 'invalid_image';
        exit;
    } elseif ($img == 'upload_failed') {
        echo 'upload_failed';
        exit;
    }

    // send confirmation link to user's email

    $token = bin2hex(random_bytes(16));
    if (!send_mail($data['email'], $data['name'], $token)) {
        echo 'mail_failed';
        exit;
    };

    $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_crud`(`name`, `phonenumber`, `dateofbirth`, `gender`, `address`, `email`, `profile`, `password`, `token`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $values = [$data['name'], $data['phonenumber'], $data['dateofbirth'], $data['gender'], $data['address'], $data['email'], $img, $enc_pass, $token];

    if(insert($query, $values, 'sssssssss')) {
        echo 1;
    } else {
        echo 0;
    }
}
