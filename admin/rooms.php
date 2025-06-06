<?php

require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Rooms</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-white">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4">Rooms</h4>

                <div id="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

                <!-- Feature section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <!-- Add Room Modal -->
                <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="" id="add-room-form" autocomplete="off">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Room</h5>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" name="name" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="area" class="form-label">Area</label>
                                            <input type="number" min="1" id="area" name="area" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" min="1" id="price" name="price" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" min="1" id="quantity" name="quantity" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="adult" class="form-label">Adult (Max.)</label>
                                            <input type="number" min="1" id="adult" name="adult" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="children" class="form-label">Children (Max.)</label>
                                            <input type="number" min="1" id="children" name="children" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Features</label>
                                            <div class="row">
                                                <?php

                                                $res = selectAll('features');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                            <div class='col-md-3'>
                                                                <label>
                                                                    <input type='checkbox' name='features[]' value='$opt[id]' class='form-check-input shadow-none'>
                                                                    $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Facilities</label>
                                            <div class="row">
                                                <?php

                                                $res = selectAll('facilities');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                            <div class='col-md-3'>
                                                                <label>
                                                                    <input type='checkbox' name='facilities[]' value='$opt[id]' class='form-check-input shadow-none'>
                                                                    $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="desc" class="form-label fw-bold">Description</label>
                                            <textarea name="desc" id="desc" rows="4" class="form-control shadow-none" required></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Room Modal -->
                <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="" id="edit-room-form" autocomplete="off">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Room</h5>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" name="name" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="area" class="form-label">Area</label>
                                            <input type="number" min="1" id="area" name="area" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" min="1" id="price" name="price" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" min="1" id="quantity" name="quantity" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="adult" class="form-label">Adult (Max.)</label>
                                            <input type="number" min="1" id="adult" name="adult" class="form-control shadow-none" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="children" class="form-label">Children (Max.)</label>
                                            <input type="number" min="1" id="children" name="children" class="form-control shadow-none" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Features</label>
                                            <div class="row">
                                                <?php

                                                $res = selectAll('features');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                            <div class='col-md-3'>
                                                                <label>
                                                                    <input type='checkbox' name='features[]' value='$opt[id]' class='form-check-input shadow-none'>
                                                                    $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Facilities</label>
                                            <div class="row">
                                                <?php

                                                $res = selectAll('facilities');
                                                while ($opt = mysqli_fetch_assoc($res)) {
                                                    echo "
                                                            <div class='col-md-3'>
                                                                <label>
                                                                    <input type='checkbox' name='facilities[]' value='$opt[id]' class='form-check-input shadow-none'>
                                                                    $opt[name]
                                                                </label>
                                                            </div>
                                                        ";
                                                }

                                                ?>
                                            </div>
                                        </div>

                                        <input type="hidden" name="room_id">

                                        <div class="col-12 mb-3">
                                            <label for="desc" class="form-label fw-bold">Description</label>
                                            <textarea name="desc" id="desc" rows="4" class="form-control shadow-none" required></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Manage Room Modal -->
                <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Room Name</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="" id="alert-image"></div>
                                <div class="border-bottom border-3 pb-3 mb-3">
                                    <form action="" id="add_image_form">
                                        <label for="image" class="form-label">Add Image</label>
                                        <input type="file" id="image" name="image" accept="[.jpg, .png, .webp, .jpeg]" class="form-control shadow-none mb-3" required>
                                        <button class="btn btn-primary shadow-none">Add</button>
                                        <input type="hidden" name="room_id">
                                    </form>
                                </div>
                                <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                                    <table class="table table-hover border text-center">
                                        <thead>
                                            <tr class="bg-dark text-light sticky-top">
                                                <th scope="col" width="60%">Image</th>
                                                <th scope="col">Thumb</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody id="room-image-data">



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>

    <script src="js/rooms.js"></script>
</body>

</html>