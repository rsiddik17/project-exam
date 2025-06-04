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
                                <tbody id="add-room">



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
                                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
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
                                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
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

            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>

    <script>
        let add_room_form = document.getElementById('add-room-form');

        add_room_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_room();
        })

        function add_room() {
            let data = new FormData();
            data.append("add_room", "");
            data.append("name", add_room_form.elements["name"].value);
            data.append("area", add_room_form.elements["area"].value);
            data.append("price", add_room_form.elements["price"].value);
            data.append("quantity", add_room_form.elements["quantity"].value);
            data.append("adult", add_room_form.elements["adult"].value);
            data.append("children", add_room_form.elements["children"].value);
            data.append("desc", add_room_form.elements["desc"].value);



            let features = [];
            add_room_form.querySelectorAll('[name="features"]:checked').forEach(el => {
                features.push(el.value);
            })

            let facilities = [];
            add_room_form.querySelectorAll('[name="facilities"]:checked').forEach(el => {
                facilities.push(el.value);
            })

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                var myModal = document.getElementById("add-room");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "New feature added!");
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert("error", "Server down! " + this.responseText);
                }
            };
            xhr.send(data);
        }

        function get_all_rooms() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("add-room").innerHTML = this.responseText;

            };
            xhr.send('get_all_rooms=true');
        }

        let edit_room_form = document.getElementById('edit-room-form');

        edit_room_form.addEventListener("submit", function(e) {
            e.preventDefault();
            submit_edit_room();
        })

        function submit_edit_room() {
            let data = new FormData();
            data.append("edit_room", "");
            data.append("room_id", edit_room_form.elements['room_id'].value);
            data.append("name", edit_room_form.elements["name"].value);
            data.append("area", edit_room_form.elements["area"].value);
            data.append("price", edit_room_form.elements["price"].value);
            data.append("quantity", edit_room_form.elements["quantity"].value);
            data.append("adult", edit_room_form.elements["adult"].value);
            data.append("children", edit_room_form.elements["children"].value);
            data.append("desc", edit_room_form.elements["desc"].value);



            let features = [];
            edit_room_form.querySelectorAll('[name="features"]:checked').forEach(el => {
                features.push(el.value);
            })

            let facilities = [];
            edit_room_form.querySelectorAll('[name="facilities"]:checked').forEach(el => {
                facilities.push(el.value);
            })

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                var myModal = document.getElementById("edit-room");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Room data edited!");
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert("error", "Server down! " + this.responseText);
                }
            };
            xhr.send(data);
        }


        function edit_details(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);
                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc'].value = data.roomdata.description;
                edit_room_form.elements['room_id'].value = data.roomdata.id;


                edit_room_form.querySelectorAll('[name="features[]"]').forEach(el => {
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });

                edit_room_form.querySelectorAll('[name="facilities[]"]').forEach(el => {
                    if (data.facilities.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });


            };
            xhr.send('get_room=' + id);
        }


        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Status toggle!')
                    get_all_rooms();
                } else {
                    alert('success', 'Server down!')
                }

            };
            xhr.send('toggle_status=' + id + '&value=' + val);
        }

        window.onload = function() {
            get_all_rooms();
        }
    </script>

</body>

</html>