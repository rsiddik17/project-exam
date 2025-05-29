<?php 

    require('admin/inc/db_config.php');
    require('admin/inc/essentials.php');


?>


<nav class="navbar navbar-expand-lg glass-navbar px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 sec-font" href="index.php">New Garden</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="room.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact Us</a>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <button type="button" class="btn btn-outline-primary shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button type="button" class="btn btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#registrationModal">Registration</button>
            </form>
        </div>
    </div>
</nav>

<!-- Login Pop Up -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-login">

            <form action="">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" class="form-control shadow-none glass-login" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control shadow-none glass-login" required>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-primary shadow-none">LOGIN</button>
                        <a href="javascript: void(0)" class="text-decoration-none text-white">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Registration Pop Up -->
<div class="modal fade" id="registrationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content glass-login">

            <form action="">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
                    </h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row text-white">

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" id="fullname" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="phonenumber" class="form-label">Phone Number</label>
                                <input type="text" id="phonenumber" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="dateofbirth" class="form-label">Date Of Birth</label>
                                <input type="date" id="dateofbirth" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control shadow-none glass-login text-black" required>
                                    <option disabled selected>Choose</option>
                                    <option value="Laki-laki">Man</option>
                                    <option value="Perempuan">Women</option>
                                </select>
                            </div>

                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control glass-login" id="address" rows="1" required></textarea>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="photoprofile" class="form-label">Photo Profile</label>
                                <input type="file" id="photoprofile" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" id="confirmpassword" class="form-control shadow-none glass-login" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-primary shadow-none">REGISTRATION</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>