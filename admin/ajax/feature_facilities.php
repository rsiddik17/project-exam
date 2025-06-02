<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();


if (isset($_POST['add_feature'])) {
    $form_data = filteration($_POST);

    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$form_data['name']];
    $res = insert($q, $values, 's');
    echo $res;
}

if (isset($_POST['get_features'])) {
    $res = selectAll('features');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<DATA
                    <tr>
                        <td>$i</td>
                        <td>$row[name]</td>
                        <td>
                            <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                                    <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                DATA;
        $i++;
    }
}

if (isset($_POST['rem_feature'])) {
    $form_data = filteration($_POST);
    $values = [$form_data['rem_feature']];

    $q = "DELETE FROM `features` WHERE `id`=? ";
    $res = delete($q, $values, 'i');
    echo $res;
}

if (isset($_POST['add_facility'])) {
    $form_data = filteration($_POST);

    $img_r = uploadPNGImage($_FILES['icon'], FACILITIES_FOLDER);

    if ($img_r == 'invalid_img') {
        echo $img_r;
    } else if ($img_r == 'invalid_size') {
        echo $img_r;
    } else if ($img_r == 'update_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?, ?, ?)";
        $values = [$img_r, $form_data['name'], $form_data['desc']];
        $res = insert($q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['get_facility'])) {
    $res = selectAll('facilities');
    $i = 1;
    $path = FACILITIES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<DATA
                    <tr>
                        <td>$i</td>
                        <td><img src="$path$row[icon]" width="100px"></td>
                        <td>$row[name]</td>
                        <td>$row[description]</td>
                        <td>
                            <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                                    <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                DATA;
                $i++;
    }
}

if (isset($_POST['rem_facility'])) {
    $form_data = filteration($_POST);
    $values = [$form_data['rem_facility']];

    $pre_q = "SELECT * FROM `facilities` WHERE `id`=? ";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['icon'], FACILITIES_FOLDER)) {
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $res =  delete($q, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }

    $q = "DELETE FROM `facilities` WHERE `id`=? ";
    $res = delete($q, $values, 'i');
    echo $res;
}

?>