<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php') ?>
    <title><?php echo $settings_con['site_title']; ?> - Room</title>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold sec-font text-center">Our Rooms</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">

                        <h4 class="mt-2">Filter</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-6">Check Availability</h5>
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control shadow-none">
                                <label class="form-label">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>

                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-6">Facilities</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                    <label for="f1" class="form-check-label">Facility One</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                    <label for="f2" class="form-check-label">Facility Two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                    <label for="f3" class="form-check-label">Facility Three</label>
                                </div>
                            </div>

                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3 fs-6">Guest</h5>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <label for="" class="form-label">Adults</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">

                <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id`", [1, 0], 'ii');

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

                    if (!$settings_con['shutdown']) {
                        $login = 0;
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            $login = 1;
                        }

                        $book_btn = "<button onclick='checkLoginToBook($login, $room_data[id])' class='btn btn-sm w-100 submit-bg shadow-none mb-3'>Book Now</button>";
                    }

                    // print room card
                    echo <<< data
                            <div class="card mb-4 border-0 shadow">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                        <img src="$room_thumb" class="img-fluid rounded" alt="...">
                                    </div>

                                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                        <h5 class="mb-2">$room_data[name]</h5>
                                        <div class="features mb-3">
                                            <h6 class="mb-1">Features</h6>
                                            $features_data
                                        </div>

                                        <div class="facilities mb-3">
                                            <h6 class="mb-1">Facilities</h6>
                                            $facilities_data
                                        </div>

                                        <div class="guests">
                                          <h6 class="mb-1">Guests</h6>
                                         <span class="badge rounded-pill bg-light text-dark text-wrap">
                                           $room_data[adult] Adults
                                         </span>
                                         <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[children]  Children
                                         </span>
                                         </div>
                                    </div>

                                    <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                        <h6 class="mb-4">Rp. $room_data[price].000,00 per night</h6>
                                        $book_btn
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-primary shadow-none">More Details</a>
                                    </div>
                                </div>
                            </div>
                    data;
                }
                ?>


            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>

    <?php require('inc/scripts.php') ?>
</body>

</html>