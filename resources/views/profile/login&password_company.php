<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class="margin-tb">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-tabs">
                    <h6>Account</h6>
                    <ul class="nav nav-tabs" id="" role="tablist">

                        <li class="nav-item">
                            <a class="<?= (isset($tab_id) && $tab_id == '' ) ? 'active' : '' ?>" href="#profile" id="topnav" data-toggle="tab"><img src="<?= asset('userassets/images/personal.png'); ?>"/><span>Company Information</span></a>
                        </li>
                        <li class="nav-item">
                            <a  href="#login_password" class="<?= (isset($tab_id) && $tab_id == 'loginpassword') ? 'active' : '' ?>" id="logging" data-toggle="tab"><img src="<?= asset('userassets/images/password.png'); ?>"/><span>Login & Password</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#memberships" class="<?= (isset($tab_id) && $tab_id == 'memberships') ? 'active' : '' ?>" data-toggle="tab"><img src="<?= asset('userassets/images/members.png'); ?>"/><span>Membership Settings</span></a>
                        </li>
                        <li class="nav-item">
                            <a  href="#email_notfications" class="<?= (isset($tab_id) && $tab_id == 'email&notification') ? 'active' : '' ?>" data-toggle="tab"><img src="<?= asset('userassets/images/email.png'); ?>"/><span>Email & Notfications</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane  <?= (isset($tab_id) && $tab_id == '') ? 'active' : '' ?>"  id="profile" role="tabpanel">
                        <?php include resource_path('views/includes/messages.php'); ?>
                        <?php
                        if (isset($result)) {
//                            dd($result);
                            ?>
                            <form id="company_profile" action="<?= asset('update_company_profile'); ?>" method="Post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="condructor-tabs">
                                    <div class="condructor-tabs-header">
                                        <div class="tabs-header">
                                            <h3>
                                                Company Information
                                            </h3>
                                        </div> 
                                    </div>
                                    <div class="condructor-tabs-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="profile-logo" style="background-image: url('<?= (isset($result)) ? $result->profile_image : '' ?>')">
                                                    <label for="uploadd-img">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>

                                                        <h6>
                                                            Upload Logo
                                                        </h6>
                                                    </label>

                                                    <input type="file" name="profile_image"  id="uploadd-img" style="display:none;"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-contact">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="green-title">
                                                        <h5>Tell us a little about you</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>
                                                            Company Name
                                                        </label>
                                                        <input type="text" class="form-control background-field" value="<?= (isset($result)) ? $result->first_name : '' ?>" placeholder="Company Name" name="company_name" id="company_name">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <input  type="email" name="email" value="<?= (isset($result)) ? $result->email : '' ?>" class="form-control general-field" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<button type="submit" class="btn btn_sm_tranparent"><i class="fa fa-pencil" aria-hidden="true"></i> Update Email</button>-->
                                                        <!--<input type="submit" value="Update Email">--> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Profile Type
                                                        </label>
                                                    </div>
                                                    <div class="genders">
                                                        <div class="form-group custom-radio">
                                                            <input type="radio" id="residential" name="profile_type" value="residential" <?= isset($result->getCompanyDetail->profile_type) ? ($result->getCompanyDetail->profile_type == 'residential') ? 'checked' : '' : ''; ?>>
                                                            <label for="residential">Residential</label>
                                                        </div>
                                                        <div class="form-group custom-radio">
                                                            <input type="radio" id="commercial" name="profile_type" value="commercial" <?= isset($result->getCompanyDetail->profile_type) ? ($result->getCompanyDetail->profile_type == 'commercial') ? 'checked' : '' : ''; ?>>
                                                            <label for="commercial">Commercial</label>
                                                        </div>
                                                        <div class="form-group custom-radio">
                                                            <input type="radio" id="both" name="profile_type" value="both" <?= isset($result->getCompanyDetail->profile_type) ? ($result->getCompanyDetail->profile_type == 'both') ? 'checked' : '' : ''; ?>>
                                                            <label for="both">Both</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-contact">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="green-title">
                                                        <h5>Buisness Address</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>
                                                            Address 1
                                                        </label>
                                                        <input type="text"  class="form-control background-field" value="<?= (isset($result)) ? $result->home_address : '' ?>" placeholder="Address Line 1" name="home_address" id="autocomplete" autocomplete="off" >
                                                        <input id="lat" type="text" style="display:none" name="latitude">
                                                        <input id="lng" type="text" style="display:none" name="longitude">
                                                        <input id="lat_two" type="text" style="display:none" name="latitude_two">
                                                        <input id="lng_two" type="text" style="display:none" name="longitude_two">
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>
                                                            Address 2
                                                        </label>
                                                        <input type="text" class="form-control background-field" value="<?= (isset($result)) ? $result->address_2 : '' ?>" placeholder="Address Line 2" name="address_2" id="address_2" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="state-address">
                                                        <div class="form-group city">
                                                            <label>
                                                                Country
                                                            </label>
                                                            <!--<input class="field" id="country" disabled="true"/>-->
                                                            <input id="country" name="country" type="text" class="form-control" placeholder="Country" value=" <?= (isset($result)) ? $result->country : '' ?>" >
        <!--                                                    <select name="country" id="ountry">
                                                                <option><?php // (isset($result))? $result->country:''   ?></option>
                                                                <option>
                                                                    USA
                                                                </option>
                                                            </select>-->
                                                        </div>
                                                        <div class="form-group state">
                                                            <label>
                                                                State
                                                            </label>
                                                            <input  name="state" class="form-control" id="administrative_area_level_1" value="<?= (isset($result)) ? $result->state : '' ?>"/>
        <!--                                                    <select   name="state" id="state">
                                                                <option ></option>
                                                                <option>
                                                                    Florida
                                                                </option>
                                                            </select>-->
                                                        </div>
                                                        <div class="form-group state">
                                                            <label>
                                                                City
                                                            </label>
                                                            <input id="locality"  name="city" required="" type="text" class="form-control"  value="<?= (isset($result)) ? $result->city : '' ?>">
                                                            <!--<input class="field" id="locality" disabled="true"/>-->
        <!--                                                    <select name="city" id="city">
                                                                <option></option>
                                                                <option>
                                                                    Orlando
                                                                </option>
                                                            </select>-->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-contact">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="green-title">
                                                        <h5>Contact</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="">
                                                        <label>
                                                            Phone
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= (isset($result)) ? $result->phone : '' ?>" class="form-control background-field" placeholder="(987) 321 654 987" name="phone" id="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="">
                                                        <label>
                                                            Company Fax Number
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['fax_number'] : '' ?>" class="form-control background-field" placeholder="(987) 321 654 987" name="fax_number" id="fax_number">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                    <div class="row">
                                                                                    <div class="col-md-12">
                                            
                                                                                        <label>
                                                                                            Company Email
                                                                                        </label>
                                            
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                            <?php // (isset($result))? $result ?>
                                                                                            <input type="text" value="<?= $result->email ?>" class="form-control background-field" placeholder="company@mail.com"  id="email">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="green-title">
                                                        <h5>Business Detail</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class='form-group'>

                                                        <textarea id="detail" name="detail"   class="text-msgs" placeholder="Enter business description"><?= (isset($result)) ? $result->getCompanyDetail['detail'] : '' ?></textarea>
                                                        <span  class ="error<?= 7; ?>" style="display:none; color:red">Business description required</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class ="row">
                                                <div class="col-md-12">

                                                    <label>
                                                        Website
                                                    </label>
                                                </div>
                                            </div>
                                            <div class ="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['website'] : '' ?>"  name="website" id="website" class="form-control background-field " placeholder="http://" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="green-title">
                                                        <h5>Social links</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                        Facebook
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['fb_link'] : '' ?>" id="fb_link" name ="fb_link" class="form-control background-field facebook" placeholder="http://www.facebook.com/Company" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Instagram
                                                </label>
                                                <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['insta_link'] : '' ?>" id="insta_link" name ="insta_link" class="instagram form-control background-field" instagrm placeholder="http://www.instagram.com/Company" />
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Linkedin
                                                </label>
                                                <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['linkedin_link'] : '' ?>" id="linkedin_link" name ="linkedin_link" class="form-control background-field linkedin" placeholder="http://www.linkedin.com/Company" />
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Twitter
                                                </label>
                                                <input type="text" value="<?= (isset($result)) ? $result->getCompanyDetail['twitter_link'] : '' ?>" id="twitter_link" name ="twitter_link" class="form-control background-field twitter" placeholder="http://www.twitter.com/Company" />
                                            </div>


                                        </div>


                                        <div class="profile_btn">
                                            <p class="success_msgs">


                                            </p>
                                            <input type="submit" class="btn btn_sm_blue" value="Save Changes">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>    
                    <!--(isset($checking->myvalue) && $checking->myvalue == 10)?'checked' : '';-->
                    <div class="tab-pane  <?= (isset($tab_id) && $tab_id == 'loginpassword') ? 'active' : '' ?>" id="login_password" role="tabpanel">
                        <div class="condructor-tabs">

                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Login Password
                                    </h3>
                                </div> 
                            </div>
                            <?php include resource_path('views/includes/messages.php'); ?>
                            <div class="condructor-tabs-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="green-title">
                                            <h5>Password</h5>
                                        </div>
                                    </div>
                                </div>
                                <form id="login_pasword_form"  action="<?= asset('update_password') ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Enter Old Password</label>
                                                <input type="password" name="old_password" id="old_password"  class="form-control general-field"placeholder="Enter a Password"/>
                                                <span style="display:none; color:red;" id="span_old_passowrd">Password incorrect</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Change Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control general-field" placeholder="Enter a New Password"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control general-field" placeholder="Conferm new  Password"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile_btn">
                                        <input type="submit" class="btn btn_sm_blue" value="Save Changes">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?= (isset($tab_id) && $tab_id == 'memberships') ? 'active' : '' ?>" id="memberships" role="tabpanel">
                        <div class="condructor-tabs">
                            <div class="condructor-tabs-header">
                                <div class="tabs-header">
                                    <h3>
                                        Memberships
                                    </h3>
                                </div> 

                            </div>
                            <?php include resource_path('views/admin/includes/messages.php'); ?>
                            <div class="condructor-tabs-body">
                                <div class='memeber_setting'>
                                    <h6>Membership</h6>
                                    <?php if ($result->getSubscription) { ?>
                                        <p>
                                            Your next monthly charge of <?php if ($result->getSubscription->stripe_plan == 'plan_FhkJmntlLpw7Di') { ?> $99.95 <?php } else { ?> $29.95 <?php } ?> wil be applied to your primary payment <br/> method on <?= date('jS M, Y', strtotime($result->getSubscription->ends_at)); ?>.
                                        </p>
                                    <?php } ?>
                                    <?php
                                    if (isset($result)) {
                                        if ($result->getSubscription) {
                                            ?>
                                            <button class="btn btn_cancel" onclick="location.href = '<?= asset('cancel_subscription'); ?>';">Cancel  Membership</button>
                                            <?php
                                        } else {
                                            ?>

                                            <a href="<?= asset('member_plan'); ?>" class="btn btn_cancel">Get Membership</a>

                                            <?php
                                        }
                                    }
                                    ?>


                                </div>
                                <?php if ($result->getSubscription) { ?>
            <!--                                <form id="payment-form" method="post" action="<?= asset('update_stripe_customer'); ?>">
                                    <?= csrf_field(); ?>
                                            <div class='payment_method'>
                                                
                                                <div class='credit-cart'>
                                                     <span style="color:red" class="payment-errors"></span>
                                                    <h6>Credit Card</h6>
                                                    <div class='form-group'>
                                                        <label>Card Number</label>
                                                        <input   class="form-control general-field card-field" value="" size="16" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 16)
                                                                        return false;" data-stripe="number" type="number" placeholder="<?= ($result->card_last_four) ? '********' . $result->card_last_four : 'Card Number' ?>"/>
                                                    </div>
                                                    <div class='cart-holder'>
                                                        <div class='form-group card-no'>
                                                            <label>Card Holder</label>
                                                            <input type="text" class="form-control general-field " name="name" value="<?= ($result->getSubscription) ? $result->getSubscription->name : '' ?>" placeholder="Card Owner Name"/>
                                                        </div>
                                                        <div class='form-group expire-date'>
                                                            <label>Exp.Date</label>
                                                             <input size="2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 2)
                                                                                return false;" data-stripe="exp-month" type="number" class="form-control" placeholder="Month" />
                                                                                                                   <input size="4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 4)
                                                                                return false;" data-stripe="exp-year" type="number" class="form-control" placeholder="Year" />
                                                        </div>
                                                        <div class='form-group expire-date'>
                                                            <label>CVC</label>
                                                           <input size="3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 3)
                                                                                return false;" data-stripe="cvc"  type="number" class="form-control" placeholder="CVC" />
                                                        </div>
                                                    </div>
                                                    <div class='credit-cart-save'>
                                                        <button class="btn btn_grey">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>-->
                                <?php } ?>
                            </div>
                            <div class="profile_btn">
                                <!--<button class="btn btn_sm_blue">Save Changes</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?= (isset($tab_id) && $tab_id == 'email&notification') ? 'active' : '' ?>" id="email_notfications" role="tabpanel">
                        <form method="Post" action="<?= asset('update_email_notification_settings') ?>">
                            <?= csrf_field(); ?>
                            <div class="condructor-tabs">
                                <div class="condructor-tabs-header">
                                    <div class="tabs-header">
                                        <h3>
                                            Email & Notifications
                                        </h3>
                                    </div> 
                                </div>
                                <div class="condructor-tabs-body">
                                    <?php include resource_path('views/includes/messages.php'); ?>
                                    <div class="email-setting">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input class="styled-checkbox" id="form_update" name="update_web_notification" type="checkbox" <?= (isset($result) && $result->update_web_notification == '0') ? 'checked' : '' ?> />
                                                    <label for="form_update">Updates from this website</label>
                                                    <p>Announcements, updates, tips & tricks.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                    <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <input class="styled-checkbox" id="job_activity" type="checkbox"/>
                                                                                        <label for="job_activity">Activity on my jobs</label>
                                                                                        <p>Someone send proposal on a job you’ve created.</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input class="styled-checkbox" id="services_quote" name="service_qoute_notication" type="checkbox" <?= (isset($result) && $result->getCompanyDetail['service_qoute_notication'] == '0') ? 'checked' : '' ?>/>
                                                    <label for="services_quote">Services Quotation</label>
                                                    <p>When someone send you a quote form submission.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input class="styled-checkbox" id="review" name="review_notification" type="checkbox" <?= (isset($result) && $result->getCompanyDetail['review_notification'] == '0') ? 'checked' : '' ?>/>
                                                    <label for="review">Reviews</label>
                                                    <p>Someone submit a review on your company profile.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile_btn">
                                    <button type="submit" class="btn btn_sm_blue">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #company_profile input.error , #login_pasword_form input.error  {
        border:solid 1px red !important;
    }
    #company_profile textarea.error , #login_pasword_form textarea.error  {
        border:solid 1px red !important;
    }

