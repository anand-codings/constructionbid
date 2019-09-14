

<!--Add Description-->
<div class="modal fade" id="adddescription">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Edit Description</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method='POST' action='<?= asset('add_description'); ?>' id="login-form" class="login-form">  
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id='desc_id'value="">
                    <input type="hidden" name="type" id='desc_type' value="">
                    <div class="form-group">
                        <textarea onkeyup="charcherCount(this, 500, 'count')" name='description' id='description' placeholder="Add description about your service" class='description' ></textarea>
                    </div>
                    <div class='save_btn'>
                        <button type='submit' class='btn btn_md_green decription' >
                            Save
                        </button>
                        <p class="count">0/500</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Edit Services-->
<div class="modal fade" id="editservices">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Edit Services</h6>
                </div>

                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <span class="ajax-label-body"></span>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method='POST' action='<?= asset('edit_service'); ?>' id='edit_service' class="login-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id='edit_service_id'value="">
                    <input type="hidden" name="type" id='edit_service_type' value="">
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Service Title</label>
                                <input name='title' id='edit_title' type="text" class="form-control general-field" placeholder="Enter a title"/>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label>Typical Job Costs</label>
                        </div>
                    </div>     
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <input type="number" id='edit_start_cost' name='cost_start' class="form-control general-field" placeholder="$"/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <input type="number" id='edit_end_cost' name='cost_end' class="form-control general-field" placeholder="$"/>
                            </div>
                        </div>
                          <span id ="job_title_span"  style="display:none; color:red">Invalid Price Range</span>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" id='edit_location' name='location' class="form-control general-field" placeholder="Gig Harbor, Washington, US" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name='description' id='edit_description' placeholder="Add description about your service" class='description'></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="attachment">
                                <label>Attachments</label>
                                <label class="attachment-link" for="edit-file-attach">
                                    <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                    <input type="file" name="file" style="display:none;" id="edit-file-attach" accept=".jpeg,.png"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class='images-lists'>

                            </ul>  
                        </div>
                    </div>
                    <div class='save_btn'>
                        <button type='submit' class='btn btn_md_green show_loader'>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add Services-->
<div class="modal fade" id="addservices">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Add Services</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">
                <form method='POST' action='<?= asset('add_service'); ?>' id='add_service' class="login-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id='service_id'value="">
                    <input type="hidden" name="type" id='service_type' value="">
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Service Title</label>
                                <input name='title' id='edit_title' type="text" class="form-control general-field" placeholder="Enter a title"/>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-6'>
                            <label>Typical Job Costs</label>
                        </div>
                    </div>     
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <input type="number" id='edit_start_cost_2' name='cost_start' class="form-control general-field" placeholder="$"/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <input type="number" id='edit_end_cost_2' name='cost_end' class="form-control general-field" placeholder="$"/>
                            </div>
                        </div>
                          <span id ="job_title_span_2"  style="display:none; color:red">Invalid Price Range</span>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" id='add_location' name='location' class="form-control general-field" placeholder="Gig Harbor, Washington, US"/>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name='description' id='edit_description' placeholder="Add description about your service" class='description'></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="attachment">
                                <label>Attachments</label>
                                <label class="attachment-link" for="file-attach">
                                    <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                    <input type="file" name="file" style="display:none;" id="file-attach" accept=".jpeg,.png"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class='images-lists'>

                            </ul>  
                        </div>
                    </div>
                    <div class='save_btn'>
                        <button type='submit' class='btn btn_md_green show_loader'>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add Project-->
