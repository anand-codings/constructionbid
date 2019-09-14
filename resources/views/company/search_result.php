<?php
if (isset($result)) {
    foreach ($result as $res) {
        ?> 
        <div class="submit-row">
            <div class="proporsal-header">
                <div class='row'>
                    <div class="col-md-6">
                        <div class='header-content'>
                            <a href="<?= asset('view_public_job/' . $res->id) ?>"><h6><?= ($res->title) ? $res->title : '' ?></h6></a>
                            <div class='proporsal-category'>
                                <span class='category-name'><?= ($res->category) ? $res->category : '' ?></span>
                                <span class='category-time'><i class="fa fa-clock-o" aria-hidden="true"></i> Posted <?php
                                    echo isset($res->updated_at) ? timeago($res->updated_at) : '';
                                    ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="external_btns jobs_searches">
                            <?php
                            if ($res->extrnal_link) {
                                $href = $res->extrnal_link;
                                if (strpos('http', $res->extrnal_link) == FALSE) {
                                    $href = $res->extrnal_link;
                                }
                                ?>
                                <a target="_blank" href="<?= $href ?>"   class='btn_md_blue'><i class="fa fa-external-link" aria-hidden="true"></i> External Link</a>
                            <?php } if (Auth::user() && !($res->appliedProposal)) { ?>
                                <button type='button' <?php if (Auth::user()) { ?> data-target="#submit-proporsal<?= $res->id; ?>" <?php } else { ?> data-target="#loginmodal" <?php } ?>  data-toggle="modal" value="<?= $res->id; ?>" class='btn btn_md_green'>Submit a Proposal</button>
                            <?php } else { ?>
                                <button type='button' <?php if (Auth::user()) {
                        ?><?php } else {
                                    ?> data-target="#loginmodal" <?php }
                                ?>  data-toggle="modal" value="<?= $res->id; ?>" <?php
                                        if (Auth::user()) {
                                            if ($res->appliedProposal->status == 'reject') {
                                                ?>class='btn btn_sm_red' <?php } else { ?> class=' btn btn_md_green' <?php }
                    } ?> class=' btn btn_md_green' >
                                        <?php
                                        if (Auth::user()) {
                                            if ($res->appliedProposal->status == 'accept') {
                                                echo 'Accepted';
                                            } else if ($res->appliedProposal->status == 'reject') {
                                                echo 'Rejected';
                                            } else {
                                                echo 'Pending';
                                            }
                                            ?>

                                    <?php } else {
                                        ?> 
                                        Submit a Proposal 
            <?php } ?></button>
        <?php } ?>
                        </div></div>
                </div>
            </div>
            <div class="proporsal-contents">
                <p>
                    <?php
                    $string = strip_tags($res->description);
                    if (strlen($string) > 500) {

                        // truncate string
                        $stringCut = substr($string, 0, 500);
                        $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $string .= '...';
//                                                    $string .= '... <a href="/this/story">Read More</a>';
                    }
//                                                echo $string;
                    ?>
        <?= ($string) ? $string : '' ?>
                </p>
            </div>
            <div class='proporsal-column-row'>
                <div class='proporsal-column'>
                    <div class='proporsal-img' style="background-image: url('<?php echo (!empty($user->getSubscription))? getUserImage($res->getUser->profile_image):asset('userassets/images/left_img1.png'); ?>')"></div>
                    <div class="proporsal-content">
                        <h6>Client</h6>
                        <p><?= (!empty($user->getSubscription))?(($res->getUser->first_name) ? $res->getUser->first_name : ''):'No name' ?></p>
                    </div>
                </div>
                <div class='proporsal-column center-align'>
                    <div class="proporsal-content">
                        <h6>Site Location</h6>
                        <p><?= (!empty($user->getSubscription)) ? (($res->location) ? $res->location : ''):'No Location' ?></p>
                    </div>
                </div>
                <div class='proporsal-column center-align'>
                    <div class="proporsal-content">
                        <h6>Budget Approx.</h6>
                        <p><img src='<?= asset('userassets/images/banknote.png'); ?>'/><?= ($res->budget_start) ? '$' . $res->budget_start : '' ?> to <?= ($res->budget_end) ? '$' . $res->budget_end : '' ?></p>
                    </div>
                </div>
                <div class='proporsal-column center-align'>
                    <div class="proporsal-content">
                        <h6>Project Type</h6>
                        <p><?= ($res->type == 'one_time_project') ? 'One Time' : 'On Going' ?></p>
                    </div>
                </div>
            </div>
        </div>    
        <div class="modal fade" id="submit-proporsal<?= $res->id; ?>">

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
                        <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <span class="ajax-label-body"></span>
                        </div>
                        <form class="post_proposell" method="POST" action="<?= asset('add_proposal'); ?>" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                            <input type="hidden" name="id" id='proposal_id'>

                            <div class="form-group">
                                <label>To:</label>
                                <input type="text" name='user_name' class="form-control general-field user_name" value="<?= $res->getUser->first_name; ?>" placeholder="Harry Schwatrtz" readonly />
                                <input type="hidden" name="job_id" value="<?= $res->id; ?>" >
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject"  class="form-control general-field subject" placeholder="Add a subject live" />
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
                                        <label class="attachment-link" for="file-attachh<?= $res->id; ?>">
                                            <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>

                                            <input type="file" name="file" accept=".jpeg ,.png ,.pdf,.ppt,.zip,.docx" style="display:none;" class="file-attach" id="file-attachh<?= $res->id; ?>"/>

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
                                        <input class="styled-checkbox ruless" name="check1" id="rules<?= $res->id; ?>" type="checkbox"  >
                                        <label for="rules<?= $res->id; ?>">I understand and agree to <a href=""> Terms of Use</a> and <a href="">Privacy Policy.</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type='submit' class="btn btn_sm_green upload" disabled>Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php } if ($result->isEmpty()) {
        ?>   <p> No result found </p>
        <?php
    }
}
?>
<script>
    $(".ruless").click(function () {
        $(".upload").attr("disabled", !this.checked);
    });

