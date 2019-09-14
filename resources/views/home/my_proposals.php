<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="company-dashboard margin-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-profile-column">
                    <div class="dash-img" style="background-image:  url('<?= isset(Auth::user()->profile_image) ? asset(Auth::user()->profile_image) : asset('userassets/images/left_img1.png'); ?>')"></div>
                    <p><?= isset(Auth::user()->first_name) ? Auth::user()->first_name . ' ' . Auth::user()->last_name : 'No Name' ?></p>
                    <a href="<?= asset('my_profile'); ?>">Edit Profile</a>
                </div>
                <div class="profile-tabs">
                    <h6>Dashboard</h6>
                    <ul class="nav nav-tabs" id="" role="tablist">

                        <li class="nav-item">
                            <a  href="<?= asset('user-dashboard'); ?>" ><img src="<?= asset('userassets/images/posting.png'); ?>"/><span>My Postings</span><span class="profile-count"><?= $count ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a  href="<?= asset('homeowner_saves'); ?>" ><img src="<?= asset('userassets/images/saves.png'); ?>"/><span>My Saves</span><span class="profile-count"><?= $saves_count ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="active" href="<?= asset('homeowner_proposals'); ?>"><img src="<?= asset('userassets/images/proposals.png'); ?>"/><span>Proposals</span><span class="profile-count"><?= $counts ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">

                <div class="condructor-tabs dashboards">
                    <div class="condructor-tabs-header">
                        <div class="tabs-header">
                            <h3>
                                Proposals
                            </h3>
                        </div>
                    </div>
                    <div class="condructor-tabs-body my_proposal">
                        <?php
                        if (isset($Proposals)) {

//                                    print_r($job->getProposal);
//                                    exit;
                            $count = 0;
                            foreach ($Proposals as $proposalss) {
                            foreach ($proposalss as $key=>$proposal) {
                               
                                ?>
                                <div class="dashboard-content">
                                    <div class="dashboard-profile align-items-start">
                                        <div class="dashboard-profile-img" style="background-image: url('<?php echo isset($proposal->getUser->profile_image) ? asset($proposal->getUser->profile_image) : '' ?>')"></div>
                                        <div class="dashboard-profile-content">
                                            
                                            <h6><?= isset($proposal->getUser->first_name) ? $proposal->getUser->first_name : '' ?></h6><b>Job Title :</b><?= $proposal->getJob->title;?>
                                            <?php if($key==0){ ?>
                                                <p style="color:blue;">  Recomended </p>
                   <?php            }
                                             ?>
                                            
                                            <div class="star-ratings-sprite-gray">
                                                <span style="width: <?= isset($proposal->getUser->ratingAvg->total) ? $proposal->getUser->ratingAvg->total * 20 : 0 ?>%;" class="star-ratings-sprite-rating"></span>
                                            </div>
                                        </div> 
                                        <?php if ($proposal->status == 'pending') { ?>
                                            <div class="d-flex align-items-start mr-5">
                                                <a href="<?= asset('proposal_check/' . $proposal->id . '/' . 'accept') ?>" class="btn btn_sm_green mr-2">Accept </a>
                                                <a href="<?= asset('proposal_check/' . $proposal->id . '/' . 'reject') ?>" class="btn btn_sm_grey ">Reject </a>
                                            </div>
                                        <?php } elseif ($proposal->status == 'accept') { ?>
                                            <a href="#" class="btn btn_sm_green mr-2">Accepted </a>
                                        <?php } elseif ($proposal->status == 'reject') { ?>
                                            <a href="#" class="btn btn_sm_grey mr-2">Rejected </a>
                                        <?php } ?>
                                    </div>

                                    <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="service-dropdown" >
                                        <ul>
                                            <li>
                                                <a href="<?= asset('company_profile_home/' . $proposal->company_id); ?>"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Company Profile</a>
                                            </li>
                                            <li>

                                            </li>
                                        </ul>
                                    </div>
        <!--                                            <span class="category-name proposal_cat mt-3 d-inline-block">Architects and Building Designers</span>-->
                                    <div class="d-flex file-download">
                                        <div class="dashboard-profile-content pt-3">
                                            <h6>Subject: <?= $proposal->subject ?></h6>
                                            <p> <?= $proposal->message ?></p>
                                        </div>
                                        <?php if (isset($proposal->getFiles)) { ?>
                                            <div class="proposal_pdf d-flex">
                                                <?php if ($proposal->getFiles->type == 'doc') {
                                                    ?>

                                                    <a  href="javascript:void(0)"><img src="<?php echo asset('userassets/images/doc1.png') ?>"></a>
                                                    <span class="pl-3"><?= $proposal->getFiles->original_name ?></span>
                                                    <a href="<?= asset('download_file_home/' . $proposal->getFiles->id) ?>"> <i class="fa fa-download pl-3" aria-hidden="true"></i></a>
                                                <?php } elseif ($proposal->getFiles->type == 'image') { ?>
                                                    <a href="javascript:void(0)" ><img src="<?php echo asset('userassets/images/jpg (1).png') ?>"></a>
                                                    <span class="pl-3"><?= $proposal->getFiles->original_name ?></span>
                                                    <a href="<?= asset('download_file_home/' . $proposal->getFiles->id) ?>"> <i class="fa fa-download pl-3" aria-hidden="true"></i></a>
                                                <?php } elseif ($proposal->getFiles->type == 'pdf') { ?>
                                                    <a href="javascript:void(0)" ><img src="<?php echo asset('userassets/images/pdf1.png') ?>"></a>
                                                    <span class="pl-3"><?= $proposal->getFiles->original_name ?></span>
                                                    <a href="<?= asset('download_file_home/' . $proposal->getFiles->id) ?>"><i class="fa fa-download pl-3" aria-hidden="true"></i></a>
                                                <?php } elseif ($proposal->getFiles->type == 'zip') { ?>
                                                    <a href="javascript:void(0)"><img src="<?php echo asset('userassets/images/zip.png') ?>"></a>
                                                    <span class="pl-3"><?= $proposal->getFiles->original_name ?></span>
                                                    <a href="<?= asset('download_file_home/' . $proposal->getFiles->id) ?>"><i class="fa fa-download pl-3" aria-hidden="true"></i></a>

                                                <?php }
                                                ?>
                                            </div> 
                                        <?php } else {
                                            ?>
                                            <h6>No files</h6>
                                        <?php } ?>
                                    </div>
                                    <div class="service-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""> <i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Company Profile</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            } }
                        } else { 
                                ?>
                                <h6>No Proposals</h6>
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
    $('.edit_ser_btn').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
        $(this).next('.service-dropdown').toggleClass('service-dropdown-open');
    });
    $('body').click(function (e) {
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
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
</script>
