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
<section class="memeber_plans">
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class="tab-wrapper">   
                    <?php include resource_path('views/includes/messages.php'); ?>
                    <form  >
                        <?= csrf_field(); ?>
                        <div class='membership-tab'>
                            <div class="membership-row">
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
                                        <input type="radio" id="plan3" class="plan" name="choose_plan" value="limited">
                                        <label for="plan3">
                                            <div class="membership-content ">
                                                <div class="plan-price-row">
                                                    <div>
                                                        <h5>Basic Plan</h5>
                                                        <p>
                                                            For advanced users, who want to have all benefits and much more
                                                        </p>
                                                    </div>
                                                    <h3>
                                                        $29.95<span>/mo</span>
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
                                                    <li>
                                                        <!--<a href="javascript:void();">Choose Plan</a>-->
<!--                                                                      <input type="hidden" name='subscription' value='unlimited'>
                                                        <input type='submit' value="Choose Plan">-->
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                    </label>
                                        <span id="error_chosse_plan" style="color:red; display:none;">Please choose plan</span>
                                </div>
                                <div class="membership-column">
                                    <div class="form-group circle-custom-radio">
                                        <input type="radio" id="plan4" class="plan" name="choose_plan" value="unlimited">
                                        <label for="plan4">
                                            <div class="membership-content ">
                                                <div class="plan-price-row">
                                                    <div>
                                                        <h5>Premium Plan</h5>
                                                        <p>
                                                            For advanced users, who want to have all benefits and much more
                                                        </p>
                                                    </div>
                                                    <h3>
                                                        $99.95<span>/mo</span>
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
                                                    <li>
                                                        <!--<a href="javascript:void();">Choose Plan</a>-->
<!--                                                                      <input type="hidden" name='subscription' value='unlimited'>
                                                        <input type='submit' value="Choose Plan">-->
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                    </label>
                                      
                                </div>
                            </div>
                              <div class="choose-btn"> 

                                <button data-target="#payment" data-toggle="modal" type="button" class="btn btn_md_green next " id="third_next" >Check Out</button>
                            </div>
                            
                        </div>
                    </form>
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
<div class="modal fade" id="payment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Payment</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form" action="<?= asset('change_membership') ?>" method ="Post">
                    <?= csrf_field(); ?>
                    <div class="credit-cart">
                        <h6>Credit Card</h6>
                        <div class="form-group">
                            <span style="color:red" class="payment-errors"></span>
                            <label>Card Number</label>
                            <input  class="form-control general-field card-field" size="16" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 16)
                                        return false;" data-stripe="number" type="number" placeholder="4242 4242 4242 4242">
                            <input type="hidden" name="choose_plan" id="choose_plan">
                        </div>
                        <div class="form-group">
                            <label>Card Holder</label>
                            <input type="text" class="form-control general-field " name="name" placeholder="Card holder name">
                        </div>
                        <div class="cart-holder">

                            <div class="form-group ">
                                <label>Exp.Date</label>
                                <input size="2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 2)
                                            return false;" data-stripe="exp-month" type="number" class="form-control" placeholder="Month" />
                                <input size="4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 4)
                                            return false;" data-stripe="exp-year" type="number" class="form-control" placeholder="Year" />
                            </div>
                            <div class="form-group ">
                                <label>CVC</label>
                                <input  size="3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 3)
                                            return false;" data-stripe="cvc"  type="number" class="form-control general-field" placeholder="CVC">
                            </div>
                        </div>
                        <div class="credit-cart-save">
                            <button class="btn btn_grey">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>

                                    Stripe.setPublishableKey('<?= env('STRIPE_KEY') ?>');
                                    jQuery(function () {

                                        $('#form').submit(function (event) {
                                            var $form = $(this);

                                            // Disable the submit button to prevent repeated clicks
                                            $form.find('button').prop('disabled', true);

                                            Stripe.card.createToken($form, stripeResponseHandler);

                                            // Prevent the form from submitting with the default action
                                            return false;
                                        });
                                    });
                                    function stripeResponseHandler(status, response) {
                                        var $form = $('#form');

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
    $('.edit_ser_btn').click(function (e) {
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation();
        $('.service-dropdown').hide();
        $(this).next('.service-dropdown').slideToggle();
    });
    $('body').click(function (e) {
        $('.service-dropdown').hide();
    });

    $('#third_next').on('click', function (e) {
               $('#error_chosse_plan').hide();
//       e.preventDefault();
//        var plan = $('input[name=choose_plan]:checked').val();
        var plan = $(".plan:checked").val();
//         alert(plan);
//         typeof plan;
//         alert(plan);
        if(typeof plan == 'undefined'){
            $('#error_chosse_plan').show();
            return false;
//            alert('here');
        }
        
        $('#choose_plan').val(plan);


    });
     $('#third_next_limit').on('click', function () {

        var plan = $('.plan_limit').val();
        

        $('#choose_plan').val(plan);


    });
</script>
