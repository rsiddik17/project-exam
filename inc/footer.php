<div class="container-fluid bg-fo mt-5 pt-4">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 m">
            <h3 class="fw-bold fs-4 mb-2"><?php echo $settings_con['site_title']; ?></h3>
            <p> <?php echo $settings_con['site_about']; ?></p>
        </div>

        <!-- About Section -->
        <div class="col-lg-2 col-md-6 mb-4">
            <h5 class="fw-semibold mb-3">About</h5>
            <ul class="list-unstyled">
                <li><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
                <li><a href="#" class="text-white text-decoration-none">Features</a></li>
                <li><a href="#" class="text-white text-decoration-none">Blog</a></li>
            </ul>
        </div>

        <!-- Company Section -->
        <div class="col-lg-2 col-md-6 mb-4">
            <h5 class="fw-semibold mb-3">Company</h5>
            <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">FAQs</a></li>
                <li><a href="#" class="text-white text-decoration-none">History</a></li>
                <li><a href="#" class="text-white text-decoration-none">Testimonials</a></li>
            </ul>
        </div>

        <!-- Contact Section -->
        <div class="col-lg-2 col-md-6 mb-4">
            <h5 class="fw-semibold mb-3">Contact</h5>
            <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">Help Center</a></li>
                <li><a href="#" class="text-white text-decoration-none">Contact Us</a></li>
                <li><a href="#" class="text-white text-decoration-none">Customer Service</a></li>
            </ul>
        </div>

        <!-- Support Section -->
        <div class="col-lg-3 col-md-12 mb-4">
            <h5 class="fw-semibold mb-3">Follow Us</h5>
            <div class="d-flex gap-3">
                <a href="<?php echo $contact_con['tw'] ?>" class="text-white fs-5"><i class="bi bi-twitter-x"></i></a>
                <a href="<?php echo $contact_con['insta'] ?>" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                <a href="<?php echo $contact_con['fb'] ?>" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                <a href="https://youtube.com/" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
            </div>
        </div>

    </div>
    <h6 class="text-center p-3 m-0 sec-font">&copy; New Garden. All rights reserved.</h6>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function alert(type, msg) {
        let succ_fail = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${succ_fail} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        document.getElementById('alert-container').appendChild(element);
        setTimeout(remAlert, 5000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }


    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('phonenumber', register_form.elements['phonenumber'].value);
        data.append('dateofbirth', register_form.elements['dateofbirth'].value);
        data.append('gender', register_form.elements['gender'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('password', register_form.elements['password'].value);
        data.append('cpassword', register_form.elements['cpassword'].value);
        data.append('register', '');

        var myModal = document.getElementById("registerModal");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'pass_missmatch') {
                alert('error', "Password Missmatch!");
            } else if (this.responseText == 'email_already') {
                alert('error', "Email is already registered!")
            } else if (this.responseText == 'phone_already') {
                alert('error', "Phone number is already registered!")
            } else if (this.responseText == 'invalid_image') {
                alert('error', "Only JPG, WEBP, & PNG images are allowed!")
            } else if (this.responseText == 'upload_failed') {
                alert('error', "Image upload failed!")
            } else if (this.responseText == 'mail_failed') {
                alert('error', "Cannot send confirmation email! Server down!")
            } else if (this.responseText == 'insert_failed') {
                alert('error', "Registration failed! Server down!")
            } else {
                alert('success', "Registration successful. Confirmation link sent to email!");
                register_form.reset();
            }
        };
        xhr.send(data);
    })


    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email', login_form.elements['email'].value);
        data.append('password', login_form.elements['password'].value);
        data.append('login', '');

        var myModal = document.getElementById("loginModal");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'invalid_email') {
                alert('error', "Invalid Email!");
            } else if (this.responseText == 'not_verified') {
                alert('error', "Email is not verified!")
            } else if (this.responseText == 'inactive') {
                alert('error', "Account Suspended! Please contact admin")
            } else if (this.responseText == 'invalid_password') {
                alert('error', "Incorrect Password!")
            } else {
                if (window.location.pathname.includes('room_details.php')) {
                    window.location.reload();
                } else {
                     window.location.reload();
                }

                // window.location = window.location.pathname;
            }
        };
        xhr.send(data);
    })


    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_password', '');

        var myModal = document.getElementById("forgotModal");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == 'invalid_email') {
                alert('error', "Invalid Email!");
            } else if (this.responseText == 'not_verified') {
                alert('error', "Email is not verified!, please contact admin")
            } else if (this.responseText == 'email_failed') {
                alert('error', "Cannot send email, Server down")
            } else if (this.responseText == 'update_failed') {
                alert('error', "Account recovery failed. Server down")
            } else {
                alert('success', 'Reset link sent to email')
                forgot_form.reset();
            }
        };
        xhr.send(data);
    })


    function checkLoginToBook(status, room_id) {
        if (status) {
            window.location.href = 'confirm_booking.php?id=' + room_id;
        } else {
            alert('error', 'Please login to book room');
        }
    }
</script>