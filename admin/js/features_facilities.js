let feature_setting_form = document.getElementById("feature-setting-form");
let facility_setting_form = document.getElementById("facility-setting-form");
let feature_name_inp = document.getElementById("feature_name_inp");

feature_setting_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_feature();
});

function add_feature() {
  let data = new FormData();
  data.append("name", feature_setting_form.elements["feature_name"].value);
  data.append("add_feature", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);

  xhr.onload = function () {
    console.log(this.responseText);

    var myModal = document.getElementById("feature-setting");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert("success", "New feature added!");
      feature_setting_form.elements["feature_name"].value = "";
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

  xhr.onload = function () {
    document.getElementById("features-data").innerHTML = this.responseText;
  };

  xhr.send("get_features");
}

function rem_feature(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Feature removed!");
      get_features();
    } else if (this.responseText == "room_added") {
      alert("error", "Feature is added in room!");
    } else {
      alert("error", "Server down!");
    }
  };

  xhr.send("rem_feature=" + val);
}

facility_setting_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_facility();
});

function add_facility() {
  let data = new FormData();
  data.append("name", facility_setting_form.elements["facility_name"].value);
  data.append("icon", facility_setting_form.elements["facility_icon"].files[0]);
  data.append("desc", facility_setting_form.elements["facility_desc"].value);
  data.append("add_facility", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);

  xhr.onload = function () {
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

  xhr.onload = function () {
    document.getElementById("facility-data").innerHTML = this.responseText;
  };

  xhr.send("get_facility");
}

function rem_facility(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Facility removed!");
      get_facility();
    } else if (this.responseText == "room_added") {
      alert("error", "Facility is added in room!");
    } else {
      alert("error", "Server down!");
    }
  };

  xhr.send("rem_facility=" + val);
}

window.onload = function () {
  get_features();
  get_facility();
};
