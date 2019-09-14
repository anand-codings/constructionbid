<?php
include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class='basic-info'>
    <div class='container'>
        <div class='info-header'>
            <div class="row">
                <div class='col-md-12'>

                    <a href="#">
                        <img src='<?= asset('userassets/images/logo1.png'); ?>' />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="basic-tabs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class="tab-wrapper">
                    <div class="arrow-steps clearfix">
                        <div class="step current"  data-attribute='title-description'> <span> Title & Description</span> </div>
                        <div class="step  " data-attribute='details-experties'> <span> Details & Experties</span> </div>
                        <div class="step " data-attribute='budget'> <span> Budget</span> </div>
                        <div class="step" data-attribute='finish'> <span>Finish</span> </div>
                    </div>
                    <form method='POST' action="<?= asset('edit_post_job'); ?>" id='job_for_submit' enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <input type='hidden' name='job_images[]' id='job_images'/>
                        <input type='hidden' name='job_images_type[]' id='job_images_type'/>
                        <input type='hidden' name='job_images_name[]' id='job_images_name'/>
                        <input type='hidden' name='job_specialities_name[]' id='job_specialities_name'/>
                        <input type='hidden' name='job_specialities_id[]' id='job_specialities_id'/>
                        <input type='hidden' name='lat' id='lat'/>
                        <input type='hidden' name='long' id='long'/>
                        <input type='hidden' name='is_draft' id='is_draft'/>
                        <div class='info-tab-content'>
                            <div class="tabs-content active-tabs" id='title-description'>
                                <div class='basic-info-tabs title-description-tabs'>
                                    <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                        <span class="ajax-label-body"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Job Title
                                        </label>
                                        <input type="text"  id="job_title" name="job_title" value="<?= (old('job_title')) ? old('job_title') : (isset($result->title) ? $result->title : ''); ?>" class="form-control background-field enter_key" placeholder="Enter the name of your job post" />
                                        <input type="hidden" id="job_id" name="job_id" value="<?= isset($result->id) ? $result->id : '' ?>" />
                                        <span id ="job_title_span" class ="error<?= 1; ?>" style="display:none; color:red">Job Title Required</span>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Job Description
                                        </label>
                                        <textarea class="enter_key" rows="5" id="job_description" name="job_description" width="100%" name="des" placeholder="Enter business description"><?= (old('job_description')) ? old('job_description') : (isset($result->description) ? $result->description : ''); ?></textarea>
                                        <span id ="job_description_span" class ="error<?= 2; ?>" style="display:none; color:red">Job Description Required</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Project brief Files</label>
                                            <ul class="revier-project">
                                                <?php
                                                if (isset($result->getFiles)) {
                                                    $count = 1;
                                                    foreach ($result->getFiles as $files) {
                                                        ?>


                                                        <?php if ($files->type == 'image') {
                                                            ?>
                                                            <li class='li_image<?= $count ?>'>
                                                                <input type="hidden" class="image_no<?= $count ?>" value="<?= asset($files->path) ?>">
                                                                <input type="hidden" class="image_type<?= $count ?>" value="<?= $files->type ?>">
                                                                <input type="hidden" class="image_name<?= $count ?>" value="<?= $files->original_name ?>">
                                                                <input type="hidden" class="image_id<?= $count ?>" value="<?= $files->id ?>">
                                                                <div class="project-photo-img" id="images<?= $files->id; ?>"  data-id="<?= $files->id ?>" value="<?= $files->path ?>" style="background-image:url('<?php echo asset($files->path) ?>');"></div>
                                                                <div class="delete-profile" data-li-count='<?= $count ?>' data-id="<?= $files->id ?>">
                                                                    <img src="<?php echo asset('userassets/images/close.png') ?>">
                                                                </div>
                                                                <span><?= $files->original_name ?></span>
                                                            </li>
                                                        <?php } elseif ($files->type == 'pdf') { ?> 

                                                            <li class='li_image<?= $count ?>'>
                                                                <input type="hidden" class="image_no<?= $count ?>" value="<?= asset($files->path) ?>">
                                                                <input type="hidden" class="image_type<?= $count ?>" value="<?= $files->type ?>">
                                                                <input type="hidden" class="image_name<?= $count ?>" value="<?= $files->original_name ?>">
                                                                <input type="hidden" class="image_id<?= $count ?>" value="<?= $files->id ?>">

                                                                <div class='brief-images'>
                                                                    <img src="<?php echo asset('userassets/images/pdf1.png') ?>" />
                                                                </div>
                                                                <div class="delete-profile" data-li-count='<?= $count ?>' data-id="<?= $files->id ?>">
                                                                    <img src="<?php echo asset('userassets/images/close.png') ?>">
                                                                </div>
                                                                <span><?= $files->original_name ?></span>



                                                            </li>
                                                        <?php } elseif ($files->type == 'doc') {
                                                            ?> 
                                                            <li class='li_image<?= $count ?>'>
                                                                <input type="hidden" class="image_no<?= $count ?>" value="<?= asset($files->path) ?>">
                                                                <input type="hidden" class="image_type<?= $count ?>" value="<?= $files->type ?>">
                                                                <input type="hidden" class="image_name<?= $count ?>" value="<?= $files->original_name ?>">
                                                                <input type="hidden" class="image_id<?= $count ?>" value="<?= $files->id ?>">
                                                                <div class="project-photo-img">
                                                                    <div class="project-img">
                                                                        <div class="brief-images">
                                                                            <img src="<?php echo asset('userassets/images/doc.png') ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div data-id="<?= $files->id ?>" data-li-count='<?= $count ?>' class="delete-profile">
                                                                        <img src="<?= asset('userassets/images/close.png') ?>">
                                                                    </div>
                                                                    <span><?= $files->original_name ?></span>
                                                                </div> 
                                                            </li>

                                                        <?php } elseif ($files->type == 'zip') {
                                                            ?> 

                                                            <li class='li_image<?= $count ?>'>
                                                                <input type="hidden" class="image_no<?= $count ?>" value="<?= asset($files->path) ?>">
                                                                <input type="hidden" class="image_type<?= $count ?>" value="<?= $files->type ?>">
                                                                <input type="hidden" class="image_name<?= $count ?>" value="<?= $files->original_name ?>">
                                                                <input type="hidden" class="image_id<?= $count ?>" value="<?= $files->id ?>">
                                                                <div class="breif-box">
                                                                    <div class="project-img">
                                                                        <div class='brief-images'>
                                                                            <img src="<?php echo asset('userassets/images/zip.png') ?>" />
                                                                        </div>
                                                                        <div class="delete-profile" data-li-count='<?= $count ?>' data-id="<?= $files->id ?>">
                                                                            <img src="<?php echo asset('userassets/images/close.png') ?>">
                                                                        </div>
                                                                        <div class="hover-layer">
                                                                            <a href="">
                                                                                <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <span><?= $files->original_name ?></span>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                        ++$count;
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <label class="project-photo-img" for="photo-upload">
                                                        <div class="plus-circle">
                                                            +
                                                        </div>
                                                        Add Photo
                                                    </label>
                                                    <input type="file" name="file" style="display:none" id="photo-upload" accept=".jpg,.png,.pdf,.zip,.docx,.doc"/>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="nav step-pagination ">
                                    <a href="#" class="first_prev" ></a>
                                    <div class="save-draft">

                                        <button type="submit" class="btn btn_md_green draft_submit">Save as Draft</button>
                                        <a href="javascript:void(0)" class="btn btn_md_green " data-count="<?= isset($count) ? $count : '' ?>" id="first">Next</a>

                                    </div>
                                </div>

                            </div>
                            <div class="tabs-content" id='details-experties'>
                                <div class='business-info-tab details-experties-tab'>
                                    <div class="business-detail-section">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        Project Type
                                                    </label>
                                                </div>
                                                <div class="genders">
                                                    <div class="form-group custom-radio">
                                                        <input type="radio" id="one-time" name="project" value="One Time Project" <?= isset($result->type) ? ($result->type == 'one_time_project') ? 'checked' : '' : 'checked'; ?>>
                                                        <label for="one-time">One-time project</label>
                                                    </div>
                                                    <div class="form-group custom-radio">
                                                        <input type="radio" id="ongoing" name="project" value="On Going Project" <?= isset($result->type) ? ($result->type == 'ongoing_project') ? 'checked' : '' : ''; ?>>
                                                        <label for="ongoing">Ongoing project</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-4">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>
                                                        Category
                                                    </label>
                                                    <select name='category' style="display: none;">
                                                        <option value="general_contractors" <?= isset($result->category) ? ($result->category == 'general_contractors') ? 'selected' : '' : 'selected'; ?>>
                                                            General Contractors
                                                        </option >
                                                        <option value="sub_contractors" <?= isset($result->category) ? ($result->category == 'sub_contractors') ? 'selected' : '' : ''; ?>>
                                                            Sub Contractors
                                                        </option>
                                                        <option value="supplier" <?= isset($result->category) ? ($result->category == 'supplier') ? 'selected' : '' : ''; ?>>
                                                            Supplier
                                                        </option>
                                                        <option value="professional" <?= isset($result->category) ? ($result->category == 'professional') ? 'selected' : '' : ''; ?>>
                                                            Professional
                                                        </option>
                                                        <option value="owner" <?= isset($result->category) ? ($result->category == 'owner') ? 'selected' : '' : ''; ?>>
                                                            Owner
                                                        </option>
                                                    </select>
<!--                                                    <div class="nice-select" tabindex="0"><span class="current">
                                                            General Contractors
                                                        </span>
                                                        <ul class="list">
                                                            <li data-value="General Contractors" class="option selected">
                                                                General Contractors
                                                            </li>
                                                            <li data-value="General Contractors" class="option">
                                                                General Contractors
                                                            </li>
                                                            <li data-value="General Contractors" class="option">
                                                                General Contractors
                                                            </li>
                                                        </ul>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>
                                                        Selected Specialities
                                                    </label>
                                                </div>
                                                <!-- Services -->
                                                <div class="services">
                                                    <?php
                                                    if (isset($specialities)) {
                                                        $i = 0;
                                                        foreach ($specialities as $special) {
                                                            $count = 0;
                                                            if (isset($result->getSpeciality) && $result->getSpeciality->isNotEmpty() && isset($result->getSpeciality)) {
                                                                foreach ($result->getSpeciality as $company_special) {
                                                                    if ($company_special->speciality_id === $special->id) {
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <input class="styled-checkbox add_speciality"  data-count='<?= $i ?>' data-special-id-admin='<?= $special->id ?>'  data-special-name="<?= $special->id ?>" id="speciality<?= $company_special->id; ?>" data-id="<?= $company_special->id ?>" type="checkbox" value="<?= $company_special->id ?>" checked>
                                                                            <label for="speciality<?= $company_special->id ?>"><?= $company_special->name ?></label>
                                                                            <input type="hidden"  data-count='<?= $i ?>' id="speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                                                            <input type='hidden' id="speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                                                            <!--                                            <input type="hidden" id="sepcial<?php //$company_special->id;   ?>" value="<?php //$special->id   ?>">
                                                            <input type="hidden" id="sepcial_name<?php //$company_special->id;   ?>" value="<?php //$special->title   ?>">-->
                                                                            <input class="styled-checkbox" id="speciality_name<?= $company_special->id ?>"  data-id="<?= $company_special->id ?>" type="checkbox" value="<?= $company_special->name ?>">

                                                                        </div>
                                                                        <?php
                                                                        $i++;
                                                                        $count++;
                                                                    }
                                                                }if ($count == 0) {
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <input class="styled-checkbox add_speciality_admin" data-count='<?= $i ?>' id="speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                                                        <label for="speciality<?= $special->id ?>"><?= $special->title ?></label>
                                                                        <input class="styled-checkbox" id="speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                                                                    </div>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="form-group">
                                                                    <input class="styled-checkbox add_speciality_admin " data-count='<?= $i ?>' id="speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                                                    <label for="speciality<?= $special->id ?>"><?= $special->title ?></label>
                                                                    <input class="styled-checkbox" id="speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                                                                </div>
                                                                <?php
                                                                $i++;
                                                            }
                                                        }
                                                    } else {
                                                        ?>

                                                        <h6>No sepciality added by Admin</h6>
                                                    <?php }
                                                    ?>

                                                    <!--                                                    <div class="form-group">
                                                                                                            <label><a href=" #" data-target="#other-services" data-toggle="modal">Other</a></label>
                                                                                                        </div>-->

                                                </div>
                                                <span class ="error_speciality" style="display:none; color:red">Please Check Specialities</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="nav step-pagination ">
                                        <a href="#" class="first_prev" ><i class="fa fa-angle-left" aria-hidden="true"></i>  <strong>Title and Description</strong></a>
                                        <div class="save-draft">
                                            <button type="submit" class="btn btn_md_green draft_submit">Save as Draft</button>
                                            <a href="#" class="btn btn_md_green next "  id="next">Next</a>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="tabs-content" id='budget'>
                                <div class='membership-tab budget-tabs'>
                                    <!--                                        <div class='row'>
                                    
                                                                                <div class="col-sm-12">
                                                                                    <div class="green-title">
                                                                                        <h5>Job End</h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->
                                    <div class='row'>

                                        <div class="col-sm-6">
                                            <div class="d-flex expected-date">
                                                <div class="form-group w-100">
                                                    <label>Date</label>
                                                    <?php $dt = Illuminate\Support\Carbon::now();
                                                    $dt->addHours(5);
                                                    ?>
                                                    <input type="date" name="date" id="date" min="<?= $dt->toDateString(); ?>" class="form-control background-field" value="<?= $dt->toDateString() ?>" placeholder="Enter your Location" disabled>
                                                    <span id="date_span" class ="error<?= 3; ?>" style="display:none; color:red">Date Required</span>
                                                </div>
                                                <div class="form-group ml-4 w-100 ml-sm-0">
                                                    <label>Time</label>
                                                    <input type="time" name="time" id="time" class="form-control background-field" value="<?= $dt->toTimeString(); ?>" placeholder="Enter your Location" disabled>
                                                    <span id ="time_span" class ="error<?= 4; ?>" style="display:none; color:red">Time Required</span>
                                                </div>
                                            </div>
                                            <div class="form-group py-4">
                                                <label>
                                                    Location
                                                </label>
                                                <input type="text" name='location'id="location" class="form-control background-field enter_key_2" value="<?= isset($result->location) ? $result->location : '' ?>" placeholder="Enter your Location" autocomplete="off">
                                                <span id ="location_span" class ="error<?= 5; ?>" style="display:none; color:red">Location Required</span>
                                            </div>

                                            <div class="d-flex py-4 expected-date">
                                                <div class="form-group w-50">
                                                    <label>Expected Start</label>
                                                    <input type="date" name="start_date" id="start_date" min="<?= $dt->toDateString(); ?>" value="<?= isset($result->start) ? $result->start : '' ?>" class="form-control background-field" placeholder="Enter your Location">
                                                    <span id ="start_date_span" class ="error<?= 6; ?>" style="display:none; color:red">Start Date Required</span>
                                                </div>
                                                <div class="form-group w-50">
                                                    <label>Expected End</label>
                                                    <input type="date" name="end_date" id="end_date" min="<?= $dt->toDateString(); ?>" value="<?= isset($result->finish) ? $result->finish : '' ?>" class="form-control background-field" placeholder="Enter your Location">
                                                    <span id ="end_date_span" class ="error<?= 9; ?>" style="display:none; color:red">End Date Required</span>
                                                </div>

                                            </div>
                                            <span  class ="wrong_dates" style="display:none; color:red">Please provide properly expected end date</span>
                                            <style>
                                                .cur-sign {
                                                    position: relative;
                                                }
                                                .cur-sign i {
                                                    position: absolute;
                                                    left: 10px;
                                                    top: 11px;
                                                }
                                                .cur-sign .form-control {
                                                    padding-left: 20px;
                                                }
                                                i.custom {
                                                    /*font-size: 2em;*/ 
                                                    /*color: gray;*/
                                                }
                                            </style>
                                            <div class="py-4">
                                                <?php
                                                $currency = '';
                                                if ($User->currency == 'pound') {
                                                    $currency = 'fa fa-gbp';
                                                } else {
                                                    $currency = 'fa fa-dollar';
                                                }
//                                                        echo $currency;
                                                ?>
                                                <label>Job Budget</label>
                                                <div class="d-flex align-items-center expected-date">
                                                    <div class="form-group cur-sign">
                                                        <i class="<?= $currency ?>"></i>
                                                        <input type="number" name="budget_start" id="budget_start" value="<?= isset($result->budget_start) ? $result->budget_start : '' ?>" class="form-control background-field enter_key_2" placeholder="Budget Start">

                                                        <span id ="budget_start_span" class ="error<?= 7; ?>" style="display:none; color:red">Budget Start Required</span>
                                                    </div>
                                                    <div class=" to" style="width:30px;">
                                                        <p class="">to</p>
                                                    </div>
                                                    <div class="form-group ml-4 cur-sign">
                                                        <i class="<?= $currency ?>"></i>
                                                        <input type="number" name="budget_end" id="budget_end" value="<?= isset($result->budget_end) ? $result->budget_end : '' ?>"class="form-control background-field enter_key_2" placeholder="Budget End">

                                                        <span id ="budget_end_span" class ="error<?= 8; ?>" style="display:none; color:red">Budget End Required</span>
                                                    </div>
                                                </div>
                                                <span  class ="wrong_bidget" style="display:none; color:red"> Please add the proper budget value!</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nav step-pagination">
                                        <a href="#" class="second_prev" ><i class="fa fa-angle-left second_prev" aria-hidden="true"></i><strong> Detail and Expertise</strong></a>
                                        <div class="save-draft">

                                            <button type="submit" class="btn btn_md_green draft_submit">Save as Draft</button>
                                            <a href="#" class="btn btn_md_green"id="second_next">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs-content" id='finish'>
                                <section class='submit-proporsal finish-tab'>
                                    <div class="">
                                        <div class="submit-row m-0 job-submit">
                                            <div class="">
                                                <div class='row'>
                                                    <div class="col-md-12">
                                                        <div class='header-content'>
                                                            <h6 id="title"></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='d-flex align-items-start flex-wrap mt-4 job-finish-content'>
                                                <div class='job_post_finish'>

                                                    <div class="proporsal-content">
                                                        <h6>Site Location</h6>
                                                        <p class="pt-2 " id="location_tab"></p>
                                                    </div>
                                                </div>
                                                <div class='job_post_finish center-align'>
                                                    <div class="proporsal-content">
                                                        <h6>Budget Approx.</h6>
                                                        <p class="pt-2" id="budget_start_tab"></p>  
                                                    </div>
                                                </div>
                                                <div class='job_post_finish center-align'>
                                                    <div class="proporsal-content">
                                                        <h6>Project Type</h6>
                                                        <p class="pt-2 " id="project_type"></p>
                                                    </div>
                                                </div>
                                                <div class='job_post_finish center-align'>
                                                    <div class="proporsal-content">
                                                        <h6>Experties</h6>
                                                        <p class="pt-2 " id="experiese"></p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class='proporsal-detail'>
                                    <div class="container">
                                        <div class="submit-row m-0 job-submit">
                                            <div class='row'>
                                                <div class='col-sm-12'>
                                                    <div class='proporsal-detail'>
                                                        <p id="description_tab">

                                                        </p>

                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='project-brief'>
                                                        <h6 class='project-brief-title'>Project Brief Files</h6>
                                                        <ul class="job_post_files">





                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="styled-checkbox" id="proporsal_link"  name="service_qoute_notication" type="checkbox" <?= isset($result->extrnal_link) ? 'checked' : ''; ?>>
                                            <label for="proporsal_link">Add an external link to my proposal</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="link_field">
                                                <input id="review_submit" name="extrnal_link" type="text" value="<?= isset($result->extrnal_link) ? $result->extrnal_link : '' ?>"class="form-control background-field" placeholder="Enter the link" <?= isset($result->extrnal_link) ? '' : 'disabled' ?>>
                                                <span id="error_external" style="display:none; color:red">Please enter valid url</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="nav step-pagination ">
                                    <a href="#" class="prev" style=""><strong>Previous</strong></a>
                                    <div class="save-draft">
                                        <button type="submit" class="btn btn_md_green draft_submit">Save as Draft</button>
                                        <button type='submit'class="btn btn_md_green submit_job">Post Job</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- other services Modal -->
<!-- Specialities Modal
--><div class="modal fade show" id="other-services" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"><!--


            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Select Other</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">

                <form method='POST' action='<?= asset('/add_speciality_admin'); ?>' id='formId' class="quote-form" enctype="multipart/form-data">

                    <h6><strong>What other deliverables do you need?</strong></h6>
                    <div class="form-group">
                        <input type="text" name="title" class="form-control general-field" placeholder="Enter value" >

                    </div>


                    <div class="form-group-special">
                    </div>
                    <h6><strong>You enter</strong></h6>
                    <?php
                    if (isset($result->getSpeciality)) {
                        $special_count = 0;
                        ?>
                        <div class="general_contractor_tags">
    <?php foreach ($result->getSpeciality as $special) { ?>
                                <input type="hidden" class="special_name<?= $special->id ?>" id="special_name<?= $special_count ?>" data-special-count="<?= $special_count ?>" value="<?= $special->name ?>">
                                <span><?= $special->name ?><a href="javascript:void(0)"><a href="javascript:void(0)" id='special'<?= $special->id ?> data-id='<?= $special->id ?>' class="text-danger delete_speciality"><i class="fa fa-times" aria-hidden="true"></i></a></span>
                                <?php
                                ++$special_count;
                            }
                            ?>
                        </div>
                        <input type="hidden" class="special_name_count" value="<?= $special_count ?>">
<?php } ?>
                    <div class="form-group">
                        <input type="submit"  class="btn btn_md_green px-4 "  value="Save">
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
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
</script>

<script>
    //window.addEventListener("beforeunload", function(event) {
    //
    //    event.returnValue = "Your.";
    //});
    jQuery(document).ready(function () {
        $("#proporsal_link").click(function () {
            $("#review_submit").attr("disabled", !this.checked);
        });


        $(function () {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;

            $('#date').attr('min', maxDate);
        });
        var path = [];
        var type = [];
        var image_names = [];
        var counts = 0;
        var back = jQuery(".prev");
        var first_back = jQuery(".first_prev");
        var second_back = jQuery(".second_prev");
        var first = jQuery("#first");

        var second_next = jQuery("#second_next");
        var next = jQuery(".next");
        var steps = jQuery(".step");
        //                          $('input[name=project]').change(function(){
        //    var value = $( 'input[name=project]:checked' ).val();

        //});
        var special_name = [];
        var special_id = [];
        $('body').on('click', '.submit_job', function (event) {
            event.preventDefault();
             var check = $('#proporsal_link').prop('checked');
            $('#job_images').val(path);
            $('#job_images_type').val(type);
            $('#job_images_name').val(image_names);
            $('#job_specialities_name').val(special_name);
            $('#job_specialities_id').val(special_id);
            if(check==true){
            if (/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test($("#review_submit").val())) {

                $("#error_external").hide();
            } else {
                event.preventDefault();
                $("#error_external").show();
                return false;
            }}
            $("#job_for_submit").submit();
        });
        $('body').on('click', '.draft_submit', function (event) {
            event.preventDefault();

            $('#job_images').val(path);
            $('#job_images_type').val(type);
            $('#job_images_name').val(image_names);
            $('#job_specialities_name').val(special_name);
            $('#job_specialities_id').val(special_id);
            $('#is_draft').val(1);

//                if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test($("#review_submit").val())){
//                   
//                    $("#error_external").hide();
//                } else {
//                        event.preventDefault();
//                        $("#error_external").show();
//                        return false;
//                    
//                }

            $("#job_for_submit").submit();
        });

        $(document).on("keypress", ".enter_key", function (e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#first').trigger('click');

            }
        });
        $(document).on("keypress", ".enter_key_2", function (e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#second_next').trigger('click');

            }
        });
//            $('body').on('change', '.add_speciality', function () {
//                $this = $(this);
//                var id = $this.data('id');
//                var index = $this.data('special-count');
//
//                var special_ids = $('#speciality' + id).val();
//                var special_names = $('#speciality_name' + id).val();
//    //        special_id.push(special_ids);
//    //        special_name.push(special_names);
//
//                var check = $('#speciality' + id).prop('checked');
//
//                if (check === true)
//                {
//                    special_id[index] = special_ids;
//                    special_name[index] = special_names;
//                } else if (check === false)
//                {
//                    special_id[index] = undefined;
//                    special_name[index] = undefined;
//
//                }
//
//
//            });
        $('body').on('change', '.add_speciality', function () {
            $this = $(this);
            var id = $this.data('id');
            var id_two = $this.data('special-id-admin');
            var index = $this.data('count');
            var check = $('#speciality' + id).prop('checked');
            if (check === true)
            {


                var special_ids = $('#speciality' + id_two).val();
                var special_names = $('#speciality_name' + id_two).val();
                special_id[index] = special_ids;
                special_name[index] = special_names;

            } else if (check === false)
            {
                special_id[index] = undefined;
                special_name[index] = undefined;

                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: "<?= asset('/delete_speciality_home') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {
                        $('#preloader').hide();
                        if (data.success)
                        {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
                $('#special_name' + index).remove();
                $('#delete_span_special' + index).remove();
                ;
            }


        });
        $('body').on('change', '.add_speciality_admin', function () {
            $this = $(this);
            var id = $this.data('id');
            var index = $this.data('count');
            var special_ids = $('#speciality' + id).val();
            var special_names = $('#speciality_name' + id).val();

            var check = $('#speciality' + id).prop('checked');
            if (check === true)
            {
                special_id[index] = special_ids;
                special_name[index] = special_names;

            } else if (check === false)
            {
                special_id[index] = undefined;
                special_name[index] = undefined;


            }


        });
        next.bind("click", function () {
            var index = $('.special_name_count').val();
            var other_count = 0;
            for (var i = 0; i < index; i++)
            {
                var special_names;
                special_names = $('#special_name' + i).val();

                if (typeof special_names !== 'undefined')
                {
                    other_count++;
                    if (i !== 0) {
                        $('#experiese').append('<span class="delete_span_special"' + i + '>,</span>');
                    }
                    $('#experiese').append('<span class="delete_span_special"' + i + '>' + special_names + '</span>');
//                    $('#experiese').append(' ,');
                }
            }

            if (other_count === 0) {
                if (special_name === undefined || special_name.length == 0) {

                    $('.error_speciality').show();
                    return false;
// array empty or does not exist
                } else
                {
                    var count = 0;
                    for (let i = 0; i < special_name.length; i++)
                    {
                        if (special_name[i] !== undefined)
                        {
                            count++;
                        }

                    }
                }
                if (count == 0)
                {
                    $('.error_speciality').show();
                    return false;
                }
            }
            $('.error_speciality').hide();
            for (var i = 0; i < special_name.length; i++)
            {

                if (typeof special_name[i] !== 'undefined') {

                    $('#experiese').append(special_name[i]);
                    if (i !== 0) {
                        $('#experiese').append(' ,');
                    }
                }

            }



            var radioValue = $("input[name='project']:checked").val();
//
//            if (radioValue === 'On Going Project') {
//
//                $("#end_date").prop('disabled', true);
//            } else {
//                $("#end_date").prop('disabled', false);
//            }
            $('#project_type').append(radioValue);

            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done')) {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });
        back.bind("click", function () {
            $("#budget_start_tab").empty();
            $("#budget_end_tab").empty();
            $("#location_tab").empty();
            jQuery.each(steps, function (i) {
                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
                    jQuery(steps[i + 1]).removeClass('current');
                    var per_step1 = jQuery(steps[i + 1]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step1).removeClass('active-tabs');
                    var datid1 = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid1).addClass('active-tabs');
                    jQuery(steps[i]).removeClass('done');
                    jQuery(steps[i]).addClass('current');
                    return false;
                }
            })
        });
        second_back.bind("click", function () {

            $("#project_type").empty();
            $("#experiese").empty();
            jQuery.each(steps, function (i) {
                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
                    jQuery(steps[i + 1]).removeClass('current');
                    var per_step1 = jQuery(steps[i + 1]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step1).removeClass('active-tabs');
                    var datid1 = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid1).addClass('active-tabs');
                    jQuery(steps[i]).removeClass('done');
                    jQuery(steps[i]).addClass('current');
                    return false;
                }
            })
        });
        first_back.bind("click", function () {

            $("#title").empty();
            $("#description_tab").empty();
            $(".job_post_files").empty();
            jQuery.each(steps, function (i) {
                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current')) {
                    jQuery(steps[i + 1]).removeClass('current');
                    var per_step1 = jQuery(steps[i + 1]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step1).removeClass('active-tabs');
                    var datid1 = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid1).addClass('active-tabs');
                    jQuery(steps[i]).removeClass('done');
                    jQuery(steps[i]).addClass('current');
                    return false;
                }
            })
        });
        first.bind("click", function () {

            var baseUrl = '<?= asset('/'); ?>';
            count = 0;
            if ((validation('#job_title', '1')) == false) {
                ++count;
            }
            ;
            if ((validation('#job_description', '2')) == false) {
                ++count;
            }
            ;


            if (count > 0) {
                return false;
            } else
            {
                $this = $(this);

                var index = $this.data('count');

                for (var i = 1; i < index; i++)
                {

                    var image_path;
                    var image_type;
                    var image_name;
                    image_path = $('.image_no' + i).val();

                    image_type = $('.image_type' + i).val();
                    image_name = $('.image_name' + i).val();
                    var image_id = $('.image_id' + i).val();

                    if (typeof image_path !== 'undefined' && typeof image_type !== 'undefined' && typeof image_name !== 'undefined') {

                        if (image_type == 'pdf')
                        {

                            $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/pdf1.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home/'); ?>/' + image_id + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_name + '</span></div> </li>');
                        } else if (image_type == 'zip')
                        {

                            $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/zip.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home/'); ?>/' + image_id + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_name + '</span></div> </li>');

                        } else if (image_type == 'doc')
                        {

                            $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/doc1.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home/'); ?>/' + image_id + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_name + '</span></div> </li>');

                        } else if (image_type == 'image') {

                            $('.job_post_files').prepend('<li><div class="breif-box"> <div class="project-img"><div class="brief-images" style="background-image: url(' + image_path + ')"></div> <div class="hover-layer"><a href="<?= asset('download_file_home'); ?>/' + image_id + '"> <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div></div>' + image_name + '</li>');
                        }
                    }
                }

                if (path) {
                    for (var i = 0; i < counts; i++)
                    {
                        if (path[i] != null) {
                            if (type[i] == 'image') {
//                                alert('<?asset('download_file_home_upload');?>/'+path[i]+'/'+image_names[i]);
//                                return false;
                                $('.job_post_files').prepend('<li><div class="breif-box"> <div class="project-img"><div class="brief-images" style="background-image: url(' + baseUrl + path[i] + ')"></div> <div class="hover-layer"><a href="<?= asset('download_file_home_upload'); ?>?path=' + path[i] + '&image=' + image_names[i] + '"> <i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div></div>' + image_names[i] + '</li>');
                            } else if (type[i] == 'pdf')
                            {
                                $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/pdf1.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home_upload'); ?>?path=' + path[i] + '&image=' + image_names[i] + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_names[i] + '</span></div> </li>');
                            } else if (type[i] == 'zip')
                            {
                                $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/zip.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home_upload'); ?>?path=' + path[i] + '&image=' + image_names[i] + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_names[i] + '</span></div> </li>');
                            } else if (type[i] == 'doc')
                            {
                                $('.job_post_files').append('<li><div class="breif-box"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/doc1.png') ?>" /></div><div class="hover-layer"><a href="<?= asset('download_file_home_upload'); ?>?path=' + path[i] + '&image=' + image_names[i] + '"><i class="fa fa-download" aria-hidden="true" data-placement="top" title="Download"></i> </a></div></div><span>' + image_names[i] + '</span></div> </li>');
                            }
                        }
                    }
                }


                var title = $('#job_title').val();
                var description = $('#job_description').val();
                $('#title').append(title);
                $('#description_tab').append(description);

            }
            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
                {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });
        second_next.bind("click", function () {

            count = 0;
            if ((validation('#date', '3')) == false) {
                ++count;
            }
            ;
            if ((validation('#time', '4')) == false) {
                ++count;
            }
            ;
            if ((validation('#location', '5')) == false) {
                ++count;
            }
            ;
            if ((validation('#start_date', '6')) == false) {
                ++count;
            }
            ;
            if ((validation('#budget_start', '7')) == false) {
                ++count;
            }
            ;
            if ((validation('#budget_end', '8')) == false) {
                ++count;
            }
            ;

//            var radioValue = $("input[name='project']:checked").val();
            

                if ((validation('#end_date', '9')) == false) {
                    ++count;
                }
                else if ($('#start_date').val() >= $('#end_date').val())
                {
                    $('.wrong_dates').show();
                    return false;
                }
                ;
        
            if (parseInt($('#budget_start').val()) > parseInt($('#budget_end').val()))
            {
                $('.wrong_bidget').show();
                return false;
            }

            $('.wrong_dates').hide();
            $('.wrong_bidget').hide();
            if (count > 0) {
                return false;
            } else
            {
                var location = $('#location').val();
                var budget_start = $('#budget_start').val();
                var budget_end = $('#budget_end').val();
                $('#location_tab').append(location);
                $('#budget_start_tab').append('$' + budget_start + ' to $' + budget_end);
//                    $('#budget_end_tab').append('$'+);
            }
            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
                {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });
        //        next.bind("click", function() {
        //            jQuery.each(steps, function(i) {
        //
        //                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current'))
        //                    var currents = jQuery(steps[i + 1]).attr("data-attribute");
        //
        //                //                         console.log(currents);
        //                if (currents == 'business-detail') {
        //                    $('.prev').html('Back to Services');
        //                    $('.prev').css('display', 'block');
        //                } else if (currents == 'membership') {
        //                    $('.prev').html('Back to Business Detail');
        //                } else if (currents == 'finish') {
        //                    $('.step-pagination .next').css('display', 'none');
        //                    $('.step-pagination').css({
        //                    });
        //                    $('.step-pagination').append('<button type="submit" class="btn btn_md_green ">Finish</button>');
        //                }
        //            });
        //        });
        function validation(input_id, num) {

            var title = $(input_id).val();
            title = title.trim();

            if (title == '') {

                $('.error' + num).show();
                return false;
            }
            $('.error' + num).hide();
        }
        back.bind("click", function () {
            jQuery.each(steps, function (i) {
                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current'))
                {
                    var per_step1 = jQuery(steps[i + 1 ]).attr("data-attribute");
                    console.log(per_step1);
                }
            });
        });
        $("#banner-images").on("change", function () {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    $(".detail-banner").css("background-image", "url(" + this.result + ")");
                };
            }
        });
        $("#banner-logo").on("change", function () {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    $(".banner-logo-img").css("background-image", "url(" + this.result + ")");
                };
            }
        });

        $("#photo-upload").on("change", function () {

            var form_data = new FormData();
            form_data.append("file", document.getElementById('photo-upload').files[0]);

            var baseUrl = '<?= asset('/'); ?>';
            $('#preloader').show();
            $.ajax({
                url: "<?= asset('/upload_image') ?>", // point to server-side PHP script 
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
                        type.push(data.type);
                        image_names.push(data.name);
                        var new_img_path = baseUrl + data.path;
                        if (data.type == 'pdf')
                        {
//                                $('.revier-project').prepend('<li><div class="project-photo-img"  style="background-image:url( http://localhost/construction-webapp/userassets/images/pdf.png )"></div><div data-index="' + counts + '" class="delete-profile"><img src="http://localhost/construction-webapp/userassets/images/close.png"></div>' + data.name + '</li>');
                            $('.revier-project').prepend('<li><div class="project-photo-img"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/pdf1.png') ?>" /></div></div><div data-index="' + counts + '" class="delete-profile"><img src="<?= asset('userassets/images/close.png') ?>"></div><span>' + data.name + '</span></div> </li>');
                        } else if (data.type == 'zip')
                        {

                            $('.revier-project').prepend('<li><div class="project-photo-img"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/zip.png') ?>" /></div></div><div data-index="' + counts + '" class="delete-profile"><img src="<?= asset('userassets/images/close.png') ?>"></div><span>' + data.name + '</span></div> </li>');

                        } else if (data.type == 'doc')
                        {

                            $('.revier-project').prepend('<li><div class="project-photo-img"><div class="project-img"><div class="brief-images"><img src="<?php echo asset('userassets/images/doc.png') ?>" /></div></div><div data-index="' + counts + '" class="delete-profile"><img src="<?= asset('userassets/images/close.png') ?>"></div><span>' + data.name + '</span></div> </li>');

                        } else if (data.type == 'image') {
                            $('.revier-project').prepend('<li><div class="project-photo-img" style="background-image:url(' + new_img_path + ')"><div data-index="' + counts + '" class="delete-profile"><img src="<?= asset('userassets/images/close.png') ?>"></div></div><span>' + data.name + '</span></li>');
                        }
                        counts++;
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
//                        window.setTimeout(function () {
//                            location.reload()
//                        }, 2000)
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
            var id = $this.data('id');
            var li_count = $this.data('li-count');
            var index = $this.data('index');

            path[index] = null;
            type[index] = null;
            image_names[index] = null;


            if (id) {
                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: "<?= asset('/delete_image') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {
                        $('#preloader').hide();
                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
            }
            $('.li_image' + li_count).remove();

            $(this).parent().remove();
        });
        $('body').on('click', '.delete_speciality', function () {

            $this = $(this);
            var id = $this.data('id');
            var special_count = $('.special_name' + id).data('special-count');
            if (id) {
                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: "<?= asset('/delete_speciality_home') ?>",
                    data: {id: id, '_token': '<?= csrf_token(); ?>'},
                    dataType: 'json',
                    success: function (data) {
                        $('#preloader').hide();
                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
            }

            $('#special_name' + special_count).remove();
            $('#delete_span_special' + special_count).remove();
            $('#delete_span_special_two' + id).remove();
            $(this).parent().remove();


        });

        $('#formId').validate({// initialize plugin
            // rules & options, 
            rules: {
                title: {
                    required: true,

                }

            },
            messages: {
                title: "Please enter Title",
            },
            submitHandler: function () {
                // your ajax would go here
                var special_name = $('.general-field').val();
                var id = $('#job_id').val();

                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: "<?= asset('/add_speciality') ?>",
                    data: {speciality: special_name, id: id, '_token': '<?= csrf_token(); ?>'},

                    dataType: 'json',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        $('#preloader').hide();
                        if (data.success)
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                            $('.general_contractor_tags').append(' <span>' + special_name + '<a href="#"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ');

                            $('#experiese').append(' <span class="delete_span_special_two"' + data.id + '>' + special_name + '</span> ');
                            $('#experiese').append(' <span class="delete_span_special_two"' + data.id + '>,</span> ');
//                        $('#other-services').modal('toggle');

                        } else
                        {
                            $('.ajax-label').show();
                            $(".ajax-label").addClass("alert-danger");
                            $(".ajax-label").removeClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('#preloader').hide();
                    }
                });
                return false;  // blocks regular submit since you have ajax
            }
        });



    });
    var placeSearch, autocomplete;
    var componentForm = {
//                                                        street_number: 'short_name',
//                                                        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
//                                                        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('location')),
                {types: ['geocode']});




        // When the user selects an address from the dropdown, populate the address
        // fields in the form.


        autocomplete.addListener('place_changed', fillInAddress);
//                                                         autocomplete2.addListener('place_changed', fillInAddress2);


    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        $('#lat').val(lat);
        $('#long').val(lng);

//                                                        for (var component in componentForm) {
//                                                            document.getElementById(component).value = '';
//                                                            //          document.getElementById(component).disabled = false;
//                                                        } 
// 
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 