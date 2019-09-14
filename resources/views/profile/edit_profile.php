<?php include resource_path('views/includes/top-header.php');
?>

<section class="margin-tb">
     <div class="container">
          <div class="row">
               <div class="col-md-12">
                    <div class="tab-content">
                         <div class="tab-pane active" id="profile" role="tabpanel">
                              <div class="condructor-tabs">
                                   <div class="condructor-tabs-header">
                                        <div class="tabs-header">
                                             <h3>
                                                  Personal Information
                                             </h3>
                                        </div> 
                                   </div>
                                   <div class="condructor-tabs-body">
                                        <div class="row">
                                             <div class="col-md-12 text-center">
                                                  <div class="profile-logo">
                                                       <label for="upload-img">
                                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                                            <h6>
                                                                 Upload Logo
                                                            </h6>
                                                       </label>
                                                       <input type="file" style="display: none" id="upload-img"/>
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
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>
                                                                 First Name
                                                            </label>
                                                            <input type="text" class="form-control background-field" placeholder="First Name">
                                                       </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>
                                                                 Last Name
                                                            </label>
                                                            <input type="text" class="form-control background-field" placeholder="Last Name">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <label>
                                                                 Category
                                                            </label>
                                                            <select>
                                                                 <option>
                                                                      Choose a category
                                                                 </option>
                                                                 <option>
                                                                      Category1
                                                                 </option>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>
                                                                 Gender
                                                            </label>
                                                       </div>
                                                       <div class="genders">
                                                            <div class="form-group custom-radio">
                                                                 <input type="radio" id="1"  name="gender">
                                                                 <label for="1">Male</label>
                                                            </div>
                                                            <div class="form-group custom-radio">
                                                                 <input type="radio" id="2"  name="gender">
                                                                 <label for="2">Female</label>
                                                            </div>
                                                            <div class="form-group custom-radio">
                                                                 <input type="radio" id="3"  name="gender">
                                                                 <label for="3">Other</label>
                                                            </div>
                                                       </div>     
                                                  </div>
                                             </div>  
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <label>
                                                                 Date of birth
                                                            </label>
                                                       </div>
                                                  </div>
                                             </div>  
                                             <div class="row">
                                                  <div class="col-md-7">
                                                       <div class="date-year">
                                                            <div class="form-group">
                                                                 <select>
                                                                      <option>
                                                                           Day
                                                                      </option>
                                                                      <option>
                                                                           Monday
                                                                      </option>
                                                                 </select>
                                                            </div>
                                                            <div class="form-group">
                                                                 <select>
                                                                      <option>
                                                                           Month
                                                                      </option>
                                                                 </select>
                                                            </div>
                                                            <div class="form-group">
                                                                 <select>
                                                                      <option>
                                                                           Year
                                                                      </option>
                                                                 </select>
                                                            </div>
                                                       </div>     
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="profile-contact">
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="green-title">
                                                            <h5>Address</h5>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <label>
                                                                 Address 1
                                                            </label>
                                                            <input type="text" class="form-control background-field" placeholder="Address Line 1">
                                                       </div>
                                                  </div>
                                             </div>  
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <label>
                                                                 Address 2
                                                            </label>
                                                            <input type="text" class="form-control background-field" placeholder="Address Line 2">
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
                                                                 <select >
                                                                      <option>
                                                                           USA
                                                                      </option>
                                                                 </select>
                                                            </div>
                                                            <div class="form-group state">
                                                                 <label>
                                                                      State
                                                                 </label>
                                                                 <select >
                                                                      <option>
                                                                           Florida
                                                                      </option>
                                                                 </select>
                                                            </div>
                                                            <div class="form-group state">
                                                                 <label>
                                                                      State
                                                                 </label>
                                                                 <select >
                                                                      <option>
                                                                           Orlando
                                                                      </option>
                                                                 </select>

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
                                                            <input type="text" class="form-control background-field" placeholder="(987) 321 654 987" id="phone">
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="profile_btn">
                                       
                                        <button class="btn btn_sm_green">Next</button>
                                   </div>
                              </div>
                         </div>
                         <div class="tab-pane " id="login_password" role="tabpanel">
                              <div class="condructor-tabs">
                                   <div class="condructor-tabs-header">
                                        <div class="tabs-header">
                                             <h3>
                                                  Login Password
                                             </h3>
                                        </div> 
                                   </div>
                                   <div class="condructor-tabs-body">
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <label>Email</label>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-6">
                                                  <div class="form-group">

                                                       <input type="email" class="form-control general-field"placeholder="xyz@gmail.com"/>
                                                  </div>
                                             </div>
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <button class="btn btn_sm_tranparent"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-12">
                                                  <div class="green-title">
                                                       <h5>Password</h5>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <label>Enter Old Password</label>
                                                       <input type="text" class="form-control general-field"placeholder="Enter a Password"/>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <label>Change Password</label>
                                                       <input type="text" class="form-control general-field" placeholder="Enter old a Password"/>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row">

                                             <div class="col-md-6">
                                                  <div class="form-group">

                                                       <input type="text" class="form-control general-field" placeholder="Enter new a Password"/>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="profile_btn">
                                        <button class="btn btn_sm_blue">Save Changes</button>
                                   </div>
                              </div>
                         </div>
                         <div class="tab-pane " id="memberships" role="tabpanel">
                              <div class="condructor-tabs">
                                   <div class="condructor-tabs-header">
                                        <div class="tabs-header">
                                             <h3>
                                                  Memberships
                                             </h3>
                                        </div> 
                                   </div>
                                   <div class="condructor-tabs-body">
                                        <div class='memeber_setting'>
                                             <h6>Membership</h6>
                                             <p>
                                                  Your next monthly charge of $9.99 wil be applied to your primary payment <br/> method on 4th June, 2019.
                                             </p>
                                             <button class="btn btn_cancel">Cancel  Membership</button>
                                             <div class='premium-account'>
                                                  <p>Switch to Premium Package <span> (SAVE 20%)</span></p>
                                             </div>
                                        </div>
                                        <div class='add_payment_method'>
                                             <h6 class="blue-title">
                                                  Add a Payment Method
                                             </h6>
                                             <div class="payment-methods-row">
                                                  <div class="form-group circle-custom-radio">
                                                       <input type="radio" id="payment" name="payment">
                                                       <label for="payment">
                                                            <div class="credit-cart-info">
                                                                 <div class="credit-cart-column">
                                                                      <h5>Credit Card</h5>
                                                                      <h6>MasterCard or Visa</h6>
                                                                 </div>
                                                                 <div class="credit-cart-column">
                                                                      <img src="<?= asset('userassets/images/master-card.png'); ?>"/>
                                                                 </div>
                                                            </div>
                                                       </label>

                                                  </div>
                                                  <div class="form-group circle-custom-radio">
                                                       <input type="radio" id="payment1" name="payment">
                                                       <label for="payment1">
                                                            <div class="credit-cart-info">
                                                                 <div class="credit-cart-column">
                                                                      <h5>PayPal</h5>
                                                                      <h6>Online Payment</h6>
                                                                 </div>
                                                                 <div class="credit-cart-column">
                                                                      <img src="<?= asset('userassets/images/paypal.png'); ?>"/>
                                                                 </div>
                                                            </div>
                                                       </label>
                                                  </div>
                                             </div>    
                                        </div>
                                        <div class='payment_method'>
                                             <h6>Payment Methods</h6>
                                             <div class='payment_row'>
                                                  <div class='payment-column'>
                                                       <p>****  ****  ****  1631</p>
                                                  </div>
                                                  <div class='payment-column'>
                                                       <p>Master Card ending in 04/2022</p>
                                                  </div>
                                                  <div class='payment-column1'>
                                                       <a href="#">
                                                            <img src='<?= asset('userassets/images/edits.png'); ?>'/></a>
                                                       <a href="#">
                                                            <img src='<?= asset('userassets/images/close-icons.png'); ?>'/></a>
                                                  </div>
                                             </div>     
                                             <div class='credit-cart'>
                                                  <h6>Credit Card</h6>
                                                  <div class='form-group'>
                                                       <label>Card Number</label>
                                                       <input type="text" class="form-control general-field card-field" placeholder="Vladimir Raksha"/>
                                                  </div>
                                                  <div class='cart-holder'>
                                                       <div class='form-group card-no'>
                                                            <label>Card Holder</label>
                                                            <input type="text" class="form-control general-field " placeholder="E5819F3A-561E-4A4C-914F-BB87D2DD8A68"/>
                                                       </div>
                                                       <div class='form-group expire-date'>
                                                            <label>Exp.Date</label>
                                                            <input type="text" class="form-control general-field" placeholder="02/20"/>
                                                       </div>
                                                       <div class='form-group expire-date'>
                                                            <label>CVC</label>
                                                            <input type="text" class="form-control general-field" placeholder="543"/>
                                                       </div>
                                                  </div>
                                                  <div class='credit-cart-save'>
                                                       <button class="btn btn_grey">Save</button>
                                                  </div>
                                             </div>
                                        </div>
                                        
                                   </div>
                                   <div class="profile_btn">
                                             <button class="btn btn_sm_blue">Save Changes</button>
                                        </div>
                              </div>
                         </div>
                         <div class="tab-pane " id="email_notfications" role="tabpanel">
                              <div class="condructor-tabs">
                                   <div class="condructor-tabs-header">
                                        <div class="tabs-header">
                                             <h3>
                                                  Email & Notifications
                                             </h3>
                                        </div> 
                                   </div>
                                   <div class="condructor-tabs-body">
                                        <div class="email-setting">
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <input class="styled-checkbox" id="form_update" type="checkbox"/>
                                                            <label for="form_update">Updates from this website</label>
                                                            <p>Announcements, updates, tips & tricks.</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <input class="styled-checkbox" id="job_activity" type="checkbox"/>
                                                            <label for="job_activity">Activity on my jobs</label>
                                                            <p>Someone send proposal on a job you’ve created.</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <input class="styled-checkbox" id="services_quote" type="checkbox"/>
                                                            <label for="services_quote">Services Quotation</label>
                                                            <p>When someone send you a quote form submission.</p>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <div class="form-group">
                                                            <input class="styled-checkbox" id="review" type="checkbox"/>
                                                            <label for="review">Reviews</label>
                                                            <p>Someone submit a review on your company profile.</p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="profile_btn">
                                        <button class="btn btn_sm_blue">Save Changes</button>
                                   </div>
                              </div>
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