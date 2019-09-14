<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="company-dashboard margin-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-tabs">
                    <h6>Account</h6>
                   <ul class="nav nav-tabs" id="" role="tablist">
                        
                        <li class="nav-item">
                            <a class="<?= (isset($tab_id) && $tab_id == '' ) ? 'active': ''?>" href="#profile" id="topnav" data-toggle="tab"><img src="<?= asset('userassets/images/personal.png'); ?>"/><span>Homeowner Information</span></a>
                        </li>
                        <li class="nav-item">
                            <a  href="#login_password" class="<?= (isset($tab_id) && $tab_id=='loginpassword') ? 'active': ''?>" id="logging" data-toggle="tab"><img src="<?= asset('userassets/images/password.png'); ?>"/><span>Login & Password</span></a>
                        </li>
                     
                        <li class="nav-item">
                            <a  href="#email_notfications" class="<?= (isset($tab_id) && $tab_id=='email_notfications') ? 'active': ''?>" data-toggle="tab"><img src="<?= asset('userassets/images/email.png'); ?>"/><span>Email & Notfications</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane <?= (isset($tab_id) && $tab_id=='') ? 'active': ''?> mobileactive" id="profile" role="tabpanel">
                        <div class="condructor-tabs">
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Personal Information
                                    </h3>
                                </div> 
                            </div>
                            <form id="my_profile" method="POST" action="<?= asset('my_profile') ?>" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="condructor-tabs-body">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="profile-logo" style="background-image: url('<?= (isset($result)) ? $result->profile_image : '' ?>')">
                                                <label for="uploadd-img">
                                                    <i class="fa fa-camera" aria-hidden="true"></i>

                                                    <h6>
                                                        Upload Logo
                                                    </h6>
                                                </label>
                                                <input type="file" name="profile_image"  id="uploadd-img" style="display:none;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-contact">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="green-title">
                                                    <h5>Tell us a little about you</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        First Name
                                                    </label>
                                                    <input value="<?= $result->first_name ?>" name="first_name" required="" type="text" class="form-control background-field" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        Last Name
                                                    </label>
                                                    <input type="text" name="last_name" value="<?= $result->last_name ?>" class="form-control background-field" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <input type="email" readonly value="<?= $result->email ?>" class="form-control general-field"placeholder="xyz@gmail.com"/>
                                                </div>
                                            </div>
                                            <!--                                    <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <button class="btn btn_sm_tranparent"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                                                    </div>
                                                                                </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        Gender
                                                    </label>
                                                </div>
                                                <div class="genders">
                                                    <div class="form-group custom-radio">
                                                        <input type="radio" value="male" id="1"  name="gender" <?= ($result->gender) ? ($result->gender == 'male') ? 'checked' : '' : '' ?>>
                                                        <label for="1">Male</label>
                                                    </div>
                                                    <div class="form-group custom-radio">
                                                        <input type="radio" value="female" id="2"  name="gender" <?= ($result->gender) ? ($result->gender == 'female') ? 'checked' : '' : '' ?>>
                                                        <label for="2">Female</label>
                                                    </div>
                                                    <div class="form-group custom-radio">
                                                        <input type="radio" value="other" id="3"  name="gender" <?= ($result->gender) ? ($result->gender == 'other') ? 'checked' : '' : '' ?>>
                                                        <label for="3">Other</label>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                        Date of birth
                                                    </label>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="date-year">
                                                    <div class="form-group">
                                                        <select name="day">

                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                <option  value="<?= $i ?>" <?= isset($day)?($day == $i) ? 'selected' : '':'' ?>>
                                                                    <?= $i ?>
                                                                </option>
                                                            <?php } ?>


                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="month">

                                                            <?php
                                                            for ($i = 1; $i <= 12; $i++) {
                                                                $dateObj = DateTime::createFromFormat('!m', $i);
                                                                $monthName = $dateObj->format('F'); // March
                                                                ?>
                                                                <option  value="<?= $i ?>" <?= isset($month)?($month == $i) ? 'selected' : '':'' ?>>
                                                                    <?= $monthName ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="year">

                                                            <?php
                                                            for ($i = 1950; $i <= date("Y"); $i++) {
                                                                ?>
                                                                <option value="<?= $i ?>" <?= isset($year)?($year == $i) ? 'selected' : '':'' ?>>
                                                                <?= $i ?>
                                                                </option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-contact">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="green-title">
                                                    <h5> Address</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                        Address 1
                                                    </label>
                                                    <input type="text"  class="form-control background-field" value="<?= (isset($result)) ? $result->home_address : '' ?>" placeholder="Address Line 1" name="home_address" id="autocomplete" autocomplete="off" >
                                                    <input id="lat" type="text" style="display:none" name="latitude">
                                                    <input id="lng" type="text" style="display:none" name="longitude">
                                                    <input id="lat_two" type="text" style="display:none" name="latitude_two">
                                                    <input id="lng_two" type="text" style="display:none" name="longitude_two">
                                                    <input id="country_code" type="text" style="display:none" name="country_code">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                        Address 2
                                                    </label>
                                                    <input type="text" class="form-control background-field" value="<?= (isset($result)) ? $result->address_2 : '' ?>" placeholder="Address Line 2" name="address_2" id="address_2" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="state-address">
                                                    <div class="form-group city">
                                                        <label>
                                                            Country
                                                        </label>
                                                        <!--<input class="field" id="country" disabled="true"/>-->
                                                        <input id="country" name="country" type="text" class="form-control" placeholder="Country" value=" <?= (isset($result)) ? $result->country : '' ?>" >
    <!--                                                    <select name="country" id="ountry">
                                                            <option><?php // (isset($result))? $result->country:'' ?></option>
                                                            <option>
                                                                USA
                                                            </option>
                                                        </select>-->
                                                    </div>
                                                    <div class="form-group state">
                                                        <label>
                                                            State
                                                        </label>
                                                        <input  name="state" class="form-control" id="administrative_area_level_1" value="<?= (isset($result)) ? $result->state : '' ?>"/>
    <!--                                                    <select   name="state" id="state">
                                                            <option ></option>
                                                            <option>
                                                                Florida
                                                            </option>
                                                        </select>-->
                                                    </div>
                                                    <div class="form-group state">
                                                        <label>
                                                            City
                                                        </label>
                                                        <input id="locality"  name="city" required="" type="text" class="form-control"  value="<?= (isset($result)) ? $result->city : '' ?>">
                                                        <!--<input class="field" id="locality" disabled="true"/>-->
    <!--                                                    <select name="city" id="city">
                                                            <option></option>
                                                            <option>
                                                                Orlando
                                                            </option>
                                                        </select>-->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-contact">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="green-title">
                                                    <h5>Contact</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="">
                                                    <label>
                                                        Phone
                                                    </label>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input name="phone" value="<?= $result->phone ?>" type="text" class="form-control background-field" placeholder="(987) 321 654 987" id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="green-title">
                                                    <h5>Language & Currency</h5>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>
                                                        Default Language
                                                    </label>
                                                    <select name="language">
                                                        <option value="english" <?= ($result->language == 'english') ? 'selected' : '' ?>>
                                                            English
                                                        </option>
                                                        <option value="dutch" <?= ($result->language == 'dutch') ? 'selected' : '' ?>>
                                                            Dutch
                                                        </option>
                                                        <option value="spanish" <?= ($result->language == 'spanish') ? 'selected' : '' ?>>
                                                            Spanish
                                                        </option>
                                                        <option value="german" <?= ($result->language == 'german') ? 'selected' : '' ?>>
                                                            German
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>
                                                        Default Currency
                                                    </label>
                                                    <select name="currency">
                                                        <option value="usd" <?= ($result->currency == 'usd') ? 'selected' : '' ?>>
                                                            USD
                                                        </option>
                                                        <option value="pound" <?= ($result->currency == 'pound') ? 'selected' : '' ?>>
                                                            Pound
                                                        </option>
                                                        <option value="aud" <?= ($result->currency == 'aud') ? 'selected' : '' ?>>
                                                            AUD
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile_btn">

                                    <button type="submit" class="btn btn_sm_blue">Save Changes</button>
                                </div>
                            </form>
                        </div>

                    </div>    
                    <div class="tab-pane  <?= (isset($tab_id) && $tab_id=='loginpassword') ? 'active': ''?>" id="login_password" role="tabpanel">
                        <div class="condructor-tabs">
                            
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Login Password
                                    </h3>
                                </div> 
                            </div>
                            <?php include resource_path('views/includes/messages.php'); ?>
                            <div class="condructor-tabs-body">
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="green-title">
                                            <h5>Password</h5>
                                        </div>
                                    </div>
                                </div>
                                <form id="login_pasword_form"  action="<?=asset('update_password_home')?>" method="post">
                                <?= csrf_field();?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Old Password</label>
                                            <input type="password" name="old_password" id="old_password"  class="form-control general-field"placeholder="Enter a Password"/>
                                            <span style="display:none; color:red;" id="span_old_passowrd">Password incorrect</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Change Password</label>
                                            <input type="password" name="new_password" id="new_password" class="form-control general-field" placeholder="Enter a New Password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control general-field" placeholder="Conferm new  Password"/>
                                        </div>
                                    </div>
                                </div>
                           
                            <div class="profile_btn">
                                <input type="submit" class="btn btn_sm_blue" value="Save Changes">
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>

                  
  <div class="tab-pane <?= (isset($tab_id) && $tab_id=='email&notification') ? 'active': ''?>" id="email_notfications" role="tabpanel">
                        <form method="Post" action="<?= asset('update_email_notification_settings_home')?>">
                                            <?= csrf_field();?>
                        <div class="condructor-tabs">
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Email & Notifications
                                    </h3>
                                </div> 
                            </div>
                            <div class="condructor-tabs-body">
                                <?php include resource_path('views/includes/messages.php'); ?>
                                <div class="email-setting">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="styled-checkbox" id="form_update" name="update_web_notification" type="checkbox" <?= (isset($result) && $result->update_web_notification == '0')? 'checked':''?> />
                                                <label for="form_update">Updates from this website</label>
                                                <p>Announcements, updates, tips & tricks.</p>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="styled-checkbox" id="job_activity" type="checkbox"/>
                                                <label for="job_activity">Activity on my jobs</label>
                                                <p>Someone send proposal on a job you’ve created.</p>
                                            </div>
                                        </div>
                                    </div>-->

                                   <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="styled-checkbox" id="job_activity" name="job_activity" type="checkbox" <?= (isset($result) && $result->activity_on_job == '0')? 'checked':''?>/>
                                                <label for="job_activity">Activity on my jobs</label>
                                                <p>Someone send proposal on a job you’ve created.</p>
                                            </div>
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                            <div class="profile_btn">
                                <button type="submit" class="btn btn_sm_blue">Save Changes</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    #my_profile input.error {
        border:solid 1px red !important;
    }
    #my_profile label.error {
        width: auto;
        /*display: none !important;*/
        color:red;
        font-size: 16px;
        float:right;
    }
