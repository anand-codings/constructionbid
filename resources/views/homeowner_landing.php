<?php
include 'includes/top-header.php';
?>
<?php
include 'includes/header.php';
?>
<?php include resource_path('views/admin/includes/messages.php');?>
<section class='main-banner'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='banner-content langing-banner'>
                    <h3>
                        <!--For your roofing and siding, quality we’ll be providing!-->
                        Post your project, Get free proposals from professionals near you.
                    </h3>
                    <!-- <form  action="<?=asset('job_search')?>"class='banner-search' method="get">
                        <div class='form-group'>
                            <input type="text" name="search_job" class='form-control general-field search-field' placeholder="What service you need?"/>
                            <input type="text" name="location_usa" class='form-control general-field map-field' id="location" placeholder="Location" autocomplete="off"/>
                            <button href="<?=asset('job_search');?>" class='btn btn_sm_blue'>Find</button>
                        </div>
                    </form> -->
                    <p>
                         
                    </p>
                    <div>
                        <a href="" class="btn-signup">See Pricing Plan</a>
                        <a href="<?= asset('post_job'); ?>"   class="btn-signup btn-white">Sign Up Today</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <img src="<?=asset('userassets/images/banner.png');?>" />
            </div>
        </div>
    </div>
</section>
<?php if (count($company) > 0) {?>
<section class="company padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($company)) {?>
                <div class="">
                    <h6 class="main-title text-center">
                        Popular Specialities 
                    </h6>
                    <p class="subtitle"></p>
                </div>
                <div class="popular-company owl-carousel">
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/gc.png');?>')">
                                </div>
                        
                        </div>
                        <p><strong> GC's</strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/crane.png');?>')">
                                </div>
                         
                        </div>
                       <p><strong> Concrete Supplier </strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/engineer.png');?>')">
                                </div>
                          
                        </div>
                       <p><strong> Engineer</strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/architecture.png');?>')">
                                </div>
                          
                        </div>
                       <p><strong> Architecture</strong> </p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/inspector.png');?>')">
                                </div>
                        
                        </div>
                       <p> <strong>Inspector</strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/delievery.png');?>')">
                                </div>
                         
                        </div>
                       <p><strong>  CM's</strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/custom.png');?>')">
                                </div>
                          
                        </div>
                       <p><strong> Custom Builder </strong></p>
                        </div>
                    <div class="item">
                         <div class="company-column">
                             <div class="company_images"
                                    style="background-image:url('<?= asset('userassets/images/icon/estimator.png');?>')">
                                </div>
                           
                        </div>
                       <p><strong>Estimator</strong> </p>
                        </div>
                    <?php // foreach ($company as $companies) {
//    ?>
<!--                    <div class="item">
                        <a href="<? php asset('company_profile_guest/' . $companies->id);?>">
                            <div class="company-column">
                                <div class="company_images"
                                    style="background-image:url('<?=isset($companies->profile_image) ? asset($companies->profile_image) : asset('public/images/images.png');?>')">
                                </div>
                                <img src=""/>
                            </div>
                        </a>
                    </div>-->
                    <?php // 
//}
}
    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php }?>
