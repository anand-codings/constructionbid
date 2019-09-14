<?php
                                if (isset($products) ) {
                                    if($products->isEmpty()){
                                ?><h6>No products</h6> <?php
                                
                            } else {
                               
foreach ($products as $product) {
                                    ?>
                                    <div class="store-column">
                                        <div class="store-wrapper">
                                            <div class="store-image">
                                                <img src="<?php echo isset($product->getFile) ? asset($product->getFile->path) : asset('public/images/images.png'); ?>"/>
                                            </div>
                                            <div class="store-content">
                                                <h6>
                                                    <?= $product->location ?>
                                                </h6>
                                                <label>
                                                    Stock: <span><?= $product->type ?></span>
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
                                
                                 } } else { ?>
                                <h6>No products</h6>
                                <?php } ?>
