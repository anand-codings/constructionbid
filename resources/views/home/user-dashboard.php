<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="company-dashboard margin-tb">
    <div class="container">
        <?php include resource_path('views/includes/messages.php');  ?>
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-profile-column">
                    <div class="dash-img" style="background-image: url('<?= isset(Auth::user()->profile_image)? asset(Auth::user()->profile_image) :asset('userassets/images/left_img1.png'); ?>')"></div>
                    <p><?=isset(Auth::user()->first_name)? Auth::user()->first_name.' '.Auth::user()->last_name :'No Name'?></p>
                    <a href="<?= asset('my_profile'); ?>">Edit Profile</a>
                </div>
                <div class="profile-tabs">
                    <h6>Dashboard</h6>

                    <ul class="nav nav-tabs" id="" role="tablist">

                        <li class="nav-item">
                            <a class="active" href="<?= asset('user-dashboard'); ?>" ><img src="<?= asset('userassets/images/posting.png'); ?>"/><span>My Postings</span><span class="profile-count"><?= $count ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a  href="<?= asset('homeowner_saves'); ?>" ><img src="<?= asset('userassets/images/saves.png'); ?>"/><span>My Saves</span><span class="profile-count"><?= $saves_count ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= asset('homeowner_proposals'); ?>"><img src="<?= asset('userassets/images/proposals.png'); ?>"/><span>Proposals</span><span class="profile-count"><?= $counts ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="condructor-tabs dashboards">
                    <div class="condructor-tabs-header">
                        <div class="tabs-header">
                            <h3>
                                Draft
                            </h3>
                        </div> 
                    </div>
                    <div class="condructor-tabs-body">
                        <?php if (count($drafts) > 0) {
                            foreach ($drafts as $draft) {
                                ?>
                                <div class="dashboard-content">
                                    <h6><?= $draft->title; ?></h6>
                                    <p>Saved on  <?= isset($draft->created_at)? date('d F, Y', strtotime($draft->created_at)):''; ?></p>
                                    <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>

                                    </div>
                                    <div class="service-dropdown" style="display:none;">
                                        <ul>
                                            <li>
                                                <a href="<?= asset('/post_job_form/' . $draft->id); ?>"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Draft</a>
                                            </li>
                                            <li>
                                                <a href="<?= asset('/delete_job/' . $draft->id); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Draft</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
        <?php }}else{ ?>
                        <div class="no-record-found">No Drafts Saved</div>
       <?php } ?>
                            </div>
                        </div>
                        <div class="condructor-tabs dashboards">
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <div class="col-md-2">
                                        <h3>
                                            My Posts
                                        </h3>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-2">
                                        <a href="<?= asset('/post_job_form'); ?>" class="btn btn_sm_white"> Add Posts</a>
                                    </div>
                                </div> 
                            </div>
                            <div class="condructor-tabs-body">
                                <?php if (count($jobs) > 0){
                                    foreach($jobs as $job){?>
                                <div class="dashboard-content">
                                    
                                    <a href="<?= asset('view_public_job/'.$job->id)?>"><h6><?= $job->title?></h6></a>
                                    <p>Posted  on <?= isset($job->created_at)? date('d F, Y', strtotime($job->created_at)):''; ?> </p>
                                    <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>

                                    </div>
                                    <div class="service-dropdown" style="display:none;">
                                        <ul>
                                            <li>
                                                <a href="<?= asset('/post_job_form/' . $job->id); ?>"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Postings</a>
                                            </li>
                                            <li>
                                                <a href="<?= asset('/delete_job/' . $job->id); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php }}else{ ?>
                                    <div class="no-record-found">No Jobs Found</div>
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