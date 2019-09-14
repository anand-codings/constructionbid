<?php
include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<section class='basic-info'>
    <div class='container'>
        <div class='info-header'>
            <div class="row">
                <div class='col-md-12'>

                    <a href="#">
                        <img src='<?= asset('userassets/images/logo1.png'); ?>'/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="basic-tabs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class="tab-wrapper">    
                    <div class="arrow-steps clearfix">
                        <div class="step current" data-attribute='basic-info'> <span> Basic Info</span> </div>
                        <div class="step" data-attribute='business-detail'> <span>Business Detail</span> </div>
                        <div class="step" data-attribute='membership'> <span> Membership</span> </div>
                        <div class="step" data-attribute='services'> <span>Add Payment</span> </div>
                    </div>
                    <!---->
                    <form id="payment-form" action="<?= asset('post_company_info'); ?>" method ="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class='info-tab-content'>
                            <div class="tabs-content active-tabs" id='basic-info'>
                                <div class='basic-info-tabs'>
                                    <div class='green-title'>
                                        <h5>Business Information</h5>
                                    </div>
                                    <?php include resource_path('views/includes/messages.php'); ?>
                                    <div class="form-group">


                                        <label>
                                            Professional or Company Name
                                        </label>
                                        <input type="text" id="company_name" name="first_name" value="<?= old('first_name') ? old('first_name') : ''; ?>" class="form-control background-field" placeholder="Write Here" />
                                        <span id ="company_name_span" class ="error<?= 1; ?>" style="display:none; color:red">Professional or Company Name required</span>
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
                                                    <input type="radio" id="residential" name="profile_type" value="residential" <?= isset($result->type) ? ($result->type == 'one_time_project') ? 'checked' : '' : 'checked'; ?>>
                                                    <label for="residential">Residential</label>
                                                </div>
                                                <div class="form-group custom-radio">
                                                    <input type="radio" id="commercial" name="profile_type" value="commercial" <?= isset($result->type) ? ($result->type == 'ongoing_project') ? 'checked' : '' : ''; ?>>
                                                    <label for="commercial">Commercial</label>
                                                </div>
                                                <div class="form-group custom-radio">
                                                    <input type="radio" id="both" name="profile_type" value="both" <?= isset($result->type) ? ($result->type == 'ongoing_project') ? 'checked' : '' : ''; ?>>
                                                    <label for="both">Both</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='green-title'>
                                        <h5>Business Address</h5>
                                    </div>
                                    <div class="form-group">
                                        <label> 
                                            Address 1
                                        </label>
                                        <input type="text" class="form-control background-field" id="address_1" name="home_address" value="<?= old('home_address') ? old('home_address') : ''; ?>" placeholder="Address Line 1" autocomplete="off" />
                                        <span id ="address_1_span" class ="error<?= 2; ?>" style="display:none; color:red">Address required</span>
                                        <input id="lat" type="text" style="display:none" name="latitude">
                                        <input id="lng" type="text" style="display:none" name="longitude">
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Address 2
                                        </label>
                                        <input type="text" class="form-control background-field"  id="address_2" name="address_2" value="<?= old('address_2') ? old('address_2') : ''; ?>" placeholder="Address Line 2" autocomplete="off" />
                                    </div>
                                    <div class="state-address">
                                        <div class="col2">
                                            <div class="form-group ">
                                                <label>
                                                    Country
                                                </label>
                                                <input type="text" class="form-control background-field"  id="country" name="country" value="<?= old('country') ? old('country') : ''; ?>"  placeholder="Country" />
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="form-group ">
                                                <label>
                                                    State
                                                </label>
                                                <input type="text" class="form-control background-field"  id="administrative_area_level_1" name="state" value="<?= old('state') ? old('state') : ''; ?>" placeholder="State" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col2">
                                        <div class="form-group ">
                                            <label>
                                                City
                                            </label>
                                            <input type="text" class="form-control background-field"  id="locality" name="city" value="<?= old('city') ? old('city') : ''; ?>" placeholder="City" />

                                   </div>
                                   

