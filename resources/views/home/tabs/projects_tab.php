<div id="projects" class="container tab-pane fade">
                        <div class="projects_navs">
                            <div class="general_contractor_heading">
                                <h4><?= $company->get_projects_count ?> Projects for <?= $company->first_name ?></h4>
                            </div>
                            <div class="projects_boxes_sec">
                                <?php
                                if (isset($company->getProjects)) {
                                    foreach ($company->getProjects as $projects) {
                                        ?>
                                        <div class="project-column">
                                            <a href="<?= asset('project_detail_home') . '/' . $projects->id . '/' . $company->id; ?>">
                                                <div class="project-padding">
                                                    <div class="project-image" style="background-image:url('<?= isset($projects->getFile[0]) ? asset($projects->getFile[0]->path) : asset('public/images/images.png') ?>"></div>
                                                    <div class="service-dropdown" style="display: none;">
                                                    </div>
                                                    <div class="projects_content">
                                                        <h6><?= $projects->title ?></h6>
                                                        <span><img src="<?= asset('userassets/images/group-photo.png'); ?>"><?= $projects->get_file_count ?> Photos</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>

                            <!--                            <div class="projects_navs_load">
                                                            <button class="btn btn_sm_load"><i class="fa fa-refresh"
                                                                                               aria-hidden="true"></i>Load more</button>
                                                        </div>-->
                        </div>
                    </div>