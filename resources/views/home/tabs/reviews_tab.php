<div id="reviews" class="container tab-pane <?= ($tab == 'sort') ? 'active' : ''; ?>">
    <div class="review_tabs">
        <div class="review_tabs_row">
            <div class="review_tabs_col">
                <div class="review_tabs_head">
                    <h3><?= ($company->get_ratings_count !== 0) ? round(($company->starrating_count / $company->get_ratings_count) * 100, 2) : '0' ?>%</h3>
                </div>
                <div class="head_text">
                    <p>of customers recommend this company/professional</p>
                </div>
            </div>
            <?php if (Auth::user()) {
          
                if(!empty($job->getJobs[0])){?>
                <div class="review_tabs_col">

                    <a href="<?= asset('write_review/' . $company->id); ?>" class="btn btn_md_blue">Write a review</a>
                </div>
                <?php }
                
                } ?>
        </div>
    </div>
    <div class="review_tabs_rows">
        <div class="review_tabs_row">
            <div class="review_tabs_col">
                <div class="general_contractor_heading">
                    <h4><?= ($company->get_ratings_count !== 0) ? $company->get_ratings_count : 'No' ?> reviews • <?= isset($company->ratingAvg->total) ? $company->ratingAvg->total : '' ?></h4>
                </div>
            </div>
            <?php if ($review->isNotEmpty()) {  ?>
                <div class="review_tabs_col">
                    <form  action="<?= asset('sort_reviews') ?>" method="POST" id="reviewform">
                        <input type='hidden' name='company_id' value='<?= $company->id ?>'>
                        <?php echo csrf_field(); ?>
                        <!--<input type="hidden" name="_token" value="<?php //csrf_token()      ?>">-->
                        <div class="dropdown cus_dropdown">
                            <select name="sort" class="reviews">
                                <option value="recent">
                                    Sort reviews by most recent 
                                </option>
                                <option value="old">
                                    Sort reviews by old
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </div>
            <div class="review_sec">
                <?php
                if (isset($review)) {
                    foreach ($review as $reviews) {
                        ?>
                        <div class="review_cus_row">
                            <div class="review_cus_col1">
                                <div class="review_left_img">
                                    <img src="<?= getUserImage($reviews->getHomeowner->profile_image); ?>">
                                </div>
                            </div>
                            <div class="review_cus_col2">
                                <div class="review_head_row">
                                    <div class="review_sec_head">
                                        <h3><?= $reviews->getHomeowner->first_name; ?>  <?= $reviews->getHomeowner->last_name; ?></h3>
                                        <div class="star-ratings-sprite-gray">
                                            <span style="width: <?= $reviews->rating * 20 ?>%;" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                    <div class="review_date">
                                        <h4><?= isset($reviews->created_at) ? date('d F, Y', strtotime($reviews->created_at)) : ''; ?></h4>
                                    </div>
                                </div>
                                <div class="head_text">
                                    <p><?= $reviews->feedback ?></p>
                                </div>
                                <div class="review_sec_imgs">
                                    <?php
                                    if (isset($reviews->getfile)) {
                                        foreach ($reviews->getfile as $file) {
                                            ?>
                                            <figure style="background-image:url(<?= asset($file->path); ?>)"></figure>
                                                <?php
                                            }
                                        }
                                        ?> 

                                </div>
                            </div>

                        </div>


                        <hr>
                        <?php
                    }
                }
                ?>



        </div>
    </div>
</div>