<!--                                             <input type="text" name="city" placeholder="City" class="form-control" value="<?= old('city') ?>" id="city">-->

                                    <div class='green-title'>
                                        <h5>Contact</h5>
                                    </div>
                                    <div class="">
                                        <label>
                                            Phone
                                        </label>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <input type="text" id="phone" name="phone"  value="<?= old('phone') ? old('phone') : ''; ?>" class="form-control background-field" placeholder="(987) 321 654 987" id='phone'/>
                                            <span class ="error<?= 3; ?>" style="display:none; color:red">Phone number required</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Company Fax Number
                                        </label>
                                        <input type="text" id="fax" name="fax_number" value="<?= old('fax_number') ? old('fax_number') : ''; ?>"  class="form-control background-field" placeholder="(987) 321 654 987" />
                                    </div>
                                    <!--                                             <div class="form-group">
                                                                                      <label>
                                                                                           Company Email
                                                                                      </label>
                                                                                      <input type="email" id ="email" name ="email" class="form-control background-field" placeholder="company@email.com" />
                                                                                      <span  class ="error<?php // 4;   ?>" style="display:none; color:red">Company Email required</span>
                                                                                 </div>-->
                                </div>
                                <div class="nav step-pagination">
                                    <a href="#" class="btn btn_md_green next "id="first_next">Next</a>
                                </div>
                            </div>
                            <div class="tabs-content" id='business-detail'>
                                <div class='business-info-tab'>
                                    <div class="business-detail-section">
                                        <div class="detail-banner" style="background-image: url('userassets/images/business-banner.png')"></div>
                                        <div class='banner-bottom'>
                                            <div class='banner-logo' style=''>
                                                <label for="banner-logo" class=''>
                                                    <div class='banner-logo-img' style="background-image: url('userassets/images/upload-logo.png')"></div>
                                                    <input type='file' style="display:none;" id='banner-logo' name="banner_logo" />
                                                    <span  class ="error<?= 5; ?>" style="display:none; color:red">Logo Required</span>
                                                </label>
                                            </div>
                                            <div class='banner-button'>
                                                <label for='banner-images' class='btn btn_sm_green '>
                                                    <img id="img_src" src='<?= asset('userassets/images/group-photo.png'); ?>'  />Upload Banner
                                                </label>
                                                <input type='file' style="display: none;" id='banner-images' name="banner_images"/>
                                                <span  class ="error<?= 6; ?>" style="display:none; color:red">Banner required</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='green-title'>
                                        <h5>Business Detail</h5>
                                    </div>
                                    <div class='form-group'>
                                        <label></label>
                                        <textarea id="business_detail" name="detail" class="text-msgs" placeholder="Enter business description"><?= old('detail') ? old('detail') : ''; ?></textarea>
                                        <span  class ="error<?= 7; ?>" style="display:none; color:red">Business description required</span>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Website
                                        </label>
                                        <input type="text" class="form-control background-field " name="website" value="<?= old('website') ? old('website') : ''; ?>" placeholder="http://" />
                                    </div>
                                    <div class='green-title'>
                                        <h5>Social Links</h5>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Facebook
                                        </label>
                                        <input type="text" name ="fb_link" value="<?= old('fb_link') ? old('fb_link') : ''; ?>" class="form-control background-field facebook" placeholder="http://www.facebook.com/Company" />
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Instagram
                                        </label>
                                        <input type="text" name ="insta_link" value="<?= old('insta_link') ? old('insta_link') : ''; ?>" class="instagram form-control background-field" instagrm placeholder="http://www.instagram.com/Company" />
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Linkedin
                                        </label>
                                        <input type="text" name ="linkedin_link" value="<?= old('linkedin_link') ? old('linkedin_link') : ''; ?>" class="form-control background-field linkedin" placeholder="http://www.linkedin.com/Company" />
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Twitter
                                        </label>
                                        <input type="text" name ="twitter_link" value="<?= old('twitter_link') ? old('twitter_link') : ''; ?>" class="form-control background-field twitter" placeholder="http://www.twitter.com/Company" />
                                    </div>
                                    <div class="nav step-pagination">

                                        <a href="#" class="prev" ><i class="fa fa-angle-left" aria-hidden="true"></i> Business Information</a>
                                        <a href="#" class="btn btn_md_green next " id="second_next">Next</a>

                                    </div>
                                </div>
                            </div>
                            <div class="tabs-content " id='membership'>
                                        <div class='membership-tab'>
                                            <div class='membership-row'>
                                                  <div class="membership-column">
                                                       <div class="pricing-content">
                                                            <h3>Our Pricing</h3>
                                                            <p>
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
                                                            </p>
                                                       </div>
                                                  </div>
                                            </div>
                                             <div class='membership-row'>
                                                 
                                                  <div class="membership-column">
                                                       <div class="form-group circle-custom-radio">
                                                            <input type="radio" id="plan3" name="choose_plan" value="limited">
                                                            <label for="plan3">
                                                                 <div class="membership-content text-center">
                                                                      <div class="plan-price-row">
                                                                           <h5>Basic Plan</h5>
                                                                           <h3>
                                                                                $29.00<span>/mo</span>
                                                                           </h3>
                                                                      </div>
                                                                      <ul>
                                                                           <li>
                                                                                Bids in a month
                                                                                <span>15</span>
                                                                           </li>
                                                                           <li>
                                                                                Portfolio Project
                                                                                <span>Limited</span>
                                                                           </li>
                                                                           <li>
                                                                                Custom Cover Photo
                                                                                <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                           </li>
                                                                           <li>
                                                                                Fees Free
                                                                                <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                           </li>