<div class="modal  fade" id="addproject">
    <div class="modal-dialog modal-large  modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Add Project</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <!-- Modal body -->

            <div class="modal-body">
                <form id="add_projectt" action="<?= asset('add_project'); ?>" method="Post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class='row'>
                        <div class="col-md-5 add-project-rows">
                            <div class='add-project-column'>
                                <div class="form-group">
                                    <label>Project Title</label>
                                    <input required="" type="text" class="form-control general-field" name="title" placeholder="Enter a title">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input required="" type="text" class="form-control general-field" name="location" id="project_location" placeholder="Enter a location" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea required="" placeholder="Add description about your service" name="description" class="description"></textarea>
                                </div>
                                <div class='form-group swith-toggle'>
                                    <label>Want to hide this project?</label>
                                    <label class="switch">
                                        <input type="checkbox" name="is_hide" >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="project-btns">
                                    <!--<button class="btn btn_sm_red">Delete Project</button>-->
                                    <button class="btn btn_md_green show_loader">Save Project</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class='project-images'>
                                <li>
                                    <div class="profile-logo">
                                        <label for="upload-img">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                            <h6>
                                                Upload Logo
                                            </h6>
                                        </label>
                                        <input type="hidden" name="path[]" id="path_project"  />
                                        <input required="" type="file" style="display: none" name="photo" accept=".png, .jpg, .jpeg, .gif" id="upload-img" >
                                    </div>
                                </li>
                                <!--<li class="add-project-image" style="background-image:url('<?php // asset('userassets/images/project1.png')     ?>')"></li>-->
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!--Add Sotre-->
<div class="modal  fade" id="addstore">

    <div class="modal-dialog modal-medium  modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Add Product</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="add_product" action="<?= asset('add_product'); ?>" method="Post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class='row'>
                        <div class="col-md-12 ">
                            <div class='add-store-image'>
                                <label for="store-upload-img">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    <h6>
                                        Upload Photo
                                    </h6>
                                </label>

                                <input type="file" style="display: none" name="image" accept=".png, .jpg, .jpeg, .gif" id="store-upload-img">
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label>Product Title</label>
                                <input type="text" class="form-control general-field" name="title" placeholder="Enter a title">
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="text" class="form-control general-field" onkeypress="return isNumberKey(event)" name="price" placeholder="Enter a price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <select name="type">
                                    <option value="available">
                                        Available
                                    </option>
                                    <option value="not_available">
                                        Not Available
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Store Location</label>
                                <input type="text" class="form-control general-field" name="location" placeholder="Enter location" id="autocomplete" autocomplete="off">
                                <input type="hidden" name="lat" id="add_lat">
                                <input type="hidden" name="lng" id="add_lng">
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class='form-group swith-toggle'>
                                <label>Want to hide this Store?</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_hide">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="project-btns">

                                <button type="submit" class="btn btn_md_green show_loader">Save Product</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>

</div>
<div class="modal  fade" id="updatestore">
    <div class="modal-dialog modal-medium  modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title border-bottom">
                    <h6>Update Product</h6>
                </div>
                <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="update_product_form" action="<?= asset('update_product'); ?>" method="Post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class='row'>
                        <div class="col-md-12 ">
                            <div class='add-store-image'>
                                <label for="store-upload-img1">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    <h6>
                                        Upload Photo 
                                    </h6>
                                </label>
                              <!--<input type='file' name='photo' >-->
<!--                                          <input type="file" style="display: none" name="image" accept=".png, .jpg, .jpeg, .gif" >-->
                                <input type="file" style="display: none" name="image" id="store-upload-img1">
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label>Product Title</label>
                                <input type="text" class="form-control general-field" id="titlee" name="title" placeholder="Enter a title">
                                <input type='hidden' id='id' name='id'>
                                <input type='hidden' id='file_id' name='file_id'>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="text" class="form-control general-field" onkeypress="return isNumberKey(event)" id="price" name="price" placeholder="Enter a price">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Stock</label>
                                <select name="type" class="type">
                                    <option value="available">
                                        Available
                                    </option>
                                    <option value="not_available">
                                        Not Available
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Store Location</label>
                                <input type="text" class="form-control general-field" id="update_location" name="location" placeholder="Enter location"  autocomplete="off">
                                <input type="hidden" name="lat" id="update_lat">
                                <input type="hidden" name="lng" id="update_lng">
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class='form-group swith-toggle'>
                                <label>Want to hide this Store?</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_hide" class="is_hidee">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="project-btns">

                                <button type="submit" class="btn btn_md_green show_loader">Update Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<style>
    #add_projectt input.error , #update_product_form input.error  {
        border:solid 1px red !important;
    }
    #add_projectt textarea.error , #update_product_form textarea.error  {
        border:solid 1px red !important;
    }
    #add_projectt input.error , #update_product_form input.error  {
        /*width: auto;*/
        /*display: none !important;*/
        color:red;
        font-size: 16px;
        float:right;
    }
