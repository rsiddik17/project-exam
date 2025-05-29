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

    if(isset($_POST['add_member'])) {
        $form_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

        if($img_r == 'invalid_img') {
            echo $img_r;
        } else if($img_r == 'invalid_size') {
            echo $img_r;
        } else if($img_r == 'update_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?, ?)";
            $values = [$form_data['name'], $img_r];
            $res = insert($q, $values, 'ss');
            echo $res;
        }
    }

    if(isset($_POST['get_members'])) {
        $res = selectAll('team_details');

        while($row = mysqli_fetch_assoc($res)) {
            $path = ABOUT_IMG_PATH;
            echo <<<DATA
                    <div class="col-md-2 mb-3">
                        <div class="card text-bg-dark">
                            <img src="$path$row[picture]" class="card-img">
                            <div class="card-img-overlay text-end">
                                <button type="button" onclick="rem_member($row[id])" class="btn btn-danger btn-sm shadow-none">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                            <p class="card-text text-center px-3 py-2">$row[name]</p>
                        </div>
                     </div>
                DATA;

        }
    }

    if(isset($_POST['rem_member'])) {
        $form_data = filteration($_POST);
        $values = [$form_data['rem_member']];

        $pre_q = "SELECT * FROM `team_details` WHERE `id`=? ";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['picture'], ABOUT_FOLDER)) {
            $q = "DELETE FROM `team_details` WHERE `id`=?";
            $res =  delete($q, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }

    }
?>