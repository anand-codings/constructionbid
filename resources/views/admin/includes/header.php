 <?php $admin = Illuminate\Support\Facades\Auth::guard('admin')->user(); ?>
     <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
     <header class="main-header">

    <!-- Logo -->
    <a href="<?= asset('dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Construction</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
       
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
         
          <!-- Tasks Menu -->
     
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= asset(getUserImage($admin->profile_pic)) ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $admin->full_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= asset(getUserImage($admin->profile_pic)) ?>" class="img-circle" alt="User Image">

                <p>
                    <?php echo $admin->full_name?>
                
<!--                  <small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body -->
            
              <!-- Menu Footer-->
              <li class="user-footer">
               
                <div class="pull-left">
                    <a href="<?= asset('edit_admin_profile_view');?>" class="btn btn-primary btn-flat">Edit Profile</a>
                </div>
                <div class="pull-right">
                    <a href="<?= asset('logout');?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>