<div id="store" class="container tab-pane fade">
                        <div class="general_contractor_heading contractor_heading">
                            <h4> Store</h4>
                            <div class="store-location">
                                <span>Store by Location</span>
                                <input type="text" id="store_location" class="form-control store_location" placeholder="Search by location" >
                                <input type="hidden" id="lngg" class="form-control"  >
                                <input type="hidden" id="latt" class="form-control" placeholder="Search by location" >
                            </div>
                        </div>
                       

                            <div id="search" class="main-store">
                                <?php
                                if ($company->getProducts->isNotEmpty()) {
                                    foreach ($company->getProducts as $product) {
                                        ?>
                                        <div class="store-column">
                                            <div class="store-wrapper" >
                                                <!--<div class="store-image"  style="background-image:url('<?=isset($product->getFile) ? asset($product->getFile->path) : asset('public/images/images.png'); ?>')">-->
                                                <div class="store-image"  >
                                                    <img src="<?php echo isset($product->getFile) ? asset($product->getFile->path) : asset('public/images/images.png'); ?>"/>
                                                </div>
                                                <div class="store-content">
                                                    <h6>
                                                        <?= $product->location ?>
                                                        <!--0000<input type="hidden" class="company_id" value="<?php // $company->id;     ?>">-->
                                                    </h6>
                                                    <label>
                                                        Stock: <span><?= str_replace('_', ' ', $product->type) ?></span>
                                                    </label>
                                                    <div class="store-price">
                                                        <label>
                                                            Price: <span>$<?= $product->price ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h6>No products</h6>
    <?php } ?>
                                    <!--default-search-->
                                </div>
                                <div id="result" class="main-store">

                                </div>

                            </div>