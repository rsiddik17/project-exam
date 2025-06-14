<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php') ?>
    <title><?php echo $settings_con['site_title']; ?> - Contact</title>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold sec-font text-center">Contact Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            If you have any questions, need help with your booking, or simply want to get in touch with us, feel free to reach out. We are here to assist you!
        </p>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-3">
                    <iframe src="<?php echo $contact_con['iframe'] ?>" class="w-100" height="320" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_con['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-geo-alt-fill"></i> <?php echo $contact_con['address'] ?></a>

                    <h5 class="mt-3">Call Us</h5>
                    <a href="tel: +<?php echo $contact_con['phone1'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contact_con['phone1'] ?></a>

                    <h5 class="mt-3">Email</h5>
                    <a href="mailto: <?php echo $contact_con['email'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-envelope-fill"></i> <?php echo $contact_con['email'] ?></a>

                    <h5 class="mt-3">Follow Us</h5>
                    <a href="<?php echo $contact_con['tw'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-twitter-x me-1"></i> </a>
                    <a href="<?php echo $contact_con['insta'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-instagram me-1"></i> </a>
                    <a href="<?php echo $contact_con['fb'] ?>" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-facebook me-1"></i> </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="" method="post">
                        <h5>Send a message</h5>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control shadow-none" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control shadow-none no-resize" rows="5" required ></textarea>
                        </div>

                            <button type="submit" name="send" class="btn submit-bg text-white shadow-none mt-2">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php
    
        if(isset($_POST['send'])) {
            $form_data = filteration($_POST);

            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)";
            $values = [$form_data['name'], $form_data['email'], $form_data['subject'], $form_data['message']];

            $res = insert($q, $values, 'ssss');
            if($res == 1) {
                alert('success', 'Mail send!');
            } else {
                alert('error', 'Server Down! Try again later');
            }
        }

    ?>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>
    <?php require('inc/scripts.php') ?>
</body>

</html>