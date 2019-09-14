<?php include resource_path('views/includes/top-header.php'); ?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="margin-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="condructor-tabs">
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Home Owner Signup
                                    </h3>
                                </div>
                            </div>
                            <?php include resource_path('views/admin/includes/messages.php'); ?>
                            <form id="register" method='POST' action='post_homeowner'>
                                <?= csrf_field(); ?>
                                <div class="condructor-tabs-body">
                                    <div class="profile-contact">
                                        <div class="row">
                                            <div class="col-sm-10 mx-auto">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                First Name
                                                            </label>
                                                            <input type="text" name='first_name' class="form-control background-field" placeholder="First Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Last Name
                                                            </label>
                                                            <input type="text" name='last_name' class="form-control background-field" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Email
                                                            </label>
                                                            <input id="email" type="email" name='email' class="form-control"  placeholder="jhonsmith@email.com">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Password
                                                            </label>
                                                        </div>
                                                        <input type="password" name='password' class="form-control" id="password"  placeholder="Password">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                Repeat Password
                                                            </label>
                                                        </div>
                                                        <input type="password" name='password_confirmation' class="form-control"  placeholder="Repeat Password">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-6">
                                                        <div class="profile_btn">

                                                            <button type='submit' class="btn btn_sm_green ">Get Started</button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</section>
<?php
include resource_path('views/includes/footer.php');
?>
<?php
include resource_path('views/includes/bottom-footer.php');
?>
<style> 
#register input.error {
                border:solid 1px red !important;
            }
            #register label.error {
                width: auto;
                /*display: none !important;*/
                color:red;
                font-size: 16px;
                float:right;
            }
</style>
<script>
    $(document).ready(function(){
       $('#create_profile').hide(); 
    });
        $('body').on('click', '.show_loader', function () {
       
 $('#preloader').show();
     
    });
    $("#upload-img").on("change", function () {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".profile-logo").css("background-image", "url(" + this.result + ")");
                $('.profile-logo').empty();
            };
        }
    });
    $("#register").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo asset('authenticate_email_validate'); ?>",
                    type: "GET",
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {

//                                    $('#errormessage').show();
                    }
                }
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },

            first_name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            last_name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        }, messages: {
            password: {
                required: "",
                minlength: "Your password must be at least 6 characters long"
            },
            first_name: {
                required: ""
            },
            last_name: {
                required: ""
            },
            email: {
                required: "",
                email: "",
                remote: "The Given Email was already Taken."
            },
            password_confirmation: {
                required: "",
                equalTo: "Please enter the same password as above"
            }
        }
    });
</script>