<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php') ?>
    <title><?php echo $settings_con['site_title']; ?> - HOME</title>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <!-- Carousel -->
    <div class="container-fluid px-lg-4 mt-2">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">

                <?php
                $res = selectAll('carousel');

                while ($row = mysqli_fetch_assoc($res)) {
                    $path = CAROUSEL_IMG_PATH;
                    echo <<<DATA
                    <div class="swiper-slide">
                        <img src="$path$row[image]" class="w-100 h-img d-block" />
                    </div>
                DATA;
                }

                ?>

            </div>
        </div>
    </div>

    <!-- Check Form Availability -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 shadow p-4 rounded glass-carou">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form action="">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label">Adult</label>
                            <select class="form-select shadow-none">
                                <option disabled selected>Choose</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option disabled selected>Choose</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn submit-bg text-white shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Our Rooms -->
    <h2 class="mt-4 pt-4 mb-5 text-center fw-bold sec-font">Our Rooms</h2>

    <div class="container">
        <div class="row">

            <?php
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` LIMIT 3", [1, 0], 'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {

                // get features room

                $fea_q = mysqli_query($con, "SELECT f.name from `features` f 
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                        WHERE rfea.room_id = '$room_data[id]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                        $fea_row[name] 
                                    </span>";
                }


                // get facilities room

                $fac_q = mysqli_query($con, "SELECT f.name from `facilities` f 
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                        WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                        $fac_row[name] 
                                    </span>";
                }

                // get thumbnail of image

                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
                         WHERE `room_id` = '$room_data[id]'
                         AND `thumb` = '1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                $book_btn = "";

                if(!$settings_con['shutdown']) {
                    $book_btn = "<a href='#' class='btn btn-sm submit-bg shadow-none'>Book Now</a>";
                }

                // print room card
                echo <<< data
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                                    <img src="$room_thumb" class="card-img-top" alt="">

                                    <div class="card-body">
                                        <h5>$room_data[name]</h5>
                                        <h6 class="mb-4">Rp. $room_data[price],00 per night</h6>
                                        <div class="features mb-4">
                                            <h6 class="mb-1">Features</h6>
                                            $features_data
                                        </div>

                                        <div class="facilities mb-4">
                                            <h6 class="mb-1">Facilities</h6>
                                            $facilities_data
                                        </div>

                                        <div class="guests mb-4">
                                            <h6 class="mb-1">Guests</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[adult] Adults
                                            </span>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[children] Children
                                            </span>
                                        </div>

                                        <div class="rating mb-4">
                                            <h6 class="mb-1">Rating</h6>
                                            <span class="badge rounded-pill bg-light">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-evenly mb-2">
                                            $book_btn
                                            <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-primary shadow-none">More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    data;
            }
            ?>


            <div class="col-lg-12 text-center mt-5">
                <a href="room.php" class="btn btn-outline-primary rounded-1 fw-bold shadow-none">More Rooms</a>
            </div>
        </div>
    </div>

    <!-- Our Facilities -->
    <h2 class="mt-4 pt-4 mb-5 text-center fw-bold sec-font">Our Facilities</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <?php

            $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` LIMIT 5");
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                        <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                             <img src="$path$row[icon]" width="50px" alt="">
                             <h5 class="mt-3">$row[name]</h5>
                        </div>
                    data;
            }

            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-outline-primary rounded-1 fw-bold shadow-none">More Facilities</a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold sec-font">TESTIMONIALS</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">

                <div class="swiper-slide bg-white p-4 shadow">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/about/founders.jpg" width="30px">
                        <h6 class="m-0 ms-2">Usamah</h6>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum fuga ad corrupti inventore
                        nulla?</p>

                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4 shadow">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/about/founders.jpg" width="30px">
                        <h6 class="m-0 ms-2">Adnin</h6>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum fuga ad corrupti inventore
                        nulla?</p>

                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4 shadow">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/about/founders.jpg" width="30px">
                        <h6 class="m-0 ms-2">Sidik</h6>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum fuga ad corrupti inventore
                        nulla?</p>

                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4 shadow">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/about/founders.jpg" width="30px">
                        <h6 class="m-0 ms-2">Uus</h6>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem ipsum fuga ad corrupti inventore
                        nulla?</p>

                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Contact Us -->

    <?php

    $contact_q = "SELECT * FROM `contact_details` WHERE `id`=?";
    $values = [1];
    $contact_con = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

    ?>

    <h2 class="mt-4 pt-4 mb-5 text-center fw-bold sec-font">Contact Us</h2>
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-8 p-3 mb-lg-0 mb-3 bg-white shadow rounded">
                <iframe src="<?php echo $contact_con['iframe'] ?>" class="w-100" height="350" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 shadow rounded mb-4">
                    <h5>Call Us</h5>
                    <span class="badge bg-light text-dark fs-6 p-2 co-hover">
                        <a href="tel: +<?php echo $contact_con['phone1'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contact_con['phone1'] ?></a>
                    </span>
                </div>

                <div class="bg-white p-4 rounded shadow mb-4">
                    <h5>Follow Us</h5>

                    <span class="badge bg-light text-dark fs-6 p-2 mb-2 co-hover">
                        <a href="<?php echo $contact_con['tw'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-twitter-x me-1"></i> Twitter</a>
                    </span>
                    <br>
                    <span class="badge bg-light text-dark fs-6 p-2 mb-2 co-hover">
                        <a href="<?php echo $contact_con['insta'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-instagram me-1"></i> Instagram</a>
                    </span>
                    <br>
                    <span class="badge bg-light text-dark fs-6 p-2 co-hover">
                        <a href="<?php echo $contact_con['fb'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-facebook me-1"></i> Facebook</a>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <!-- Password reset modal and code -->
    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content glass-login">

                <form action="" id="recovery-form">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                            <i class="bi bi-shiled-lock fs-3 me-2"></i> Set up new password
                        </h1>
                    </div>

                    <div class="modal-body text-white">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-control shadow-none glass-login" required>
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>


                        <div class="mb-2 text-end">
                            <button type="button" class="btn border-0 text-decoration-none text-white shadow-none me-2" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary shadow-none">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_GET['account_recovery'])) {
        $data = filteration($_GET);

        $t_date = date("Y-m-d");

        $query = select(
            "SELECT * FROM `user_crud` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
            [$data['email'], $data['token'], $t_date], 'sss');


        if (mysqli_num_rows($query) == 1) {
            echo <<<showModal
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        var myModal = document.getElementById("recoveryModal");

                        myModal.querySelector("input[name='email']").value = '$data[email]';
                        myModal.querySelector("input[name='token']").value = '$data[token]';

                        var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                        modal.show();
                        });
                        </script>
                showModal;
        } else {
            alert("error", "Invalid or Expired Link !");
        }
    }

    ?>


    <!-- Footer -->
    <?php require('inc/footer.php') ?>


    <?php require('inc/scripts.php') ?>
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            }
        });


        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });


        // recover account
        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('email', recovery_form.elements['email'].value);
            data.append('token', recovery_form.elements['token'].value);
            data.append('password', recovery_form.elements['password'].value);
            data.append('recovery_user', '');

            var myModal = document.getElementById("recoveryModal");
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);

            xhr.onload = function() {
                if (this.responseText == 'failed') {
                    alert('error', "Account reset failed!")
                } else {
                    alert('success', 'Account reset successful!')
                    recovery_form.reset();
                }
            };
            xhr.send(data);
        })
    </script>
</body>

</html>