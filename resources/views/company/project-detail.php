<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<div class="stone_family_sec">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <section class="construct_owl_slider">


                    <div class="owl-carousel project-detail-slider">
                        <?php
                        if (isset($project_detial)) {
                            foreach ($project_detial->getFile as $file) {
                                ?>  
                                <div class="item" >
                                    <figure style="background-image: url('<?= asset($file->path); ?>')"></figure>  
                                </div>

                            <?php }
                        }
                        ?>
                        <!--                              <div class="slidercounter"></div>-->
                    </div>

                    <!--                         <div class="slider_thumbnails">
                                                  <a href="#slider_img1">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project1.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img2">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project2.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img3">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project3.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img4">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project4.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img5">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project4.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img6">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project6.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img7">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project7.png"); ?>')"></figure>
                                                  </a>
                                                  <a href="#slider_img8">
                                                       <figure style="background-image: url('<?= asset("userassets/images/project8.png"); ?>')"></figure>
                                                  </a>
                    
                                             </div>-->
                </section>
            </div>
            <div class="col-xl-5">
                <div class="detail-content">
                    <h6><?= isset($project_detial->title) ? $project_detial->title : '' ?></h6>
                    <h5><span><img src="<?= asset('userassets/images/address.png'); ?>"/></span><?= isset($project_detial->location) ? $project_detial->location : '' ?></h5>

                    <p>
<?= isset($project_detial->description) ? $project_detial->description : '' ?>
                    </p>
                    <div class="company-logo-row">
                        <div class="company-image">
                            <div class="compnay_profile_imgs" style="background-image:url('<?= asset($project_detial->getComapny->cover_image); ?>');"></div>
                            <!-- <img src="<?= asset(getUserImage($project_detial->getComapny->cover_image)); ?>"/> -->
                        </div>
                        <div class="home_left_head">
                            <h2><?= isset($project_detial->getComapny->first_name) ? $project_detial->getComapny->first_name : '' ?>
<?php if ($project_detial->getComapny->is_verified == 1) { ?>
                                    <a href="#">
                                        <img src="<?= asset('userassets/images/verified.svg'); ?>" alt="verified">
                                    </a>
    <?php } ?>
                                </h2>
                                <div class="star-ratings-sprite-gray">
                                    <span style="width: <?=isset($project_detial->getComapny->ratingAvg)? $project_detial->getComapny->ratingAvg->total*20:0?>%;" class="star-ratings-sprite-rating"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stone_family_carousal">
                        <div class="family_carousel_title">
                            <h5>More Projects</h5>
                        </div>
                        <div class="recently-added owl-carousel">

                            <?php
                            if (isset($more_projects)) {
                                foreach ($more_projects as $more_project) {
                                    ?>     
                                    <a href="<?= asset('project_detail') . '/' . $more_project->id; ?>"> 
                                        <div class="item active">
                                            <div class="project-padding">
                                                <?php
                                                $image = asset('public/images/images.png');
                                                if (count($more_project->getFile) > 0) {
                                                    $image = asset($more_project->getFile[0]->path);
                                                }
                                                ?>
                                                <div class="project-image" style="background-image: url('<?= $image ?>')"></div>
                                                <div class="projects_content">
                                                    <h6><?= $more_project->title; ?></h6>
                                                    <p><?= $more_project->location; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
        <?php }
    }
    ?>

                        </div>
                    </div>
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
    $('.recently-added.owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        dots: false,
        nav: true,
        autoplay: false,
        autoplayTimeout: 5000,
        items: 1,
        smartSpeed: 500,
        navText: ['<span class="slider-btns nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class="slider-btns nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>']
    });
    $('.owl-carousel.project-detail-slider').owlCarousel({
        items: 1,
        loop: false,
        center: true,
        nav: true,
        margin: 10,
        navText: ['<span class=" nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', '<span class=" nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'],
        onInitialized: makePages,
        onTranslated: makePages,
    });
    function makePages() {
        $(".owl-carousel.project-detail-slider .item").each(function (i) {
            $image = $(this).find('figure').css('background-image');

            $('.owl-dots .owl-dot span').eq(i)
                    .css({
                        'background-image': $image,
                        'background-size': 'cover'
                    })
        });


    }
//     function counter(event) {

////                         console.log(event);
//          var element = event.target; // DOM element, in this example .owl-carousel
//          var items = event.item.count; // Number of items
//          var item = event.item.index; // Position of the current item
////                         console.log(items);
//          // it loop is true then reset counter from 1
//          if (item > items) {
//               item = item - items;
//          }
//          jQuery('.slidercounter').html("<span class='counts''>0" + item + "</span><span>/</span>" + "0" + items);
//     }

</script>
