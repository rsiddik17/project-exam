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
    <title>Admin - Features & Facilities</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-white">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4">Features & Facilities</h4>

                <div id="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

                <!-- Feature section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feature-setting">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <!-- Facilities section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#facility-setting">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facility-data">



                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <!-- Feature Modal -->
                <div class="modal fade" id="feature-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" id="feature-setting-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Feature</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="feature_name" class="form-label">Name</label>
                                        <input type="text" id="feature_name_inp" name="feature_name" class="form-control shadow-none" required>
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

                <!-- Facilitiy Modal -->
                <div class="modal fade" id="facility-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" id="facility-setting-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facilitiy</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="facility_name" class="form-label">Name</label>
                                        <input type="text" id="facility_name" name="facility_name" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="facility_icon" class="form-label">Icon</label>
                                        <input type="file" id="facility_icon" name="facility_icon" accept=".png" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="facility_desc" class="form-label">Description</label>
                                        <textarea class="form-control shadow-none" id="facility_desc" name="facility_desc" rows="3" required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
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
        let feature_setting_form = document.getElementById("feature-setting-form");
        let facility_setting_form = document.getElementById("facility-setting-form");
        let feature_name_inp = document.getElementById("feature_name_inp");

        feature_setting_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_feature();
        });

        function add_feature() {
            let data = new FormData();
            data.append("name", feature_setting_form.elements['feature_name'].value);
            data.append("add_feature", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                var myModal = document.getElementById("feature-setting");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "New feature added!");
                    feature_setting_form.elements['feature_name'].value = '';
                    get_features();
                } else {
                    alert("error", "Server down!");
                }
            };
            xhr.send(data);
        }

        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("features-data").innerHTML = this.responseText;
            };

            xhr.send("get_features");
        }

        function rem_feature(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Feature removed!");
                    get_features();
                } else if (this.responseText == 'room_added') {
                    alert("error", "Feature is added in room!");
                } else {
                    alert("error", "Server down!");
                }
            };

            xhr.send("rem_feature=" + val);
        }


        facility_setting_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_facility();
        });

        function add_facility() {
            let data = new FormData();
            data.append("name", facility_setting_form.elements['facility_name'].value);
            data.append("icon", facility_setting_form.elements['facility_icon'].files[0]);
            data.append("desc", facility_setting_form.elements['facility_desc'].value);
            data.append("add_facility", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                var myModal = document.getElementById("facility-setting");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == "invalid_img") {
                    alert("error", "Only PNG images are allowed!");
                } else if (this.responseText == "invalid_size") {
                    alert("error", "Image Should be less than 1MB!");
                } else if (this.responseText == "update_failed") {
                    alert("error", "Image upload failed. Server Down!");
                } else {
                    alert("success", "New facility added!");
                    facility_setting_form.reset();
                    get_facility();
                }
            };
            xhr.send(data);
        }

        function get_facility() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("facility-data").innerHTML = this.responseText;
            };

            xhr.send("get_facility");
        }

        function rem_facility(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Facility removed!");
                    get_facility();
                } else if (this.responseText == 'room_added') {
                    alert("error", "Facility is added in room!");
                } else {
                    alert("error", "Server down!");
                }
            };

            xhr.send("rem_facility=" + val);
        }


        window.onload = function() {
            get_features();
            get_facility();
        };
    </script>

</body>

</html>