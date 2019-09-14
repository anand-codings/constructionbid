<html>
    <head>
        <title><?= isset($title)? $title : ''?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
 <style>
     .form-gap {
    padding-top: 70px;
}
 </style>
    </head>
    <body>
    
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
            <div class="col-md-4"></div>
		<div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h2 class="text-center">Forgot your password?</h2>
                  <p>Please change your password below:</p>
                  <div class="panel-body">

                      <?php if ((Session::has('success'))) : ?>
                            <div class="alert alert-success"><?= Session::get('success') ?></div>
                        <?php endif; ?>

                        <?php if ((Session::has('error'))) : ?>
                            <div class="alert alert-danger"><?= Session::get('error') ?></div>
                        <?php endif; ?>

                        <?php if ($errors->first('password')) : ?>
                            <div class="alert alert-danger"><?= $errors->first('password') ?></div>
                        <?php endif; ?>  
                      <form action="<?= asset('resetpassword'); ?>" role="form" autocomplete="off" class="form" method="post">
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="forget_token" value="<?php echo $forget_password_token; ?>">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input name="password" placeholder="New Password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input name="password_confirmation" placeholder="Confirm password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	<div class="col-md-4"></div>
        </div>
</div>
 </body>
</html>