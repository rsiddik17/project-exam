<nav class="navbar navbar-expand-lg glass-navbar px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 sec-font" href="index.php"><?php echo $settings_con['site_title']; ?></a>
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
                <?php
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        $path = USERS_IMG_PATH;
                        echo<<<data
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <img src="$path$_SESSION[uProfile]" style="width: 25px; height: 25px;" class="rounded-circle me-1">
                                        $_SESSION[uName]
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                                        <li><a class="dropdown-item" style="background-color: transparent;" onmouseover="this.style.backgroundColor='#f8d7da'; this.style.color='#a71d2a'" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#dc3545'" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                        data;
                    } else {
                        echo<<<data
                                <button type="button" class="btn btn-outline-primary shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                                <button type="button" class="btn btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                        data;
                    }
                ?>
            </form>
        </div>
    </div>
</nav>

<div id="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

<!-- Login Pop Up -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-login">

            <form action="" id="login-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control shadow-none glass-login" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control shadow-none glass-login" required>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-primary shadow-none">LOGIN</button>
                        <button type="button" class="btn border-0 text-decoration-none text-white shadow-none" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Forgot Password?</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Registration Pop Up -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content glass-login">

            <form action="" id="register-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Register
                    </h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row text-white">

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="phonenumber" class="form-label">Phone Number</label>
                                <input type="text" id="phonenumber" name="phonenumber" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="dateofbirth" class="form-label">Date Of Birth</label>
                                <input type="date" id="dateofbirth" name="dateofbirth" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-control shadow-none glass-login text-black" required>
                                    <option value="" disabled selected>Choose</option>
                                    <option value="man">Man</option>
                                    <option value="women">Women</option>
                                </select>
                            </div>

                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control glass-login" id="address" name="address" rows="1" required></textarea>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="profile" class="form-label">Photo Profile</label>
                                <input type="file" id="profile" name="profile" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control shadow-none glass-login" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <input type="password" id="cpassword" name="cpassword" class="form-control shadow-none glass-login" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-primary shadow-none">REGISTER</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Forgot Pop Up -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-login">

            <form action="" id="forgot-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center text-white">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                    </h1>
                </div>

                <div class="modal-body text-white">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: A link will be sent to your email to reset your password!
                        </span>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control shadow-none glass-login" required>
                    </div>


                    <div class="mb-2 text-end">
                        <button type="button" class="btn border-0 text-decoration-none text-white shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary shadow-none">SEND LINK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>