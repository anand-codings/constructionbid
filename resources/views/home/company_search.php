<?php
include resource_path('views/includes/top-header.php');
include resource_path('views/includes/header.php');
?>
<section class="search-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="seact-bar">
                    <!--<select>-->
                        <!--<option>Companies</option>-->
                        <!--<option>Job</option>-->
                    <!--</select>-->
                    <div class="form-group">
                        <input type="text" name="comapany_name"  <?php if (isset($_GET['comapany_name'])) { ?> value="<?= $_GET['comapany_name'] ?>" <?php } ?> class="general-field form-control" id="job_name" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class='mobile-filter'>
            <span>Filter</span>
        </div>
        <div class="row">
            <div class="search_menu_overlay" style="display: none;"></div>
            <div class="col-md-4 search-desktop">
                <div class='mobile-close-icon'>
                    <button type="button" class="close-modal" ><i class="fa fa-times" aria-hidden="true"></i></button>
                    <form id="job_search" action="<?= asset('post_company_search') ?>" method="Post">
                        <?= csrf_field(); ?>
                        <div class="search-filter">
                            <div class="filter-head">
                                <h6>Filter</h6>
                                <span>
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="filter-location">
                                <div class="address-filter">
                                    <div class="filter-subtile">
                                        <h6>location</h6>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control general-field location-filed" name="location" id="location" placeholder="New York" autocomplete="off"/>
                                        <input id="lat" type="text" style="display:none" name="latitude">
                                        <input id="lng" type="text" style="display:none" name="longitude">

                                    </div>
                                    <div class="check-filter">
                                        <div class="form-group">
                                            <input class="styled-checkbox company_emp" id="contractors" name="company_emp[]" value="general_contractors" type="checkbox" style="display:none;">
                                            <label for="contractors">
                                                <img src="<?= asset('userassets/images/condructor.png') ?>"/>
                                                <span class="check-name">General Contractors</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input class="styled-checkbox company_emp" id="subcontractors" name ="company_emp[]" value="sub_contractors" type="checkbox" style="display:none;">
                                            <label for="subcontractors">
                                                <img src="<?= asset('userassets/images/sub.png') ?>"/>
                                                <span class="check-name">Subcontractors</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input class="styled-checkbox company_emp" id="suppliers" name="company_emp[]" value="supplier" type="checkbox" style="display:none;">
                                            <label for="suppliers">
                                                <img src="<?= asset('userassets/images/vendors.png') ?>"/>
                                                <span class="check-name">Suppliers/Vendors</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input class="styled-checkbox company_emp" id="professional" name="company_emp[]" value="professional" type="checkbox" style="display:none;">
                                            <label for="professional">
                                                <img src="<?= asset('userassets/images/professional.png') ?>"/>
                                                <span class="check-name">Professionals</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input class="styled-checkbox company_emp" id="owner" name="company_emp[]"  value="owner" type="checkbox" style="display:none;">
                                            <label for="owner">
                                                <img src="<?= asset('userassets/images/owner.png') ?>"/>
                                                <span class="check-name">Owners</span>
                                            </label>
                                        </div>
                                        <!--                                                  <div class="form-group">
                                                                                               <input class="styled-checkbox" id="other" type="checkbox" style="display:none;">
                                                                                               <label for="other">
                                                                                                    <img src="<?= asset('userassets/images/other.png') ?>"/>
                                                                                                    <span class="check-name">Other</span>
                                                                                               </label>
                                                                                          </div>-->
                                    </div>
                                </div>
                                <div class="specialites-filter">
                                    <div class="filter-subtile">
                                        <h6>Specialities</h6>
                                        <span>
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="speciality">
                                        <?php
                                        if (isset($specialities)) {
                                            $count = 0;
                                            foreach ($specialities as $speciality) {
                                                ++$count;
                                                ?>
                                                <div class="form-group">
                                                    <input class="styled-checkbox job_speciality" job="<?= $speciality->id; ?>" value="<?= $speciality->title; ?>" name="speciality[]" <?php if (isset($_GET['category_job']) && $speciality->title == $_GET['category_job']) { ?> checked <?php } ?> id="speciality <?= $speciality->id; ?>" type="checkbox">
                                                    <label for="speciality <?= $speciality->id; ?>"><?= $speciality->title ?> </label>
                                                </div>
                                            <?php }
                                            ?> <input type="hidden" id="count_speciality" value="<?= $count ?>">
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="price-filter">
                                    <div class="filter-subtile">
                                        <h6>Typical Job Price</h6>
                                        <span>
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <!--<div id="slider-range"></div>-->
                                    <div class="range-slider-value">
                                        <label for='amount_start'> Minimum
                                        <input type="text" class='form-group' name="amount_start" onkeypress="return isNumberKey(event)" id="amount_start"  >
                                        </label><span>-</span>
                                        <label for='amount_end'> Maximum
                                        <input type="text" class='form-group' name="amount_end" onkeypress="return isNumberKey(event)" id="amount_end" >
                                        </label>
                                    </div>
                                </div>
                                
                                        <h6>Company Type</h6>
                                       
                                   

                                    <!--<div id="slider-range"></div>-->
                                   
                                             
                                            <label for="5star">Resedential
                                                <input type="radio" id="company_type" value="residential" name="company_type">
                                            </label>
                                   
                                            <label for="5star">Commercial
                                            <input type="radio" id="company_type" value="commercial" name="company_type">
                                            </label>
                                        
                                            <label for="5star">Both
                                            <input type="radio" id="company_type" value="both" name="company_type">
                                                
                                            </label>
                                       
                                <div class="review-filter">
                                    <div class="filter-subtile">
                                        <h6>Reviews</h6>
                                        <span>
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="">
                                        <div class="form-group circle-custom-radio">
                                            <input type="radio" id="5star" value="5" name="star">
                                            <label for="5star">
                                                <div class="radio-filters">
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                </div>
                                            </label>

                                        </div>
                                        <div class="form-group circle-custom-radio">
                                            <input type="radio" id="4star" value="4" name="star">
                                            <label for="4star">
                                                <div class="radio-filters">
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-group circle-custom-radio">
                                            <input type="radio" id="3star" value="3" name="star">
                                            <label for="3star">
                                                <div class="radio-filters">
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-group circle-custom-radio">
                                            <input type="radio" value="2" id="2star" name="star">
                                            <label for="2star">
                                                <div class="radio-filters">
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-group circle-custom-radio">
                                            <input type="radio" value="1" id="1star" name="star">
                                            <label for="1star">
                                                <div class="radio-filters">
                                                    <img src="<?php echo asset('userassets/images/star.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                    <img src="<?php echo asset('userassets/images/emptystar.png') ?>"/>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="styled-checkbox" id="verify" name="verify" type="checkbox" />
                                    <label for="verify">Only Verify </label>
                                </div>
                            </div>
                            <div class="filter-btn">
                                <button onclick="getJobs()" class="btn btn_apply" type="button" >Apply Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="search-result">
                    <div class="search-header">
                        <h6>Search Results <span id="total_record"></span></h6>
                        <select id="per_page" onchange="getJobs()">
                            <option value="10">
                                10 Per Page 
                            </option>
                            <option value="20">
                                20 Per Page 
                            </option>
                        </select>
                    </div>
                    <div class="search-body">
                        <div class="default_search">
                            <div class="company-search">
                                <?php
                                if (isset($comapanies)) {
                                    foreach ($comapanies as $comapany) {
                                        ?> 


                                        <div class="company-search-row">
                                            <div class="company-search-column" style="background-image: url('<?= ($comapany->cover_image) ? asset($comapany->cover_image) : asset('public/images/images.png'); ?>')">
                                            </div>
                                            <div class="company-search-column1">
                                                <div class='result-row'>
                                                    <div class="result-head">
                                                        <div class='result-profile' style='background-image: url("<?= getUserImage($comapany->profile_image); ?>")'></div>
                                                        <div class="home_left_head">
                                                            <h2><a href="<?= asset('company_profile_home/' . $comapany->id); ?>"><?= $comapany->first_name; ?></a>
                                                                <?php if ($comapany->is_verified == '1') { ?>
                                                                    <a href="#">
                                                                        <img src="<?= asset('userassets/images/verified.svg') ?>" alt="verified">
                                                                    </a>
                                                                <?php } ?>
                                                            </h2>
                                                            <div class="middle"style="">
                                                                <div class="star-ratings-sprite-gray">
                                                                    <span style="width: <?=isset($comapany->ratingAvg->total)? $comapany->ratingAvg->total*20:0?>%;" class="star-ratings-sprite-rating"></span>
                                                                </div>
                                                                <span class="total-give-review">(<?= $comapany->get_ratings_count ?> Reviews)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        <?= $comapany->getCompanyDetail['detail']; ?>
                                                    </p>
                                                    <div class='result-profile-footer'>
                                                        <div class="typical-job">
                                                            <?php
                                                            foreach ($comapany->getProposals as $proposal) {
                                                                if ($proposal->status == 'accept') {
                                                                    ?>

                                                                    <h6>Typical Job</h6>
                                                                    <p> <?= '$' . $proposal->getJob->budget_start ?> - <?= '$' . $proposal->getJob->budget_end ?> </p>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="typical-job">
                                                            <div class="home_left_btns">
                                                                                         <?php if ($comapany->getSaves->isEmpty()) { ?>  
                                        <!--<a href="<?php //asset('unsave_company').'/'.$comapany->id.'/'.'company';?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>-->

    <?php } else { ?>
                                <button class="btn btn_sm_grey save_company<?= $comapany->id ?>" data-id="<?= $comapany->id ?>"><img src="<?= asset('userassets/images/favorites.svg') ?>" alt="favorites">Saved</button>

                     <!--<button class="btn btn_sm_grey save_company<?php //$comapany->id  ?>" data-id="<?php //$comapany->id  ?>"><img src="<?php // asset('userassets/images/favorites.svg')  ?>" alt="favorites">Save</button>-->
                            <?php }?>
                                                                <button data-toggle="modal" data-target="#contact-person" class="btn btn_sm_green">Contact</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                } else if ($comapanies->isEmpty()) {
                                    echo 'No company added yet';
                                }
                                ?>


                            </div>
                        </div>
                        <div id="result">

                        </div>
                    </div>
                </div>
                <div class="paginations">
                    <!--                         <nav aria-label="Page navigation example">
                                                  <ul class="pagination">
                                                       <li class="page-item">
                                                            <a class="page-link " href="#" aria-label="Previous">
                                                                 <span aria-hidden="true">&laquo;</span>
                                                                 <span class="sr-only">Previous</span>
                                                            </a>
                                                       </li>
                                                       <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                       <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Next">
                                                                 <span aria-hidden="true">&raquo;</span>
                                                                 <span class="sr-only">Next</span>
                                                            </a>
                                                       </li>
                                                  </ul>
                                             </nav>-->
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include resource_path('views/includes/footer.php');
include resource_path('views/includes/bottom-footer.php');
?>
<script src="<?= asset('public/js/jquery.simplePagination.js'); ?>"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.js"></script>-->
<script>
//    $('#result').pagination({
//    dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 195],
//    callback: function(dataSource) {
//        // template method of yourself
//        var html = template(data);
//        dataContainer.html(html);
//    }
//});

                            $('#job_name').keypress(function (e) {
                                if (e.which == 13) {
                                    getJobs();
                                }
                            });
                            $(document).ready(function () {
//         contact_company
                                $('body').on('click', '.contact_form', function () {
                                    var id=$(this).data('id');
                                  
                                    $form = $(this).parents('form');
                                    $this = $(this);
                                    console.log($form);
//                                    Form
//                                    validation
                                    $form.validate({
                                        rules: {
                                            email: {
                                                required: true,
                                            },
                                            first_name: {
                                                required: true,

                                            },
                                            last_name: {
                                                required: true,

                                            },
                                            phone: {
                                                required: true,

                                            },
                                            details: {
                                                required: true,

                                            }

                                        },
                                        messages: {
                                            email: "Please enter Email",
                                            first_name: "Please enter first name",
                                            last_name: "Please enter last name",
                                            phone: "Please enter phone",
                                            details: "Please enter details"
                                        },

                                   submitHandler: function (form) {
                                        $('#preloader').show();
                                        var formData = new FormData($form[0]);
                                        $.ajax({
                                            type: "POST",
                                            url: $form.attr('action'),
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            dataType: 'json',
                                            success: function (data) {
                                                $('#preloader').hide();
                                         $('#success_message').show();
                                        $('#message_to_append').html(data.message);
                                        $('.update_project_li' + id).remove();
                        setTimeout(function(){
                            $('#success_message').hide();
                        },3000);
                           $('#contact-person'+id).modal('hide');            
                       },
                                            error: function (data) {
                                                $('#preloader').hide();
                                              $('#delete_message').show();
                        $('#message_to_append_error').html('Sorry Something went wrong');
                        setTimeout(function(){
                            $('#delete_message').hide();
                        },3000);      
                     $('#contact-person'+id).modal('hide');}
                                        });
                                    }

                                    });
                                });
                            });


//               if ($form.valid()) {
//
////             $('#login').attr("disabled", true);
//    $('#preloader').show();
//                    var formData = new FormData($form[0]);
//                    
//               }

//                         
                            function getJobs() {
//         event.preventDefault();
                                location_company = $('#location').val();
                                pangination = $('#pangination').val();
                                var val_emp = [];
                                $('.company_emp:checked').each(function (i) {
                                    val_emp[i] = $(this).val();
                                });

                                var val = [];
                                $('.job_speciality:checked').each(function (i) {
                                    val[i] = $(this).val();
                                });
                                lat = $('#lat').val();
                                lng = $('#lng').val();
//            review = $('input[name=star]:checked').val();

                                comapany_name = $('#job_name').val();
                                amount_start = $('#amount_start').val();
                                amount_end = $('#amount_end').val();
//        verify = $('#verify').val();
                                verify = $('#verify:checked').val();
                                ;

                                rating = $("input[name='star']:checked").val();
                                company_type= $("input[name='company_type']:checked").val();
//                                alert(company_type);
                                $('#preloader').show();
                                
                                $.ajax({
                                    type: 'Post',
                                    url: "<?= asset('post_company_search') ?>",
                                    data: {'verify': verify, 'rating': rating, 'amount_start': amount_start, 'amount_end': amount_end, 'lat': lat, 'lng': lng, 'val_emp':val_emp , 'comapany_name': comapany_name, 'location': location_company, 'specialities': val, 'company_type':company_type, '_token': '<?= csrf_token(); ?>'},
                                    success: function (data) {
                                        data = JSON.parse(data);
//               $("#result").html(data);
                                        $('#preloader').hide();
                                      
                                        $('#result').appendTo('.search-body').html(data.view);
                                        $('#total_record').html('(' + data.total_count + ')');
                                        $(".default_search").remove();
                                        var items = $('#result .company-search-row');
                                        var numItems = data.total_count;
                                        var perPage = $('#per_page').val();
                                        items.slice(perPage).hide();

                                        setTimeout(function () {
                                            $('.paginations').pagination({
                                                items: data.total_count,
                                                itemsOnPage: perPage,
                                                cssStyle: 'light-theme',
                                                onPageClick: function (pageNumber) {
                                                    // We need to show and hide `tr`s appropriately.
                                                    var showFrom = perPage * (pageNumber - 1);
                                                    var showTo = showFrom + perPage;

                                                    // We'll first hide everything...
                                                    items.hide()
                                                            // ... and then only show the appropriate rows.
                                                            .slice(showFrom, showTo).show();
                                                }
                                            });
                                        }, 1000);
                                    },
                                    error: function () {
                                        $('#preloader').hide();
                                    }
                                });

                            }
                            function initAutocomplete() {
                                // Create the autocomplete object, restricting the search to geographical
                                // location types.
                                autocomplete = new google.maps.places.Autocomplete(
                                        /** @type {!HTMLInputElement} */(document.getElementById('location')),
                                        {types: ['geocode']});
                                autocomplete.addListener('place_changed', fillInAddress);
                            }

                            function fillInAddress() {

                                // Get the place details from the autocomplete object.
                                var place = autocomplete.getPlace();
                                var lat = place.geometry.location.lat();
                                var lng = place.geometry.location.lng();
                                $('#lat').val(lat);
                                $('#lng').val(lng);
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


                            $(document).ready(function () {
                                setTimeout(function () {
                                    getJobs();
                                }, 100);

                            });
                            jQuery('.mobile-filter').click(function () {
                                jQuery('html').toggleClass('openfilter');
                                jQuery('.search_menu_overlay').show();
                            });
                            jQuery('.search_menu_overlay').click(function () {
                                jQuery('html').toggleClass('openfilter');
                                jQuery(this).hide();
                            });
                            jQuery('.mobile-close-icon .close-modal').click(function () {
                                jQuery('html').toggleClass('openfilter');
                                jQuery('.search_menu_overlay').hide();
                            });
                            $(function () {
                                var minPriceInRupees = 0;
                                var maxPriceInRupees = 500;
                                var currentMinValue = 0;
                                var currentMaxValue = 500;

                                $("#slider-range").slider({
                                    range: true,
                                    min: minPriceInRupees,
                                    max: maxPriceInRupees,
                                    values: [currentMinValue, currentMaxValue],
                                    slide: function (event, ui) {
                                        $("#amount").val("$" + ui.values[ 0 ]);
                                        $("#amount1").val("$" + ui.values[ 1 ]);
                                        currentMinValue = ui.values[ 0 ];
                                        currentMaxValue = ui.values[ 1 ];
                                    },
                                    stop: function (event, ui) {
                                        currentMinValue = ui.values[ 0 ];
                                        currentMaxValue = ui.values[ 1 ];
                                    }
                                });
                                $("#amount").val("$" + $("#slider-range").slider("values", 0));
                                $("#amount1").val("$" + $("#slider-range").slider("values", 1));
                            });
   function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 46 || charCode > 57))
        return false;
    return true;
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script> 
