<?php
include resource_path('views/includes/top-header.php');
?>
<?php
include resource_path('views/includes/header.php');
?>

<section class="construct_owl_slider">
    <div class="owl-carousel ">
        <div class="item" data-hash="slider_img1">
            <figure style="background-image:url('<?= isset($company->cover_image) ? asset($company->cover_image) : asset('public/images/images.png'); ?>"></figure>
        </div>
        <!--        <div class="item" data-hash="slider_im"></figure>
                </div>
                <div class="item" data-hash="slider_img3">
                    <figure style="background-image:url('"></figure>
                </div>
                <div class="item" data-hash="slider_img4">
                    <figure style="background-image:url('"></figure>
                </div>
                <div class="item" data-hash="slider_img5">
                    <figure style="background-image:url('"></figure>
                </div>-->

    </div>
</section>
<section class="home_navs">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="home_left">
                    <input id="companyId" type="hidden" value="<?= $company->id; ?>">
                    <div class="home_left_img">
                        <img src="<?= asset($company->profile_image); ?>" alt="rectangle.png">
                    </div>
                    <div class="home_left_head">
                        <h2><?= $company->first_name ?> <?= $company->last_name ?>
                            <!--                                   <a href="#" data-toggle="tooltip" data-placement="top" title="Verified Company">-->
                            <!--                                   <a href="javascript:void();" data-toggle="tooltip" data-placement="top" title="Verified Company">-->
                            <?php if ($company->is_verified == 1) { ?>
                                <img src="<?= asset('userassets/images/verified.svg'); ?>" alt="verified">
                            <?php } ?>
                            <!--</a>-->
                        </h2>
                    </div>
                    <?php if (Auth::user()) { ?>
                        <div class="home_left_btns">
                            <?php if (empty($save)) { ?>
                                <a href="<?= asset('save_company/' . $company->id); ?>" class="btn btn_sm_grey"><img src="<?= asset('userassets/images/favorites.svg'); ?>" alt="favorites">Save</a>
                            <?php } else { ?>
                                <a href="<?= asset('/unsave_company/' . $company->id . '/' . 'company') ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                            <?php } if (empty($contact)) { ?>
                                <button data-toggle="modal" data-target="#contact-person" class="btn btn_sm_green">Contact</button>
                            <?php } else { ?>
                                <button  class="btn btn_sm_green">Contacted</button>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="home_left_cont_info">
                        <div class="address">
                            <i class="fa fa-map-marker" aria-hidden="true"></i><span><?= $company->home_address ?>.
                            </span>
                        </div>
                        <div class="email">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i><span><?= $company->email ?></span>
                        </div>
                    </div>
                    <div class="home_left_icons">
                        <?php
                        if (isset($company->getCompanyDetail)) {
                            if (isset($company->getCompanyDetail->fb_link)) {
                                ?>
                                <a target="_blank" href="<?= asset($company->getCompanyDetail->fb_link); ?>">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            <?php } if (isset($company->getCompanyDetail->insta_link)) { ?>
                                <a target="_blank" href="<?= asset($company->getCompanyDetail->insta_link); ?>">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            <?php } if (isset($company->getCompanyDetail->linkedin_link)) { ?>
                                <a target="_blank" href="<?= asset($company->getCompanyDetail->linkedin_link); ?>">
                                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                </a>
                            <?php } if (isset($company->getCompanyDetail->twitter_link)) { ?>
                                <a target="_blank" href="<?= asset($company->getCompanyDetail->twitter_link); ?>">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            <?php } if (isset($company->getCompanyDetail->website)) { ?>
                                <a target="_blank" href="<?= asset($company->getCompanyDetail->website); ?>">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <!-- Nav tabs -->
                <button class="btn_contractor">Contractor Tabs</button>
                <div class="search_menu_overlay" style="display: none;"></div>
                <ul class="nav nav-tabs mobile_nav_tabs" role="tablist">
                    <button type="button" class="close-modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <?php if (isset($company) && $company->getGeneralContractor) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($tab == 'default') ? 'active' : ''; ?>" data-toggle="tab"  href="#general_Contractor">General Contractor</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getSubContractor) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#subcontractor">Subcontractor</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getSupplier) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#supplier">Supplier</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getProfessional) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#professional">Professional </a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getOwner) { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#owner">Owner</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getProducts->isEmpty()) { ?>

                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#store">Store</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($company) && $company->getProjects->isEmpty()) { ?>

                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#projects">Projects</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?= ($tab == 'sort') ? 'active' : ''; ?>" data-toggle='tab' href="#reviews">Reviews</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php include resource_path('views/includes/messages.php'); ?>
                    <?php include resource_path('views/home/tabs/general_contractor_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/sub_contractor_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/supplier_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/professional_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/owner_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/store_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/projects_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/about_tab.php'); ?>
                    <?php include resource_path('views/home/tabs/reviews_tab.php'); ?>





                    <!--                            <div id="result">
                    
                                                </div>-->


                    <!--</div>-->




                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="contact-person">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Contact <?= $company->first_name; ?></h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">

                <form class="quote-form" action="<?= asset('post_contact_company'); ?>" id="contact_company" method="POST" >
                    <?= csrf_field(); ?>
                    <h6>Your Contact Info</h6>
                    <div class="form-group">
                        <input type="hidden" name = "company_id" value="<?= $company->id ?>">
                        <input type="email" class="form-control general-field" value="<?= isset(Auth::user()->email) ? Auth::user()->email : '' ?>" name="email" placeholder="Email" disabled />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" value="<?= isset(Auth::user()->first_name) ? Auth::user()->first_name : '' ?>" class="form-control general-field" name="first_name" placeholder="First Name" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" value="<?= isset(Auth::user()->last_name) ? Auth::user()->last_name : '' ?>" class="form-control general-field" name="last_name" placeholder="Last Name" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= isset(Auth::user()->phone) ? Auth::user()->phone : '' ?>"class="form-control general-field" name="phone" placeholder="Phone"  />
                    </div>
                    <div class="form-group">
                        <textarea rows="4" class="form-control general-field" name="details" placeholder="Write here..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn_sm_green contact_form">Get Started</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include resource_path('views/includes/footer.php');
?>
<?php
include resource_path('views/includes/bottom-footer.php');
?>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>

    $('body').on('change', '.reviews', function (event) {
        event.preventDefault();
        $('#reviewform').submit();
    });
    $('body').on('click', '.service_quote', function () {
        var id = $(this).data('id');
        var title = $('#service_quote_title' + id).val();
        var service_id = $('#service_quote_id' + id).val();
        var cost_start = $('#service_quote_cost_start' + id).val();
        var cost_end = $('#service_quote_cost_end' + id).val();
        var loation = $('#service_quote_location' + id).val();
        var image = $('#service_quote_image' + id).val();
        var path = '<?= asset('') ?>' + image;

        if (image) {
            $('#quote_image').attr('src', path);
        } else {
            $('#quote_image').attr('src', '<?= asset('public/images/images.png') ?>');
        }

        $('#quote_title').html(title);
        $('#quote_service_id').val(service_id);
        $('#quote_location').html(loation);
        $('#quote_job_cost').html('$' + cost_start + '-$' + cost_end);
        //        event.preventDefault();
        //         $('#reviewform').submit();
    });
    $('body').on('click', '.sc_service_quote', function () {
        var id = $(this).data('id');
        var title = $('#sc_service_quote_title' + id).val();
        var service_id = $('#sc_service_quote_id' + id).val();
        var cost_start = $('#sc_service_quote_cost_start' + id).val();
        var cost_end = $('#sc_service_quote_cost_end' + id).val();
        var loation = $('#sc_service_quote_location' + id).val();
        var image = $('#sc_service_quote_image' + id).val();
        var path = '<?= asset('') ?>' + image;

        if (image) {
            $('#quote_image').attr('src', path);
        } else {
            $('#quote_image').attr('src', '<?= asset('public/images/images.png') ?>');
        }

        $('#quote_title').html(title);
        $('#quote_service_id').val(service_id);
        $('#quote_location').html(loation);
        $('#quote_job_cost').html('$' + cost_start + '-$' + cost_end);
        //        event.preventDefault();
        //         $('#reviewform').submit();
    });
    $('body').on('click', '.supplier_service_quote', function () {
        var id = $(this).data('id');
        var title = $('#supplier_service_quote_title' + id).val();
        var service_id = $('#supplier_service_quote_id' + id).val();
        var cost_start = $('#supplier_service_quote_cost_start' + id).val();
        var cost_end = $('#supplier_service_quote_cost_end' + id).val();
        var loation = $('#supplier_service_quote_location' + id).val();
        var image = $('#supplier_service_quote_image' + id).val();
        var path = '<?= asset('') ?>' + image;

        if (image) {
            $('#quote_image').attr('src', path);
        } else {
            $('#quote_image').attr('src', '<?= asset('public/images/images.png') ?>');
        }

        $('#quote_title').html(title);
        $('#quote_service_id').val(service_id);
        $('#quote_location').html(loation);
        $('#quote_job_cost').html('$' + cost_start + '-$' + cost_end);
        //        event.preventDefault();
        //         $('#reviewform').submit();
    });
    $('body').on('click', '.prof_service_quote', function () {
        var id = $(this).data('id');
        var title = $('#prof_service_quote_title' + id).val();
        var service_id = $('#prof_service_quote_id' + id).val();
        var cost_start = $('#prof_service_quote_cost_start' + id).val();
        var cost_end = $('#prof_service_quote_cost_end' + id).val();
        var loation = $('#prof_service_quote_location' + id).val();
        var image = $('#prof_service_quote_image' + id).val();
        var path = '<?= asset('') ?>' + image;

        if (image) {
            $('#quote_image').attr('src', path);
        } else {
            $('#quote_image').attr('src', '<?= asset('public/images/images.png') ?>');
        }

        $('#quote_title').html(title);
        $('#quote_service_id').val(service_id);
        $('#quote_location').html(loation);
        $('#quote_job_cost').html('$' + cost_start + '-$' + cost_end);
        //        event.preventDefault();
        //         $('#reviewform').submit();
    });
    $('body').on('click', '.owner_service_quote', function () {
        var id = $(this).data('id');
        var title = $('#owner_service_quote_title' + id).val();
        var service_id = $('#owner_service_quote_id' + id).val();
        var cost_start = $('#owner_service_quote_cost_start' + id).val();
        var cost_end = $('#owner_service_quote_cost_end' + id).val();
        var loation = $('#owner_service_quote_location' + id).val();
        var image = $('#owner_service_quote_image' + id).val();
        var path = '<?= asset('') ?>' + image;

        if (image) {
            $('#quote_image').attr('src', path);
        } else {
            $('#quote_image').attr('src', '<?= asset('public/images/images.png') ?>');
        }

        $('#quote_title').html(title);
        $('#quote_service_id').val(service_id);
        $('#quote_location').html(loation);
        $('#quote_job_cost').html('$' + cost_start + '-$' + cost_end);
        //        event.preventDefault();
        //         $('#reviewform').submit();
    });
    function initMap() {
        var $maps = $('.embedmap');
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('store_location')),
                {types: ['geocode']});

        $.each($maps, function (i, value) {
            var uluru = {lat: parseFloat($(value).attr('lat')), lng: parseFloat($(value).attr('lng'))};

            console.log($(value).attr('lat'));
            var mapDivId = $(value).attr('id');
            console.log(mapDivId);
            maps = new google.maps.Map(document.getElementById(mapDivId), {
                zoom: 12,
                center: uluru

            });

            markers = new google.maps.Marker({
                position: uluru,
                map: maps
            });
        })
        autocomplete.addListener('place_changed', fillInAddress);
    }
    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#latt').val(lat);
        $('#lngg').val(lng);
    }
    //function initMap() {
    //  // The location of Uluru
    //  var uluru = {lat: -25.344, lng: 131.036};
    //  // The map, centered at Uluru
    //  var map = new google.maps.Map(
    //      document.getElementById('map'), {zoom: 4, center: uluru});
    //  // The marker, positioned at Uluru
    //  var marker = new google.maps.Marker({position: uluru, map: map});
    //}

    //    $('.owl-carousel').owlCarousel({
    //        items: 1,
    //        loop: false,
    //        center: true,
    //        margin: 10,
    //        onInitialized: makePages,
    //        onTranslated: makePages,
    //
    //    });


    $('.store_location').on('keypress', function (e) {
        //        alert('jdfbhb');
        if (e.which == 13) {
            //        alert('You pressed enter!');
            lattt = $('#latt').val();
            lnggg = $('#lngg').val();
            id = $('#companyId').val();
                
                
            $('#preloader').show();
            $.ajax({
                type: 'Get',
                url: '<?= asset('store_search_location'); ?>',
                data: {'lat': lattt, 'lng': lnggg, 'company_id': id},
                success: function (data) {
//                    console.log(data);
                    data = JSON.parse(data);
                    $('#preloader').hide();
                    $('#result').appendTo('.main-store').html(data.view);
                    $("#search").remove();
                },
                error: function () {
                    alert('error');
                }

            });
        }
//alert('vsdgshd');


    });
    $(document).ready(function () {
//         contact_company
        $('body').on('click', '.contact_form', function () {

            $form = $(this).parents('form');
            $this = $(this);
            console.log($form);
//                                    Form
//                                    validation
            $form.validate({
                rules: {
                    email: {
                        required: true,
                    },
                    first_name: {
                        required: true,

                    },
                    last_name: {
                        required: true,

                    },
                    phone: {
                        required: true,

                    },
                    details: {
                        required: true,

                    }

                },
                messages: {
                    email: "Please enter Email",
                    first_name: "Please enter first name",
                    last_name: "Please enter last name",
                    phone: "Please enter phone",
                    details: "Please enter details"
                },

                submitHandler: function (form) {
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
                            $('#success_message').show();
                            $('#message_to_append').html(data.message);
//                            $('.update_project_li' + id).remove();
                            setTimeout(function () {
                                $('#success_message').hide();
                            }, 3000);
                            setTimeout(function () {
                                window.location.reload(1);
                            }, 3000);

                        },
                        error: function (data) {
                            $('#preloader').hide();
                            $('#delete_message').show();
                            $('#message_to_append_error').html('Sorry Something went wrong');
                            setTimeout(function () {
                                $('#delete_message').hide();
                            }, 3000);
                        }
                    });
                }

            });
        });
    });
    function makePages() {
        $(".owl-carousel .item").each(function (i) {
            $image = $(this).find('figure').css('background-image');

            $('.owl-dots .owl-dot span').eq(i)
                    .css({
                        'background-image': $image,
                        'background-size': 'cover'
                    })
        });


    }
    jQuery('.btn_contractor').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery('.search_menu_overlay').show();
    });
    jQuery('.search_menu_overlay').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery(this).hide();
    });
    jQuery('.nav.nav-tabs.mobile_nav_tabs .close-modal').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery('.search_menu_overlay').hide();
    });

    function myFunction(x) {
        if (x.matches) { // If media query matches
            jQuery('.nav.nav-tabs.mobile_nav_tabs li a').click(function () {
                jQuery('html').toggleClass('openfilter');
                jQuery('.search_menu_overlay').hide();
            });
        } else {
//               document.body.style.backgroundColor = "pink";
        }
    }

    var x = window.matchMedia("(max-width: 767px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initMap" async defer></script> 