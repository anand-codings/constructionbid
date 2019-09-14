<div class="tab-pane <?= ($tab_id == 'review') ? 'active' : '' ?>" id="reviews" role="tabpanel">
                        <div class='condructor-tabs'>
                            <div class='condructor-tabs-header'>
                                <div class='tabs-header'>
                                    <h3>
                                        <?= (isset($reviews_count) && ($reviews_count->get_ratings_count != Null)) ? $reviews_count->get_ratings_count : '' ?> Reviews - <?= (isset($reviews_count) && ($reviews_count->ratingAvg->total != Null)) ? $reviews_count->ratingAvg->total : '' ?> Rating
                                    </h3>
                                    <div class="view-review">
<!--                                        <select>
                                            <option>
                                                Sort reviews by most recent 
                                            </option>
                                            <option>
                                                <a href="<?= asset('/company-dashboard');?>"> Sort reviews by oldd </a> 
                                            </option>
                                        </select>-->
                                        <ul><li><a href="<?= asset('view_contractor').'/'.'review';?>"> Sort reviews by most recent</a> </li>
                                            <li><a href="<?= asset('view_contractor').'/'.'old';?>"> Sort reviews by old </a> </li></ul>
                                    </div>` 
                                </div> 
                            </div>
                            <div class="condructor-tabs-body">
                                <?php if(isset($reviews)) {
                                    foreach($reviews as $reviews_detail) {
                                        ?>
                                <div class="total-reviews">
                                    <div class="rewiew-image">
                                        <div class="rewiew-image-link" style="background-image: url('<?= asset(getUserImage($reviews_detail->getHomeowner['profile_image'])); ?>')"></div> 
                                    </div>
                                    <div class="review-content">
                                        <div class="review-title-row">
                                            <div class="review-title">
                                                <h6>
                                                    <?= $reviews_detail->getHomeowner['first_name'];?>
                                                </h6>
                                                <div class="star-ratings-sprite-gray">
                                              
                                                    <span style="width: <?=isset($reviews_detail->rating)? $reviews_detail->rating*20:''?>%;" class="star-ratings-sprite-rating"></span>
                                                </div><?= $reviews_detail->rating;?>
                                            </div>
                                            <div class="review-date">
                                                <p>
                                                    <?php $date = strtotime($reviews_detail->created_at);
                                                     echo date('F d,m',$date); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="review-body">
                                            <p>
                                               <?= $reviews_detail->feedback;?> 
                                            </p>
                                             
                                            <ul>
                                                <?php 
//                                             if($reviews_detail->getfile->path ) {  print_r($reviews_detail->getfile)
                                                foreach($reviews_detail->getfile as $file){
                                                    if($file) { 
                                             ;?> 
                                                <li style="background-image: url('<?= asset($file->path); ?>')"></li>
                                                 <?php }  } ?>
                                            </ul>
                                               
                                        </div>
                                    </div>
                                </div>
                            
                                        <?php  } } ?>
                                <?php if($reviews->isEmpty()){
                                    ?>
                                
                                <div class="projects_navs_load">
                                    <button class="btn btn_sm_load"><i class="" aria-hidden="true"></i>No reviews added yet</button>
                                </div>
                                <?php  } else { ?>
                               <div class="projects_navs_load">
                                    <button class="btn btn_sm_load"><i class="fa fa-refresh" aria-hidden="true"></i>Load more</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


