<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Garden</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <!-- Carousel -->
    <div class="container-fluid px-lg-4 mt-2">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="images/carousel/hotel-1.png" class="w-100 h-img d-block" />
                </div>

                <div class="swiper-slide">
                    <img src="images/carousel/hotel-2.png" class="w-100 h-img d-block" />
                </div>

                <div class="swiper-slide">
                    <img src="images/carousel/hotel-3.png" class="w-100 h-img d-block" />
                </div>

                <div class="swiper-slide">
                    <img src="images/carousel/hotel-4.png" class="w-100 h-img d-block" />
                </div>
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

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                    <img src="images/rooms/room-1.jpg" class="card-img-top" alt="room-1">

                    <div class="card-body">
                        <h5>Simple Room</h5>
                        <h6 class="mb-4">Rp. 500.000,00 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Room Details</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balkon
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>

                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>

                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                4 Children
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
                            <a href="#" class="btn btn-sm submit-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-primary shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                    <img src="images/rooms/room-2.png" class="card-img-top" alt="kamar-2">
                    <div class="card-body">
                        <h5>Simple Room</h5>
                        <h6 class="mb-4">Rp. 500.000,00 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Room Details</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balkon
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>

                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>

                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                4 Children
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
                            <a href="#" class="btn btn-sm submit-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm  btn-outline-primary shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                    <img src="images/rooms/room-3.png" class="card-img-top" alt="kamar-3">
                    <div class="card-body">
                        <h5>Simple Room</h5>
                        <h6 class="mb-4">Rp. 500.000,00 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Room Details</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balkon
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>

                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>

                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                4 Children
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
                            <a href="#" class="btn btn-sm submit-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-primary shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 text-center mt-5">
                <a href="room.php" class="btn btn-outline-primary rounded-1 fw-bold shadow-none">More Rooms</a>
            </div>
        </div>
    </div>

    <!-- Our Facilities -->
    <h2 class="mt-4 pt-4 mb-5 text-center fw-bold sec-font">Our Facilities</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                <img src="images/features/wifi.png" width="50px" alt="">
                <h5 class="mt-3">Wifi</h5>
            </div>

            <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                <img src="images/features/ac.png" width="70px" alt="">
                <h5 class="mt-3">AC</h5>
            </div>

            <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                <img src="images/features/television.png" width="50px" alt="">
                <h5 class="mt-3">TV</h5>
            </div>

            <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                <img src="images/features/room-heater.png" width="50px" alt="">
                <h5 class="mt-3">Room Heater</h5>
            </div>

            <div class="col-lg-2 col-md-2 text-center rounded py-4 my-4 card-hover">
                <img src="images/features/gym.png" width="50px" alt="">
                <h5 class="mt-3">Gym Equipment</h5>
            </div>

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
    <h2 class="mt-4 pt-4 mb-5 text-center fw-bold sec-font">Contact Us</h2>
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-8 p-3 mb-lg-0 mb-3 bg-white shadow rounded">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.506900448354!2d106.77729787399389!3d-6.583732393409815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c45243f50bff%3A0x19dbaa73fce1ea4a!2sNew%20Garden%20Hotel!5e0!3m2!1sid!2sid!4v1747995119200!5m2!1sid!2sid" class="w-100" height="350" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 shadow rounded mb-4">
                    <h5>Call Us</h5>
                    <span class="badge bg-light text-dark fs-6 p-2 co-hover">
                        <a href="tel: +6289608762017" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +6289608762017</a>
                    </span>
                </div>

                <div class="bg-white p-4 rounded shadow mb-4">
                    <h5>Follow Us</h5>
                    <span class="badge bg-light text-dark fs-6 p-2 mb-2 co-hover">
                        <a href="https://twitter.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-twitter-x me-1"></i> Twitter</a>
                    </span>
                    <br>
                    <span class="badge bg-light text-dark fs-6 p-2 mb-2 co-hover">
                        <a href="https://instagram.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-instagram me-1"></i> Instagram</a>
                    </span>
                    <br>
                    <span class="badge bg-light text-dark fs-6 p-2 co-hover">
                        <a href="https://facebook.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-facebook me-1"></i> Facebook</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</body>

</html>