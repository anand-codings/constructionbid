<div class="dashboard-profile-column profile-column">
     <div class="dash-img" style="background-image: url('<?= getUserImage($image->profile_image); ?>')"></div>
     <p><?=isset(Auth::user()->first_name)? Auth::user()->first_name.' '.Auth::user()->last_name :'No Name'?> <?php if (Auth::user()->is_verified == 1) { ?>
                                <img src="<?= asset('userassets/images/verified.svg'); ?>" alt="verified">
                            <?php } ?></p>
     <a href="<?= asset('company_profile'); ?>">Edit Profile</a>
     <!--<h6>Remaining Bids: <?php //(Auth::user()->getSubscription)? Auth::user()->getSubscription->bids:'No subscription';?></h6>-->
     <h6> <?php if (isset(Auth::user()->getSubscription)) {
                                if (Auth::user()->getSubscription->stripe_plan == 'plan_FhkJScuGNd74AI') { ?> 
         Remaining Bids: <?= Auth::user()->getSubscription->bids ?> 
             <?php }
     else {
         ?>
             Unlimited Bids 
     <?php } } ?> </h6>
</div>
<div class="profile-tabs">
     <h6>  Dashboard</h6>
     <ul class="nav nav-tabs" id="" role="tablist">

          <li class="nav-item">
               <a class="<?= ($tab == 'dashboard' ? 'active ' : '') ?>" href="<?= asset('company-dashboard'); ?>" ><img src="<?= asset('userassets/images/posting.png'); ?>"/><span>My Proposals</span><span class="profile-count"><?= $count ?></span></a>
          </li>
          <li class="nav-item">

               <a class="<?= ($tab == 'saves' ? 'active ' : '') ?>" href="<?= asset('my_saves') ?>" ><img src="<?= asset('userassets/images/saves.png'); ?>"/><span>My Saves</span><span class="profile-count"><?= $saves_count ?></span></a>

          </li>

     </ul>
</div>