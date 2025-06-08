<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();


if (isset($_POST['get_users'])) {
    $res = selectAll("user_crud");
    $i = 1;
    $path = USERS_IMG_PATH;

    $data = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $delete_btn = "<button type='button' onclick='remove_user($row[id])' class='btn     btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i>
                    </button>";
        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']) {
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $delete_btn = "";
        }

        $status = "<button onclick='toggle_status($row[id], 0)' class='btn btn-primary btn-sm shadow-none'>active</button>";

        if(!$row['status']) {
             $status = "<button onclick='toggle_status($row[id], 1)' class='btn btn-danger btn-sm shadow-none'>inactive</button>";
        }

        $date = date("d-m-Y", strtotime($row['datentime']));

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[profile]' width='55px'>
                    <br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phonenumber]</td>
                <td>$row[address]</td>
                <td>$row[dateofbirth]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$delete_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}

if (isset($_POST['toggle_status'])) {
    $form_data = filteration($_POST);

    $q = "UPDATE `user_crud` SET `status`=? WHERE `id`=?";
    $values = [$form_data['value'], $form_data['toggle_status']];

    if (update($q, $values, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_user'])) {
    $form_data = filteration($_POST);

    $res = delete("DELETE FROM `user_crud` WHERE `id`=? AND `is_verified`=?", [ $form_data['user_id'], 0], 'ii');

    
    if($res) {
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['search_user'])) {
    $form_data = filteration($_POST);

    $query = "SELECT * FROM `user_crud` WHERE `name` LIKE ?";

    $res = select($query, ["%$form_data[name]%"], "s");
    $i = 1;
    $path = USERS_IMG_PATH;

    $data = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $delete_btn = "<button type='button' onclick='remove_user($row[id])' class='btn     btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i>
                    </button>";
        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']) {
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $delete_btn = "";
        }

        $status = "<button onclick='toggle_status($row[id], 0)' class='btn btn-primary btn-sm shadow-none'>active</button>";

        if(!$row['status']) {
             $status = "<button onclick='toggle_status($row[id], 1)' class='btn btn-danger btn-sm shadow-none'>inactive</button>";
        }

        $date = date("d-m-Y", strtotime($row['datentime']));

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[profile]' width='55px'>
                    <br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phonenumber]</td>
                <td>$row[address]</td>
                <td>$row[dateofbirth]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$delete_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}