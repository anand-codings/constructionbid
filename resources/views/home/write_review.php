<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="review-write ">
    <div class="container">
        <div class="review-row padding-tb-lr">
            <form method='POST' action="<?= asset('post_review'); ?>" id='review_for_submit' enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type='hidden' name='review_images[]' id='review_images'/>
                <input type='hidden' name='review_images_name[]' id='review_images_name'/>
                <input type='hidden' name='rating' id='rating'>
                <input type='hidden' name='company_id' value="<?=$user->id?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="home_left_img text-center">
                            <img src="<?php echo asset($user->profile_image); ?>" alt="rectangle.png">
                        </div>
                        <div class="home_left_head">
                            <h2><?= $user->first_name; ?> <?= $user->last_name ?>
                                <a href="#">
                                    <?php if ($user->is_verified === 1) { ?>
                                        <img src="<?php echo asset('userassets/images/verified.svg'); ?>" alt="verified">
                                    <?php } ?>
                                </a>
                            </h2>
                        </div>
                        <div class="green-title">
                            <h5>Write a review for <?= $user->first_name; ?> <?= $user->last_name ?></h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                               <?php include resource_path('views/includes/messages.php'); ?>
                            <label>Rate This Professional</label>
                            <span class="my-rating-9"></span>
                            <span class="live-rating"></span>




                            <textarea class="text-msgs" name="description" placeholder="Please share your experience with this company."></textarea>
                        </div>
                    </div>
                </div>
                <!--                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" value="<? isset(Auth::user()->first_name) ? Auth::user()->first_name : '' ?>" name="first_name" class="form-control general-field" placeholder="First Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" value="<? isset(Auth::user()->last_name) ? Auth::user()->last_name : '' ?>" name="last_name" class="form-control general-field" placeholder="Last Name" />
                                        </div>
                                    </div>
                                </div>-->
                <!--                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Relation with company</label>
                                                <select>
                                                    <option>I hired this company</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->
                <!--                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Approximate Project Cost</label>
                                            <select>
                                                <option>Select one</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label>Project Completion Date</label>
                                        <div class="completion-date">
                                            <div class="form-group">
                
                                                <select>
                                                    <option>Month</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select>
                                                    <option>Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <label>Project Photos</label>
                        <ul class='revier-project'>
                            <li>
                                <label class="project-photo-img" for='photo-upload'>
                                    <div class='plus-circle'>
                                        +
                                    </div>
                                    Add Photo
                                </label>
                                <input type="file" style='display:none' id='photo-upload' />
                            </li>


                        </ul>
                    </div>
                </div>
                <!--                <div class="row">
                                    <div class="col-md-12">
                                        <div class="green-title">
                                            <h5>Account Verification (not publicly shown)</h5>
                                        </div>
                                    </div>
                                </div>-->
                <!--                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Your email</label>
                                            <input type="email" value="<? isset(Auth::user()->email) ? Auth::user()->email : '' ?>" name="email" class="form-control general-field" placeholder="Enter your email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Project Street Address</label>
                                            <input type="text" class="form-control general-field" placeholder="Enter project full address" />
                                        </div>
                                    </div>-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group term_use">
                            <input class="styled-checkbox" id="agrement" type="checkbox" value="value1">
                            <label for="agrement">I confirm that the information submitted here is true and accurate. I confirm that I do not work for, am not in competition with and am not related to this service provider.<br /><br />By signing up, signing in or continuing, I agree to <a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row submit_row">
                    <div class="col-md-6">
                        <a href="<?= asset('company_profile_home/' . $user->id); ?>" class="back_btn"><i class="fa fa-angle-left" aria-hidden="true"></i>
                            Back to Company Profile</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="review_submit" class="btn btn_md_green submit_review" disabled>Submit</button>
                    </div>
                </div>
            </form>
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
    jQuery(document).ready(function () {
        var path = [];
        var image_names = [];
        var counts = 0;
         $("#agrement").click(function () {
                $("#review_submit").attr("disabled", !this.checked);
            });
        $("#photo-upload").on("change", function () {

            var form_data = new FormData();
            form_data.append("file", document.getElementById('photo-upload').files[0]);

            var baseUrl = '<?= asset('/'); ?>';
            $('#preloader').show();
            $.ajax({
                url: "<?= asset('/upload_review_image') ?>", // point to server-side PHP script 
                dataType: 'json', // what to expect back from the PHP script
                contentType: false,
                cache: false,
                processData: false,
                data: form_data,
                type: 'POST',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                },
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {

                        path.push(data.path);
                        image_names.push(data.name);
                        var new_img_path = baseUrl + data.path;

                        $('.revier-project').prepend('<li class="delete_li' + counts + '"><div class="project-photo-img" style="background-image:url(' + new_img_path + ')"><div data-index="' + counts + '" class="delete-profile"><img src="<?= asset('userassets/images/close.png') ?>"></div><span>' + data.name + '</span></li>');
                     counts++;
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000)
                    }

                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });
            //            var files = !!this.files ? this.files : [];
            //            if (!files.length || !window.FileReader)
            //                return; // no file selected, or no FileReader support
            //            if (/^image/.test(files[0].type)) { // only image file
            //                var reader = new FileReader(); // instance of the FileReader
            //                reader.readAsDataURL(files[0]); // read the local file
            //                reader.onloadend = function() { // set image data as background of div
            //                    $('.revier-project').prepend('<li><div class="project-photo-img" style="background-image:url('+ this.result +');"></div><div class="delete-profile"><img src="http://localhost/construction-webapp/userassets/images/close.png"></div></li>');
            ////                    $(".banner-logo-img").css("background-image", "url(" + this.result + ")");
            //
            //                };
            //            }
        });
        $('body').on('click', '.delete-profile', function () {

            $this = $(this);
            var index = $this.data('index');

            path[index] = null;
            image_names[index] = null;

            $('.delete_li' + index).remove();
        });
        $('body').on('click', '.submit_review', function (event) {
            event.preventDefault();
            $('#review_images').val(path);
            $('#review_images_name').val(image_names);
            $("#review_for_submit").submit();
        });
              $('#review_for_submit').validate({// initialize the plugin
            rules: {
          
                description: {
//               phoneUS: true,
                    required: true,
//               minlength: 9,
//               maxlength: 12,
//               number : true,

                },
                   rating: {
//               phoneUS: true,
                    required: true,
//               minlength: 9,
//               maxlength: 12,
//               number : true,

                },
//            profile_image: {
//                extension: "xls|csv",
//            },
            }
        });
    });


</script>
