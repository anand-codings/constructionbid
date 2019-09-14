<?php
include resource_path('views/includes/top-header.php');
include resource_path('views/includes/header.php');
?>

<section class="search-section">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php include resource_path('views/includes/messages.php'); ?>
                <div class="seact-bar">
                    

                    <div class="form-group">
                        <input onkeyup="getEnterJob()" <?php if (isset($_GET['search_job'])) { ?> value="<?= $_GET['search_job'] ?>" <?php } ?>  type="text" class="general-field form-control" id="job_name" placeholder="Search Job"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class='mobile-filter'>
            <span>Filter</span>
        </div>

        <div class="row">
            <div class="search_menu_overlay" style="display: none;"></div>
            <div class="col-md-4 search-desktop">
                <div class='mobile-close-icon'>
                    <button type="button" class="close-modal" ><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <form id="job_search" action="<?= asset('post_job_search') ?>" method="Post">
                    <?= csrf_field(); ?>
                    <div class="search-filter">
                        <div class="filter-head">
                            <h6>Filter</h6>
                            <span>
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="filter-location">
                            <div class="address-filter">
                                <div class="filter-subtile">
                                    <h6>location</h6>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control general-field location-filed" <?php if (isset($_GET['location_usa'])) { ?> value="<?= $_GET['location_usa'] ?>" <?php } ?> name="location" id="location" placeholder="New York"/>
                                    <input id="lat" type="text" style="display:none" name="latitude">
                                    <input id="lng" type="text" style="display:none" name="longitude">
                                </div>
                                <div class="check-filter">
                                    <div class="form-group">
                                        <input class="styled-checkbox company_emp" id="contractors" name="company_emp[]" value="general_contractors" type="checkbox" style="display:none;">
                                        <label for="contractors">
                                            <img src="<?= asset('userassets/images/condructor.png') ?>"/>
                                            <span class="check-name">General Contractors</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input class="styled-checkbox company_emp" id="subcontractors" name ="company_emp[]" value="sub_contractors" type="checkbox" style="display:none;">
                                        <label for="subcontractors">
                                            <img src="<?= asset('userassets/images/sub.png') ?>"/>
                                            <span class="check-name">Subcontractors</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input class="styled-checkbox company_emp" id="suppliers" name="company_emp[]" value="supplier" type="checkbox" style="display:none;">
                                        <label for="suppliers">
                                            <img src="<?= asset('userassets/images/vendors.png') ?>"/>
                                            <span class="check-name">Suppliers/Vendors</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input class="styled-checkbox company_emp" id="professional" name="company_emp[]" value="professional" type="checkbox" style="display:none;">
                                        <label for="professional">
                                            <img src="<?= asset('userassets/images/professional.png') ?>"/>
                                            <span class="check-name">Professionals</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input class="styled-checkbox company_emp" id="owner" name="company_emp[]"  value="owner" type="checkbox" style="display:none;">
                                        <label for="owner">
                                            <img src="<?= asset('userassets/images/owner.png') ?>"/>
                                            <span class="check-name">Owners</span>
                                        </label>
                                    </div>
                                    <!--                                             <div class="form-group">
                                                                                      <input class="styled-checkbox company_emp" id="other" name="company_emp[]"  value="other" type="checkbox" style="display:none;">
                                                                                      <label for="other">
                                                                                           <img src="<?= asset('userassets/images/other.png') ?>"/>
                                                                                           <span class="check-name">Other</span>
                                                                                      </label>
                                                                                 </div>-->
                                </div>
                            </div>
                            <div class="specialites-filter">
                                <div class="filter-subtile">
                                    <h6>Specialities</h6>
                                    <span>
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="speciality">
                                    <?php
                                    if (isset($specialities)) {
                                        $count = 0;
                                        foreach ($specialities as $speciality) {
                                            ++$count;
                                            ?>
                                            <div class="form-group">
                                                <input class="styled-checkbox job_speciality" job="<?= $speciality->id; ?>" value="<?= $speciality->title; ?>" name="speciality[]" <?php if (isset($_GET['category_job']) && $speciality->title ==$_GET['category_job']) { ?> checked <?php } ?> id="speciality <?= $speciality->id; ?>" type="checkbox">
                                                <label for="speciality <?= $speciality->id; ?>"><?= $speciality->title ?> </label>
                                            </div>
                                        <?php }
                                        ?> <input type="hidden" id="count_speciality" value="<?= $count ?>">
    <?php }
