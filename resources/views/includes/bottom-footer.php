<div id="preloader" class="preloader" style="display:none">
    <img src="<?= asset('userassets/images/loader.gif') ?>"/>
</div>
<div class="flash_message" id="success_message">
    <i class="flash_close">×</i>

    <a href="#">
        <div class="msg_body">
            <div class="">
                <div>
                    <p class="mb-0" id="message_to_append"> Record Delete Successfully</p>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="flash_message delete_msgs" id="delete_message">
    <i class="flash_close">×</i>

    <a href="#">
        <div class="msg_body">
            <div class="">
                <div>
                    <p class="mb-0"  id="message_to_append_error"> Record Add Successfully</p>
                </div>
            </div>
        </div>
    </a>
</div>
<script src="<?= asset('userassets/js/jquery3.3.1.min.js'); ?>"></script> 
<script src="<?= asset('public/js/pagination.min.js'); ?>"></script>
<script src="<?= asset('public/js/pagination.js'); ?>"></script>
<script src="<?= asset('userassets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= asset('userassets/js/owl.js'); ?>"></script> 
<script src="<?= asset('userassets/js/all.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://hernansartorio.com/jquery-nice-select/js/fastclick.js"></script>
<script src="https://hernansartorio.com/jquery-nice-select/js/prism.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>   
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://hernansartorio.com/jquery-nice-select/js/jquery.nice-select.min.js"></script> 
<script src="<?=asset('userassets/src/jquery.star-rating-svg.js');?>"></script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/core.js"></script>-->

<script>
//        $('#search_company_auth').on('keypress',function(e) {
//    if(e.which == 13) {

//       company_name =  $(this).val();
//       $.ajax({
//          type:'Post',
//          url:"<?// asset('post_job_search');?>",
//          data:{'search_company':company_name,'_token':'<? csrf_token();?>'},
//          success: function(data){
//              console.log(data);
//          },
//           error: function(){

//           }
//       });
//       
//
//    }
//    });
//  $(".my-rating-9").starRating({
//    initialRating: 3.5,
//    disableAfterRate: false,
//    onHover: function(currentIndex, currentRating, $el){
//      $('.live-rating').text(currentIndex);
//    },
//    onLeave: function(currentIndex, currentRating, $el){
//      $('.live-rating').text(currentRating);
//    }
//  });
  $(".my-rating-9").starRating({
    initialRating: 3.5,
    ratedColor :'#ebaf0c' ,
    disableAfterRate: false,
    onHover: function(currentIndex, currentRating, $el){
      console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
      $('.live-rating').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
      $('.live-rating').text(currentRating);
      $('#rating').val(currentRating);
    }
  });
    $('#find_job').on('keypress', function (e) {
        if (e.which == 13) {

            company_name = $(this).val();
            $('#searc_job').submit();
//       $.ajax({
//          type:'Post',
//          url:"<?ph= asset('post_job_search');?>",
//          data:{'search_company_':company_name,'_token':'<? csrf_token();?>'},
//          success: function(data){
//              console.log(data);
//          },
//           error: function(){

//           }
//       });


        }
    });
    $('#search_company_guest').on('keypress', function (e) {
        if (e.which == 13) {
            $('#search_job_guest').submit();



        }
    });
    
    $('#post_job').on('click',function(){
//        alert('here');
       $('#create_profile').hide(); 
    });
    $(document).ready(function () {
        $('select').niceSelect();
        $("#phone").intlTelInput();
        $('.profile-menu').click(function (e) {
            e.preventDefault(); // stops link from making page jump to the top
            e.stopPropagation();
            $('.user-menu').slideToggle();
        });
        $('body').click(function (e) {
            $('.user-menu').hide();
        });
        $('.browse-category').click(function (e) {
            e.preventDefault(); // stops link from making page jump to the top
            e.stopPropagation();
            $('.mega-menu').slideToggle();
        });
        $('body').click(function (e) {
            $('.mega-menu').hide();
        });
        $('.menu-icons').click(function () {
            $('.login-menu').slideToggle();
        });
    });



