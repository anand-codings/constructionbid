  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= asset(getUserImage($admin->profile_pic)) ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <span class="hidden-xs"><?php $admin = Illuminate\Support\Facades\Auth::guard('admin')->user();
                                            echo $admin->full_name;?></span>
          <!-- Status -->
        
        </div>
      </div>

      <!-- search form (Optional) -->
    
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="<?= ($tab == 'dashboard' ? 'active treeview menu-open' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>
     
        </li>
        <li class="<?= ($tab == 'companies' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('companies') ?>">
            <i class="fa  fa-building"></i> <span>Companies</span>
          </a>
     
        </li>
        <li class="<?= ($tab == 'homeowners' ? 'active' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('home_owner') ?>">
            <i class="fa  fa-user"></i> <span>Home Owner</span>
          </a>
     
        </li>
                  <li class="<?= ($tab == 'jobs' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('jobs') ?>">
            <i class="fa  fa-briefcase"></i> <span>Jobs</span>
          </a>
     
        </li>
                <li class="<?= ($tab == 'job_speciality' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('job_specialities') ?>">
            <i class="fa    fa-book"></i> <span>Job Specialities</span>
          </a>
     
        </li>
        
        </li>
                <li class="<?= ($tab == 'proposal' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('proposals') ?>">
            <i class="fa   fa-file-text"></i> <span>Job Proposals</span>
          </a>
     
        </li>
                      <li class="<?= ($tab == 'subscriptions' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('subscription') ?>">
            <i class="fa     fa-credit-card"></i> <span>Subscription</span>
          </a>
     
        </li>
                    <li class="<?= ($tab == 'reviews' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('reviews') ?>">
            <i class="fa    fa-comments-o"></i> <span>Reviews</span>
          </a>
     
        </li>
                            <li class="<?= ($tab == 'notifications' ? 'active ' : '') ?>">
        <!--<li class="">-->
            <a href="<?= asset('notification') ?>">
            <i class="fa     fa-bell-o"></i> <span>Send Notification</span>
          </a>
     
<!--        </li>
       
          <li class="<?($tab == 'deleted_user' ? 'active ' : '') ?>">
        <li class="">
            <a href="<? asset('/deleted_user') ?>">
            <i class="fa    fa-user-times"></i> <span>Deleted Home Owners</span>
          </a>
     
        </li>
        <li class="<? ($tab == 'deleted_company' ? 'active ' : '') ?>">
        <li class="">
            <a href="<? asset('/deleted_company') ?>">
            <i class="fa   fa-remove"></i> <span>Deleted Companies</span>
          </a>
     
        </li>-->
        <li class="<? ($tab == 'edit_profile' ? 'active ' : '') ?>">
            <a href="<?= asset('edit_admin_profile_view');?>">
                <i class="fa   fa-edit"></i> <span>Edit Profile</span>
            </a>
        </li>
          
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>