?>
                                </div>
                            </div>

                            <!--                                   <div class="review-filter">
                                                                    <div class="filter-subtile">
                                                                         <h6>Reviews</h6>
                                                                         <span>
                                                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                                                         </span>
                                                                    </div>
                                                                    <div class="">
                                                                         <div class="form-group circle-custom-radio">
                                                                              <input type="radio" id="5star" value="5" name="star">
                                                                              <label for="5star">
                                                                                   <div class="radio-filters">
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                   </div>
                                                                              </label>
                            
                                                                         </div>
                                                                         <div class="form-group circle-custom-radio">
                                                                              <input type="radio" id="4star" value="4" name="star">
                                                                              <label for="4star">
                                                                                   <div class="radio-filters">
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                   </div>
                                                                              </label>
                                                                         </div>
                                                                         <div class="form-group circle-custom-radio">
                                                                              <input type="radio" id="3star" value="3" name="star">
                                                                              <label for="3star">
                                                                                   <div class="radio-filters">
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                   </div>
                                                                              </label>
                                                                         </div>
                                                                         <div class="form-group circle-custom-radio">
                                                                              <input type="radio" id="2star" value="2" name="star">
                                                                              <label for="2star">
                                                                                   <div class="radio-filters">
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                   </div>
                                                                              </label>
                                                                         </div>
                                                                         <div class="form-group circle-custom-radio">
                                                                              <input type="radio" id="1star" value="1" name="star">
                                                                              <label for="1star">
                                                                                   <div class="radio-filters">
                                                                                        <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                        <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                                                   </div>
                                                                              </label>
                                                                         </div>
                                                                    </div>
                                                               </div>-->
                            <!--<div class="form-group">-->
<!--                                        <input class="styled-checkbox" id="verify" type="checkbox">
                                 <label for="verify">Only Verify </label>-->
                            <!--</div>-->
                        </div>
                        <!--<div class="filter-btn">-->
                        <button onclick="getJobs()" class="btn btn_apply" type="button">Apply Filter</button>
                        <!--</div>-->
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="search-result">
                    <div class="search-header">
                        <h6>Search Results <span id="total_record"></span></h6>
                        <select id="pangination" onchange="getJobs()">
                             <option value="10">
                                  10 Per Page 
                             </option>
                             <option value="20">
                                  20 Per Page 
                             </option>
                        </select>
                    </div>
                    <div class="search-body">
                        <div class="default_search">
                            <?php
                            if (isset($result)) {
                                foreach ($result as $res) {
                                    ?> 

<!--                                    <div class="submit-row">

                                        <div class="proporsal-header">
                                            <div class='row'>
                                                <div class="col-md-6">
                                                    <div class='header-content'>
                                                        <a href="<?= asset('view_job') . '/' . $res->id; ?>"> <h6><?= ($res->title) ? $res->title : '' ?></h6></a>
                                                        <div class='proporsal-category'>
                                                            <span class='category-name'><?= ($res->category) ? $res->category : '' ?></span>
                                                            <span class='category-time'><i class="fa fa-clock-o" aria-hidden="true"></i> Posted <?php
                                                                $fdate = $current_date_time;
                                                                $tdate = $res->created_at;
                                                                $datetime1 = new DateTime($fdate);
                                                                $datetime2 = new DateTime($tdate);
                                                                $interval = $datetime1->diff($datetime2);
                                                                $days = $interval->format('%a'); //now do whatever you like with $days
                                                                echo $days;
                                                                ?> days ago</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="external_btns jobs_searches">
                                                <button type='button' class='btn_md_blue'><i class="fa fa-external-link" aria-hidden="true"></i> External Link</button>
                                                    <button type='button' <?php if(Auth::user()) { ?> data-target="#submit-proporsal<?= $res->id; ?>" <?php } else { ?> data-target="#loginmodal" <?php } ?> data-toggle="modal" value="<?= $res->id; ?>" class='btn_md_green'>Submit a Proposal</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="proporsal-contents">
                                            <p>
                                                <?= ($res->description) ? $res->description : '' ?>
                                            </p>
                                        </div>
                                        <div class='proporsal-column-row'>
                                            <div class='proporsal-column'>
                                                <div class='proporsal-img' style="background-image: url('<?php echo asset($res->getUser->profile_image); ?>')"></div>
                                                <div class="proporsal-content">
                                                    <h6>Client</h6>
                                                    <p><?= ($res->getUser->first_name) ? $res->getUser->first_name : '' ?></p>
                                                </div>
                                            </div>
                                            <div class='proporsal-column center-align'>
                                                <div class="proporsal-content">
                                                    <h6>Site Location</h6>
                                                    <p><?= ($res->location) ? $res->location : '' ?></p>
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
                                                 Modal Header 
                                                <div class="modal-header">
                                                    <div class="modal-title border-bottom">
                                                        <h6>Proposal Form</h6>
                                                    </div>
                                                    <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                 Modal body 
                                                <div class="modal-body">
                                                    <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                                        <span class="ajax-label-body"></span>
                                                    </div>
                                                    <form class="post_proposel<?= $res->id ?>" method="POST" action="<?= asset('add_proposal'); ?>" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>

                                                        <div class="form-group">
                                                            <label>To:</label>
                                                            <input type="text" name='user_name' value="<?= $res->getUser->first_name; ?>" class="form-control general-field user_name" placeholder="Harry Schwatrtz" readonly />
                                                            <input type="hidden" name="job_id" value="<?= $res->id; ?>">
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
                                                                    <label class="attachment-link" for="file-attach_<?= $res->id ?>">
                                                                        <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                                                        <input type="file" name="file" accept=".jpeg , .png , .pdf,.docx,.ppt" style="display:none;" class="file-attachhh" id="file-attach_<?= $res->id ?>"/>
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
                                                            <button type='submit'id='upload' data-job="<?= $res->id ?>" class="btn btn_sm_green upload" disabled>Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->

                                <?php }
                            } ?>
                            <div id="result">

                            </div>

                        </div>
                    </div>
                    <div class="paginations">
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include resource_path('views/includes/footer.php');
include resource_path('views/includes/bottom-footer.php');

