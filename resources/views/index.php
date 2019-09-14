
<?php
include 'includes/top-header.php';
?>
<?php
include 'includes/header.php';
?>
<?php include resource_path('views/admin/includes/messages.php'); ?>
<section class='main-banner' >
    <div class='container'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='banner-content'>
                    <h3>
                        For your roofing and siding, quality we’ll be providing!  
                    </h3>
                    <form  action="<?= asset('job_search') ?>"class='banner-search' method="get">
                        <div class='form-group'>
                            <input type="text" name="search_job" class='form-control general-field search-field' placeholder="What service you need?"/>
                            <input type="text" name="location_usa" class='form-control general-field map-field' id="location" placeholder="Location" autocomplete="off"/>
                            <button href="<?= asset('job_search'); ?>" class='btn btn_sm_blue'>Find</button>
                        </div>
                    </form>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
            <div class='col-md-6'>
                <img src="<?= asset('userassets/images/banner.png'); ?>"/>
            </div>
        </div>
    </div>
</section>
<section class="company category-section padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h6 class="main-title">
                        Browse Specialities
                    </h6>
                    <p class="subtitle"></p>
                </div>
                <div class="category owl-carousel">
                    <?php
                    if (isset($speciality)) {
                    foreach ($speciality as $special) {
                    ?>
                    <div class="item">
                        <a href='<?= asset('job_search') . '?' . 'category_job' . '=' . $special->title ?>'>
                            <div class="category-column">
                                <div class='category_img' style="background-image:url('<?= isset($special->image_path) ? asset($special->image_path) : asset('public/images/images.png'); ?>')"></div>
                                <!--<img src="<?= isset($special->image_path) ? asset($special->image_path) : asset('public/images/images.png'); ?>"/>-->

                                <div class='company-title'>
                                    <h6><?= $special->title ?></h6>
                                </div>
                            </div>

                        </a>
                    </div>
                    <?php
                    }
                    } else {
                    ?>
                    <h6>No speciality</h6>
                    <?php } ?>






                </div>
            </div>
        </div>
    </div>
