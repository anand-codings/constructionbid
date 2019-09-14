<div class="tab-pane <?= (isset($tab_id) && $tab_id == 'owner') ? 'active' : ''; ?>" id="owner" role="tabpanel">
    <div class='condructor-tabs'>
        <div class='condructor-tabs-header'>
            <div class='tabs-header'>
                <h3>
                    Owner
                </h3>
                <?php if ($result->getOwner) { ?>
                    <button class="btn btn_sm_white owner" data-toggle="modal" data-target="#adddescription"> <i class="fa fa-plus" aria-hidden="true"></i> Edit Description</button>
                    <input type="hidden"  id="owner_id" value="<?= $result->getOwner->id ?>">
                    <input type="hidden"  id="owner_description" value="<?= $result->getOwner->description ?>">
                    <input type="hidden" id="owner_type" value="owner">
                <?php } ?>
            </div> 

        </div>
        <div class="condructor-tabs-body">
            <div class="contractor-description mb-40">
                <label class="labels">Description</label>
                <?php if ($result->getOwner) { ?>
                    <p><?= $result->getOwner->description; ?></p>
                <?php } else { ?>
                    <div class='add-description'>
                        <button class="btn btn_lg_tranparent owner" data-toggle="modal" data-target="#adddescription">Add Description</button>
                        <input type="hidden" id="owner_type" value="owner">
                    </div>
                <?php } ?>
            </div>
            <?php if ($result->getOwner) { ?>
                <div class="specialitys">
                    <div class="condructor-tabs-header">
                        <div class="tabs-header">
                            <h3>
                                Speciality
                            </h3>
                            <?php if (isset($result->getOwner->getSpecialities)) { ?>
                                <button class="btn btn_sm_white owner_special"  data-target="#owner-specialities" data-toggle="modal"> <i class="fa fa-plus" aria-hidden="true"></i> Add/Edit Speciality</button>
                            <?php } ?>
                        </div> 
                    </div>

                    <!-- Services -->
                    <?php if (isset($result->getOwner->getSpecialities)) { ?>
                        <div class="general_contractor_tags_special owner_contractor_tags_special">
                            <?php foreach ($result->getOwner->getSpecialities as $special) { ?>
                                <span class='special_delete<?= $special->id ?>'><a href="<?= asset('company_search') ?>"><?= $special->name ?></a></span>
                            <?php } ?>
                        </div>
                    <?php } else { ?>

                        <div class="specility-service">
                            <div class="form-group">
                                <label><a href=" #" class="owner_special" data-target="#owner-specialities" data-toggle="modal">Add Speciality</a></label>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="condructor-tabs-header">
                <div class="tabs-header">
                    <h3>
                        Services in Owner
                    </h3>
                    <button class="btn btn_sm_white add_service_owner" data-toggle="modal" data-target="#addservices"> <i class="fa fa-plus" aria-hidden="true"></i> Create a Service</button>
                </div> 
            </div>
            <div class="contracts_sec">
                <?php foreach ($owner_services as $service) {
                    ?>
                    <?php if (isset($service->getServices)) {
                        ?>

                        <?php
                        foreach ($service->getServices as $data) {
                            $type = 'owner';
                            ?>
                            <div class="condructor_tabing">
                                <div class="row">
                                    <input type="hidden"  id="title<?= $data->id; ?>" value="<?= $data->title ?>">
                                    <input type="hidden"  id="cost_start<?= $data->id; ?>" value="<?= $data->cost_start ?>">
                                    <input type="hidden"  id="cost_end<?= $data->id; ?>" value="<?= $data->cost_end ?>">
                                    <input type="hidden"  id="location<?= $data->id; ?>" value="<?= $data->location ?>">
                                    <input type="hidden"  id="image<?= $data->id; ?>" value="<?= isset($data->getfile->path) ? $data->getfile->path : '' ?>">
                                    <input type="hidden"  id="image_id<?= $data->id; ?>" value="<?= isset($data->getfile->id) ? $data->getfile->id : '' ?>">
                                    <input type="hidden"  id="image_name<?= $data->id; ?>" value="<?= isset($data->getfile->original_name) ? $data->getfile->original_name : '' ?>">
                                    <input type="hidden"  id="description<?= $data->id; ?>" value="<?= $data->description ?>">
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="contracts_sec_img">
                                            <figure style="background-image:url('<?= isset($data->getfile->path) ? asset($data->getfile->path) : asset('public/images/images.png'); ?>"></figure>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9">
                                        <div class="contracts_sec_content">
                                            <h3><?= $data->title ?></h3>
                                            <h4>Description</h4>
                                            <p><?= $data->description ?>.</p>

                                            <div class="contracts_sec_bottom">
                                                <div class="contracts_cus_row">
                                                    <div class="contracts_cus_col1">
                                                        <div class="contracts_sec_bottom">
                                                            <h4>Typical Job Costs:</h4>
                                                            <p>$<?=
                                                                $data->cost_start;
                                                                echo ' -';
                                                                ?> $<?= $data->cost_end ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="contracts_cus_col2">
                                                        <div class="contracts_sec_bottom location_sec">
                                                            <h4>Location:</h4>
                                                            <p><img src="<?= asset('userassets/images/usa.svg'); ?>" alt="usa"><?= $data->location ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_ser_btn">
                                        <span></span>
                                        <span></span>
                                        <span></span>

                                    </div>
                                    <div class="service-dropdown">
                                        <ul>
                                            <li>
                                                <a href="javascript:void();" data-toggle="modal" class='edit_owner' value='<?= $data->id; ?>' data-id='<?= $data->id ?>' data-target="#editservices"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Service</a>
                                            </li>
                                            <li>
                                                <a href="<?= asset('/delete_service/' . $data->id . '/' . $type) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div> 
    </div>
</div>
<!-- Specialities Modal
--><div class="modal fade show" id="owner-specialities" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"><!--


            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Select Other</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">

                <form method='POST' action='<?= asset('/add_speciality_admin'); ?>' id='owner_formId' class="quote-form" enctype="multipart/form-data">

                    <h6><strong>What other deliverables do you need?</strong></h6>
<!--                    <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <span class="ajax-label-body"></span>
                    </div>-->
                    <div class="form-group">
                      
                        <input type="hidden" name='specialities[]' id='owner_specialities' placeholder="Enter value">
                        <input type="hidden" name='sp_id' id='owner_sp_id' placeholder="Enter value">
                        <input type="hidden" name='type'  value="owner">
                        <input type="hidden" name='_token' value='<?= csrf_token() ?>'>
                        <input type="hidden" name='specialities_id[]' id='owner_specialities_id' placeholder="Enter value">
                    </div>


            
                    <?php
                    if (isset($specialities)) {
                        $i = 0;
                        foreach ($specialities as $special) {
                            $count = 0;
                            if (isset($result->getOwner->getSpecialities) && $result->getOwner->getSpecialities->isNotEmpty() && isset($result->getOwner->getSpecialities)) {
                                foreach ($result->getOwner->getSpecialities as $company_special) {
                                    if ($company_special->speciality_id === $special->id) {
                                        ?>
                                        <div class="form-group">
                                            <input class="styled-checkbox add_owner_speciality" data-owner-special-id-admin='<?= $special->id ?>'  data-count='<?= $i ?>'  data-special-name="<?= $special->id ?>" id="owner_speciality<?= $company_special->id; ?>" data-id="<?= $company_special->id ?>" type="checkbox" value="<?= $company_special->id ?>" checked>
                                            <label for="owner_speciality<?= $company_special->id ?>"><?= $company_special->name ?></label>
                                  
                                            <input type="hidden"  data-count='<?= $i ?>' id="owner_speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                            <input type='hidden' id="owner_speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                    <!--                                            <input type="hidden" id="sepcial<?php //$company_special->id;     ?>" value="<?php //$special->id     ?>">
                                            <input type="hidden" id="sepcial_name<?php //$company_special->id;     ?>" value="<?php //$special->title     ?>">-->
                                            <input class="styled-checkbox" id="owner_speciality_name<?= $company_special->id ?>"  data-id="<?= $company_special->id ?>" type="checkbox" value="<?= $company_special->name ?>">

                                        </div>
                                        <?php
                                        $i++;
                                        $count++;
                                    }
                                }if ($count == 0) {
                                    ?>
                                    <div class="form-group">
                                        <input class="styled-checkbox add_owner_speciality_admin" data-count='<?= $i ?>' id="owner_speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                        <label for="owner_speciality<?= $special->id ?>"><?= $special->title ?></label>
                                        <input class="styled-checkbox" id="owner_speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                                    </div>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <div class="form-group">
                                    <input class="styled-checkbox add_owner_speciality_admin" data-count='<?= $i ?>' id="owner_speciality<?= $special->id ?>" data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->id ?>">
                                    <label for="owner_speciality<?= $special->id ?>"><?= $special->title ?></label>
                                    <input class="styled-checkbox" id="owner_speciality_name<?= $special->id ?>"  data-id="<?= $special->id ?>" type="checkbox" value="<?= $special->title ?>">

                                </div>
                                <?php
                                $i++;
                            }
                        }
                    } else {
                        ?>

                        <h6>No sepciality added by Admin</h6>
                    <?php }
                    ?>
    

                    <div class="form-group">
                        <input type="submit" class="btn btn_md_green px-4 add_owner_speciality_forn" value="Save">
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>