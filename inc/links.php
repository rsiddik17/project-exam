<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="css/global.css">

<?php
session_start();

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
date_default_timezone_set('Asia/Jakarta');


$contact_q = "SELECT * FROM `contact_details` WHERE `id`=?";
$settings_q = "SELECT * FROM `settings` WHERE `id`=?";
$values = [1];
$contact_con = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
$settings_con = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
?>