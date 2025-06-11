<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php') ?>
    <title><?php echo $settings_con['site_title']; ?> - CONFIRM BOOKING</title>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <!-- 
        Check room id from url is present or not
        Shutdown mode is active or not
        User is logged in or not
    -->

    <?php

    if (!isset($_GET['id']) || $settings_con['shutdown'] == true) {
        redirect('room.php');
    } elseif (!isset($_SESSION['login']) && $_SESSION['login'] == true) {
        redirect('room.php');
    }


    // filter and get room and user data

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('room.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "book" => null,
        "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_crud` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 'i');
    $user_data = mysqli_fetch_assoc($user_res);

    ?>


    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">CONFIRM BOOKING</h2>
                <div class="" style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none ">HOME</a>
                    <span class="text-primary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none ">ROOMS</a>
                    <span class="text-primary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none ">CONFIRM</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div>

                    <?php

                    $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
                         WHERE `room_id` = '$room_data[id]'
                         AND `thumb` = '1'");

                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                    }

                    echo <<<data
                        <div class="card p-3 shadow-sm rounded">
                            <img src="$room_thumb" class="img-fluid rounded mb-3" alt="...">
                            <h5>$room_data[name]</h5>
                            <h6>Rp. $room_data[price].000,00 per night</h6>
                        </div>
                    data;

                    ?>

                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <form action="book_now.php" id="booking-form">
                            <h6 class="mb-3">BOOKING DETAILS</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phonenumber" class="form-label">Phone Number</label>
                                    <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $user_data['phonenumber'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" id="address" name="address" rows="1" required><?php echo $user_data['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="checkin" class="form-label">Check In</label>
                                    <input type="date" onchange="check_availability()" id="checkin" name="checkin" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="checkout" class="form-label">Check Out</label>
                                    <input type="date" onchange="check_availability()" id="checkout" name="checkout" class="form-control shadow-none" required>
                                </div>
                                <div class="col-12">
                                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h6 class="mb-3 text-danger" id="book_info">Provide check-in & check-out date !</h6>
                                    <button name="book_now" class="btn w-100 submit-bg shadow-none mb-1" disabled>Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>

    <?php require('inc/scripts.php') ?>

    <script>
        let booking_form = document.getElementById('booking-form');

        let info_loader = document.getElementById('info_loader');

        let book_info = document.getElementById('book_info');

        function check_availability() {
            let checkin_val = booking_form.elements['checkin'].value;
            let checkout_val = booking_form.elements['checkout'].value;
            booking_form.elements['book_now'].setAttribute('disabled', true)

            if (checkin_val != '' && checkout_val != '') {
                book_info.classList.add('d-none');
                book_info.classList.replace('text-dark', 'text-danger');
                info_loader.classList.remove('d-none');

                let data = new FormData();

                data.append('check_availability', '');
                data.append('check_in', checkin_val);
                data.append('check_out', checkout_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirm_booking.php", true);

                xhr.onload = function() {
                    let data =JSON.parse(this.responseText);

                    if(data.status == 'check_in_out_equal') {
                        book_info.innerText = "You cannot check-out on the same day!";
                    } else if(data.status == 'check_out_earlier') {
                        book_info.innerText = "Check-out date is earlier than check-in date!";
                    } else if(data.status == 'check_in_earlier') {
                        book_info.innerText = "Check-in date is earlier than today's date!";
                    } else if(data.status == 'unavailable') {
                        book_info.innerText = "Room not available for this check-in date!";
                    } else {
                        book_info.innerHTML = "No. of Days: " + data.days + "<br> Total Amount to Pay: Rp. " + data.book;
                        book_info.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['book_now'].removeAttribute('disabled');
                    }

                    book_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');
                };
                xhr.send(data);
            }
        }
    </script>
</body>

</html>