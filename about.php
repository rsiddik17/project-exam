<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Garden - About</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold sec-font text-center">About Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Welcome to New Garden, your versatile destination for comfortable and convenient stays. <br> Whether youre here for a relaxing holiday, a business trip, or any other purpose, our hotel offers a welcoming environment tailored to your needs.
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Our mission.</h3>
                <p>
                    We focus on providing high-quality service, cozy accommodations, and modern amenities to ensure every guest feels at home. Our team is dedicated to making your stay enjoyable and hassle-free, no matter the reason for your visit.

                    At New Garden, its all about you—comfort, convenience, and excellent hospitality designed to suit all kinds of stays.
                </p>
            </div>

            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-1 order-1">
                <img src="images/about/founders.jpg" class="w-100 rounded" alt="">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded p-1 border-top border-3 border-primary text-center">
                    <h4 class="mt-3 fw-semibold">100+ <br> <span class="fw-medium fs-5">Rooms</span></h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded p-1 border-top border-3 border-primary text-center">
                    <h4 class="mt-3 fw-semibold">150+ <br> <span class="fw-medium fs-5">Customers</span></h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded p-1 border-top border-3 border-primary text-center">
                    <h4 class="mt-3 fw-semibold">100+ <br> <span class="fw-medium fs-5">Review</span></h4>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded p-1 border-top border-3 border-primary  text-center">
                    <!-- <img src="images/about/staff.png" width="70px" alt=""> -->
                    <h4 class="mt-3 fw-semibold">70+ <br> <span class="fw-medium fs-5">Staff</span></h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold sec-font text-center">Management Team</h3>

    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">

                <?php

                $about_con = selectAll('team_details');
                $path = ABOUT_IMG_PATH;
                
                while($row = mysqli_fetch_assoc($about_con)) {
                    echo <<< data
                        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                            <img src="$path$row[picture]" class="w-100" alt="">
                            <h5 class="mt-2">$row[name]</h5>
                        </div>
                    data;
                }

                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>

    <?php require('inc/scripts.php') ?>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidePerview: 4,
            spaceBetween: 40,
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
    </script>
</body>

</html>