<section class="with-us padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="with-us-container">
                    <h6>Do with us</h6>
                    <h3>36 million professionals on demand.</h3>
                    <ul>
                        <li>The Basics Of Western Astrology Explained</li>
                        <li>Words To Live By</li>
                        <li>The Basics Of Western Astrology Explained</li>
                        <li>Fact And Truth</li>
                        <li>Peace On Earth A Wonderful Wish But No Way</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="with-us-img">
                    <img src="<?=asset('userassets/images/macbook.png')?>"/>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="counter-project" style="background-image:url('<?=asset('userassets/images/project-img.png');?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="bit_column text-center">
                    <img src="<?=asset('userassets/images/qualified.png');?>">
                    <h3><?= isset($target_bids) ? $target_bids : '0' ?></h3>
                    <p>Targeted Bids</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bit_column text-center">
                    <img src="<?=asset('userassets/images/qualified.png');?>">
                    <h3>4302</h3>
                    <p>Trusted Clients</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bit_column text-center">
                    <img src="<?=asset('userassets/images/qualified.png');?>">
                    <h3><?= isset($successfull_projects) ? $successfull_projects : '0' ?></h3>
                    <p>Successful Projects</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="how-works padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="work-title text-center">
                    <h6>How it works</h6>
                    <h3>
                        We’ll nail your next project because nobody<br> wants a screw up!
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="work-steps padding-tb">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="step1 text-center">
                        <div class="step-circle">
                            <span>1</span>
                        </div>
                        <h6>Post Job Services</h6>
                        <p>
                        Post Job Services- Post services needed, give a brief description, Invite specific providers, or allow open bid proposals.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step1 text-center">
                        <div class="step-circle">
                            <span>2</span>
                        </div>
                        <h6>Contractors will Bid on your Job</h6>
                        <p>
                      Contractors will bid on your job- Proposals will be sent directly to you. </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step1 text-center">
                        <div class="step-circle">
                            <span>3</span>
                        </div>
                        <h6>Professional Dvd Replication</h6>
                        <p>
                        Choose your network Pro- Check profile, Choose lowest bidder, see previously done projects, Accept or decline offer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial_newsletter landing_testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div  class="testimonail owl-carousel">
                    <div class="test_content text-center">
                        <div class="testi_profile" style="background-image:url('<?=asset('userassets/images/testimonial_profile.png')?>')"></div>
                        <div class="testi_content homeowner-langind">
                            <p>
                            We are so pleased with the first leg of our project that we look forward to working with them on the rest of our house! Contractors are on ConstructBid very helpful and a pleasure to work with. I highly recommend them.
                            </p>
                            <h6>Jayden Wilson</h6>
                            <h5>Client</h5>
                        </div>
                    </div>
                    <div class="test_content text-center">
                        <div class="testi_profile" style="background-image:url('<?=asset('userassets/images/testimonial_profile.png')?>')"></div>
                        <div class="testi_content homeowner-langind">
                            <p>
                            We are so pleased with the first leg of our project that we look forward to working with them on the rest of our house! Contractors are on ConstructBid very helpful and a pleasure to work with. I highly recommend them.
                            </p>
                            <h6>Jayden Wilson</h6>
                            <h5>Client</h5>
                        </div>
                    </div>
                    <div class="test_content text-center">
                        <div class="testi_profile" style="background-image:url('<?=asset('userassets/images/testimonial_profile.png')?>')"></div>
                        <div class="testi_content homeowner-langind">
                            <p>
                            We are so pleased with the first leg of our project that we look forward to working with them on the rest of our house! Contractors are on ConstructBid very helpful and a pleasure to work with. I highly recommend them.
                            </p>
                            <h6>Jayden Wilson</h6>
                            <h5>Client</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="competition padding-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="competition-content">
                    <h5>Don’t get framed by the competition, trust our solid reputation.</h5>
                    <p>
                    Banjo tote bag bicycle rights, High Life sartorial cray craft beer whatever street art fap. Hashtag typewriter banh mi, squid keffiyeh High Life Brooklyn twee craft beer tousled chillwave. PBR&B selfies chillwave, bespoke tote bag blog post-ironic. Single-origin coffee put a bird on it craft beer YOLO,
                    </p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="owl-carousel project-sliders">
                <div class="item" >
                    <figure class="project-slider-img" style="background-image:url('<?=asset('userassets/images/project-imgs.png');?>');"></figure>
                </div>
                <div class="item" >
                    <figure class="project-slider-img" style="background-image:url('<?=asset('userassets/images/project-imgs.png');?>');"></figure>
                    </div>
                <div class="item" >
                    <figure class="project-slider-img" style="background-image:url('<?=asset('userassets/images/project-imgs.png');?>');"></figure>    
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

                <div class="newsletter-form">
                    <input type="hidden" name="_token" value="<?=csrf_token();?>">
                    <div class="form-group">
                        <input class="from-control general-field news_email" name="news_email" type="email"
                            placeholder="Enter Your Email" />
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
     <img src="<?=asset('userassets/images/loader.gif')?>"/>
</div>-->
<script>
    $(document).ready(function () {
        $('.owl-carousel.project-sliders').owlCarousel({
        items: 1,
        loop: false,
        center: true,
        nav: false,
        margin: 10,
        navText: ['<span class=" nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class=" nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'],
        onInitialized: makePages,
        onTranslated: makePages,
    });
    function makePages() {
        $(".owl-carousel.project-sliders .item").each(function (i) {
            $image = $(this).find('figure').css('background-image');
            $('.owl-dots .owl-dot span').eq(i)
                    .css({
                        'background-image': $image,
                        'background-size': 'cover'
                    })
        });


    }
  
});
jQuery(document).ready(function() {
    $('.testimonail.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 5000,
            items: 1,
            smartSpeed: 500,
            navText: ['<span class="testimonial-right nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class="testimonial-left nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>']
        });
    $('body').on('click', '.news', function(e) {
        e.preventDefault();
        //        $this = $(this);
        var email = $('.news_email').val();
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?=asset('/news_letter')?>",
            data: {
                email: email,
                '_token': '<?=csrf_token();?>'
            },
            dataType: 'json',
            success: function(data) {
                $('#preloader').hide();
                if (data.success) {

                    $('.ajax-label').hide();
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                } else {
                    $('.ajax-label').hide();
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);

                }
            },
            error: function(data) {

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
        navText: [
            '<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        ],
        responsive: {
            1000: {
                items: 8
            },
            768: {
                items: 3
            },
            520: {
                items: 4
            },
            320: {
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
        navText: [
            '<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        ],
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
        navText: [
            '<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
        ],
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
        /** @type {!HTMLInputElement} */
        (document.getElementById('location')), {
            types: ['geocode']
        });

}
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete"
    async defer></script>