</div>     
</section>
<section class='how-works padding-tb'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='work-title text-center'>
                    <h6>How it works</h6>
                    <h3>
                        We’ll nail your next project because nobody<br/> wants a screw up!
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class='work-steps padding-tb'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-4'>
                    <div class='step1 text-center'>
                        <div class='step-circle'>
                            <span>1</span>
                        </div>
                        <h6>Post Job Services</h6>
                        <p>
                            Therefore, I saw that here was a sort of interregnum in Providence; for its even-handed equity never could 
                        </p>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='step1 text-center'>
                        <div class='step-circle'>
                            <span>2</span>
                        </div>
                        <h6>Contractors will Bid on your Job</h6>
                        <p>
                            So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions.
                        </p>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='step1 text-center'>
                        <div class='step-circle'>
                            <span>3</span>
                        </div>
                        <h6>Professional Dvd Replication</h6>
                        <p>
                            Nor could I possibly forget that, do what I would, I only had the management of one end of it. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (count($company_recent) > 0) { ?>
<section class="company added padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (isset($company_recent)) { ?>
                <div class="">
                    <h6 class="main-title">
                        Recently Added
                    </h6>
                    <p class="subtitle">
                        Discover all recently reviewed companies
                    </p>
                </div>
                <div class="recently-added owl-carousel">
                    <?php foreach ($company_recent as $companies_recent) {
                    ?>

                    <div class="item">
                        <a href="<?= asset('company_profile_guest/' . $companies_recent->id); ?>">
                            <div class="recent-column">
                                <div class="recent-image" style="background-image: url('<?= isset($companies_recent->cover_image) ? asset($companies_recent->cover_image) : asset('public/images/images.png'); ?>"> </div>

                                <div class='recent-content'>
                                    <div class='recent-content-header'>
                                        <div class='header-img'>
                                            <div class='headers_imgs' style="background-image:url('<?= isset($companies_recent->profile_image) ? asset($companies_recent->profile_image) : ''; ?>')"></div>
                                            <img src=''/>
                                        </div>
                                        <div class='header-contents'>
                                            <h6><?=
                    $companies_recent->first_name;
                    if ($companies_recent->is_verified === 1) {
                    ?> <span><img src='<?= asset('userassets/images/verified.svg'); ?>'/></span>
                                                <?php } else { ?>
                                                <span></span>
                                                <?php } ?></h6>
                                            <div class='reviews'>
                                                <div class="star-ratings-sprite-gray">

                                                    <span style="width: <?= isset($companies_recent->ratingAvg->total) ? $companies_recent->ratingAvg->total * 20 : 0 ?>%;;" class="star-ratings-sprite-rating"></span>
                                                </div>
                                                <p class='total-review'>
                                                    (<?= $companies_recent->get_ratings_count; ?> Reviews)
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='recent-content-body'>
                                        <div class='recent-content-column'>


                                            <h6>Typical Job</h6>
                                            <p> <?= '$' . $companies_recent->getProposals['0']->getJob->budget_start ?> - <?= '$' . $companies_recent->getProposals['0']->getJob->budget_end ?> </p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    } else {
                    ?>
                    <h6>No Companies</h6>
                </div>
                <?php } ?>





            </div>
        </div>
    </div>
</section>     
<?php } ?>
<?php if (count($company) > 0) { ?>
<section class="company padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <?php if (isset($company)) { ?>
                <div class="">
                    <h6 class="main-title">
                        Popular Companies
                    </h6>
                    <p class="subtitle"></p>
                </div>
                <div class="popular-company owl-carousel">
<?php foreach ($company as $companies) {
?>
                    <div class="item">
                        <a href="<?= asset('company_profile_guest/' . $companies->id); ?>">
                            <div class="company-column">
                                <div class="company_images" style="background-image:url('<?= isset($companies->profile_image) ? asset($companies->profile_image) : asset('public/images/images.png'); ?>')"></div>
                                <!--<img src=""/>-->
                            </div>
                        </a>
                    </div>
<?php
}
}
?>
                </div>
            </div>
        </div>
    </div>
</div>     
</section>
<?php } ?>
<section class="newsletter padding-tb">

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="newstitle">


                    <h4>Join our newsletter!</h4>
                    <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <span class="ajax-label-body"></span>
                    </div>
                </div>

                <div  class="newsletter-form">
                    <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
                    <div class="form-group">
                        <input class="from-control general-field news_email" name="news_email" type="email" placeholder="Enter Your Email"/>
                        <button type="button" class="btn btn_sm_blue news">Send</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'includes/footer.php';
?>
<?php
include 'includes/bottom-footer.php';
?>

<!--<div class="preloader">
     <img src="<?= asset('userassets/images/loader.gif') ?>"/>
</div>-->
<script>
    jQuery(document).ready(function () {
        $('body').on('click', '.news', function (e) {
            e.preventDefault();
//        $this = $(this);
            var email = $('.news_email').val();
            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/news_letter') ?>",
                data: {email: email, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {

                        $('.ajax-label').hide();
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').hide();
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);

                    }
                },
                error: function (data) {

                }
            });




        });
        $('.popular-company.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            items: 1,
            smartSpeed: 500,
            navText: ['<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'],
            responsive: {
                1000: {
                    items: 8
                },
                768: {
                    items: 4
                },
                748: {
                    items: 2
                }
            }
        });
//          Recently Added
        $('.recently-added.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            items: 1,
            smartSpeed: 500,
            navText: ['<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'],
            responsive: {
                1000: {
                    items: 4
                },
                768: {
                    items: 2
                },
                748: {
                    items: 1
                }
            }
        });
        //Category
        $('.category.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            items: 1,
            smartSpeed: 500,
            navText: ['<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'],
            responsive: {
                1000: {
                    items: 6
                },
                768: {
                    items: 3
                },
                748: {
                    items: 1
                }
            }
        });
    });
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
//                                                      
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('location')),
                {types: ['geocode']});

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 