</style>
<script>
    $(document).ready(function () {
        $(".moreBox").slice(0, 3).show();
        if ($(".blogBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".projects-row").fadeIn('slow');
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });
    });
    $(document).ready(function () {
        $(".moreBox").slice(0, 3).show();
        if ($(".blogBox:hidden").length != 0) {
            $("#loadMore").show();
        }
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".project-column").fadeIn('slow');
            if ($(".moreBox:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
        });
    });
    $(document).ready(function () {
        $(".close-modal").click(function () {

            $(".images-lists").empty();
//                $(".general_contractor_tags").empty();

        });

        $('#update_product_form').validate({
            rules: {
                title: {
                    required: true,
                },

                image: {
                    required: true,

                },
                price: {
                    required: true,
                    number: true,

                },
                location: {
                    required: true,

                },

            }, submitHandler: function (form) {
                $('#preloader').show();
                form.submit();

            }


        });
        $('#add_projectt').validate({
            rules: {
                ignore: [],
                title: {
                    required: true,
                },
                image: {
                    required: true,

                },
                location: {
                    required: true,

                },
                description: {
                    required: true,

                },

            }, messages: {
                title: {
                    required: ""
                },
                image: {
                    required: ""
                },
                location: {
                    required: ""
                },
                description: {
                    required: ""
                }
            }, submitHandler: function (form) {
                $('#preloader').show();
                form.submit();

            }

        });


        $('body').on('click', '.update_project', function () {

            var form = $(this).parents('form');
         
            form.validate({
                rules: {
                    ignore: [],
                    title: {
                        required: true,
                    },
                    image: {
                        required: true,

                    },
                    location: {
                        required: true,

                    },
                    description: {
                        required: true,

                    }

                }, submitHandler: function (form) {
                    $('#preloader').show();
                    form.submit();

                }

            });
        });


        $('#edit_businees').validate({
            rules: {
                first_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,

                },
                home_address: {
                    required: true,

                },
                website: {
                 url: true,
            },
            fb_link: {
                url:true,
            },
            insta_link: {
                url: true,
            },
            linkedin_link: {
                url: true,
            },
            twitter_link: {
                url: true,
            },
            }, submitHandler: function (form) {
                $('#preloader').show();
                form.submit();

            }

        });

        $('body').on('click', '.update_del_img', function () {

            $(this).parent().remove();
        });
        $('body').on('click', '.del_img', function () {
            id = $(this).data('id');
            $('#preloader').show();
            $.ajax({
                type: 'Post',
                url: "<?= asset('delete_project_image') ?>", // point to server-side PHP script 
                dataType: 'json', // what to expect back from the PHP script
                data: {'id': id, _token: "<?= csrf_token(); ?>"},
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success) {
                        $('#success_message').show();
                        $('#message_to_append').html('Image Deleted Successfully');
                        $('.update_project_li' + id).remove();
                        setTimeout(function () {
                            $('#success_message').hide();
                        }, 3000);
                    }
                },
                error: function (e) {
                    $('#preloader').hide();
                    $('#delete_message').show();
                    $('#message_to_append_error').html('Sorry Something went wrong');
                    setTimeout(function () {
                        $('#delete_message').hide();
                    }, 3000);
                }
            });


        });


        var path = [];

        $("body").on('change', '.update-upload-img', function (e)
        {

            id = $(this).attr('data-id');

            var form_data = new FormData();

            form_data.append("file", $('#update_projcet_images' + id)[0].files[0]);
            form_data.append("project", id);
            $('#preloader').show();
            $.ajax({
                url: "<?= asset('/upload_project_image') ?>", // point to server-side PHP script 
                dataType: 'json', // what to expect back from the PHP script
                contentType: false,
                cache: false,
                processData: false,
                data: form_data,
                type: 'POST',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                },
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
                        $('#success_message').show();
                        $('#message_to_append').html('Image Added Successfully');
                        $('.update_project_li' + id).remove();
                        setTimeout(function () {
                            $('#success_message').hide();
                        }, 3000);

                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
//                        window.setTimeout(function () {
//                            location.reload()
//                        }, 2000)
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });
        });
        $("#upload-img").on("change", function (e)
        {

            var form_data = new FormData();
            form_data.append("file", document.getElementById('upload-img').files[0]);
            form_data.append("project", '1');
            $('#preloader').show();
            $.ajax({
                url: "<?= asset('/company_upload_image') ?>", // point to server-side PHP script 
                dataType: 'json', // what to expect back from the PHP script
                contentType: false,
                cache: false,
                processData: false,
                data: form_data,
                type: 'POST',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                },
                success: function (data) {
                    $('#preloader').hide();

                    if (data.success)
                    {

                        path.push(data.path);
                        $('#path_project').val(path);

                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000)
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });
        });

        $('body').on('click', '.edit_gc', function () {
            $this = $(this);
            var id = $this.data('id');
            var title = $('#title' + id).val();
            var cost_start = $('#cost_start' + id).val();
            var cost_end = $('#cost_end' + id).val();
            var location = $('#location' + id).val();
            var image = $('#image' + id).val();
            var image_name = $('#image_name' + id).val();
            var image_id = $('#image_id' + id).val();
            var description = $('#description' + id).val();
            $('#edit_service_id').val(id);
            $('#edit_service_type').val('gc');
            $('#edit_title').val(title);
            $('#edit_start_cost').val(cost_start);
            $('#edit_end_cost').val(cost_end);
            $('#edit_location').val(location);
            $('#edit_description').val(description);
            var baseUrl = '<?= asset('/'); ?>';
            var new_img_path = baseUrl + image;
            if (image) {
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + new_img_path + ')"></div><span data-id="' + image_id + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + image_name + '</li>');

            }

        });

        $('body').on('click', '.edit_prof', function () {
            $this = $(this);
            var id = $this.data('id');
            var title = $('#title' + id).val();
            var cost_start = $('#cost_start' + id).val();
            var cost_end = $('#cost_end' + id).val();
            var location = $('#location' + id).val();
            var image = $('#image' + id).val();
            var image_name = $('#image_name' + id).val();
            var image_id = $('#image_id' + id).val();
            var description = $('#description' + id).val();
            $('#edit_service_id').val(id);
            $('#edit_service_type').val('prof');
            $('#edit_title').val(title);
            $('#edit_start_cost').val(cost_start);
            $('#edit_end_cost').val(cost_end);
            $('#edit_location').val(location);
            $('#edit_description').val(description);
            var baseUrl = '<?= asset('/'); ?>';
            var new_img_path = baseUrl + image;
            if (image) {
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + new_img_path + ')"></div><span data-id="' + image_id + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + image_name + '</li>');
            }
        });
        $('body').on('click', '.edit_sup', function () {
            $this = $(this);
            var id = $this.data('id');
            var title = $('#title' + id).val();
            var cost_start = $('#cost_start' + id).val();
            var cost_end = $('#cost_end' + id).val();
            var location = $('#location' + id).val();
            var image = $('#image' + id).val();
            var image_name = $('#image_name' + id).val();
            var image_id = $('#image_id' + id).val();
            var description = $('#description' + id).val();
            $('#edit_service_id').val(id);
            $('#edit_service_type').val('sup');
            $('#edit_title').val(title);
            $('#edit_start_cost').val(cost_start);
            $('#edit_end_cost').val(cost_end);
            $('#edit_location').val(location);
            $('#edit_description').val(description);
            var baseUrl = '<?= asset('/'); ?>';
            var new_img_path = baseUrl + image;
            if (image) {
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + new_img_path + ')"></div><span data-id="' + image_id + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + image_name + '</li>');
            }
        });
        $('body').on('click', '.edit_sub', function () {
            $this = $(this);
            var id = $this.data('id');
            var title = $('#title' + id).val();
            var cost_start = $('#cost_start' + id).val();
            var cost_end = $('#cost_end' + id).val();
            var location = $('#location' + id).val();
            var image = $('#image' + id).val();
            var image_name = $('#image_name' + id).val();
            var image_id = $('#image_id' + id).val();
            var description = $('#description' + id).val();
            $('#edit_service_id').val(id);
            $('#edit_service_type').val('sc');
            $('#edit_title').val(title);
            $('#edit_start_cost').val(cost_start);
            $('#edit_end_cost').val(cost_end);
            $('#edit_location').val(location);
            $('#edit_description').val(description);
            var baseUrl = '<?= asset('/'); ?>';
            var new_img_path = baseUrl + image;
            if (image) {
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + new_img_path + ')"></div><span data-id="' + image_id + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + image_name + '</li>');
            }
        });
        $('body').on('click', '.edit_owner', function () {
            $this = $(this);
            var id = $this.data('id');
            var title = $('#title' + id).val();
            var cost_start = $('#cost_start' + id).val();
            var cost_end = $('#cost_end' + id).val();
            var location = $('#location' + id).val();
            var image = $('#image' + id).val();
            var image_name = $('#image_name' + id).val();
            var image_id = $('#image_id' + id).val();
            var description = $('#description' + id).val();
            $('#edit_service_id').val(id);
            $('#edit_service_type').val('owner');
            $('#edit_title').val(title);
            $('#edit_start_cost').val(cost_start);
            $('#edit_end_cost').val(cost_end);
            $('#edit_location').val(location);
            $('#edit_description').val(description);
            var baseUrl = '<?= asset('/'); ?>';
            var new_img_path = baseUrl + image;
            if (image) {
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + new_img_path + ')"></div><span data-id="' + image_id + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + image_name + '</li>');
            }
        });
        $(".gc").click(function () {
            var id = $('#gc_id').val();
            var type = $('#gc_type').val();
            var description = $('#gc_description').val();

            $("textarea#description").val(description);

            $('#desc_id').val(id);
            $('#desc_type').val(type);
        });
        $(".gc_special").click(function () {
            var id = $('#gc_id').val();
            $('#gc_sp_id').val(id);

        });
        $(".sc_special").click(function () {
            var id = $('#sub_id').val();
            $('#sub_sp_id').val(id);

        });
        $(".sup_special").click(function () {
            var id = $('#supp_id').val();

            $('#sup_sp_id').val(id);

        });
        $(".owner_special").click(function () {
            var id = $('#owner_id').val();

            $('#owner_sp_id').val(id);

        });
        $(".professional_special").click(function () {

            var id = $('#prof_id').val();
            $('#professional_sp_id').val(id);

        });
        $(".add_gc_service").click(function () {
            var id = $('#gc_id').val();
            var type = $('#gc_type').val();
            $('#service_id').val(id);
            $('#service_type').val(type);
        });
        $(".prof").click(function () {
            var id = $('#prof_id').val();
            var type = $('#prof_type').val();
            var description = $('#prof_description').val();

            $("textarea#description").val(description);
            $('#desc_id').val(id);
            $('#desc_type').val(type);
        });
        $(".add_service_professional").click(function () {
            var id = $('#prof_id').val();
            var type = $('#prof_type').val();



            $('#service_id').val(id);
            $('#service_type').val(type);
        });
        $(".sub").click(function () {
            var id = $('#sub_id').val();
            var type = $('#sub_type').val();
            var description = $('#sub_description').val();

            $("textarea#description").val(description);
            $('#desc_id').val(id);
            $('#desc_type').val(type);
        });
        $(".add_service_subContractor").click(function () {
            var id = $('#sub_id').val();
            var type = $('#sub_type').val();



            $('#service_id').val(id);
            $('#service_type').val(type);
        });
        $(".owner").click(function () {
            var id = $('#owner_id').val();
            var type = $('#owner_type').val();
            var description = $('#owner_description').val();

            $("textarea#description").val(description);
            $('#desc_id').val(id);
            $('#desc_type').val(type);
        });
        $(".add_service_owner").click(function () {
            var id = $('#owner_id').val();
            var type = $('#owner_type').val();

            $('#service_id').val(id);
            $('#service_type').val(type);
        });
        $(".supp").click(function () {
            var id = $('#supp_id').val();
            var type = $('#supp_type').val();
            var description = $('#supp_description').val();

            $("textarea#description").val(description);
            $('#desc_id').val(id);
            $('#desc_type').val(type);
        });
        $(".add_service_supplier").click(function () {
            var id = $('#supp_id').val();
            var type = $('#supp_type').val();

            $('#service_id').val(id);
            $('#service_type').val(type);
        });
        $('#add_service').validate({
            rules: {
                title: {
                    required: true,
                },
                cost_start: {
                    required: true,

                },
                cost_end: {
                    required: true,

                },
                location: {
                    required: true,

                }, description: {
                    required: true,

                },

            },
            messages: {
                title: "Please enter Title",
                cost_start: "Please enter Start cost",
                cost_end: "Please enter end cost",
                location: "Please enter location",
                description: "Please enter Description"


            }, submitHandler: function (form) {
                     if(parseInt($('#edit_start_cost_2').val())>= parseInt($('#edit_end_cost_2').val())){
                    $('#job_title_span_2').show();
                }else{
                $('#preloader').show();
                  $('#job_title_span_2').hide();
                form.submit();
            }
            }


        });

        $('#edit_service').validate({
            rules: {
                title: {
                    required: true,
                },
                cost_start: {
                    required: true,

                },
                cost_end: {
                    required: true,

                },
                location: {
                    required: true,

                }, description: {
                    required: true,

                },

            },
            messages: {
                title: "Please enter Title",
                cost_start: "Please enter Start cost",
                cost_end: "Please enter Start cost",
                location: "Please enter End cost",
                description: "Please enter Start cost"


            }, submitHandler: function (form) {
                if(parseInt($('#edit_start_cost').val())>= parseInt($('#edit_end_cost').val())){
                    $('#job_title_span').show();
                }else{
                $('#preloader').show();
                  $('#job_title_span').hide();
                form.submit();
            }

            }


        });
        $('#add_product').validate({
            rules: {
                title: {
                    required: true,
                },
                image: {
                    required: true,

                },

                price: {
                    required: true,
                    number: true,

                },
                location: {
                    required: true,

                },

            }, submitHandler: function (form) {
                $('#preloader').show();
                form.submit();

            }

        });
    });
    $('.edit_ser_btn').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
        $(this).next('.service-dropdown').toggleClass('service-dropdown-open');
    });
    $('body').click(function (e) {
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
    });


    $("#banner-cover").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".contractor-banner").css("background-image", "url(" + this.result + ")");
            };
        }
    });

    $("#file-attach,#edit-file-attach").on("change", function (e) {

        var files = !!this.files ? this.files : [];
        var fileName = e.target.files[0].name;
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $('.images-lists').html('');
                $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + this.result + ')"></div><span data-index="" class="delete_image" ><img src="<?= asset('userassets/images/close.png') ?>"/></span>' + fileName + '</li>');
            };
        }
    });
    $('body').on('click', '.delete_image', function () {

        $this = $(this);
        var id = $this.data('id');
        if (id) {
            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_image_company') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#file-attach').val('');
                    $('#preloader').hide();
                    if (data.success)
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });
        }
        $(this).parent().remove();
    });
    $('body').on('change', '#banner-cover', function () {

        var form_data = new FormData();
        form_data.append("file", document.getElementById('banner-cover').files[0]);
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/upload_cover') ?>",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                $('#preloader').hide();
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });

    });

    $('body').on('click', '.add_speciality_forn', function (event) {
        event.preventDefault();

        $('#specialities').val(special_name);
        $('#specialities_id').val(special_id);
        $('#formId').submit();
    });
