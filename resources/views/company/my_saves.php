<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="company-dashboard margin-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php include('includes/dashboard_sidebar.php') ?>
            </div>
            <div class="col-md-9">

                <div class="condructor-tabs dashboards">
                    <div class="condructor-tabs-header">
                        <div class="tabs-header">
                            <h3>
                                Jobs
                            </h3>
                        </div> 
                    </div>
                    <div class="condructor-tabs-body">
                        <?php
                        if (count($saves) > 0) {
                           
                            foreach ($saves as $save) {
                                ?>
                                <div class="dashboard-content">
                                    <div class="dashboard-profile">

                                        <?php foreach ($save->getJobs as $jobs) { ?>
                                            <div class="dashboard-profile-content">
                                                <h6><?= $jobs->title ?></h6>

                                            </div>
                                        <?php } ?>
                                    </div>
                                    <p>Saved on <?= isset($jobs->created_at)? date('d F, Y', strtotime($jobs->created_at)):''; ?></p>
                                    <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>

                                    </div>
                                    <div class="service-dropdown">
                                        <ul>
                                            
                                            <li>
                                                <a href="<?= asset('unsave_job/' . $save->job_id) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                                                <a href="<?= asset('view_job/' . $save->job_id) ?>"><i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Job</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                             <div class="no-record-found">No Record Saved </div>
                            <?php } ?>



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
<script>
    $("#upload-img").on("change", function ()
    {
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
</script>
<script>
    $('.edit_ser_btn').click(function (e) {
          e.preventDefault();
          e.stopPropagation();
              $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
              $(this).next('.service-dropdown').toggleClass('service-dropdown-open');
     });
     $('body').click(function (e) {
          $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
     });
</script>