<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="all-notification margin-tb">
    <div class="container">
        <div class="notifaction-section">
            <div class="noti-head">
                <h6>Notifications</h6>
            </div>

            <div class="noti-body">
                <?php
                if (count($notifications) > 0) {
                    $i = 0;
                    foreach ($notifications as $notification) {
                        $i++;
                        ?>
                        <input type="hidden" id="notification_title<?= $notification->id ?>" value="<?= $notification->title ?>">
                        <input type="hidden" id="notification_description<?= $notification->id ?>" value="<?= $notification->description ?>">
                        <input type="hidden" id="notification_date<?= $notification->id ?>" value="<?= $notification->created_at ?>">
                        <div <?php if ($i > 10) { ?> style="display: none" <?php } ?> class="notification-row notification_admin " data-id="<?=$notification->id?>" data-toggle="modal" data-target="<?= ($notification->type == 'admin') ? '#notification_admin' : '' ?>">
                            <div class="notifcation-column">
                                <div class="notif-profile" style="background-image: url('<?= isset($notification->getSender->profile_image) ? asset($notification->getSender->profile_image) : asset('userassets/images/left_img1.png') ?>')"></div>
                                <div class="notif-content">
                                    <p>
                                        <?php if ($notification->type == "quote") { ?> 
                                            <span><?= $notification->getSender->first_name ?></span> quote on your profile. You can check your email.
                                        <?php } else if ($notification->type == "review") { ?>
                                            <a href="<?= asset('view_contractor') . '/' . 'review'; ?>">  <span><?= $notification->getSender->first_name ?></span>give review on your profile.</a> 
                                        <?php } else if ($notification->type == "proposal") { ?>
                                            <span><?= $notification->getSender->first_name ?></span> <?= $notification->title ?>.
                                        <?php } else { ?>
                                            <span><?= isset($notification->getSender->first_name) ? $notification->getSender->first_name : '' ?></span> Admin notification.
                                        <?php } ?>      
                                    </p>
                                </div>
                            </div>
                            <div class="notifcation-column1">
                                <p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?= timeago($notification->created_at) ?></p>
                                <p></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="no-record-found">
                        <p class="text-center">No Posts To Show</p>
                    </div>
                <?php } if (count($notifications) > 10) { ?>
                    <div class="projects_navs_load">
                        <!--<div ><a href="#" class="btn btn-primary">Load More</a></div>-->
                        <button class="btn btn_sm_load" id="loadMore" ><i class="fa fa-refresh" aria-hidden="true"></i><?php// (count($notifications)-10).' ' ; ?>Load more</button>
                    </div>
                <?php } ?>
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

    $(document).ready(function () {
        $(".moreBox").slice(0, 3).show();
        if ($(".blogBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".notification-row").fadeIn('slow');
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });
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

