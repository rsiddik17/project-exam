<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_general'])) {
        $q = "SELECT * FROM `settings` WHERE `id`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }


    if(isset($_POST['upd_general'])) {
        $form_data = filteration($_POST);

        $q = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `id`=?";
        $values = [$form_data['site_title'], $form_data['site_about'], 1];
        $res = update($q, $values, 'ssi');
        echo $res;
    }

    if(isset($_POST['upd_shutdown'])) {
        $form_data = ($_POST['upd_shutdown'] == 0) ? 1 : 0;

        $q = "UPDATE `settings` SET `shutdown`=? WHERE `id`=?";
        $values = [$form_data, 1];
        $res = update($q, $values, 'ii');
        echo $res;
    }

    if(isset($_POST['get_contacts'])) {
        $q = "SELECT * FROM `contact_details` WHERE `id`=?";
        $values = [1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);
        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_contacts'])) {
        $form_data = filteration($_POST);

        $q = "UPDATE `contact_details` SET `address`=?, `gmap`=?, `phone1`=?, `email`=?, `tw`=?,`insta`=?,`fb`=?,`iframe`=? WHERE `id`=?";
        $values = [$form_data['address'], $form_data['gmap'], $form_data['phone1'], $form_data['email'], $form_data['tw'], $form_data['insta'], $form_data['fb'], $form_data['iframe'], 1];
        $res = update($q, $values, 'ssssssssi');
        echo $res;
    }
?>