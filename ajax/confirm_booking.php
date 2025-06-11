<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
date_default_timezone_set('Asia/Jakarta');


if(isset($_POST['check_availability'])) {
    $form_data = filteration($_POST);
    $status = '';
    $result = '';

    // chechk in and out validations

    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($form_data['check_in']);
    $checkout_date = new DateTime($form_data['check_out']);

    if($checkin_date == $checkout_date) {
        $status = 'check_in_out_equal';
        $result = json_encode(["status" => $status]);
    } elseif($checkout_date < $checkin_date) {
        $status = 'check_out_earlier';
        $result = json_encode(["status" => $status]);
    } elseif($checkin_date < $today_date) {
        $status = 'check_in_earlier';
        $result = json_encode(["status" => $status]);
    }

    // check booking availability if status is blank else return the error

    if($status != '') {
        echo $result;
    } else {
        session_start();
        $_SESSION['room'];

        // run query to check room is available or not

        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $book = $_SESSION['room']['price'] * $count_days;

        $_SESSION['room']['book'] = $book;
        $_SESSION['room']['available'] = true;

        $result = json_encode(["status" => 'available', "days" => $count_days, "book" => $book]);
        echo $result;
    }
}

?>