</script>
<script>
    $(document).ready(function () {
           $('#service_quote').validate({// initialize the plugin
            rules: {
                first_name: {
                    required: true,
                },
                 last_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
               phone : {
                    required: true,

                },

                description: {
//               phoneUS: true,
                    required: true,
//               minlength: 9,
//               maxlength: 12,
//               number : true,

                },

//            profile_image: {
//                extension: "xls|csv",
//            },
            }, submitHandler: function (form) {
                $('#preloader').show();
                form.submit();

            }
        });
        $('body').on('click', '.register', function () {
            $form = $(this).parents('form');
            $this = $(this);

            //Form validation
            $form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"

                    }
                }
                , messages: {
                    password: {
                        required: "",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    email: {
                        required: "",
                        email: ""
                    },
                    password_confirmation: {
                        required: "",
                        equalTo: "Please enter the same password as above"
                    }
                }, submitHandler: function (form) {
                    $('#register').attr("disabled", true);
                    $('#preloader').show();

                    var formData = new FormData($form[0]);
                    $.ajax({
                        type: "POST",
                        url: $form.attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            $('#preloader').hide();
                            if (data.success) {
                                $('.ajax-label').show();
                                $(".ajax-label").removeClass("alert-danger");
                                $(".ajax-label").addClass("alert-success");
                                $(".ajax-label-body").html(data.message);
                                setTimeout(function () {
                                    location.reload()
                                }, 3000)

                            } else {
                                $('ul li:first-child').remove();
                                $("#show_message_register ul").append('<li><div class="alert alert-danger  in alert-dismissible ajax-label" ><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><span class="ajax-label-body">' + data.message + '</span></div></li>');

                            }
                        },
                        error: function (data) {
                            $('#preloader').hide();

                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                        }
                    });
                }

            });
        }); //End save label function

        $('body').on('click', '.reset', function () {
            $form = $(this).parents('form');
            $this = $(this);
            //Form validation
            $form.validate({
                rules: {
                    email: {
                        required: true,
                    },

                },
                messages: {
                    email: "Please enter email",

                }, submitHandler: function (form) {
                    $('#reset').attr("disabled", true);
                    var formData = new FormData($form[0]);
                    $('#preloader').show();
                    $.ajax({
                        type: "POST",
                        url: $form.attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',

                        success: function (data) {
                            $('#preloader').hide();
                            if (data.success) {
                                url = "<?= asset('/') ?>";
                                $('#reset').attr("disabled", false);
                                $('.ajax-label').show();
                                $(".ajax-label").removeClass("alert-danger");
                                $(".ajax-label").addClass("alert-success");
                                $(".ajax-label-body").html(data.message);
                                window.location.href = url;

                            } else {
                                $('#reset').attr("disabled", false);

                                $('.ajax-label').show();
                                $(".ajax-label").addClass("alert-danger");
                                $(".ajax-label").removeClass("alert-success");
                                $(".ajax-label-body").html(data.message);
                            }
                        },
                        error: function (data) {
                            $('#preloader').hide();
                            $('#reset').attr("disabled", true);
                            ;
                            $('.ajax-label').show();
                            var response = $.parseJSON(data.responseText);
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                        }
                    });
                }

            });
        }); //End save label function
        //Form validation
        $('body').on('click', '.reset_password', function () {
            $form = $(this).parents('form');
            $this = $(this);
            //Form validation
            $form.validate({
                rules: {
                    reset_password: {
                        required: true,
                        minlength: 6
                    },
                    reset_confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#reset_confirm_password"

                    },

                },
                messages: {
                    reset_password: "Please enter password",
                    reset_confirm_password: "password does not match"

                }, submitHandler: function (form) {
                    $('#preloader').show();
                    var formData = new FormData($form[0]);
                    $.ajax({
                        type: "POST",
                        url: $form.attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',

                        success: function (data) {
                            $('#preloader').hide();
                            if (data.success) {
//                       
                                $('.ajax-label').show();
                                $(".ajax-label").addClass("alert-success");
                                $(".ajax-label").removeClass("alert-danger");

                                $(".ajax-label-body").html(data.message);
                                url = "<?= asset('/') ?>";
                                  setTimeout(function () {
                                    window.location.href = url;
                                }, 1500)

                                

                            } else {
                                $('.ajax-label').show();
                                $(".ajax-label").addClass("alert-danger");
                                $(".ajax-label").removeClass("alert-success");
                                $(".ajax-label-body").html(data.message);
                                url = "<?= asset('/') ?>";
                                   setTimeout(function () {
                                    window.location.href = url;
                                }, 1500)

                            }
                        },
                        error: function (data) {
                            $('#preloader').hide();
                            $('.ajax-label').show();
                            var response = $.parseJSON(data.responseText);
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                        }
                    });

                }

            });

        }); //End save label function

        $('body').on('click', '.login', function () {

            $form = $(this).parents('form');
            $this = $(this);
            //Form validation
            $form.validate({
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },

                },
                messages: {
                    email: "",
                    password: ""


                }, submitHandler: function (form) {
                    $('#preloader').show();
                    var formData = new FormData($form[0]);
                    $.ajax({
                        type: "POST",
                        url: $form.attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            $('#preloader').hide();
                            if (data.success) {

                                window.location.href = data.redirect;
                            } else {
                                $('ul li:first-child').remove();
                                $("#show_message ul").append('<li><div class="alert alert-danger  in alert-dismissible ajax-label" ><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><span class="ajax-label-body">' + data.message + '</span></div></li>');


                            }
                        },
                        error: function (data) {
                            $('#preloader').hide();
                            $('#login').attr("disabled", false);
                            $('.ajax-label').show();
                            var response = $.parseJSON(data.responseText);
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                        }
                    });
                }

            });
//               if ($form.valid()) {
//
////             $('#login').attr("disabled", true);
//    $('#preloader').show();
//                    var formData = new FormData($form[0]);
//                    
//               }

        });

    });

    function charcherCount(val, len, counter) {
        var max = len;
        var min = 0;
        var len = val.value.length;
        if (len >= max) {
            val.value = val.value.substring(min, max);
            $('.' + counter).html(len + '/' + max);
        } else {
            $('.' + counter).html(len + '/' + max);
        }
    }


</script>    
<?php if (isset($reset_model_open)) { ?>
    <script>
        $('#resetpassword').modal('show');
    </script>
    <?php
}
?>
<?php if (Session::has('success_login')) { ?>

    <script>
        //                        
        $('#loginmodal').modal('show');
    </script>

<?php } ?>
<?php if (Session::has('open_login')) { ?>

    <script>
        //                        
        $('#loginmodal').modal('show');
    </script>

<?php } ?>
</body>

</html>