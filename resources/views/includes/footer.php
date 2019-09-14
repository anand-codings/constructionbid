
<footer class="top-footer">
    <div class="container">
        <div class="row footer-border">
            <div class="col-md-3">
                <h6 class="footer-title">Who We Are</h6>
                <ul class="footer-link">
                    <li>
                        <a href="#">About Us</a>
                    </li>
                    <li>
                        <a href="#">Careers</a>
                    </li>
                    <li>
                        <a href="#">Feature Tour</a>
                    </li>
                    <li>
                        <a href="#">Presentation</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="footer-title">Support</h6>
                <ul class="footer-link">
                    <li>
                        <a href="#">Knowledge Base</a>
                    </li>
                    <li>
                        <a href="#">Video Guides</a>
                    </li>
                    <li>
                        <a href="#">Report a Bug</a>
                    </li>
                    <li>
                        <a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="footer-title">Support</h6>
                <ul class="footer-link">
                    <li>
                        <a href="mailto:hello@construction.com">hello@construction.com</a>
                    </li>
                    <li>
                        Street: 233 Sunnyside City:<br /> Rancho Santa Margarita <br />State: MI Zip: 41113
                    </li>

                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="footer-title">Follow Us</h6>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="" target="_blank"><i class="fa fa-behance" aria-hidden="true"></i></a>
                    </li>
                </ul>
                <p>We’re socialized!</p>
            </div>
        </div>
    </div>
</footer>
<footer class="bottom-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="bottom-links">
                    <li>
                        <a href="<?= asset('company_search');?>">Find Companies</a>
                    </li>
                    <li>
                        <a href="">Service</a>
                    </li>
                    <li>
                        <a href="">Journal</a>
                    </li>
                    <li>
                        <a href="">About</a>
                    </li>
                    <li>
                        <a href="">Support</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <p>
                    © 2019 Construction - Make with <i class="fa fa-heart" aria-hidden="true"></i> <a href="https://www.codingpixel.com/" target="_blank">CodingPixel</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Login Modal -->

<div class="modal fade" id="loginmodal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title text-center">
                    <h5>Sign in to the ConstructBid</h5>
                    <p>Enter your details below.</p>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="show_message">
                    <ul>
                        <li>
                <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span class="ajax-label-body"></span>
                </div>
                            </li>
                        </ul>
                    </div>
                <form  id="login_modal" class="login-form"  action="<?= asset('company_post_login') ?>" method="Post" enctype="multipart/form-data">
                      <?= csrf_field(); ?>
                    <?php if (Session::has('success_login')) { ?>
                    <script src="<?= asset('userassets/js/jquery3.3.1.min.js'); ?>"></script>
                    
    <div class="alert alert-success web-alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
        <?php echo Session::get('success_login') ?>
           
    </div>
<?php } ?>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control general-field" placeholder="johnsmith@email.com"/>

                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <a href="javascript:void(0)" data-target="#forgot-password" data-toggle="modal" data-dismiss="modal" class="forgotpassword">Forgot Password</a>

                        <input type="password" name="password" class="form-control general-field" placeholder="•••••••••••"/>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn_md_blue login" id="login">Log In</button>
                    </div>
                </form>
                <div class="modal-footers text-center">
                    <p>Don’t have an account? <a href="javascript:void(0)" data-target="#signup" data-toggle="modal" data-dismiss="modal">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Forgot Modal -->
<div class="modal fade" id="forgot-password">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title text-center">
                    <h5>Forgot Your Password?</h5>
                    <p>Enter your email below and we’ll send you the reset link.</p>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                     <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span class="ajax-label-body"></span>
                </div>
                <form class="login-form" action="<?= asset('sendforget') ?>" method="Post" enctype="multipart/form-data" >  
                        <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control general-field" placeholder="johnsmith@email.com" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn_md_blue reset" id="reset" >Get Reset Link</button>
                    </div>
                </form>
                <div class="modal-footers text-center">
                    <p>Go Back to <a href="javascript:void(0)" data-target="#loginmodal" data-toggle="modal" data-dismiss="modal" >Log In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SignUp Modal -->