</style>
<?php
include resource_path('views/includes/footer.php');
?>
<?php
include resource_path('views/includes/bottom-footer.php');
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>

                                                Stripe.setPublishableKey('<?= env('STRIPE_SECRET') ?>');
                                                jQuery(function () {

                                                    $('#payment-form').submit(function (event) {
                                                        var $form = $(this);

                                                        // Disable the submit button to prevent repeated clicks
                                                        $form.find('button').prop('disabled', true);

                                                        Stripe.card.createToken($form, stripeResponseHandler);

                                                        // Prevent the form from submitting with the default action
                                                        return false;
                                                    });
                                                });
                                                function stripeResponseHandler(status, response) {
                                                    var $form = $('#payment-form');

                                                    if (response.error) {
                                                        // Show the errors on the form
                                                        $form.find('.payment-errors').text(response.error.message);
                                                        $form.find('button').prop('disabled', false);

                                                    } else {
                                                        // response contains id and card, which contains additional card details
//                                                   
                                                        var token = response.id;
                                                        // Insert the token into the form so it gets submitted to the server
                                                        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                                                        $form.append($('<input type="hidden" name="stripeToken" />').val(token));


                                                        // and submit
                                                        $form.get(0).submit();
                                                    }
                                                }
</script>
<script>
    $(".web-alert").alert();
    window.setTimeout(function () {
        $(".web-alert").alert('close');
    }, 2000);
