<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();


    if(isset($_POST['add_image'])) {
        $form_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);

        if($img_r == 'invalid_img') {
            echo $img_r;
        } else if($img_r == 'invalid_size') {
            echo $img_r;
        } else if($img_r == 'update_failed') {
            echo $img_r;
        } else {
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$img_r];
            $res = insert($q, $values, 's');
            echo $res;
        }
    }

    if(isset($_POST['get_carousel'])) {
        $res = selectAll('carousel');

        while($row = mysqli_fetch_assoc($res)) {
            $path = CAROUSEL_IMG_PATH;
            echo <<<DATA
                    <div class="col-md-4 mb-3">
                        <div class="card text-bg-dark">
                            <img src="$path$row[image]" class="card-img">
                            <div class="card-img-overlay text-end">
                                <button type="button" onclick="rem_image($row[id])" class="btn btn-danger btn-sm shadow-none">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                     </div>
                DATA;
        }
    }

    if(isset($_POST['rem_image'])) {
        $form_data = filteration($_POST);
        $values = [$form_data['rem_image']];

        $pre_q = "SELECT * FROM `carousel` WHERE `id`=? ";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'], CAROUSEL_FOLDER)) {
            $q = "DELETE FROM `carousel` WHERE `id`=?";
            $res =  delete($q, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }

    }
?>