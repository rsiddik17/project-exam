<?php

require('inc/db_config.php');
require('inc/essentials.php');

session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php') ?>
</head>

<body>

    <?php

    if (isset($_POST['login'])) {
        $form_data = filteration($_POST);

        $query = "SELECT * FROM `admin_crud` WHERE `admin_name`=? AND `admin_pass`=?";
        $values = [$form_data['admin_name'], $form_data['admin_pass']];

        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['id'];
            redirect('dashboard.php');
        } else {
            alert('error', 'Login Failed! Username or Password Wrong');
        }
    }

    ?>


    <div class="login-form text-center">
        <form action="" method="post">
            <h4 class="login-title">Admin</h4>
            <div class="form-body">
                <div class="mb-3">
                    <input name="admin_name" type="text" class="form-control glass-input" placeholder="Admin" required>
                </div>

                <div class="mb-3">
                    <input name="admin_pass" type="password" class="form-control glass-input" placeholder="Password" required>
                </div>

                <button name="login" type="submit" class="login-btn">Login</button>
            </div>
        </form>
    </div>


    <?php require('inc/scripts.php') ?>
</body>

</html>