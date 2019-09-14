<div id="supplier" class="container tab-pane fade">
                        <div class="general_contractor_tabs">
                            <?php if (isset($company->getSupplier)) {
                                ?>
                                <div class="head_text">
                                    <p><?= $company->getSupplier->description ?>.</p>


                                </div>
                                <div class="general_contractor_heading">
                                    <h4>Specialities:</h4>
                                </div>
                                <div class="general_contractor_tags">
                                    <?php
                                    if (isset($company->getSupplier->getSpecialities)) {
                                        foreach ($company->getSupplier->getSpecialities as $special) {
                                            ?>
                                            <span><a href="<?= asset('company_search'); ?>"><?= $special->name ?></a></span>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h6>No Speciality</h6>
                                    <?php } ?>
                                </div>
                                <div class="general_contractor_bar">
                                    <h2>Services in General Contractor <span>(<?= $company->getSupplier->get_services_count ?>)</span></h2>
                                </div>
                                <div class="contracts_sec">
                                    <?php
                                    if (isset($company->getSupplier->getServices)) {
                                        foreach ($company->getSupplier->getServices as $service) {
                                            ?>
                                            <input type="hidden" id="supplier_service_quote_title<?= $service->id ?>" value="<?= $service->title ?>" >
                                            <input type="hidden" id="supplier_service_quote_id<?= $service->id ?>" value="<?= $service->id ?>" >
                                            <input type="hidden" id="supplier_service_quote_cost_start<?= $service->id ?>" value="<?= $service->cost_start ?>" >
                                            <input type="hidden" id="supplier_service_quote_cost_end<?= $service->id ?>" value="<?= $service->cost_end ?>" >
                                            <input type="hidden" id="supplier_service_quote_location<?= $service->id ?>" value="<?= $service->location ?>" >
                                            <input type="hidden" id="supplier_service_quote_image<?= $service->id ?>" value="<?= isset($service->getFile) ? $service->getFile->path : '' ?>" >
                                            <a href="#">
                                                <div class="row">
                                                    <div class="col-xl-3 col-lg-3">
                                                        <div class="contracts_sec_img">
                                                            <figure style="background-image:url('<?= isset($service->getFile) ? asset($service->getFile->path) : asset('public/images/images.png'); ?>"></figure>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="contracts_sec_content">
                                                            <h3><?= $service->title ?></h3>
                                                            <h4>Description</h4>
                                                            <p><?= $service->description; ?></p>

                                                            <div class="contracts_sec_bottom">
                                                                <div class="contracts_cus_row">
                                                                    <div class="contracts_cus_col1">
                                                                        <div class="contracts_sec_bottom">
                                                                            <h4>Typical Job Costs:</h4>
                                                                            <p>$<?= $service->cost_start ?> - $<?= $service->cost_end ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="contracts_cus_col2">
                                                                        <div class="contracts_sec_bottom location_sec">
                                                                            <h4>Location:</h4>
                                                                            <p><img src="<?= asset('userassets/images/usa.svg'); ?>" alt="usa"><?= $service->location ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="contracts_cus_col3">
                                                                        <div class="contracts_cus_btn">
                                                                            <button class="btn btn_lg_blue supplier_service_quote" data-toggle="modal" data-target="#get-quote" data-id="<?= $service->id ?>"  >Get Quote</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h6>No Supplier</h6>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <h6>No Supplier</h6>
                            <?php } ?>
                        </div>
                    </div>