<!--                                                                           <li>
                                                                                <a href="#">Choose Plan</a>
                                                         <input type="hidden" name='subscription' value='unlimited'>
                                                            <input type='submit' value="Choose Plan">
                                                                           </li>-->
                                                                      </ul>
                                                                 </div>
                                                       </div>
                                                       </label>
                                                  </div>
                                                 <div class="membership-column">
                                                       <div class="form-group circle-custom-radio">
                                                            <input type="radio" id="plan4" name="choose_plan" value="unlimited">
                                                            <label for="plan4">
                                                                 <div class="membership-content text-center">
                                                                      <div class="plan-price-row">
                                                                           <h5>Premium Plan</h5>
                                                                           <h3>
                                                                                $99.99<span>/mo</span>
                                                                           </h3>
                                                                      </div>
                                                                      <ul>
                                                                           <li>
                                                                                Bids in a month
                                                                                <span>Unlimited</span>
                                                                           </li>
                                                                           <li>
                                                                                Portfolio Project
                                                                                <span>Unlimited</span>
                                                                           </li>
                                                                           <li>
                                                                                Custom Cover Photo
                                                                                <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                           </li>
                                                                           <li>
                                                                                Fees Free
                                                                                <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                           </li>
<!--                                                                           <li>
                                                                                <a href="#">Choose Plan</a>
                                                         <input type="hidden" name='subscription' value='unlimited'>
                                                            <input type='submit' value="Choose Plan">
                                                                           </li>-->
                                                                      </ul>
                                                                 </div>
                                                       </div>
                                                       </label>
                                                  </div>

                                             </div>
                                             <div class="nav step-pagination">
                                                  <a href="#" class="prev" ><i class="fa fa-angle-left" aria-hidden="true"></i> Business Detail</a>
                                                  <a href="#" class="btn btn_md_green next " id="skip_next" >Skip</a>
                                                  <a href="#" class="btn btn_md_green next " id="third_next" >Next</a>
                                             </div>

                                        </div>
                                    </div>
                            <div class="tabs-content" id='services'>

                                <div class="credit-cart">
                                    <h6>Credit Card</h6>
                                    <span style="color:red" class="payment-errors"></span>
                                    <div class="form-group">
                                        <label>Card Number</label>
                                        <!--<input type="text" class="form-control general-field card-field" placeholder="Vladimir Raksha">-->
                                        <input size="16" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 16)
                                                    return false;" data-stripe="number" type="number" class="form-control" placeholder="4567 9874 2315 4599" />
                                    </div>
                                    <div class="cart-holder">
                                        <div class="form-group card-no">
                                            <label>Card Holder</label>
                                            <!--<input type="text" class="form-control general-field " placeholder="E5819F3A-561E-4A4C-914F-BB87D2DD8A68">-->
                                            <input id="card_holder_name" type="text" name="card_holder_name" value="<?= old('card_holder_name') ? old('card_holder_name') : ''; ?>" class="form-control" placeholder="Card Holder Name" />
                                        </div>
                                        <div class="form-group expire-date">
                                            <label>Exp.Date</label>
                                            <input size="2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 2)
                                                        return false;" data-stripe="exp-month" type="number" class="form-control" placeholder="Month" />
                                            <input size="4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 4)
                                                        return false;" data-stripe="exp-year" type="number" class="form-control" placeholder="Year" />
                                        </div>
                                        <div class="form-group expire-date">
                                            <label>CVC</label>
                                            <!--<input type="text" class="form-control general-field" placeholder="543">-->
                                            <input size="3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 3)
                                                        return false;" data-stripe="cvc"  type="number" class="form-control" placeholder="CVC" />
                                        </div>
                                    </div>
                                    <div class="credit-cart-save">
                                        <button type="submit" class="btn btn_grey show_loader">Save</button>
                                    </div>
                                </div>
                                <div class="">
                                    <!--<a href="" class="btn btn_sm_green">Go to Add Services</a>-->

                                </div>
                                <a href="#" class="prev" ><i class="fa fa-angle-left" aria-hidden="true"></i> Business Detail</a>
                            </div>

                        </div>
                    </form>
                    <!--                         <div class="nav step-pagination">
                                                  <a href="#" class="prev" style="display: none;">Previous</a>
                                                  <a href="#" class="btn btn_md_green next ">Next</a>
                                             </div>-->

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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>

    Stripe.setPublishableKey('<?= env('STRIPE_KEY') ?>');
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

            // and submit
            $form.get(0).submit();
        }
    }
