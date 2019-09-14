<?php if(isset($result)){
    foreach($result as $res){

?> 
<div class="dashboard-content">
                                            <div class="dashboard-profile align-items-start">
                                                <div class="dashboard-profile-img" style="background-image: url('<?php //echo asset($proposal->getUser->profile_image) ?>')"></div>
                                                <div class="dashboard-profile-content">
                                                    <h6><?php// $proposal->getUser->first_name ?></h6>
                                                    <div class="star-ratings-sprite-gray">
                                                        <span style="width: <?= $proposal->getUser->ratingAvg->total * 20 ?>%;" class="star-ratings-sprite-rating"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start mr-5">
                                                    <a href="#" class="btn btn_sm_green mr-2">Accept </a>
                                                    <a href="#" class="btn btn_sm_grey ">Reject </a>
                                                </div>
                                            </div>

                                            <div class="edit_ser_btn">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="service-dropdown" >
                                                <ul>
                                                    <li>
                                                        <a href="<?= asset('view_contractor_project'); ?>"> <i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Company Profile</a>
                                                    </li>
                                                    <li>

                                                    </li>
                                                </ul>
                                            </div>
                <!--                                            <span class="category-name proposal_cat mt-3 d-inline-block">Architects and Building Designers</span>-->
                                            <div class="d-flex file-download">
                                                <div class="dashboard-profile-content pt-3">
                                                    <h6>Subject: <?php //$proposal->subject ?></h6>
                                                    <p> <?php// $proposal->message ?></p>
                                                </div>
                                           
                                            </div>
                                            <div class="service-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href=""> <i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Company Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="fa fa-trash-o" aria-hidden="true"></i> Unsave</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
<?php } } ?>