</style>
<?php
include resource_path('views/includes/footer.php');
?>
<?php
include resource_path('views/includes/bottom-footer.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>
    $('.mobile-tabs a').click(function () {
        var value = $(this).attr("href");
        $('.mobile-tabs.tabactive').removeClass('tabactive');
        $(this).parent().addClass('tabactive');
        $('.tab-pane.mobileactive').removeClass('mobileactive');
        $('.tab-content').find(value).addClass('mobileactive');
    });
    $("#uploadd-img").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".profile-logo").css("background-image", "url(" + this.result + ")");
//                $('.profile-logo').empty();
            };
        }
    });





    $(document).ready(function () {

        $('body').on('change', '#phone', function () {
            $('#country_code').val($("#phone").intlTelInput("getSelectedCountryData").dialCode);

        });

   $('#old_password').on('change',function(){
//        alert($(this).val());
$('#preloader').show();
        passwrod = $(this).val();
        $.ajax({
           type:"Post",
           url : "<?= asset('check_password_home')?>",
           data: {'password':passwrod ,'_token':'<?= csrf_token();?>'},
           success: function(data){
               $('#preloader').hide();
               if(data == '1'){
                   $('#span_old_passowrd').show();
                   $( "#new_password" ).prop( "disabled", true );
                   $( "#password_confirmation" ).prop( "disabled", true );
               }
               else{
                   $('#span_old_passowrd').hide();
                   $( "#new_password" ).prop( "disabled", false );
                   $( "#password_confirmation" ).prop( "disabled", false );
                   $('#login_pasword_form').validate({ // initialize the plugin
                    rules: {
                        new_password: {
                            required: true,
                            minlength: 6,
                  
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 6,
                            equalTo: "#new_password"

                },
                       } 
                   });
               }
           }, error : function(){
           },
        });
    });
        $('#my_profile').validate({// initialize the plugin
            rules: {
                first_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                home_address: {
                    required: true,

                },

                phone: {
//               phoneUS: true,
                    required: true,
//               minlength: 9,
//               maxlength: 12,
//               number : true,

                },

                detail: {
                    required: true,
//                minlength: 9
                },

//            profile_image: {
//                extension: "xls|csv",
//            },
            }
        });
    });
    var phones = [{"mask": "(###) ###-####"}];
    $('#phone').inputmask({
        mask: phones,
        greedy: false,
        definitions: {'#': {validator: "[0-9]", cardinality: 1}}});

    $('.menu-icon').click(function () {
        $('.cus-sidebar').toggleClass('cus-sidebar-view');
    });

    var testPattern = new RegExp("^(\\+)?(\\d+)$");
    function chkInput() {
        var v = $('#phone').val().charAt($('#phone').val().length - 1);
        return testPattern.test(v);
    }

    $('#phone_no, #fax_number').bind("paste", function (e) {
        e.preventDefault();
    });
    var placeSearch, autocomplete;
    var componentForm = {
//                                                        street_number: 'short_name',
//                                                        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
//                                                        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});
        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                        (document.getElementById('address_2')), {
                    types: ['geocode']});


        // When the user selects an address from the dropdown, populate the address
        // fields in the form.


        autocomplete.addListener('place_changed', fillInAddress);
        autocomplete2.addListener('place_changed', fillInAddress_two);
//                                                         autocomplete2.addListener('place_changed', fillInAddress2);


    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lat').val(lat);
        $('#lng').val(lng);

//                                                        for (var component in componentForm) {
////                                                            alert(document.getElementById(component))
//                                                            document.getElementById(component).value = '';
//                                                            //          document.getElementById(component).disabled = false;
//                                                        } 
//                                                        alert('here');
// 
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
    function fillInAddress_two() {

        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lat_two').val(lat);
        $('#lng_two').val(lng);

//                                                        for (var component in componentForm) {
////                                                            alert(document.getElementById(component))
//                                                            document.getElementById(component).value = '';
//                                                            //          document.getElementById(component).disabled = false;
//                                                        } 
//                                                        alert('here');
// 
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 