//      $('body').on('click', '.show_loader', function () {
//       
//           
//     
////    });
//    $( "#add_service" ).submit(function(  ) {
//    $('#preloader').show();
// 
//});
    $('body').on('click', '.add_sub_speciality_forn', function (event) {
        event.preventDefault();

        $('#sub_specialities').val(special_name);
        $('#sub_specialities_id').val(special_id);
        $('#sub_formId').submit();
    });
    $('body').on('click', '.add_prof_speciality_forn', function (event) {
        event.preventDefault();

        $('#prof_specialities').val(special_name);
        $('#prof_specialities_id').val(special_id);
        $('#profformId').submit();
    });
    $('body').on('click', '.add_sup_speciality_forn', function (event) {
        event.preventDefault();

        $('#sup_specialities').val(special_name);
        $('#sup_specialities_id').val(special_id);
        $('#supformId').submit();
    });
    $('body').on('click', '.add_owner_speciality_forn', function (event) {
        event.preventDefault();

        $('#owner_specialities').val(special_name);
        $('#owner_specialities_id').val(special_id);
        $('#owner_formId').submit();
    });
    $('body').on('click', '.gc-general-field', function () {


        var special_name = $('.gc-general-field-special').val();
        var id = $('#gc_id').val();
        var type = 'gc';
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/add_speciality_company') ?>",
            data: {speciality: special_name, id: id, type: type, '_token': '<?= csrf_token(); ?>'},

            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                    $('.gc_special_field').append(' <span>' + special_name + '<a href="#"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ')
                    $('.gc_contractor_tags_special').append(' <span class="special_delete' + data.id + '" ><a href="<?= asset('company_search') ?>">' + special_name + '</a></span>')

                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });
    });
    $('body').on('click', '.prof-general-field', function () {

        var special_name = $('.prof-general-field-special').val();
        var id = $('#prof_id').val();
        var type = 'prof';
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/add_speciality_company') ?>",
            data: {speciality: special_name, id: id, type: type, '_token': '<?= csrf_token(); ?>'},

            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                $('#preloader').hide();
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                    $('.prof_special_field').append(' <span>' + special_name + '<a href="#"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ')
                    $('.prof_contractor_tags_special').append(' <span class="special_delete' + data.id + '" ><a href="<?= asset('company_search') ?>">' + special_name + '</a></span>')

                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });
    });
    $('body').on('click', '.sub-general-field', function () {

        var special_name = $('.sub-general-field-special').val();
        var id = $('#sub_id').val();
        var type = 'sc';
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/add_speciality_company') ?>",
            data: {speciality: special_name, id: id, type: type, '_token': '<?= csrf_token(); ?>'},

            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                $('#preloader').hide();
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                    $('.sub_special_field').append(' <span>' + special_name + '<a href="#"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ')
                    $('.sub_contractor_tags_special').append(' <span class="special_delete' + data.id + '" ><a href="<?= asset('company_search') ?>">' + special_name + '</a></span>')
                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });
    });
    $('body').on('click', '.sup-general-field', function () {

        var special_name = $('.sup-general-field-special').val();
        var id = $('#supp_id').val();
        var type = 'sup';
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/add_speciality_company') ?>",
            data: {speciality: special_name, id: id, type: type, '_token': '<?= csrf_token(); ?>'},

            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                $('#preloader').hide();
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                    $('.sup_special_field').append(' <span>' + special_name + '<a href="#"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ')
                    $('.sup_contractor_tags_special').append(' <span class="special_delete' + data.id + '" ><a href="<?= asset('company_search') ?>">' + special_name + '</a></span>')
                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });
    });
    $('body').on('click', '.owner-general-field', function () {

        var special_name = $('.owner-general-field-special').val();
        var id = $('#owner_id').val();
        var type = 'owner';
        $('#preloader').show();
        $.ajax({
            type: "POST",
            url: "<?= asset('/add_speciality_company') ?>",
            data: {speciality: special_name, id: id, type: type, '_token': '<?= csrf_token(); ?>'},

            dataType: 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
            },
            success: function (data) {
                $('#preloader').hide();
                if (data.success)
                {
                    $('.ajax-label').show();
                    $(".ajax-label").removeClass("alert-danger");
                    $(".ajax-label").addClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                    $('.owner_special_field').append(' <span>' + special_name + '<a href="javascript:void(0)"><a href="#"class="delete_speciality  text-danger" id="delete_speciality' + data.id + '" data-id="' + data.id + '"><i class="fa fa-times" aria-hidden="true"></i></a></span> ')
                    $('.owner_contractor_tags_special').append(' <span class="special_delete' + data.id + '" ><a href="<?= asset('company_search') ?>">' + special_name + '</a></span>')

                } else
                {
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                    $(".ajax-label-body").html(data.message);
                }
            },
            error: function (data) {
                $('#preloader').hide();
            }
        });
    });
    $('body').on('click', '.delete_speciality', function () {

        $this = $(this);
        var id = $this.data('id');
        if (id) {
            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });
        }


        $(this).parent().remove();

        $('.special_delete' + id).remove();

    });
    var special_name = [];
    var special_id = [];
    $('body').on('change', '.add_speciality', function () {
        $this = $(this);
        var id = $this.data('id');
        var id_two = $this.data('special-id-admin');
        var index = $this.data('count');
        var check = $('#speciality' + id).prop('checked');
        if (check === true)
        {


            var special_ids = $('#speciality' + id_two).val();
            var special_names = $('#speciality_name' + id_two).val();
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;

            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });

        }


    });
    $('body').on('change', '.add_speciality_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var index = $this.data('count');
        var special_ids = $('#speciality' + id).val();
        var special_names = $('#speciality_name' + id).val();

        var check = $('#speciality' + id).prop('checked');
        if (check === true)
        {
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;
//            
//            $('#preloader').show();
//            $.ajax({
//                type: "POST",
//                url: "<? asset('/delete_speciality') ?>",
//                data: {id: id, '_token': '<? csrf_token(); ?>'},
//                dataType: 'json',
//                success: function (data) {
//                    $('#preloader').hide();
//                    if (data.success)
//                    {
////                         $('#speciality' + id).val(special);
////                          $('#speciality_name' + id).val(specialid);
//                        $('.ajax-label').show();
//                        $(".ajax-label").removeClass("alert-danger");
//                        $(".ajax-label").addClass("alert-success");
//                        $(".ajax-label-body").html(data.message);
//                    } else
//                    {
//                        $('.ajax-label').show();
//                        $(".ajax-label").addClass("alert-danger");
//                        $(".ajax-label").removeClass("alert-success");
//                        $(".ajax-label-body").html(data.message);
//                    }
//                },
//                error: function (data) {
//                    $('#preloader').hide();
//                }
//            });

        }


    });
    $('body').on('change', '.add_sub_speciality_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var index = $this.data('count');
        var special_ids = $('#sub_speciality' + id).val();
        var special_names = $('#sub_speciality_name' + id).val();

        var check = $('#sub_speciality' + id).prop('checked');
        if (check === true)
        {
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;


        }


    });
    $('body').on('change', '.add_prof_speciality_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var index = $this.data('count');
        var special_ids = $('#prof_speciality' + id).val();
        var special_names = $('#prof_speciality_name' + id).val();

        var check = $('#prof_speciality' + id).prop('checked');
        if (check === true)
        {
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;


        }


    });
    $('body').on('change', '.add_sup_speciality_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var index = $this.data('count');
        var special_ids = $('#sup_speciality' + id).val();
        var special_names = $('#sup_speciality_name' + id).val();

        var check = $('#sup_speciality' + id).prop('checked');
        if (check === true)
        {
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;


        }


    });
    $('body').on('change', '.add_owner_speciality_admin', function () {
        $this = $(this);
        var id = $this.data('id');
        var index = $this.data('count');
        var special_ids = $('#owner_speciality' + id).val();
        var special_names = $('#owner_speciality_name' + id).val();

        var check = $('#owner_speciality' + id).prop('checked');
        if (check === true)
        {
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;


        }


    });
    $('body').on('change', '.add_sub_speciality', function () {
        $this = $(this);
        var id = $this.data('id');
        var id_two = $this.data('sub-special-id-admin');
        var index = $this.data('count');
        var check = $('#sub_speciality' + id).prop('checked');
        if (check === true)
        {


            var special_ids = $('#sub_speciality' + id_two).val();
            var special_names = $('#sub_speciality_name' + id_two).val();
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;

            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });

        }


    });

    $('body').on('change', '.add_prof_speciality', function () {

        $this = $(this);
        var id = $this.data('id');
        var id_two = $this.data('prof-special-id-admin');
        var index = $this.data('count');
        var check = $('#prof_speciality' + id).prop('checked');
        if (check === true)
        {


            var special_ids = $('#prof_speciality' + id_two).val();
            var special_names = $('#prof_speciality_name' + id_two).val();
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;

            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });

        }

    });
    $('body').on('change', '.add_sup_speciality', function () {
        $this = $(this);
        var id = $this.data('id');
        var id_two = $this.data('sup-special-id-admin');
        var index = $this.data('count');
        var check = $('#sup_speciality' + id).prop('checked');
        if (check === true)
        {


            var special_ids = $('#sup_speciality' + id_two).val();
            var special_names = $('#sup_speciality_name' + id_two).val();
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;

            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });

        }



    });
    $('body').on('change', '.add_owner_speciality', function () {
        $this = $(this);
        var id = $this.data('id');
        var id_two = $this.data('owner-special-id-admin');
        var index = $this.data('count');
        var check = $('#owner_speciality' + id).prop('checked');
        if (check === true)
        {


            var special_ids = $('#owner_speciality' + id_two).val();
            var special_names = $('#owner_speciality_name' + id_two).val();
            special_id[index] = special_ids;
            special_name[index] = special_names;

        } else if (check === false)
        {
            special_id[index] = undefined;
            special_name[index] = undefined;

            $('#preloader').show();
            $.ajax({
                type: "POST",
                url: "<?= asset('/delete_speciality') ?>",
                data: {id: id, '_token': '<?= csrf_token(); ?>'},
                dataType: 'json',
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success)
                    {
//                         $('#speciality' + id).val(special);
//                          $('#speciality_name' + id).val(specialid);
                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    } else
                    {
                        $('.ajax-label').show();
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                    }
                },
                error: function (data) {
                    $('#preloader').hide();
                }
            });

        }

   }); 
    

    $('#login-form').validate({
        rules: {

            description: {
                required: true,
            }


        }, submitHandler: function (form) {
            $('#preloader').show();
            form.submit();

        }

    });
    $("#upload-logo").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".user-profile-img").css("background-image", "url(" + this.result + ")");
            };
        }
    });
    $("#upload-img").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".project-images").append('<li class="add-project-image" style="background-image:url(' + this.result + ')"></li>');
            };
        }
    });
    $('body').on('change', '.update-upload-img', function ()
    {
        var files = !!this.files ? this.files : [];
        var img_url = '<?= asset('userassets/images/close.png') ?>';

        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".project-images").append('<li class="add-project-image" style="background-image:url(' + this.result + ')"><a href="javascript:void(0)" class="update_del_img del_img delete-profile"> <img src="' + img_url + '"/> </a></li>');
            };
        }
    });
    $("#store-upload-img").on("change", function ()
    {
        var files = !!this.files ? this.files : [];

        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".add-store-image").css("background-image", "url(" + this.result + ")");

//                $(".add-store-image").empty();
            };
        }

    });
    $("#store-upload-img1").on("change", function ()
    {
        var files = !!this.files ? this.files : [];

        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".add-store-image").css("background-image", "url(" + this.result + ")");

//                $(".add-store-image").empty();
            };
        }

    });
    function initAutocomplete() {

        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete1 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});
        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('update_location')),
                {types: ['geocode']});
        autocomplete3 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('project_location')),
                {types: ['geocode']});
        autocomplete4 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('update_project_location')),
                {types: ['geocode']});
        autocomplete5 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('edit_location')),
                {types: ['geocode']});
        autocomplete6 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('add_location')),
                {types: ['geocode']});

        autocomplete7 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('update_edit_business')),
                {types: ['geocode']});
        autocomplete1.addListener('place_changed', fillInAddress);
        autocomplete2.addListener('place_changed', fillInAddress2);

    }
    function fillInAddress() {

        // Get the place details from the autocomplete object.
        var place = autocomplete1.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#add_lat').val(lat);
        $('#add_lng').val(lng);

    }
    function fillInAddress2() {

        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        $('#update_lat').val(lat);
        $('#update_lng').val(lng);

    }

    $('body').on('click', '.edit_store', function () {


        id = $(this).data('id');

        product_id = $('.product_id' + id).val();
        $('#id').val(product_id);
//        product_id = $('.product_id' + id).val();
//        $('#id').val(product_id);

        title = $('.title' + id).val();

        $('#titlee').val(title);

        price = $('.price' + id).val();
        $('#price').val(price);

        location_product = $('.location' + id).val();
        $('#update_location').val(location_product);

        lat = $('.lat' + id).val();
        $('#update_lat').val(lat);

        lng = $('.lng' + id).val();
        $('#update_lng').val(lng);

        type = $('.type' + id).val();
        if (type == 'Available') {
            $('.type').val('available');
            $('.type').niceSelect('update');
        } else {
            $('.type').val('not_available');
            $('.type').niceSelect('update');
        }

        is_hide = $('.is_hide' + id).val();

        if (is_hide == '1') {
            $('.is_hidee').prop('checked', true);
        } else {
            $('.is_hidee').prop('checked', false);
        }

        photo = $('.photo' + id).val();
        u = "<?= asset(''); ?>" + photo;
        $(".add-store-image").css("background-image", "url(" + u + ")");

        file = $('.file_id' + id).val();
        $('#file_id').val(file);
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
//    alert(charCode);
        if (charCode > 31 && (charCode < 46 || charCode > 57))
            return false;
        return true;
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApyIRH_zIWZT32AXvIU2A2Y-A0fvPSv50&libraries=places&callback=initAutocomplete" async defer></script>
