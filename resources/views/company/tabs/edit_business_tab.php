 <div class="tab-pane <?= (isset($tab_id) && $tab_id == 'edit_business') ? 'active' : ''; ?>"" id="edit_business" role="tabpanel">
                        <div class='condructor-tabs'>
                            <div class='condructor-tabs-header'>
                                <div class='tabs-header'>
                                    <h3>
                                        Edit Business
                                    </h3>
                                </div> 
                            </div>
                            <form id="edit_businees" action="<?= asset('update_edit_businees')?>" method="Post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="condructor-tabs-body">
                                    <div class="user-profile-row">
                                        <div class='profile-parent'>
                                            <div class="user-profile-img" style="background-image: url('<?= asset($business->profile_image)?>')"></div>
                                            <div class='upload-logo'>
                                                <input type="file" name="photo" style="display: none;" id="upload-logo">
                                                <label for="upload-logo" class="btn btn_upload"> Upload Logo</label>
                                            </div>
                                        </div>
                                        <div class="user-profile-column">
                                            <div class="form-group">
                                                <label>
                                                    Business Name
                                                </label>
                                                <input type="hidden" name="comopany_id" value="<?= $business->id; ?>">
                                                <input type="hidden" name="comopany_detail_id" value="<?= isset($business->getCompanyDetail)? $business->getCompanyDetail->id:''; ?>">
                                                <input type="text" class="form-control background-field" name='first_name' value="<?= isset($business) ? $business->first_name : '' ?>" placeholder="Enter name" />
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Location
                                                </label>
                                                <input type="text" class="form-control background-field" name='home_address' id="update_edit_business" value='<?= isset($business) ? $business->home_address : '' ?>' placeholder="Gig Harbor, Washington, US" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="business-details">
                                        <div class='green-title'>
                                            <h5>Social Links</h5>
                                        </div>
                                        <div class='form-group'>
                                            <label>Bio</label>
                                            <textarea  placeholder="Enter Detail" name="bio"class='text-msgs'><?= isset($business->getCompanyDetail->bio) ? $business->getCompanyDetail->bio : ''; ?></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <label>Services Provided</label>
                                            <textarea  placeholder="Enter Detail" name="service_provided" class='text-msgs'><?= isset($business->getCompanyDetail->service_provided) ? $business->getCompanyDetail->service_provided : ''; ?></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <label>Areas Served</label>
                                            <textarea  placeholder="Enter Detail" name="area_served" class='text-msgs'><?= isset($business->getCompanyDetail->area_served) ? $business->getCompanyDetail->area_served : ''; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Email
                                            </label>
                                            <input type="text" class="form-control background-field" name="email" value="<?= isset($business) ? $business->email : '' ?>" placeholder="company@email.com" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Website
                                            </label>
                                            <input type="text" class="form-control background-field" name="website" value="<?= isset($business->getCompanyDetail) ? $business->getCompanyDetail->website : '' ?>" placeholder="http://" />
                                        </div>
                                        <div class='green-title'>
                                            <h5>Social Links</h5>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Facebook
                                            </label>
                                            <input type="text" class="form-control background-field facebook" name="fb_link" value ="<?= isset($business->getCompanyDetail) ? $business->getCompanyDetail->fb_link : '' ?>" placeholder="http://www.facebook.com/Company" />
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Instagram
                                            </label>
                                            <input type="text" class="instagram form-control background-field" name="insta_link" value ="<?= isset($business->getCompanyDetail) ? $business->getCompanyDetail->insta_link : '' ?>"  instagrm placeholder="http://www.instagram.com/Company" />
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Linkedin
                                            </label>
                                            <input type="text" class="form-control background-field linkedin" name="linkedin_link" value ="<?= isset($business->getCompanyDetail) ? $business->getCompanyDetail->linkedin_link : '' ?>"  placeholder="http://www.linkedin.com/Company" />
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Twitter
                                            </label>
                                            <input type="text" class="form-control background-field twitter" name="twitter_link" value ="<?= isset($business->getCompanyDetail) ? $business->getCompanyDetail->twitter_link : '' ?>"  placeholder="http://www.twitter.com/Company" />
                                        </div>
                                        <div class='form-group'>
                                            <button class="btn btn_md_green">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>     
                    </div>