?><script src="<?= asset('public/js/jquery.simplePagination.js'); ?>"></script>
<script>
    $('#job_name').keypress(function (e) {
        if (e.which == 13) {
            getJobs();
        }
    });
    jQuery('.mobile-filter').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery('.search_menu_overlay').show();
    });
    jQuery('.search_menu_overlay').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery(this).hide();
    });
    jQuery('.mobile-close-icon .close-modal').click(function () {
        jQuery('html').toggleClass('openfilter');
        jQuery('.search_menu_overlay').hide();
    });


    function getJobs() {
//         event.preventDefault();
        location_company = $('#location').val();
        pangination = $('#pangination').val();

        var val_emp = [];
        $('.company_emp:checked').each(function (i) {
            val_emp[i] = $(this).val();
        });

        var val = [];
        $('.job_speciality:checked').each(function (i) {
            val[i] = $(this).val();
        });
        lat = $('#lat').val();
        lng = $('#lng').val();
//            review = $('input[name=star]:checked').val();

        job = $('#job_name').val();
        $('#preloader').show();
        $.ajax({
            type: 'Post',
            url: "<?= asset('post_job_search') ?>",
            data: {'pangination': pangination, 'lat': lat, 'lng': lng, 'val_emp': val_emp, 'job_name': job, 'location': location_company, 'specialities': val, '_token': '<?= csrf_token(); ?>'},
            success: function (data) {
//               $("#result").html(data);
                data=JSON.parse(data);
                $('#preloader').hide();
                $('#result').appendTo('.search-body').html(data.view);
                $(".default_search").remove();
                $('#total_record').html('('+data.total_count+')');
                var items = $('#result .submit-row');
                var numItems = data.total_count;
    var perPage = pangination;
    items.slice(perPage).hide();

setTimeout(function(){
    $('.paginations').pagination({
        items: data.total_count,
        itemsOnPage: pangination,
        cssStyle: 'light-theme',
        onPageClick: function(pageNumber) {
            // We need to show and hide `tr`s appropriately.
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;

            // We'll first hide everything...
            items.hide()
                 // ... and then only show the appropriate rows.
                 .slice(showFrom, showTo).show();
        }
    });
}, 1000);
           },
            error: function () {
                $('#preloader').hide();
            }
        });
   }

    $(".rules").click(function () {

        $(".upload").attr("disabled", !this.checked);
    });

    var path = [];
    var type = [];
    var image_name = [];
    var count = 0;
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
//                alert(filetype);
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
    $('.upload').on('click', function () {
        id = $(this).data('job');

        $('.post_proposel' + id).validate({

            rules: {

                subject: {
                    required: true,

                },
                message: {
                    required: true,

                },
            },
            messages: {
                subject: "Please enter subject",
                message: "Please enter message"

            }

        });
    });
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('location')),
                {types: ['geocode']});
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lat').val(lat);
        $('#lng').val(lng);
    }
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }


    $(document).ready(function () {
        setTimeout(function () {
            getJobs();
        }, 100);

    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 
<section>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                AGREEMENT TO TERMS
            </div>
        </div>
    </div>
</section>