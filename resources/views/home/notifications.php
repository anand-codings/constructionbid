<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="all-notification margin-tb">
    <div class="container">
        <div class="notifaction-section">
            <div class="noti-head">
                <h6>Notifications</h6>
            </div>
            <?php include resource_path('views/includes/messages.php'); ?>
            <div class="noti-body">
                <?php
                if (isset($notifications)) {
                    foreach ($notifications as $notification) {
                        ?>


                        <?php if ($notification->type == 'proposal') {
                            ?>
                            <input type='hidden' name="company_name" id="company_name<?= $notification->proposal_id ?>" value="<?= $notification->getSender->first_name ?> <?= $notification->getSender->last_name ?>" />
                            <input type='hidden' name="company_image" id="company_image<?= $notification->proposal_id ?>" value="<?= $notification->getSender->profile_image ?>" />
                            <input type='hidden' name="company_rating" id="company_rating<?= $notification->proposal_id ?>" value="<?= isset($notification->getSender->ratingAvg) ? $notification->getSender->ratingAvg->total : '0' ?>" />
                            <input type='hidden' name="proposal_subject" id="proposal_subject<?= $notification->proposal_id ?>" value=" <?= isset($notification->getProposal->subject) ? $notification->getProposal->subject : '' ?>" />
                            <input type='hidden' name="proposal_status" id="proposal_status<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->status) ? $notification->getProposal->status : '' ?>" />
                            <input type='hidden' name="proposal_message" id="proposal_message<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->message) ? $notification->getProposal->message : '' ?>" />
                            <input type='hidden' name="proposal_date" id="proposal_date<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->created_at) ? $notification->getProposal->created_at : '' ?>" />
                            <input type='hidden' name="proposal_file" id="proposal_file<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->getFiles) ? $notification->getProposal->getFiles->path : '' ?>" />
                            <input type='hidden' name="proposal_file_id" id="proposal_file_id<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->getFiles) ? $notification->getProposal->getFiles->id : '' ?>" />
                            <input type='hidden' name="proposal_type" id="proposal_type<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->getFiles) ? $notification->getProposal->getFiles->type : '' ?>" />
                            <input type='hidden' name="proposal_original_name" id="proposal_original_name<?= $notification->proposal_id ?>" value="<?= isset($notification->getProposal->getFiles) ? $notification->getProposal->getFiles->original_name : '' ?>" />


                            <div class="notification-row " id='proposal_id<?= $notification->proposal_id ?>' data-id='<?= $notification->proposal_id; ?>' data-toggle="modal" data-target="#notification<?= $notification->id ?>">
                                <div class="notifcation-column">
                                    <div class="notif-profile" style="background-image: url('<?= getUserImage($notification->getSender->profile_image); ?>')"></div>
                                    <div class="notif-content">
                                        <p>
                                            <span><?= $notification->getSender->first_name ?>  <?= $notification->getSender->last_name ?></span>send you a proposal
                                        </p>
                                              
                                    </div>
                                    <?php if(isset($notification->getProposal)){
                                                    if ($notification->getProposal->status == 'pending') { ?>
                                                        <div class="proporsal-form-footer pending" >
                                                              <button type='button' class="btn btn_sm_green">Pending</button>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($notification->getProposal->status == 'accept') { ?>
                                                        <div class="proporsal-form-footer accept" >
                                                            <button type='button' class="btn btn_sm_green">Accepted</button>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($notification->getProposal->status == 'reject') { ?>
                                                        <div class="proporsal-form-footer reject" >
                                                            <button type='button' class="btn btn_red">Rejected</button>
                                                        </div>
                                                    <?php } } ?>
                                </div>
                                <div class="notifcation-column1">
                                    <p><i class="fa fa-calendar-o" aria-hidden="true"> </i><?= isset($notification->created_at) ? timeago($notification->created_at) : '' ?></p>

                                </div>
                            </div>
                            <div class="modal fade" id="notification<?= $notification->id ?>">
                                <div class="modal-dialog modal-medium  modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <div class="modal-title border-bottom">
                                                <h6>Proposal Detail</h6>
                                            </div>
                                            <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form class="proporsal-form">
                                                <div class="proporsal-form-body">
                                                    <div class="proporsal-form-header">
                                                        <div class="proporsal-form-img">
                                                            <div class='image-file' style="background-image: url('<?= getUserImage($notification->getSender->profile_image) ?>')"></div>
                                                            <div class="proporsal-title">
                                                                <h6 id="company_name"><?= $notification->getSender->first_name ?> <?= $notification->getSender->last_name ?></h6>
                                                                <div class="star-ratings-sprite-gray">
                                                                    <span id="rating" style="width:<?= isset($notification->getSender->ratingAvg) ? $notification->getSender->ratingAvg->total * 20 : '0' ?>% " class="star-ratings-sprite-rating"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="proporsal-time">
                                                            <p id="proposal_date">Received On <?= isset($notification->created_at) ? date('d F, Y', strtotime($notification->created_at)) : ''; ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="proporsal-form-content">
                                                        <h6 id="subject">
                                                            <?= isset($notification->getProposal->subject) ? $notification->getProposal->subject : '' ?>
                                                        </h6>
                                                        <p id="description">
                                                            <?= isset($notification->getProposal->message) ? $notification->getProposal->message : '' ?>
                                                        </p>
                                                        <?php if (isset($notification->getProposal->getFiles)) { ?>
                                                            <div class='project-file'>
                                                                <ul>
                                                                    <?php if ($notification->getProposal->getFiles->type == 'image') { ?>
                                                                        <li>
                                                                            <a id="image_download" href="<?= asset('download_file_home/' . $notification->getProposal->getFiles->id) ?>">
                                                                                <div>

                                                                                    <img id="proposal_image" src='<?= asset('userassets/images/jpg (1).png'); ?>' />
                                                                                    <p id="file_name"><?= $notification->getProposal->getFiles->original_name ?></p>

                                                                                </div>
                                                                                <img  id="image_download_icon" src='<?= asset('userassets/images/download.png'); ?>' />
                                                                            </a>
                                                                        </li>
                                                                    <?php } elseif ($notification->getProposal->getFiles->type == 'doc') { ?>
                                                                        <li>
                                                                            <a id="image_download" href="<?= asset('download_file_home/' . $notification->getProposal->getFiles->id) ?>">
                                                                                <div>

                                                                                    <img id="proposal_image" src='<?= asset('userassets/images/doc1.png'); ?>' />
                                                                                    <p id="file_name"><?= $notification->getProposal->getFiles->original_name ?></p>

                                                                                </div>
                                                                                <img  id="image_download_icon" src='<?= asset('userassets/images/download.png'); ?>' />
                                                                            </a>
                                                                        </li>
                                                                    <?php } elseif ($notification->getProposal->getFiles->type == 'pdf') { ?>
                                                                        <li>
                                                                            <a id="image_download" href="<?= asset('download_file_home/' . $notification->getProposal->getFiles->id) ?>">
                                                                                <div>

                                                                                    <img id="proposal_image" src='<?= asset('userassets/images/pdf1.png'); ?>' />
                                                                                    <p id="file_name"><?= $notification->getProposal->getFiles->original_name ?></p>

                                                                                </div>
                                                                                <img  id="image_download_icon" src='<?= asset('userassets/images/download.png'); ?>' />
                                                                            </a>
                                                                        </li>                                                                       
                                                                    <?php } elseif ($notification->getProposal->getFiles->type == 'zip') { ?>
                                                                        <li>
                                                                            <a id="image_download" href="<?= asset('download_file_home/' . $notification->getProposal->getFiles->id) ?>">
                                                                                <div>

                                                                                    <img id="proposal_image" src='<?= asset('userassets/images/zip.png'); ?>' />
                                                                                    <p id="file_name"><?= $notification->getProposal->getFiles->original_name ?></p>

                                                                                </div>
                                                                                <img  id="image_download_icon" src='<?= asset('userassets/images/download.png'); ?>' />
                                                                            </a>
                                                                        </li>                                                                      
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        <?php } else { ?>
                                                            <h6>No Files</h6>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <?php if(isset($notification->getProposal)){
                                                    if ($notification->getProposal->status == 'pending') { ?>
                                                        <div class="proporsal-form-footer pending" >
                                                            <a href="<?= asset('proposal_check/' . $notification->getProposal->id . '/' . 'accept/rediect') ?>"  class="btn btn_sm_green accept_proposal" href=''>Accept</a>
                                                            <a href="<?= asset('proposal_check/' . $notification->getProposal->id . '/' . 'reject/rediect') ?>"  class="btn btn_grey reject_proposal" href=''>Reject</a>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($notification->getProposal->status == 'accept') { ?>
                                                        <div class="proporsal-form-footer accept" >
                                                            <button type='button' class="btn btn_sm_green">Accepted</button>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($notification->getProposal->status == 'reject') { ?>
                                                        <div class="proporsal-form-footer reject" >
                                                            <button type='button' class="btn btn_red">Rejected</button>
                                                        </div>
                                                    <?php } } ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } elseif ($notification->type == 'admin') {
                                ?>
                                <input type="hidden" id="notification_title<?= $notification->id ?>" value="<?= $notification->title ?>">
                                <input type="hidden" id="notification_description<?= $notification->id ?>" value="<?= $notification->description ?>">
                                <input type="hidden" id="notification_date<?= $notification->id ?>" value="<?= $notification->created_at ?>">
                                <div class="notification-row notification_admin" data-id="<?= $notification->id ?>" data-toggle="modal" data-target="#notification_admin">
                                    <div class="notifcation-column">
                                        <div class="notif-profile" style="background-image: url('<?= asset('userassets/images/left_img1.png'); ?>')"></div>
                                        <div class="notif-content">
                                            <p>
                                                <span>Admin Notification</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="notifcation-column1">
                                        <p><i class="fa fa-calendar-o" aria-hidden="true"> </i> <?= isset($notification->created_at) ? timeago($notification->created_at) : '' ?></p>

                                    </div>
                                </div>
                            <?php }
                            ?>

                            <?php
                        }
                    } else {
                        ?>
                        <h6>No Notification</h6>
                    <?php } ?>
                    <!--                <div class="projects_navs_load">
                                        <button class="btn btn_sm_load"><i class="fa fa-refresh" aria-hidden="true"></i>Load 75 more</button>
                                    </div>-->
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

    <div class="modal fade" id="notification_admin">
        <div class="modal-dialog modal-medium  modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-title border-bottom">
                        <h6>Admin Notification</h6>
                    </div>
                    <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form class="proporsal-form">
                        <div class="proporsal-form-body">
                            <div class="proporsal-form-header">
                                <div class="proporsal-form-img">
                                    <div class='image-file-admin' style="background-image: url('<?= asset('userassets/images/left_img1.png') ?>')"></div>
                                    <div class="proporsal-title">
                                        <h6 >Admin</h6>

                                    </div>
                                </div>
                                <div class="proporsal-time">
                                    <p id="proposal_date_admin"></p>
                                </div>
                            </div>

                            <div class="proporsal-form-content">
                                <h6 id="subject_admin">

                                </h6>
                                <p id="description_admin">

                                </p>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('body').on('click', '.notification', function () {
            $this = $(this);
            var id = $this.data('id');
            var company_name = $('#company_name' + id).val();
            var company_image = $('#company_image' + id).val();
            var company_rating = $('#company_rating' + id).val();
            var proposal_subject = $('#proposal_subject' + id).val();
            var proposal_status = $('#proposal_status' + id).val();
            var proposal_message = $('#proposal_message' + id).val();
            var proposal_date = $('#proposal_date' + id).val();
    //        var proposal_file = $('#proposal_file'+id).val();
            var proposal_file_id = $('#proposal_file_id' + id).val();
            var proposal_type = $('#proposal_type' + id).val();
            var proposal_original_name = $('#proposal_original_name' + id).val();
            var d = new Date(proposal_date);
            var x = d.toDateString();

            $('#company_name').html(company_name);
            $('#subject').html(proposal_subject);
            $('#description').html(proposal_message);
            $('#proposal_date').html('Received on ' + x);
            $("#rating").css("width", company_rating * 20 + '%');

            if (company_image)
            {

                $(".image-file").css("background-image", 'url(' + company_image + ')');
            } else {

                $(".image-file").css("background-image", 'url(<?= asset('userassets/images/left_img1.png'); ?> )');
            }

            if (proposal_status == "pending")
            {
                $('.reject').hide();
                $('.accept').hide();
                $('.pending').show();
                $('.accept_proposal').attr('href', '<?= asset('proposal_check') ?>/' + id + '/accept/rediect');
                $('.reject_proposal').attr('href', '<?= asset('proposal_check') ?>/' + id + '/reject/rediect');
            } else if (proposal_status == 'reject')
            {
                $('.accept').hide();
                $('.pending').hide();
                $('.reject').show();
            } else if (proposal_status == "accept")
            {
                $('.pending').hide();
                $('.reject').hide();
                $('.accept').show();
            }

            if (proposal_type)
            {

                $('#image_download_icon').attr('src', '<?= asset('userassets/images/download.png') ?>');
                if (proposal_type === 'image')
                {

                    $('#file_name').html(proposal_original_name);
                    $('#proposal_image').attr('src', '<?= asset('userassets/images/jpg (1).png'); ?>');
                    $('#image_download').attr('href', '<?= asset('download_file_home') ?>/' + proposal_file_id);
//                
            } else if (proposal_type === 'pdf')
            {
                $('#proposal_image').attr('src', 'userassets/images/pdf1.png');
                $('#image_download').attr('href', 'download_file_home/' + proposal_file_id);
                $('#file_name').html(proposal_original_name);
            } else if (proposal_type === 'zip')
            {
                $('#proposal_image').attr('src', 'userassets/images/zip.png');
                $('#image_download').attr('href', 'download_file_home/' + proposal_file_id);
                $('#file_name').html(proposal_original_name);
            } else if (proposal_type === 'doc')
            {
                $('#proposal_image').attr('src', 'userassets/images/doc1.png');
                $('#image_download').attr('href', 'download_file_home/' + proposal_file_id);
                $('#file_name').html(proposal_original_name);
            }
        }




    });
    $('body').on('click', '.notification_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var admin_title = $('#notification_title' + id).val();
        var admin_description = $('#notification_description' + id).val();
        var admin_date = $('#notification_date' + id).val();
        var d = new Date(admin_date);
        var x = d.toDateString();
        $('#subject_admin').html(admin_title);
        $('#description_admin').html(admin_description);
        $('#proposal_date_admin').html('Received on ' + x);
    });
</script>