<?php

require('inc/essentials.php');
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Carousel</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-white">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4">Carousel</h4>

                <div id="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

                <!-- Carousel section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Carousel</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carousel-setting">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="row" id="carousel-data">
                            
                        </div>
                    </div>
                </div>

                <!-- Carousel Modal -->
                <div class="modal fade" id="carousel-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" id="carousel-setting-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Image</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="carousel_picture" class="form-label">Picture</label>
                                        <input type="file" id="carousel_picture_inp" name="carousel_picture" accept="[.jpg, .png, .webp, .jpeg]" class="form-control shadow-none" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="carousel_picture.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>

    <script src="js/carousel.js"></script>
</body>

</html>