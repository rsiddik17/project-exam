<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Garden - Contact</title>
    <?php require('inc/links.php') ?>
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.506900448354!2d106.77729787399389!3d-6.583732393409815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c45243f50bff%3A0x19dbaa73fce1ea4a!2sNew%20Garden%20Hotel!5e0!3m2!1sid!2sid!4v1747995119200!5m2!1sid!2sid" class="w-100" height="320" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="https://maps.app.goo.gl/ShLMNo9GK3Mw2QFJ9" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-geo-alt-fill"></i> Universitas Ibn Khaldun Bogor</a>

                    <h5 class="mt-3">Call Us</h5>
                    <a href="tel: +6289608762017" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +6289608762017</a>

                    <h5 class="mt-3">Email</h5>
                    <a href="mailto: freesidik07@gmail.com" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-envelope-fill"></i> freesidik07@gmail.com</a>

                    <h5 class="mt-3">Follow Us</h5>
                    <a href="https://twitter.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-twitter-x me-1"></i> </a>
                    <a href="https://instagram.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-instagram me-1"></i> </a>
                    <a href="https://facebook.com/" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-facebook me-1"></i> </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="">
                        <h5>Send a message</h5>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="email" class="form-control shadow-none" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control shadow-none no-resize" rows="5" required ></textarea>
                        </div>

                            <button type="submit" class="btn submit-bg text-white shadow-none mt-2">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>
    <?php require('inc/scripts.php') ?>
</body>

</html>