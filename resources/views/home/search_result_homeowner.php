<?php
$result_count = 0;

if (isset($comapanies)) {
    foreach ($comapanies as $comapany) {
//                                echo   ++$result_count;  ;
        ?> 


        <div class="company-search-row">
            <div class="company-search-column" style="background-image: url('<?= ($comapany->cover_image) ? asset($comapany->cover_image) : asset('public/images/images.png'); ?>')">
            </div>
            <div class="company-search-column1">
                <div class='result-row'>
                    <div class="result-head">
                        <div class='result-profile' style='background-image: url("<?= getUserImage($comapany->profile_image);?>")'></div>
                        <div class="home_left_head">

                            <h2><a href="<?= asset('company_profile_home/' . $comapany->id); ?>"><?= $comapany->first_name; ?></a>

                                <?php if ($comapany->is_verified == '1') { ?>
                                    <a href="javascript:void(0)">
                                        <img src="<?= asset('userassets/images/verified.svg') ?>" alt="verified">
                                    </a>
                                <?php } ?>
                            </h2>
                            <div class="middle"style="">
                                <div class="star-ratings-sprite-gray">
                                    <span style="width: <?= isset($comapany->ratingAvg->total) ? $comapany->ratingAvg->total * 20 : 0 ?>%;"  class="star-ratings-sprite-rating"></span>
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
                            <?php }
                        }
                        ?>
                    </div>                                              <div class="typical-job">
                        <div class="home_left_btns">
                            <?php if ($comapany->getSaves->isEmpty()) { ?>  
                                        <!--<a href="<?php //asset('unsave_company').'/'.$comapany->id.'/'.'company';?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>-->

    <?php } else { ?>
                                <button class="btn btn_sm_grey save_company<?= $comapany->id ?>" data-id="<?= $comapany->id ?>"><img src="<?= asset('userassets/images/favorites.svg') ?>" alt="favorites">Saved</button>

                     <!--<button class="btn btn_sm_grey save_company<?php //$comapany->id  ?>" data-id="<?php //$comapany->id  ?>"><img src="<?php // asset('userassets/images/favorites.svg')  ?>" alt="favorites">Save</button>-->
                            <?php } if ($comapany->getCompanyConatcted->isEmpty()) { ?>
                                <button data-toggle="modal" data-target="#contact-person<?= $comapany->id ?>" class="btn btn_sm_green">Contact</button>
                            <?php } else { ?> 
                                <button  class="btn btn_sm_green">Contacted</button>

    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="contact-person<?= $comapany->id; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-title border-bottom">
                        <h6>Contact <?= $comapany->first_name; ?></h6>
                    </div>
                    <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>


                <!-- Modal body -->
                <div class="modal-body">

                    <form class="quote-form" action="<?= asset('post_contact_company'); ?>" id="contact_company" method="POST" >
    <?= csrf_field(); ?>
                        <h6>Your Contact Info</h6>
                        <div class="form-group">
                            <input type="hidden" name = "company_id" value="<?= $comapany->id ?>">
                            <input type="email" class="form-control general-field" value="<?= isset(Auth::user()->email) ? Auth::user()->email : '' ?>" name="email" placeholder="Email" disabled/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="<?= isset(Auth::user()->first_name) ? Auth::user()->first_name : '' ?>" class="form-control general-field" name="first_name" placeholder="First Name" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="<?= isset(Auth::user()->last_name) ? Auth::user()->last_name : '' ?>" class="form-control general-field" name="last_name" placeholder="Last Name" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?= isset(Auth::user()->phone) ? Auth::user()->phone : '' ?>"class="form-control general-field" name="phone" placeholder="Phone"  />
                        </div>
                        <div class="form-group">
                            <textarea rows="4" class="form-control general-field" name="details" placeholder="Write here..."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn_sm_green contact_form" data-id="<?= $comapany->id ?>">Get Started</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?> 
<input type="hidden" class="count_res" value="<?= $result_count; ?>" >

<?php
} else if ($comapanies->isEmpty()) {
    echo 'No company added yet';
}
?>


<!--<div class="company-search-row">
                                        <div class="company-search-column" style="background-image: url('<?php echo asset('userassets/images/project2.png') ?>')">
                                        </div>
                                        <div class="company-search-column1">
                                             <div class='result-row'>
                                                  <div class="result-head">
                                                       <div class='result-profile' style='background-image: url("<?php echo asset('userassets/images/left_img1.png') ?>")'></div>
                                                       <div class="home_left_head">
                                                            <h2>ANDINA Renovationsssssssssss
                                                                 <a href="#">
                                                                      <img src="http://localhost/construction-webapp/userassets/images/verified.svg" alt="verified">
                                                                 </a>
                                                            </h2>
                                                            <div class="middle"style="">
                                                                 <div class="star-ratings-sprite-gray">
                                                                      <span style="width: 50%;" class="star-ratings-sprite-rating"></span>
                                                                 </div>
                                                                 <span class="total-give-review">(23 Reviews)</span>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <p>
                                                       The additions we designed are Greek revival, which is a vernacular style of the region and was consistent with the age of the original home.
                                                  </p>
                                                  <div class='result-profile-footer'>
                                                       <div class="typical-job">
                                                            <h6>Typical Job</h6>
                                                            <p>$1,000 - $10,000</p>
                                                       </div>
                                                       <div class="typical-job">
                                                            <div class="home_left_btns">
                                                                 <button class="btn btn_sm_grey"><img src="http://localhost/construction-webapp/userassets/images/favorites.svg" alt="favorites">Save</button>
                                                                 <button data-toggle="modal" data-target="#contact-person" class="btn btn_sm_green">Contact</button>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>-->
<!--</div>-->