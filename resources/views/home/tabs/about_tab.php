        <div id="about" class="container tab-pane">
                        <div class="about_tabs">
                            <?php if (isset($company->getCompanyDetail->bio)) { ?>
                                <div class="general_contractor_heading">
                                    <h4>Bio</h4>
                                </div>  
                                <?php } ?>
                                <div class="head_text">
                                    <p><?= isset($company->getCompanyDetail) ? $company->getCompanyDetail->bio : '' ?> </p>
                                </div>
                              <?php if (isset($company->getCompanyDetail->service_provided)) { ?>
                                <div class="general_contractor_heading">
                                    <h4>Services Provided</h4>
                                </div>  
                               <?php } ?>
                                <div class="head_text">
                                    <p><?= isset($company->getCompanyDetail) ? $company->getCompanyDetail->service_provided : '' ?> </p>
                                </div>
                              <?php if (isset($company->getCompanyDetail->area_served)) { ?>
                                <div class="general_contractor_heading">
                                    <h4>Areas Served</h4>
                                </div>  
                               <?php } ?>
                                <div class="head_text">
                                    <p><?= isset($company->getCompanyDetail) ? $company->getCompanyDetail->area_served : '' ?></p>
                                </div>


                                <!--                        <div class="map">
                                                                   <input type="hidden"  lat='<?php //$company->latitude_two        ?>' value='<?php //$company->latitude_two        ?>'>
                                                                <input type="hidden" lng='<?php //$company->longitude_two        ?>' value='<?php //$company->longitude_two        ?>'>
                                                                <input type="hidden" >
                                                             </div>-->
                                <div class="contruct_location">
                                    <!--<div class="location-column">-->
                                    <div class="location-column"  >
                                        <div class="embedmap" lat='<?= $company->latitude ?>' lng='<?= $company->longitude ?>' id='<?= 1 ?>' ></div>
                                        <div class="location-address">
                                            <h6><img src="<?= asset('userassets/images/location.png'); ?>"/>Location 1</h6>
                                            <p>
                                                <?= $company->home_address ?>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="location-column" >
                                        <div class="embedmap" lat='<?= $company->latitude_two ?>' lng='<?= $company->longitude_two ?>' id='<?= 2 ?>' ></div>

                                        <div class="location-address">
                                            <h6><img src="<?= asset('userassets/images/location.png'); ?>"/>Location 1</h6>
                                            <p>
                                                <?= $company->address_2 ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>