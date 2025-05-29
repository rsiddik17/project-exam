<?php

require('inc/essentials.php');
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Setting</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-white">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h4 class="mb-4">Setting</h4>

                <div id="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050;"></div>

                <!-- General Settings section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#general-setting">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!-- General Setting Modal -->
                <div class="modal fade" id="general-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" id="general-setting-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="site_title" class="form-label">Site Title</label>
                                        <input type="text" id="site_title_inp" name="site_title" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="site_about" class="form-label">About Us</label>
                                        <textarea id="site_about_inp" name="site_about" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form action="">
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" role="switch" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text">
                            No customers will be allowed to book hotel room, when shutdown mode is turn on.
                        </p>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-setting">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone1"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter-x me-1"></i>
                                        <span id="tw"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram me-1"></i>
                                        <span id="insta"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook me-1"></i>
                                        <span id="fb"></span>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Iframe</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- Contact Setting Modal -->
                <div class="modal fade" id="contact-setting" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="" id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contacts Settings</h5>
                                </div>

                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" id="address_inp" name="address" class="form-control shadow-none" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="gmap" class="form-label">Google Map Link</label>
                                                    <input type="text" id="gmap_inp" name="gmap" class="form-control shadow-none" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone1" class="form-label">Phone Numbers</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="text" id="phone1_inp" name="phone1" class="form-control shadow-none" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email_inp" name="email" class="form-control shadow-none" required>
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                                        <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                                        <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                                        <input type="text" name="tw" id="tw_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">iFrame Src</label>
                                                        <input type="text" id="iframe_inp" name="iframe" class="form-control shadow-none" required>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
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
        let general_data, contacts_data;

        let general_setting_form = document.getElementById('general-setting-form');
        let site_title_inp = document.getElementById('site_title_inp');
        let site_about_inp = document.getElementById('site_about_inp');
        
        let contacts_s_form = document.getElementById('contacts_s_form');


        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');

            let shutdown_toggle = document.getElementById('shutdown-toggle');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting_crud.php", true)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {
                general_data = JSON.parse(this.responseText);

                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_inp.value = general_data.site_title;
                site_about_inp.value = general_data.site_about;

                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                } else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }


            xhr.send('get_general');
        }


        general_setting_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value);
        })


        function upd_general(site_title_val, site_about_val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting_crud.php", true)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {
                console.log(this.responseText);

                var myModal = document.getElementById('general-setting');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'Change saved!');
                    get_general();
                } else {
                    alert('error', 'No change made!');
                }
            }
            xhr.send('site_title=' + site_title_val + '&site_about=' + site_about_val + '&upd_general');
        }


        function upd_shutdown(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting_crud.php", true)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {

                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert('success', 'Site has been shutdown!');
                } else {
                    alert('success', 'Shutdown mode!');
                }
                get_general();
            }


            xhr.send('upd_shutdown=' + val);
        }


        function get_contacts() {
            let contacts_p_id = ['address', 'gmap', 'phone1', 'email', 'tw', 'insta', 'fb', 'iframe'];
            let iframe = document.getElementById('iframe');


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting_crud.php", true)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {
                contacts_data = JSON.parse(this.responseText);
                contacts_data = Object.values(contacts_data);

                for (let i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
                }

                iframe.src = contacts_data[8];
                contacts_inp(contacts_data);
            }


            xhr.send('get_contacts')
        }

        function contacts_inp(data){
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'phone1_inp', 'email_inp', 'tw_inp', 'insta_inp', 'fb_inp', 'iframe_inp'];

            for(i=0;i<contacts_inp_id.length;i++){
                document.getElementById(contacts_inp_id[i]).value = data[i+1];
            }
        }

        contacts_s_form.addEventListener('submit',function(e){
            e.preventDefault();
            upd_contacts();
        })

        function upd_contacts(){
            let index = ['address', 'gmap', 'phone1', 'email', 'tw', 'insta', 'fb', 'iframe'];
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'phone1_inp', 'email_inp', 'tw_inp', 'insta_inp', 'fb_inp', 'iframe_inp'];

            let data_str="";

            for(i=0;i<index.length;i++){
                data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
            }
            
            data_str += "upd_contacts";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting_crud.php", true)
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                var myModal = document.getElementById('contact-setting');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'Changes saved');
                    get_contacts();
                } else {
                    alert('error', 'No changes made');
                }
            }

            xhr.send(data_str);
        }


        window.onload = function() {
            get_general();
            get_contacts();
        }
    </script>
</body>

</html>