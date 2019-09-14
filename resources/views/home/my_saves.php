<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="company-dashboard margin-tb">
     <div class="container">
          <div class="row">
               <div class="col-md-3">
                    <div class="profile-column dashboard-profile-column">
                         <div class="dash-img" style="background-image: url('<?= isset(Auth::user()->profile_image)? asset(Auth::user()->profile_image) :asset('userassets/images/left_img1.png'); ?>')"></div>
                         <p><?=isset(Auth::user()->first_name)? Auth::user()->first_name.' '.Auth::user()->last_name :'No Name'?></p>
                         <a href="<?= asset('my_profile');?>">Edit Profile</a>
                    </div>
                    <div class="profile-tabs">
                          <ul class="nav nav-tabs" id="" role="tablist">
                              
                              <li class="nav-item">
                                   <a href="<?=asset('user-dashboard');?>" ><img src="<?= asset('userassets/images/posting.png'); ?>"/><span>My Postings</span><span class="profile-count"><?= $count ?></span></a>
                              </li>
                              <li class="nav-item">
                                  <a  class='active' href="<?=asset('homeowner_saves');?>" ><img src="<?= asset('userassets/images/saves.png'); ?>"/><span>My Saves</span><span class="profile-count"><?= $saves_count ?></span></a>
                              </li>
                              <li class="nav-item">
                                  <a href="<?= asset('homeowner_proposals');?>"><img src="<?= asset('userassets/images/proposals.png'); ?>"/><span>Proposals</span><span class="profile-count"><?= $counts ?></span></a>
                              </li>
                         </ul>
                    </div>
               </div>
               <div class="col-md-9">

                    <div class="condructor-tabs dashboards">
                         <div class="condructor-tabs-header">
                              <div class="tabs-header">
                                   <h3>
                                        My Saves
                                   </h3>
                              </div> 
                         </div>
                         <div class="condructor-tabs-body">
                             <?php if(isset($company)){
                                 foreach($company as $key=> $companies){?>
                             
                              <div class="dashboard-content">
                                   <div class="dashboard-profile">
                                        <div class="dashboard-profile-img" style="background-image: url('<?php echo asset($companies->profile_image)?>')"></div>
                                        <div class="dashboard-profile-content">
                                             <h6><?= $companies->first_name;?> <?=$companies->last_name;   ?></h6>
                                             <p>Saved on <?= isset($saves[$key]->created_at)? date('d F, Y', strtotime($saves[$key]->created_at)):''; ?></p>
                                        </div>
                                   </div>
                                   <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>

                                   </div>
                                   <div class="service-dropdown">
                                        <ul>
                                             <li>
                                                 <a href="<?=asset('company_profile_home/'.$companies->id);?>"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Company Profile</a>
                                             </li>
                                             <li>
                                                  <a href="<?= asset('/unsave_company/' . $companies->id) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                             <?php }}?>

                     
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
     $("#upload-img").on("change", function ()
     {
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