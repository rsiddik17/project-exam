<?php

// frontend purpose data
define('SITE_URL', 'http://localhost/new_garden/');
define('ABOUT_IMG_PATH', SITE_URL.'images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');


// backend upload process need this data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/new_garden/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');


function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>
                    window.location.href = 'index.php';
                </script>";
        exit;
    }
}


function redirect($url)
{
    echo "<script> 
                window.location.href='$url';
            </script>";
    exit;
}


function alert($type, $msg)
{
    $succ_fail = ($type == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
                <div class="alert $succ_fail alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                alert;
}


function uploadImage($image, $folder) {
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if(!in_array($img_mime, $valid_mime)) {
        return 'invalid_image'; // invalid image mime or format
    } else if(($image['size']/(1024*1024)) > 2) {
        return 'invalid_size'; // invalid size greater than 2 mb
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111, 99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upload_failed';
        }
    }
}

function deleteImage($image, $folder) {
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)) {
        return true;
    } else {
        return false;
    }
}

?>
