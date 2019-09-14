<?php
include resource_path('views/includes/top-header.php');
?>
<?php
include resource_path('views/includes/header.php');
?>
<section class="contractor-banner" style="background-image: url('<?= isset($result->cover_image) ?asset($result->cover_image) :asset('public/images/images.png');?>')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-upload"> 
                    
                        <input type='hidden' name='_token' value='<?= csrf_token()?>'/>
                        
                        <input type="file" name='file' style="display: none;" id="banner-cover" />
                        <label for="banner-cover"  class="btn btn_upload "><i class="fa fa-plus" aria-hidden="true"></i> Change Cover</label>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<section class='contract-section margin-tb'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-3'>
                <div class="business-tabs">
                    <ul class="nav nav-tabs" id="" role="tablist">
                        <!--<li class="active"><a href="#home" data-toggle="tab">Home</a></li>-->
                        <li class="category-heading">
                            Business Categories
                        </li>
                        <li class="nav-item">
                            <a class="<?= ($tab_id == '') ? 'active' : '' ?>"  href="#general_contractor" data-toggle="tab">General Contractor</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link <?= ($tab_id == 'professional') ? 'active' : '' ?>"  href="#professional" data-toggle="tab">Professional</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link <?= ($tab_id == 'supplier') ? 'active' : '' ?>" href="#supplier" data-toggle="tab">Supplier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($tab_id == 'sc') ? 'active' : '' ?>" href="#subcontractor" data-toggle="tab">Subcontractor</a>
                        </li>
                        <li class="nav-item last-category">
                            <a class="nav-link <?= ($tab_id == 'owner') ? 'active' : '' ?>" href="#owner" data-toggle="tab">Owner</a>
                        </li>
                        <li class="nav-item second-tab-first">
                            <a class="nav-link <?= ($tab_id == 'store') ? 'active' : '' ?>" href="#store" data-toggle="tab">Store</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link  <?= ($tab_id == 'project') ? 'active' : '' ?>" href="#projects" data-toggle="tab">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($tab_id == 'review') ? 'active' : '' ?>" href="#reviews" data-toggle="tab">Reviews 
                                <!--<span class="counter-review">2new</span>-->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($tab_id == 'edit_business') ? 'active' : '' ?>"   href="#edit_business" data-toggle="tab">Edit Business</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class='col-md-9'>
                <?php include resource_path('views/includes/messages.php'); ?>
                <div class="tab-content">
                    <?php include resource_path('views/company/tabs/general_contractor_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/professional_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/supplier_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/subcontractor_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/owner_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/store_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/projects_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/reviews_tab.php'); ?>
                    <?php include resource_path('views/company/tabs/edit_business_tab.php'); ?>
                  
                </div>
            </div>
        </div>
</section>

<?php
include resource_path('views/includes/bottom-footer.php');
include resource_path('views/company/modals.php');
?>