<?php // if (Session::has('custom_error')) {    ?>
//           $('.tab-pane.active').removeClass('active');
//           $('.tab-pane.active').removeClass('active');
//           
//            $("document").ready(function() {
//            $("#topnav").removeClass('active').removeClass('show');
//            $("#profile").removeClass('active').removeClass('show');
//            $("#logging").addClass('active').addClass('show')
//            $("#logging").addClass('active').addClass('show')
//            $("#login_password").addClass('active').addClass('show')
//        
//            $("#logging").trigger('click')            
//                
//            });

<?php // }    ?>

    $('.mobile-tabs a').click(function () {
        var value = $(this).attr("href");

        $('.mobile-tabs.tabactive').removeClass('tabactive');
        $(this).parent().addClass('tabactive');
        $('.tab-pane.mobileactive').removeClass('mobileactive');
        $('.tab-content').find(value).addClass('mobileactive');
    });
    $("#uploadd-img").on("change", function ()
    {

        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".profile-logo").css("background-image", "url(" + this.result + ")");

            };
        }
    });

    $('#company_profile').validate({// initialize the plugin
        rules: {
            company_name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            home_address: {
                required: true,

            },
            phone: {
                required: true,

            },
            detail: {
                required: true,
            },
            website: {
                url: true,
            },
            fb_link: {
                url: true,
            },
            insta_link: {
                url: true,
            },
            linkedin_link: {
                url: true,
            },
            twitter_link: {
                url: true,
            },
        }, messages: {
            company_name: "Please enter Company Name",
            email: "Please enter email",
            home_address: "Please enter Start cost",
            phone: "Please enter phone",
            detail: "Please enter detail",
            website: "Please enter valid url with https",
            fb_link: "Please enter valid url with https",
            insta_link: "Please enter valid url with https",
            linkedin_link: "Please enter valid url with https",
            twitter_link: "Please enter valid url with https"
        }
    });

    var phones = [{"mask": "(###) ###-####"}];
    $('#phone, #fax_number').inputmask({
        mask: phones,
        greedy: false,
        definitions: {'#': {validator: "[0-9]", cardinality: 1}}});

    $('.menu-icon').click(function () {
        $('.cus-sidebar').toggleClass('cus-sidebar-view');
    });

    var testPattern = new RegExp("^(\\+)?(\\d+)$");
