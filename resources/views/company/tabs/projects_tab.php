<div class="tab-pane <?= (isset($tab_id) && $tab_id == 'project') ? 'active' : ''; ?>" id="projects" role="tabpanel">
    <div class='condructor-tabs'>
        <div class='condructor-tabs-header'>
            <div class='tabs-header'>
                <h3>
                    <?= count($projects->getProjects) ?> Projects
                </h3>
                <button data-toggle="modal" data-target="#addproject" class="btn btn_sm_white"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Project</button>
            </div> 
        </div>
        <div class="condructor-tabs-body">
            <div class="contractor-projects">
                <?php
                if (count($projects->getProjects) > 0) {
//                                        foreach ($projects as $project) {
                    $j = 0;
                    foreach ($projects->getProjects as $project_detail) {
                        $i = 0;
                        $j++;
//                                               foreach ($project_detail->getFile as $file) {
//                                                    
                        ?>
                                            <!--<input type="hidden"  class="image_id//<?= $project_detail->id ?><?php // $i;  ?>" value="<?php // $file->id  ?>">-->
                                            <!--<input type="hidden"  class="image//<?= $project_detail->id ?><?php // $i; ?>" value="<?php // asset($file->path); ?>">-->

                        <?php
//                                                              ++$i;
//                                                    }
//                                                     
                        ?>
                        <div class='project-column projects-row' <?php if ($j > 10) { ?> style="display: none" <?php } ?>>

                            <div class='project-padding'>
                                <?php
                                $image = asset('public/images/images.png');
                                if (count($project_detail->getFile) > 0) {
                                    $image = asset($project_detail->getFile[0]->path);
                                }
                                ?>
                                <a href="<?= asset('project_detail') . '/' . $project_detail->id; ?>">
                                    <div class='project-image' style="background-image: url('<?= $image ?>')"></div>
                                </a>
                                <div class="edit_ser_btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>

                                </div>
                                <div class="service-dropdown" >
                                    <ul>
                                        <li>
                                            <a href="" data-toggle="modal" id="updateproject" data-id='<?= $project_detail->id; ?>' data-image='<?= $i ?>' class='edit_project' data-target="#updateproject<?= $project_detail->id; ?>"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Project</a>
                                        </li>
                                        <li>
                                            <a href="<?= asset('delete_project') . '/' . $project_detail->id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="projects_content">
                                    <a href="<?= asset('project_detail') . '/' . $project_detail->id; ?>">
                                        <h6><?= $project_detail->title ?></h6>
                                        <span><img src="<?= asset('userassets/images/group-photo.png'); ?>"><?= $project_detail->getFile->count(); ?> Photos</span>
                                    </a>
                                </div>
                            </div>
                            <!--</a>-->


                        </div>

                        <div class="modal  fade" id="updateproject<?= $project_detail->id; ?>">
                            <div class="modal-dialog modal-large  modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <div class="modal-title border-bottom">
                                            <h6>Update Project</h6>
                                        </div>
                                        <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form id="update_project" action="<?= asset('update_project'); ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
                                            <div class='row'>
                                                <div class="col-md-5 add-project-rows">
                                                    <div class='add-project-column'>
                                                        <div class="form-group">
                                                            <label>Project Title</label>
                                                            <input type="hidden" name="id" value="<?= $project_detail->id; ?>"> 
                                                            <input type="text" class="form-control general-field" name="title" id="title" value="<?= $project_detail->title; ?>"placeholder="Enter a title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <input type="text" class="form-control general-field" name="location" value="<?= $project_detail->location; ?>"id="update_project_location" placeholder="Enter a location" autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea placeholder="Add description about your service" name="description" id="project_description" class="description"><?= $project_detail->description; ?></textarea>
                                                        </div>
                                                        <div class='form-group swith-toggle'>
                                                            <label>Want to hide this project?</label>
                                                            <label class="switch">
                                                                <!--value=""-->
                                                                <input type="checkbox" name="is_hide" id="is_hide" <?= ($project_detail->is_hide == '1') ? 'checked' : ''; ?>>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                        <div class="project-btns">
                                                            <a class="btn btn_sm_red" href="<?= asset('delete_project') . '/' . $project_detail->id; ?>">Delete Project</a>
                                                            <button  class="btn btn_md_green update_project ">Save Project</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class='project-images'>
                                                        <li>
                                                            <div class="profile-logo">
                                                                <label >
                                                                    <i class="fa fa-camera" aria-hidden="true"><input type="file" style="display: none" name="photoooo" accept=".png, .jpg, .jpeg, .gif" data-id="<?= $project_detail->id; ?>" class="update-upload-img" id="update_projcet_images<?= $project_detail->id; ?>">
                                                                        <input type="hidden" name="path[]"  class="path_update_projectt project_files_<?= $project_detail->id ?>"  /></i>
                                                                    <h6>
                                                                        Upload Logo
                                                                    </h6>
                                                                </label>

        <!--<input type="file" style="display: none" name="photoooo" accept=".png, .jpg, .jpeg, .gif" class="update-upload-img" >-->
        <!--<input name="upload" type="file">--> 

                                                            </div>

                                                        </li>
        <?php foreach ($project_detail->getFile as $file) {
            ?>
                                                            <li class="add-project-image update_project_li<?= $file->id; ?>" style="background-image:url(<?= asset($file->path); ?>)"><a href="javascript:void(0)" data-id="<?= $file->id; ?>" class="del_img  delete-profile"> <img src="<?= asset('userassets/images/close.png') ?>"/> </a></li>
        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php
                }
            }
            ?>

            </div>
            <?php if ($projects->getProjects->isEmpty()) {
                ?>
                <div class="projects_navs_load">
                    <button class="btn btn_sm_load"><i class="" aria-hidden="true"></i>No Projects added yet</button>

                </div>
<?php } if (count($projects->getProjects) > 10) { ?>
                <div class="projects_navs_load">
                    <button id="loadMore" class="btn btn_sm_load"><i class="fa fa-refresh" aria-hidden="true"></i>Load more</button>
                </div>
<?php } ?>
        </div>

    </div>
</div>


<script>
//        $('#update_project').validate();
 
      
</script>