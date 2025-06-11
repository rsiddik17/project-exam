<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php') ?>
    <title><?php echo $settings_con['site_title']; ?> - PROFILE</title>
</head>

<body class="bg-c">
    <?php
    require('inc/header.php');

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    $u_exist = select("SELECT * FROM `user_crud` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');
    $u_fetch = mysqli_fetch_assoc($u_exist);

    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-primary">></span>
                    <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
                </div>
            </div>

            <div class="col-12 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form action="" id="info-form">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phonenumber" class="form-label">Phone Number</label>
                                <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $u_fetch['phonenumber'] ?>" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="dateofbirth" class="form-label">Date Of Birth</label>
                                <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo $u_fetch['dateofbirth'] ?>" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <input id="gender" name="gender" value="<?php echo $u_fetch['gender'] ?>" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="address" class="form-label">Address</label>
                                <input id="address" name="address" value="<?php echo $u_fetch['address'] ?>" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white submit-bg shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-4 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form action="" id="profile-form">
                        <h5 class="mb-3 fw-bold">Picture</h5>
                        <img src="<?php echo USERS_IMG_PATH . $u_fetch['profile'] ?>" class="rounded-circle img-fluid mb-3" style="width: 250px; height: 250px; object-fit: cover; border-radius: 50%; display: block; margin: 0 auto;"  alt="">

                        <label for="profile" class="form-label">New Profile</label>
                        <input type="file" id="profile" name="profile" class="mb-4 form-control shadow-none glass-login" required>

                        <button type="submit" class="btn text-white submit-bg shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form action="" id="password-form">
                        <h5 class="mb-3 fw-bold">Change Password</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control shadow-none" required>
                            </div>
                        </div>

                        <button type="submit" class="btn text-white submit-bg shadow-none">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        let info_form = document.getElementById('info-form');

        info_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('info-form', '');
            data.append('name', info_form.elements['name'].value);
            data.append('phonenumber', info_form.elements['phonenumber'].value);
            data.append('dateofbirth', info_form.elements['dateofbirth'].value);
            data.append('gender', info_form.elements['gender'].value);
            data.append('address', info_form.elements['address'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'phone_already') {
                    alert('error', "Phone number is already registered!")
                } else if (this.responseText == 0) {
                    alert('error', "No Changes Made!");
                } else {
                    alert('success', 'Changes saved!')
                }
            };
            xhr.send(data);
        })

        let profile_form = document.getElementById('profile-form');

        profile_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('profile-form', '');
            data.append('profile', profile_form.elements['profile'].files[0]);


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'invalid_image') {
                    alert('error', "Only JPG, WEBP, & PNG images are allowed!")
                } else if (this.responseText == 'upload_failed') {
                    alert('error', "Image upload failed!")
                } else if(this.responseText == 0) {
                    alert('error', 'Update Failed!')
                } else {
                    window.location.href = window.location.pathname;
                }
            };
            xhr.send(data);
        })

        let password_form = document.getElementById('password-form');

        password_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let new_password = password_form.elements['new_password'].value;
            let confirm_password = password_form.elements['confirm_password'].value;

            if(new_password != confirm_password) {
                alert('error', 'Password do not match');
                return false;
            }

            let data = new FormData();

            data.append('password-form', '');
            data.append('new_password', new_password);
            data.append('confirm_password', confirm_password);


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'missmatch') {
                    alert('error', "Password do not match!")
                } else if(this.responseText == 0) {
                    alert('error', 'Update Failed!')
                } else {
                    alert('success', 'Changes saved!');
                    password_form.reset();
                }
            };
            xhr.send(data);
        })

    </script>

</body>

</html>