</script>
<script>
    var phones = [{"mask": "(###) ###-####"}];
    $('#phone, #fax').inputmask({
        mask: phones,
        greedy: false,
        definitions: {'#': {validator: "[0-9]", cardinality: 1}}});

    $('.menu-icon').click(function () {
        $('.cus-sidebar').toggleClass('cus-sidebar-view');
    });

    var testPattern = new RegExp("^(\\+)?(\\d+)$");
    function chkInput() {
        var v = $('#phone').val().charAt($('#phone').val().length - 1);
        return testPattern.test(v);
    }

    $('#phone_no, #fax').bind("paste", function (e) {
        e.preventDefault();
    });

    jQuery(document).ready(function () {
        var back = jQuery(".prev");
        var first_next = jQuery("#first_next");
        var second_next = jQuery("#second_next");
        var third_next = jQuery("#third_next");
//        var next = jQuery(".next");
        var steps = jQuery(".step");
//        next.bind("click", function () {
////            return false;
//            jQuery.each(steps, function (i) {
//                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
//                {
//                    jQuery(steps[i]).addClass('current');
//                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
//                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
//                    var datid = jQuery(steps[i]).attr("data-attribute");
//                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
//                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
//                    return false;
//                }
//            })
//        });
        back.bind("click", function () {
            jQuery.each(steps, function (i) {
                if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current'))
                {
                    jQuery(steps[i + 1]).removeClass('current');
                    var per_step1 = jQuery(steps[i + 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step1).removeClass('active-tabs');
                    var datid1 = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid1).addClass('active-tabs');
                    jQuery(steps[i]).removeClass('done');
                    jQuery(steps[i]).addClass('current');
                    return false;
                }
            })
        });
//          next.bind("click", function () {
//               jQuery.each(steps, function (i) {
//                    if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current'))
//                         var currents = jQuery(steps[i + 1]).attr("data-attribute");
////                         console.log(currents);
//                    if (currents == 'business-detail') {
//                         $('.prev').html('Back to Services');
//                         $('.prev').css('display', 'block');
//                    } else if (currents == 'membership') {
//                         $('.prev').html('Back to Business Detail');
//                    } else if (currents == 'services') {
//                         $('.step-pagination').css('display', 'none');
//                    }
//               });
//          });
//          back.bind("click", function () {
//                jQuery.each(steps, function (i) {
//                    if (jQuery(steps[i]).hasClass('done') && jQuery(steps[i + 1]).hasClass('current'))
//                    {
//                          var per_step1 = jQuery(steps[i + 1 ]).attr("data-attribute");
//                          console.log(per_step1);
//                    }
//                         });
//          });
        $("#banner-images").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    $(".detail-banner").css("background-image", "url(" + this.result + ")");
                };
            }
        });
        $("#banner-logo").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    $(".banner-logo-img").css("background-image", "url(" + this.result + ")");
                };
            }
        });

