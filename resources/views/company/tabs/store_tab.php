      <div class="tab-pane <?= (isset($tab_id) && $tab_id == 'store') ? 'active' : ''; ?>" id="store" role="tabpanel">
                        <div class='condructor-tabs'>
                            <div class='condructor-tabs-header'>
                                <div class='tabs-header'>
                                    <h3>
                                        <?= count($products)?> Store <?= $tab_id; ?>
                                    </h3>
                                    <button class="btn btn_sm_white" data-toggle="modal" data-target="#addstore"  > <i class="fa fa-plus" aria-hidden="true" ></i> Add New Product</button>
                                </div> 
                            </div>
                            <div class="condructor-tabs-body">
                                <div class="contractor-projects store-section">
                                    <?php
                                    if (count($products) > 0) {
                                        $i=0;
                                        foreach ($products as $product_detail) {
$i++;
//                                                           echo '<pre>';
//                                                           print_r($product_detail->getFile->path);
                                                ?>
                                    <div class='project-column' <?php if($i > 10){ ?> style="display: none" <?php } ?>>
                                                    <div class='project-padding'>
                                                        <div class='project-image' style="background-image: url('<?= isset($product_detail->getFile->path) ? asset($product_detail->getFile->path) : ''; ?>"></div>
                                                        <div class="edit_ser_btn">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>


                                                        </div>
                                                        <div class="service-dropdown" style="display: none;">
                                                            <ul>
                                                                <li>
                                                                    <a href="" data-toggle="modal" data-target="#updatestore" data-id='<?= $product_detail->id; ?>' class='edit_store'> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Store</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?= asset('delete_product') . '/' . $product_detail->id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="projects_content">
                                                            <h6><?= $product_detail->title; ?></h6>
                                                            <div class='stock-title'>
                                                                <p><span>Stock : </span><?= ($product_detail->type == 'available') ? 'Available' : 'Not Available'; ?></p>
                                                                <p><span>Price : </span><?= '$' . $product_detail->price; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <input type='hidden' value='<?= $product_detail->id; ?>' class='product_id<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->title; ?>' class='title<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= isset($product_detail->getFile->path) ? $product_detail->getFile->path : '' ?>' class='photo<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= isset($product_detail->getFile->id) ? $product_detail->getFile->id : '' ?>' class='file_id<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= ($product_detail->type == 'available') ? 'Available' : 'Not Available'; ?>' class='type<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->price; ?>' class='price<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->location; ?>' class='location<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->lat; ?>' class='lat<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->lng; ?>' class='lng<?= $product_detail->id ?>'>
                                                <input type='hidden' value='<?= $product_detail->is_hide; ?>' class='is_hide<?= $product_detail->id ?>'>
                                                <?php
                                        }
                                    }
                                    ?> 

                                </div>
                                <?php  if(count($products) == 0){
                                    ?>
                                <div class="projects_navs_load">
                                    <button class="btn btn_sm_load"><i class="" aria-hidden="true"></i>No store added yet</button>
                                    
                                </div>
                                <?php  } if(count($products) > 10) { ?>
                                <div class="projects_navs_load">
                                    <button id="loadMore" class="btn btn_sm_load"><i class="fa fa-refresh" aria-hidden="true"></i>Load more</button>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>

<script>

</script>