//    $('.post_proposell').validate({
//            rules: {
//                
//                subject: {
//                    required: true,
//
//                },
//                message: {
//                    required: true,
//
//                },
//            },
//            messages: {
//                subject: "Please enter subject",
//                message: "Please enter message"
//            }
//    });
$(document).ready(function(){
//     jQuery.validator.addMethod("noSpace", function(value, element) { 
//      
//  return value.indexOf(" ") < 0 && value != ""; 
//}, "No space please and don't leave it empty");
});
    $('.post_proposell').each(function () {
        $(this).validate({
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
                   
                }
            },
            messages: {
                subject: "Please enter subject",
                message: "Please enter message"
            }
        });
    });
    $(".file-attach").on("change", function (e)
    {
//        alert('here');
        $('.images-lists').empty();
        var filename = $(this).val();
        var aux = filename.split('.');
        var extension = aux[aux.length - 1].toUpperCase();
//   alert(extension);
        var files = !!this.files ? this.files : [];
        var fileName = e.target.files[0].name;
        var filetype = e.target.files[0].type;
        file_path = '<?= asset('userassets/images/file.png') ?>';
        zip_path = '<?= asset('userassets/images/zip.png') ?>';
        pdf_path = '<?= asset('userassets/images/pdf.png') ?>';
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
//                       console.log(files);
                if (filetype == 'image/png') {
                    $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( ' + this.result + ' )"></div></li>');
                } else if (filetype == 'image/jpeg') {
                    $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( ' + this.result + ' )"></div></li>');

                }

            }
        } else {
            if (extension == 'ZIP') {
                $('.images-lists').append('<li><div class="upload-imgs" style="background-image:url( ' + zip_path + ' )"></div></li>');
            } else if (extension == 'PDF') {
                $('.images-lists').append('<li><div class="upload-imgs" style="background-image:url( ' + pdf_path + ' )"></div></li>');
            } else {
                $('.images-lists').append('<li><div class="upload-imgs" style="background-image:url( ' + file_path + ' )"></div></li>');
            }
        }

    });
</script>