//     basic_info

        first_next.bind("click", function () {
            count = 0;
            if ((validation('#company_name', '1')) == false) {
                ++count;
            }
            ;
            if ((validation('#address_1', '2')) == false) {
                ++count;
            }
            ;
            if ((validation('#phone', '3')) == false) {
                ++count;
            }
            ;
//               if ((validation('#email', '4')) == false) {
//                    ++count;
//               }
//               ;

            if (count > 0) {
                return false;
            }
            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
                {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });
        second_next.bind("click", function () {
            count = 0;

            var bg = $('.detail-banner').css('background-image');
            bg = bg.replace('url(', '').replace(')', '').replace(/\"/gi, "");

            img_src = "<?= asset('userassets/images/business-banner.png'); ?>"

            if (bg == img_src) {
                $('.error6').show();
                ++count;
            } else {
                $('.error6').hide();
            }
            var bg2 = $('.banner-logo-img').css('background-image');
            bg2 = bg2.replace('url(', '').replace(')', '').replace(/\"/gi, "");
            srce = "<?= asset('userassets/images/upload-logo.png'); ?>";


            if (bg2 == srce) {

                $('.error5').show();
                ++count;
            } else {

                $('.error5').hide();
            }

            if ((validation('#business_detail', '7')) == false) {
                ++count;
            }
            ;

            if (count > 0) {
                return false;
            }

            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
                {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });
//          third_next.bind("click", function () {
//              
//               jQuery.each(steps, function (i) {
//                    if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
//                    {
//                         jQuery(steps[i]).addClass('current');
//                         var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
//                         $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
//                         var datid = jQuery(steps[i]).attr("data-attribute");
//                         $('.info-tab-content').find('#' + datid).addClass('active-tabs');
//                         jQuery(steps[i - 1]).removeClass('current').addClass('done');
//                         return false;
//                    }
//               })
//          });

        $('#skip_next').on('click', function () {
            $('#payment-form').get(0).submit();
        });
        third_next.bind("click", function () {
            var value = $('input[name=choose_plan]:checked').val();
//              if(value == null || value == 'Freeee'){
            if (value == null) {
//                   $('#payment-form').append('<input type="hidden" name="stripeFreePlan" />');
//                   $('#payment-form').get(0).submit();
//    function submitDetailsForm() {
//       $("#payment-form").submit();
//    }
                return false;
            }
            jQuery.each(steps, function (i) {
                if (!jQuery(steps[i]).hasClass('current') && !jQuery(steps[i]).hasClass('done'))
                {
                    jQuery(steps[i]).addClass('current');
                    var per_step = jQuery(steps[i - 1 ]).attr("data-attribute");
                    $('.info-tab-content').find('#' + per_step).removeClass('active-tabs');
                    var datid = jQuery(steps[i]).attr("data-attribute");
                    $('.info-tab-content').find('#' + datid).addClass('active-tabs');
                    jQuery(steps[i - 1]).removeClass('current').addClass('done');
                    return false;
                }
            })
        });

        function validation(input_id, num) {

            var title = $(input_id).val();
            title = title.trim();

            if (title == '') {

                $('.error' + num).show();
                return false;
            }
            $('.error' + num).hide();
        }
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
                /** @type {!HTMLInputElement} */(document.getElementById('address_1')),
                {types: ['geocode']});

        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                        (document.getElementById('address_2')), {
                    types: ['geocode']});


        // When the user selects an address from the dropdown, populate the address
        // fields in the form.


        autocomplete.addListener('place_changed', fillInAddress);
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

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
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


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 