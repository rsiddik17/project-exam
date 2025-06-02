<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Garden - Facilities</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-c">

    <!-- Navbar -->
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold sec-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            We offer a wide range of high-quality facilities to ensure your comfort and satisfaction during your stay. <br>
            From modern amenities to thoughtful services, everything is designed to make your experience memorable and convenient.
        </p>
    </div>

    <div class="container">
        <div class="row">

            <?php

                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res)) {
                    echo <<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                             <div class="d-flex align-items-center mb-2">
                                 <img src="$path$row[icon]" alt="" width="40px">
                                <h5 class="m-0 ms-3">$row[name]</h5>
                             </div>
                             <p>$row[description]</p>
                            </div>
                         </div>
                    data;
                }

            ?>

        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php') ?>
    <?php require('inc/scripts.php') ?>
</body>

</html>