<div class="modal fade" id="signup">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title text-center">
                    <h5>Company Sign up</h5>
                    <p>Let’s get your all set up, so you can get hired<br /> from millions of homeowners!</p>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="show_message_register">
                    <ul>
                        <li>
                
                <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span class="ajax-label-body"></span>
                </div>
                            </li>
                        </ul>
                    </div>

                <form id="c_register_form" class="login-form"  action="<?= asset('register_company') ?>" method="Post" enctype="multipart/form-data">

                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control general-field" placeholder="johnsmith@email.com" />
                        <span id="email_check" style="display:none; color:red">Email is not unique..</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control general-field" placeholder="•••••••••••" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Repeat Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control general-field" placeholder="•••••••••••" />

                    </div>
                    <div class="form-group">
                        <input type="submit" id="f-btn" class="btn btn_md_blue register" value="Get Started">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quote Modal -->
<div class="modal fade" id="get-quote">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">


            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Get Quote</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <div class="quote-head flex">
                    <div class="quote-image">
                        <img id="quote_image" src="<?= asset('userassets/images/project1.png'); ?>" alt="" />
                    </div>
                    <div class="quote-detail">
                        <p id="quote_title"><strong></strong></b></p>
                        <div class="flex quote-job">
                            <div class="about-quote">
                                <h6>Typical Job Costs:</h6>
                                <p id="quote_job_cost">$100 - 5,000</p>
                            </div>
                            <div class="about-quote">
                                <h6>Location:</h6>
                                <p id="quote_location">Gig Harbor, Washington, US</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="quote-form" action="<?= asset('post_quote_company');?>" method="POST" id="service_quote">
                    <?php echo csrf_field();?>
                    <h6>Your Contact Info</h6>
                    <input type="hidden" name="service_id" id="quote_service_id">
                    <input type="hidden" name="company_id" value="<?=isset($company->id)?$company->id:''?>">
                    <div class="form-group">
                        <input type="email" value="<?=isset(Auth::user()->email)? Auth::user()->email:''?>" name="email" class="form-control general-field" placeholder="Email" disabled/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" value="<?=isset(Auth::user()->first_name)? Auth::user()->first_name:''?>" name="first_name" class="form-control general-field" placeholder="First Name" disabled/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" value="<?=isset(Auth::user()->last_name)? Auth::user()->last_name:''?>" name="last_name" class="form-control general-field" placeholder="Last Name" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?=isset(Auth::user()->phone)? Auth::user()->phone:''?>" name="phone" class="form-control general-field" placeholder="Phone" />
                    </div>
                    <div class="form-group">
                        <textarea rows="4" name='description'class="form-control general-field" placeholder="Write here..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn_sm_green">Get Started</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact Modal -->


<!-- Reset password Modal -->

<div class="modal " id="resetpassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title text-center">
                    <h5>Reset Password</h5>
                    <p>Let’s get your all set up, so you can get hired<br /> from millions of homeowners!</p>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span class="ajax-label-body"></span>
                </div>


                <form class="login-form"  action="<?= asset('reset_password') ?>" method="Post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="<?=isset($token) ? $token:''  ?>" name="token"/>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password"  id="reset_confirm_password" name="reset_password"  class="form-control general-field" placeholder="Enter New Password" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="reset_confirm_password"  class="form-control general-field" placeholder="Confirm New Password" />
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" id="f-btnn" class="btn btn_md_blue reset_password" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #c_register_form input.error,#login_modal input.error  {
        border:solid 1px red !important;
    }
     #c_register_form input.error ,#login_modal input.error {
        /*width: auto;*/
        /*display: none !important;*/
        /*color:red;*/
        /*font-size: 16px;*/
        /*float:right;*/
    }
</style>
<script>

</script>