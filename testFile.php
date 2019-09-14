<form id="payment-form" action="#">
                                            <span style="color:red" class="payment-errors"></span>
                                            <div class="form-group icon-field bordered">
                                                <i class="fa fa-user text-white"></i>
                                                <input id="card_holder_name" type="text" class="form-control" placeholder="Card Holder Name" />
                                            </div> <!-- form group -->
                                            <div class="form-group icon-field bordered">
                                                <i class="fas fa-credit-card text-white"></i>
                                                <input size="16" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 16)
                                                            return false;" data-stripe="number" type="number" class="form-control" placeholder="4567 9874 2315 4599" />
                                            </div> <!-- form group -->
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group icon-field bordered">
                                                        <i class="fa fa-calendar-check text-white"></i>
                                                        <input size="2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 2)
                                                                    return false;" data-stripe="exp-month" type="number" class="form-control" placeholder="Month" />
                                                    </div> <!-- form-group -->
                                                </div>
                                                <div class="col">
                                                    <div class="form-group icon-field bordered">
                                                        <i class="fa fa-calendar-check text-white"></i>
                                                        <input size="4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 4)
                                                                    return false;" data-stripe="exp-year" type="number" class="form-control" placeholder="Year" />
                                                    </div> <!-- form-group -->
                                                </div>
                                                <div class="col">
                                                    <div class="form-group icon-field bordered">
                                                        <i class="fas fa-lock text-white"></i>
                                                        <input size="3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if (this.value.length == 3)
                                                                    return false;" data-stripe="cvc" type="number" class="form-control" placeholder="CVC" />
                                                    </div> <!-- form-group -->
                                                </div>
                                            </div> <!-- form row -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-primary btn-lg mb-3"> Add </button>
                                                    </div> <!-- element -->
                                                </div> <!-- col -->
                                            </div> <!-- row -->
                                        </form>

                                        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!--                                        Stripe.setPublishableKey('<?= env('STRIPE_KEY') ?>');
                                                            jQuery(function  {
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

                                                                    var token = response.id;
                                                                    //alert(token)
                                                                    $.ajax({
                                                                        url: "<?= asset('add_card') ?>",
                                                                        type: 'POST',
                                                                        data: {
                                                                            'token': token,
                                                                            'card_holder_name': $('#card_holder_name').val(),
                                                                            '_token': '<?= csrf_token() ?>'
                                                                        },
                                                                        success: function (response) {
                                                                            $form.find('button').prop('disabled', false);
                                                                            $('#payment-form')[0].reset();
                                                                            $('#users_cards').append(response.view);
                                                                            $('#success-msg').addClass('show').html('<i class="fas fa-check text-success"></i> Card Added Successfully');
                                                                            setTimeout(function () {
                                                                                $('#success-msg').removeClass('show');
                                                                            }, 5000);
                                                                        },

                                                                        error: function (response) {
                                                                            $form.find('button').prop('disabled', false);
                                                                            $('#payment-form')[0].reset();
                                                                            $('#success-msg').addClass('show').html('<i class="fas fa-times text-danger"></i>' + response.statusText);
                                                                            setTimeout(function () {
                                                                                $('#success-msg').removeClass('show');
                                                                            }, 5000);
                                                                        },
                                                                    });
                                                                }
                                                            }
                                                            -->
                                                            
                                                            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script>
                                            Stripe.setPublishableKey('<?= env('STRIPE_KEY') ?>');
                                            jQuery(function  {
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
                                                    var token = response.id;
                                                    // Insert the token into the form so it gets submitted to the server
                                                    $form.append($('<input type="hidden" name="stripeToken" />').val(token));

                                                    // and submit
                                                    $form.get(0).submit();
                                                }
                                            }
        </script>