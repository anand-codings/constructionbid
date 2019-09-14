<header class='main-header'>

    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-2'>
                <a href="<?= asset('/'); ?>">
                  <img src="<?= asset('userassets/images/BidnBuild3.png'); ?>" width="200px"/>
                </a>
            </div>
            <div class='col-md-6'>
                <div class='header-search'>
                    <!--action="asset('post_job_search');?>" method="Post"-->
                    <?php
                    if (Auth::check()) {
                        if (Auth::user()->type == 'homeowner') {
                            ?>
                            <!--<form id="search_company_name_auth"  class="header-search-form">-->

                            <div class="header-search-form">
                                <form action="<?= asset('company_search') ?>" method="Get">
                                    <div class='form-group'>
                                        <input <?php if (isset($_GET['comapany_name'])) { ?> value="<?= $_GET['comapany_name'] ?>" <?php } ?> type="text"   name ="comapany_name" class="form-control general-field" placeholder="Find Companies"/>
                                    </div>
                                </form>
                            </div>
                            <!--</form>-->
                        <?php } else { ?> 
                            <div class="header-search-form">
                                <form id="searc_job" action="<?= asset('job_search') ?>" method="get">

                                    <div class='form-group'>

                                        <input <?php if (isset($_GET['search_job'])) { ?> value="<?= $_GET['search_job'] ?>" <?php } ?> type="text" name="search_job" id="find_job" class="form-control general-field" placeholder="Find Jobs" />
                                    </div>
                                </form>
                            </div>

                            <?php
                        }
                    } else {
                        ?>

<!--                        <form id="search_job_guest" action="<?= ('job_search') ?>" method="Get" class="header-search-form">

                            <div class="header-search-form">
                            <div class='form-group'>
                                <input type="text" <?php if (isset($_GET['search_job'])) { ?> value="<?= $_GET['search_job'] ?>" <?php } ?> id="search_company_guest" name ="search_job" class="form-control general-field" placeholder="Find Jobs"/>
                            </div>
                            </div>
                        </form>-->

                    <?php } ?>
                    <?php if (Auth::check()) {
                        if (Auth::user()->type == 'company') {
                            ?>
                            <div class="browse-category">
                                <span><span class="browsec">Browes by Categories</span> <img src="<?php echo asset('userassets/images/select-icon.png') ?>"/></span>
                            </div>
    <?php }
} ?>
                    <div class="mega-menu">
                        <div class="mega-menu-row">
                            <div class='mege-menu-column'>
                                <!--<h6>OUTDOOR & GARDEN</h6>-->
                                <ul>
                                    <?php
                                    $categories = getCategories();

                                    if (isset($categories)) {
                                        foreach ($categories as $category) {
                                            ?>
                                            <li>
                                                <a href="<?= asset('job_search') . '?' . 'category_job' . '=' . $category->title ?>"><?= $category->title; ?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!--                            <div class='mege-menu-column'>
                                                            <h6>OUTDOOR & GARDEN</h6>
                                                            <ul>
                                                                <li>
                                                                    <a href="<?php // asset('job_search')    ?>">Air Conditioning & Heating</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php // asset('job_search')    ?>">Painters</a>
                                                                </li>
                            
                                                            </ul>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>



                    <?php if (Auth::check()) { ?>
                    <ul class='userlogin-menu' >
                                <?php if (Auth::user()->type == 'company') { ?>
                            <li class="noti ">
                                <a href="<?= asset('company_notification'); ?>"><i class="fa fa-bell" aria-hidden="true"></i>
                                    <?php if (getNotificationCount(Auth::user()->id)) { ?>
                                        <span><?= getNotificationCount(Auth::user()->id); ?></span>
                                <?php } ?>
                                    </a>
                                </li>
        <?php } elseif (Auth::user()->type == 'homeowner') { ?>

                                <li class="noti ">
                                    <a href="<?= asset('home_notification'); ?>"><i class="fa fa-bell" aria-hidden="true"></i>
                                        <?php if (getNotificationCount(Auth::user()->id)) { ?>
                                            <span><?= getNotificationCount(Auth::user()->id); ?></span>
                                    <?php } ?>
                                        </a>
                                    </li>
            <?php } ?>
                                <li>
                                    <div class='profile-menu'>
                                        <div class='profile-img' style="background-image: url('<?= getUserImage(Auth::user()->profile_image); ?>')"></div><i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </div>
                                    <div class="user-menu" style="display: none;">
            <?php if (Auth::user()->type == 'company') { ?>
                                            <ul>
                                                <li class="active">
                                                    <a href="<?= asset('company_profile'); ?>"><img src="<?= asset('userassets/images/profile.png'); ?>"/>My Profile</a>
                                                </li>

                                                <li>
                                                    <a href="<?= asset('my_saves'); ?>"><img src="<?= asset('userassets/images/save.png'); ?>"/>My Saves</a>
                                                </li>

                                                <li>
                                                    <a href="<?= asset('view_contractor') ?>"><img src="<?= asset('userassets/images/edit.png'); ?>"/>My Business</a>
                                                </li>

                                                <li>
                                                    <a href="<?= asset('company_logout') ?>"><img src="<?= asset('userassets/images/logout.png"'); ?>"/>Log Out</a>
                                                </li>

                                            </ul>
            <?php } else { ?>
                                            <ul>

                                                <li class="active">
                                                    <a href="<?= asset('my_profile'); ?>"><img src="<?= asset('userassets/images/profile.png'); ?>"/>My Profile</a>
                                                </li>
                                                <li>
                                                    <a href="<?= asset('homeowner_proposals'); ?>"><img src="<?= asset('userassets/images/dollor.png'); ?>"/>Proposals</a>
                                                </li>
                                                <li>
                                                    <a href="<?= asset('homeowner_saves'); ?>"><img src="<?= asset('userassets/images/save.png'); ?>"/>My Saves</a>
                                                </li>



                                                <li>
                                                    <a href="<?= asset('company_logout') ?>"><img src="<?= asset('userassets/images/logout.png"'); ?>"/>Log Out</a>
                                                </li>

                                            </ul>
            <?php } ?>
                                    </div>
                                </li>
                            </ul>

        <?php } else { ?>
                            <div class="menu-icons" id="menu-icons">
                                <span class="sr-onlys"></span>
                                <span class="sr-onlys"></span>
                                <span class="sr-onlys"></span>
                            </div>
                            <ul class='login-menu' >

                                <li>
            <!--                                   <a href="<?= asset('view_contractor') ?>" >
                                          Are you Company?
                                     </a>-->
                                    <a href="<?= asset('/'); ?>" >Are you owner? </a>
                                    <!--<a href="<?asset('landing_page');?>" type="button" class="btn btn-primary" id="create_profile">  Are you company? </a>-->
                                </li>
                                <li>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginmodal">Log In</a>
                                </li>
                                <li>
                                    <a href="" data-target="#signup" data-toggle="modal" data-dismiss="modal" id="post_job">Create Profile</a>
                                </li>
                            </ul>

        <?php } ?>
            </div>
        </div>
    </div>

</header>
<body>

