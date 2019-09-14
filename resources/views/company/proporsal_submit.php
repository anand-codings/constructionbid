<?php
include resource_path('views/includes/top-header.php');
include resource_path('views/includes/header.php');
?>
<section class='submit-proporsal'>
    <?php
    if (isset($job)) {
//        foreach ($jobs as $job) {
    ?>
    <div class="container">
        <div class="submit-row">
            <div class="proporsal-header">
                <div class='row'>

                    <div class="col-md-7">
                        <div class='header-content'>
                            <h6><?= $job->title ?></h6>
                            <div class='proporsal-category'>
                                <span class="category-name"><?= $job->category; ?> </span>
                                <span class='category-time'><i class="fa fa-clock-o" aria-hidden="true"></i> Posted <?= isset($job->created_at) ? date('d F, Y', strtotime($job->created_at)) : ''; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="external_btns">
                            <?php
                            if ($job->extrnal_link ) {
                            $href = $job->extrnal_link;
                            if (strpos('http', $job->extrnal_link) == FALSE) {
                            $href = $job->extrnal_link;
                            }
                            ?>
                            <a target="_blank" href="<?= $href ?>"  class='btn_md_blue'><i class="fa fa-external-link" aria-hidden="true"></i> External Link</a>
                            <?php
                            }
//                                } if ($current_user && $current_user->id != $job->user_id) {
                            
                            if ($check_proposal) {

                            if (Auth::user()->type == 'company') {
                            if ($check_proposal->status == 'accept') {
                            ?>
                            <button type='button' class="btn btn_sm_green">Accepted</button>
                                <?php } elseif ($check_proposal->status == 'reject') { ?>
                            <button type='button' class="btn btn_sm_red">Rejected</butto
                                <?php } elseif ($check_proposal->status == 'pending') { ?> 
                                <button type='button' class="btn btn_sm_green">Pending</button>
                                <?php
                                }
                                } else if(Auth::user()->type == 'homeowner') {

                                if ($check_proposal->status == 'accept') {
                                ?>
                                <button type='button' class="btn btn_sm_green">Accepted</button>
                                    <?php } elseif ($check_proposal->status == 'reject') { ?>
                                <button type='button' class="btn btn_sm_red">Rejected</button>
                                <?php } elseif ($check_proposal->status == 'pending') { ?> 
                                    <a href="<?= asset('proposal_check/' . $check_proposal->id . '/' . 'accept') ?>"  class="btn btn_sm_green accept_proposal" href=''>Accept</a>
                                    <a href="<?= asset('proposal_check/' . $check_proposal->id . '/' . 'reject') ?>"  class="btn btn_grey reject_proposal" href=''>Reject</a>
                                    <?php }
                                    ?>
                                    <?php
                                    }
                                    } elseif(Auth::user()->type == 'company') {
                                    ?>
                                    <button type='button' data-target="#submit-proporsal" data-toggle="modal" class='btn_md_green'>Submit a Proposal</button>
                                    <?php
//                                            }
                                    }
                                    ?>

                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class='proporsal-column-row'>
                                        <div class='proporsal-column'>
                                            <div class='proporsal-img' style="background-image: url('<?php echo (!empty($user->getSubscription)) ? getUserImage($job->getUser->profile_image):asset('userassets/images/left_img1.png'); ?>')"></div>
                                            <div class="proporsal-content">
                                                <h6>Client</h6>
                                                <p><?=(!empty($user->getSubscription))? $job->getUser->first_name:'No Name' ?></p>
                                            </div>
                                        </div>
                                        <div class='proporsal-column center-align'>
                                            <div class="proporsal-content">
                                                <h6>Site Location</h6>
                                                <p><?= (!empty($user->getSubscription))? $job->location:'No location' ?></p>
                                            </div>
                                        </div>
                                        <div class='proporsal-column center-align'>
                                            <div class="proporsal-content">
                                                <h6>Budget Approx.</h6>
                                                <p><img src='<?= asset('userassets/images/banknote.png'); ?>'/>$<?= $job->budget_start ?> to $<?= $job->budget_end ?></p>
                                            </div>
                                        </div>
                                        <div class='proporsal-column center-align'>
                                            <div class="proporsal-content">
                                                <h6>Project Type</h6>
                                                <?php if ($job->type == 'ongoing_project') { ?>
                                                    <p>Ongoing Project</p>
                                                <?php } elseif ($job->type == 'one_time_project') { ?>
                                                    <p>One Time Project</p>
<?php } ?>
                                            </div>
                                        </div>
                                        <div class='proporsal-column center-align'>
                                            <div class="proporsal-content">
                                                <h6>Expertise</h6>
                                                <?php
                                                if (isset($job->getSpeciality)) {
                                                    foreach ($job->getSpeciality as $special) {
                                                        ?>
                                                        <p><?= $special->name ?></p>
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
                                    <section class='proporsal-detail'>
                                        <div class="container">
                                            <div class="submit-row">
                                                <div class='row'>
                                            <style type="text/css">
                                                    .more .more-text{
                                                        display: none;
                                                    }
                                            </style>
                                                    <div class='col-md-7' style="border-right: 1px solid #cecece; color: #86939E;">
                                                        <div class='proporsal-detail more'>
                                                 <p><?= $job->description ?></p>
                                                                   
                                                               
            
                                                        </div>
                                                    </div>
                                                    <div class='col-md-5'>
<div class='project-brief'>
                                                                <h5 class='project-brief-title'>Project Brief Files</h5>
<?php if (!empty($job->getFiles) && count($job->getFiles) > 0) { ?>
                                                            
                                                                <ul>
                                                                    <?php
                                                                    foreach ($job->getFiles as $files) {
                                                                        if ($files->type == 'image') {
                                                                            ?>

                                                                            <li>
                                                                                <div class="breif-box">
                                                                                    <div class="project-img">
                                                                                        <div class='brief-images' style="background-image: url('<?php echo asset($files->path) ?>')"></div>
                                                                                        <div class="hover-layer">
                                                                                            <a href="<?= (Auth::user()->type == 'homeowner') ? asset('download_file_home/' . $files->id) : asset('download_file/' . $files->id) ?>">
                                                                                                <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> 
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span><?= $files->original_name ?></span>
                                                                                </div>
                                                                            </li>
        <?php } elseif ($files->type == 'doc') { ?>
                                                                            <li>
                                                                                <div class="breif-box">
                                                                                    <div class="project-img">
                                                                                        <div class='brief-images' >
                                                                                            <img src="<?php echo asset('userassets/images/doc1.png') ?>"/>
                                                                                        </div>
                                                                                        <div class="hover-layer">
                                                                                            <a href="<?= (Auth::user()->type == 'homeowner') ? asset('download_file_home/' . $files->id) : asset('download_file/' . $files->id) ?>">
                                                                                                <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> 
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span><?= $files->original_name ?></span>


                                                                                </div>
                                                                            </li>
        <?php } elseif ($files->type == 'pdf') { ?>
                                                                            <li>
                                                                                <div class="breif-box">
                                                                                    <div class="project-img">
                                                                                        <div class='brief-images' >
                                                                                            <img src="<?php echo asset('userassets/images/pdf1.png') ?>"/>
                                                                                        </div>
                                                                                        <div class="hover-layer">
                                                                                            <a href="<?= (Auth::user()->type == 'homeowner') ? asset('download_file_home/' . $files->id) : asset('download_file/' . $files->id) ?>">
                                                                                                <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> 
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span><?= $files->original_name ?></span>
                                                                                </div>
                                                                            </li>
        <?php } elseif ($files->type == 'zip') { ?>
                                                                            <li>
                                                                                <div class="breif-box">
                                                                                    <div class="project-img">
                                                                                        <div class='brief-images' >
                                                                                            <img src="<?php echo asset('userassets/images/zip.png') ?>"/>
                                                                                        </div>
                                                                                        <div class="hover-layer">
                                                                                            <a href="<?= (Auth::user()->type == 'homeowner') ? asset('download_file_home/' . $files->id) : asset('download_file/' . $files->id) ?>">
                                                                                                <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> 
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span><?= $files->original_name ?></span>
                                                                                </div>
                                                                            </li>
                                                                        <?php } ?>
    <?php }
    ?>
                                                                </ul>
                                                            
                                                        <?php } ?>
</div>
                                                        <?php
                                                        if (Auth::user()->type == 'company') {
                                                            if (!$check_save) {
                                                                ?>
                                                                <a href="<?= asset('save_job') . '/' . $job->id; ?>" class="btn_md_green"> Save Job</a>
                                                            <?php } else { ?>
                                                                <a href="<?= asset('unsave_job/' . $job->id) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>  
                                    <div class="modal fade" id="submit-proporsal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <div class="modal-title border-bottom">
                                                        <h6>Proposal Form</h6>
                                                    </div>
                                                    <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form class="post_proposel" method="POST" action="<?= asset('add_proposal'); ?>" enctype="multipart/form-data">
<?= csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label>To:</label>
                                                            <input type="text" name='user_name' value="<?= $job->getUser->first_name; ?>" class="form-control general-field user_name" placeholder="Harry Schwatrtz" readonly />
                                                            <input type="hidden" name="job_id" value="<?= $job->id; ?>">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Subject</label>
                                                                    <input type="text" name="subject" class="form-control general-field subject" placeholder="Add a subject live" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Message
                                                                    </label>
                                                                    <textarea name='message' placeholder="Add a message…" class="message" class="text-msgs"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="attachment">
                                                                    <label>Attachment</label>
                                                                    <label class="attachment-link" for="file-attach">
                                                                        <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                                                        <input type="file" name="file" accept=".jpeg ,.zip ,.png , .pdf,.docx,.ppt" style="display:none;" class="file-attachhh" id="file-attach"/>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <ul class='images-lists'>

                                                                </ul>  
                                                            </div>
                                                        </div>    
                                                        <div class="row check-rule">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input class="styled-checkbox rules" id="ruless" type="checkbox" >
                                                                    <label for="ruless">I understad and agree to <a href=""> Terms of Use</a> and <a href="">Privacy Policy.</a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type='submit'id='upload'  class="btn btn_sm_green upload" disabled>Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
//            }
                                    ?>
                                    <?php
                                    include resource_path('views/includes/footer.php');
                                    include resource_path('views/includes/bottom-footer.php');
                                    ?>
                                     <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->   
                                    <script>
                                        $(document).ready(function(){
                                            
                                        
                                        var maxLength = 500;
                                        $(".more").each(function(){
                                            var myStr = $(this).text();
                                            if($.trim(myStr).length > maxLength){
                                                var newStr = myStr.substring(0, maxLength);
                                                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                                                $(this).empty().html(newStr);
                                                
                                                $(this).append(' <a href="javascript:void(0);" class="read-more" style="color:blue;">Read More...</a>');
                                                $(this).append('<span class="more-text">' + removedStr + '</span>');
                                            }
                                        });
                                        $(".read-more").click(function(){
                                            $(this).siblings(".more-text").contents().unwrap();
                                            $(this).remove();
                                        });
});
                                        $(".file-attachhh").on("change", function (e)
                                        {
                                            $('.images-lists').empty();

                                            var files = !!this.files ? this.files : [];
                                            var fileName = e.target.files[0].name;
                                            var filetype = e.target.files[0].type;
                                            file_path = '<?= asset('userassets/images/file.png') ?>';
                                            if (!files.length || !window.FileReader)
                                                return; // no file selected, or no FileReader support
                                            if (/^image/.test(files[0].type)) { // only image file
                                                var reader = new FileReader(); // instance of the FileReader
                                                reader.readAsDataURL(files[0]); // read the local file
                                                reader.onloadend = function () { // set image data as background of div

                                                    if (filetype == 'image/png') {
                                                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( ' + this.result + ' )"></div></li>');
                                                    } else if (filetype == 'image/jpeg') {
                                                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( ' + this.result + ' )"></div></li>');

                                                    } else {

                                                    }
                                                };
                                            } else {

                                                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( ' + file_path + ' )"></div></li>');

                                            }


                                        });
                                        $(".rules").click(function () {

                                            $(".upload").attr("disabled", !this.checked);
                                        });
                                        $('.post_proposel').validate({

                                            rules: {

                                                subject: {
                                                    required: true,
                                                     normalizer: function (value) {
                                return $.trim(value);
                            }

                                                },
                                                message: {
                                                    required: true,
                                                     normalizer: function (value) {
                                return $.trim(value);
                            }

                                                },
                                            },
                                            messages: {
                                                subject: "Please enter subject",
                                                message: "Please enter message"

                                            }

                                        });

                                    </script>