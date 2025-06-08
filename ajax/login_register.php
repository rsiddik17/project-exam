<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../inc/sendgrid/sendgrid-php.php");
date_default_timezone_set('Asia/Jakarta');

function send_mail($uemail, $token, $type)
{
    if($type == "email_confirmation") {
        $page = 'email_confirm.php';
        $subject = 'Account Verification Link';
        $content = 'confirm your email';
    } else {
        $page = 'index.php';
        $subject = 'Account Reset Link';
        $content = 'reset your account';
    }


    $email = new \SendGrid\Mail\Mail();
    $email->setFrom(SENDGRID_EMAIL, SENDGRID_NAME);
    $email->setSubject($subject);
    $email->addTo($uemail);

    $email->addContent(
        "text/html",
        "
            Click the link to $content: <br>
            <a href='" . SITE_URL . "$page?$type&email=$uemail&token=$token" . "'>
                Click Me
            </a>
        "
    );
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);

    try {
        $sendgrid->send($email);
        return 1;
    } catch (Exception $e) {
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
    if (!send_mail($data['email'], $token, "email_confirmation")) {
        echo 'mail_failed';
        exit;
    };

    $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_crud`(`name`, `phonenumber`, `dateofbirth`, `gender`, `address`, `email`, `profile`, `password`, `token`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $values = [$data['name'], $data['phonenumber'], $data['dateofbirth'], $data['gender'], $data['address'], $data['email'], $img, $enc_pass, $token];

    if (insert($query, $values, 'sssssssss')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    // check user exists or not

    $u_exist = select(
        "SELECT * FROM `user_crud` WHERE `email`=? OR `phonenumber`=? LIMIT 1",
        [$data['email'], $data['email']],
        'ss'
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo "invalid_email";
        exit;
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);

        if($u_fetch['is_verified'] == 0) {
            echo "not_verified";
        } elseif($u_fetch['status'] == 0) {
            echo "inactive";
        } else {
            if(!password_verify($data['password'], $u_fetch['password'])) {
                echo "invalid_password";
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $u_fetch['id'];
                $_SESSION['uName'] = $u_fetch['name'];
                $_SESSION['uProfile'] = $u_fetch['profile'];
                $_SESSION['uPhoneNumber'] = $u_fetch['phonenumber'];
                echo 1;
            }
        }
    }
    
}

if (isset($_POST['forgot_password'])) {
    $data = filteration($_POST);

    // check user exists or not

    $u_exist = select("SELECT * FROM `user_crud` WHERE `email`=?  LIMIT 1", [$data['email']], 's');

    if (mysqli_num_rows($u_exist) == 0) {
        echo "invalid_email";
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);

        if($u_fetch['is_verified'] == 0) {
            echo "not_verified";
        } elseif($u_fetch['status'] == 0) {
            echo "inactive";
        } else {
            //send reset to email

            $token = bin2hex(random_bytes(16));
            if(!send_mail($data['email'], $token, 'account_recovery')) {
                echo 'email_failed';
            } else {
                $date = date("Y-m-d");

                $query = mysqli_query($con, "UPDATE `user_crud` SET `token`='$token', `t_expire`='$date' WHERE `id`='$u_fetch[id]'");

                if($query) {
                    echo 1;
                } else {
                    echo 'update_failed';
                }
            }
        }
    }
    
}

if (isset($_POST['recovery_user'])) {
    $data = filteration($_POST);

    $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);
    
    $query = "UPDATE `user_crud` SET `password`=?, `token`=?, `t_expire`=? WHERE `email`=? AND `token`=?";
    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if(update($query, $values, 'sssss')) {
        echo 1;
    } else {{
        echo 'failed';
    }}
    
}