//            function chkInput() {
//                var v = $('#phone').val().charAt($('#phone').val().length - 1);
//                return testPattern.test(v);
//            }

    $('#phone_no, #fax_number').bind("paste", function (e) {
        e.preventDefault();
    });

//    $("#email_update").validate({
// // initialize the plugin
//                    rules: {
//                        email: {
//                            required: true,
//                            email:true,
//                  
//                        },
//                    
//                       } 
//                   });

    $('#old_password').on('change', function () {

        $('#preloader').show();
        passwrod = $(this).val();
        $.ajax({
            type: "Post",
            url: "<?= asset('check_password') ?>",
            data: {'password': passwrod, '_token': '<?= csrf_token(); ?>'},
            success: function (data) {
                $('#preloader').hide();
                if (data == '1') {
                    $('#span_old_passowrd').show();
                    $("#new_password").prop("disabled", true);
                    $("#password_confirmation").prop("disabled", true);
                } else {
                    $('#span_old_passowrd').hide();
                    $("#new_password").prop("disabled", false);
                    $("#password_confirmation").prop("disabled", false);
                    $('#login_pasword_form').validate({// initialize the plugin
                        rules: {
                            new_password: {
                                required: true,
                                minlength: 6,

                            },
                            password_confirmation: {
                                required: true,
                                minlength: 6,
                                equalTo: "#new_password"

                            },
                        }
                    });
                }
            }, error: function () {
            },
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
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});
        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                        (document.getElementById('address_2')), {
                    types: ['geocode']});


        // When the user selects an address from the dropdown, populate the address
        // fields in the form.


        autocomplete.addListener('place_changed', fillInAddress);
        autocomplete2.addListener('place_changed', fillInAddress_two);
//                                                         autocomplete2.addListener('place_changed', fillInAddress2);


    }

    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lat').val(lat);
        $('#lng').val(lng);

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
    function fillInAddress_two() {

        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#lat_two').val(lat);
        $('#lng_two').val(lng);

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

//                                                    function geolocate() {
//                                                        if (navigator.geolocation) {
//                                                            navigator.geolocation.getCurrentPosition(function (position) {
//                                                                var geolocation = {
//                                                                    lat: position.coords.latitude,
//                                                                    lng: position.coords.longitude
//                                                                };
//                                                                var circle = new google.maps.Circle({
//                                                                    center: geolocation,
//                                                                    radius: position.coords.accuracy
//                                                                });
//                                                                autocomplete.setBounds(circle.getBounds());
//                                                            });
//                                                        }
//                                                    }
//                                                    function fillInAddress2() {
////                                                        var place = autocomplete.getPlace();
////                                                        for (var i = 0; i < place.address_components.length; i++) {
////                                                            var addressType = place.address_components[i].types[0];
////                                                              
////                                                            if (componentForm[addressType]) {
////                                                                var val = place.address_components[i][componentForm[addressType]];
////                                                                document.getElementById(addressType).value = val;
////                                                            }
////                                                        }
//                                                    }
//
// (function($){
//   // your code goes here
//$.validator.addMethod("complete_url", function(val, elem) {
//    // if no url, don't do anything
//alert('here');
//    if (val.length == 0) { return true; }
// 
//    // if user has not entered http:// https:// or ftp:// assume they mean http://
//  if(!/^(https?|ftp):\/\//i.test(val)) {
//
//val = 'http://'+val; // set both the value
//$(elem).val(val); // also update the form element
//}
//else
//{
//val = val.replace(/(http\:\/\/)+/,'http://');
//$(elem).val(val); // also update the form element
//}
//    // now check if valid url
//    // http://docs.jquery.com/Plugins/Validation/Methods/url
//    // contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
//    return /^(https?|ftp)://(((([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(%[da-f]{2})|[!$&amp;'()*+,;=]|:)*@)?(((d|[1-9]d|1dd|2[0-4]d|25[0-5]).(d|[1-9]d|1dd|2[0-4]d|25[0-5]).(d|[1-9]d|1dd|2[0-4]d|25[0-5]).(d|[1-9]d|1dd|2[0-4]d|25[0-5]))|((([a-z]|d|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(([a-z]|d|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])*([a-z]|d|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF]))).)+(([a-z]|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(([a-z]|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])*([a-z]|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF]))).?)(:d*)?)(/((([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(%[da-f]{2})|[!$&amp;'()*+,;=]|:|@)+(/(([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(%[da-f]{2})|[!$&amp;'()*+,;=]|:|@)*)*)?)?(?((([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(%[da-f]{2})|[!$&amp;'()*+,;=]|:|@)|[uE000-uF8FF]|/|?)*)?(#((([a-z]|d|-|.|_|~|[u00A0-uD7FFuF900-uFDCFuFDF0-uFFEF])|(%[da-f]{2})|[!$&amp;'()*+,;=]|:|@)|/|?)*)?$/i.test(val);
//});
//})($); 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 
