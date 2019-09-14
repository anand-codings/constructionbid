<?php include resource_path('views/includes/top-header.php');
?>
<?php include resource_path('views/includes/header.php'); ?>
<?php include resource_path('views/includes/messages.php'); ?>
<section class="company-dashboard margin-tb">
    <div class="container">
        <div class="row">
            
            <div class="col-md-3">
                <?php include('includes/dashboard_sidebar.php') ?>
            </div>
            <div class="col-md-9">

                <div class="condructor-tabs dashboards">
                    <div class="condructor-tabs-header">
                        <div class="tabs-header">
                            <h3>
                                Proposals
                            </h3>
                        </div>
                    </div>
                    <div class="condructor-tabs-body my_proposal">
                        <?php
                        if (count($proposals)>0) {
                            foreach ($proposals as $proposal) {

                              
                                        ?>
                                        <div class="dashboard-content">
                                            <div class="dashboard-profile align-items-start">
                                                <div class="dashboard-profile-img" style="background-image: url('<?php echo getUserImage($proposal->getJob->getUser->profile_image)  ?>')"></div>
                                                <div class="dashboard-profile-content">
                                                    <h6> To : <?= $proposal->getJob->getUser->first_name; ?> <?= $proposal->getJob->getUser->last_name ?></h6>
                                                    
                                                </div>
                                                <div class="d-flex align-items-start ">
                                                    
                                                    <?php if ($proposal->status == 'accept') { ?>
                                                        <a href="#" class="btn btn_sm_green mr-2">Accepted </a>
                                                        
                                                    <?php } elseif ($proposal->status == 'reject') { ?>
                                                        <a href="#" class="btn btn_sm_red mr-2 ">Rejected </a>
                                                    <?php } elseif ($proposal->status == 'pending') { ?>
                                                        <a href="#" class="btn btn_sm_grey mr-2 ">Pending </a>
                                              
                                                    <?php }if (isset($proposal->getFiles)) {
                                                        //if ($proposal->getFiles->type == 'doc') {
                                                            ?>
                                                        
                                                        <a href="<?= asset('download_file/'.$proposal->getFiles->id)?>" class="btn btn_sm_green "> <i class="fa fa-download pl-3" aria-hidden="true"></i>Download</a>
                                                    <?php  }?>
                                                        <a href="<?= asset('view_public_job/'.$proposal->getJob->id)?>" class="btn btn_sm_blue mr-2">View Job </a>
                                                </div>
                                            </div>


                                            <div class="d-flex file-download">
                                                <div class="dashboard-profile-content pt-3">
                                                    <h6>Subject: <?= $proposal->subject; ?></h6>
                                                    <p><?= $proposal->message; ?></p>
                                                </div>
                                             
                                                    
                                                   
                                                </div>

                                            </div>
                                        <?php
                                        
                                    
                                }
                        }else{ ?>
                        <div class="no-record-found">No Proposals Found </div>
                        <?php }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <div class="modal fade" id="submit-proporsal">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-title border-bottom">
                        <h6>Proposal Form</h6>
                    </div>
                    <button type="button" class="close-modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <span class="ajax-label-body"></span>
                    </div>
                    <form  method="POST" action="<?= asset('edit_proposal'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id" id='proposal_id'>
                        <div class="form-group">
                            <label>To:</label>
                            <input type="text" name='user_name' id="user_name" class="form-control general-field" placeholder="Harry Schwatrtz" />
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control general-field" placeholder="Add a subject live" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="path[]" id="path" class="form-control general-field" placeholder="Add a subject live" />
                        <input type="hidden" name="type[]" id="type" class="form-control general-field" placeholder="Add a subject live" />
                        <input type="hidden" name="name[]" id="name" class="form-control general-field" placeholder="Add a subject live" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        Message
                                    </label>
                                    <textarea name='message' placeholder="Add a message…" id="message" class="text-msgs"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="attachment">
                                    <label>Attachment</label>
                                    <label class="attachment-link" for="file-attach">
                                        <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                        <input type="file" name="file" style="display:none;" id="file-attach"/>
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
                        <div class="row check-rule">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="styled-checkbox" id="rules" type="checkbox" value="value1" >
                                    <label for="rules">I understad and agree to <a href=""> Terms of Use</a> and <a href="">Privacy Policy.</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type='button'id='upload' class="btn btn_sm_green upload" disabled>Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include resource_path('views/includes/footer.php');
    ?>
    <?php
    include resource_path('views/includes/bottom-footer.php');
    ?>
    <script>

        $(document).ready(function () {
            $(".close-modal").click(function () {
                window.setTimeout(function () {
                    location.reload()
                }, 1000)
            });
            $("#rules").click(function () {
                $("#upload").attr("disabled", !this.checked);
            });

            $('body').on('click', '.edit', function () {
                $this = $(this);
                var id = $this.data('id');
                var img = $this.data('image');



                var i;
                for (i = 0; i < img; i++) {
                    var img_id = $('#image_id' + id + i).val();
                    var img_type = $('#image_type' + id + i).val();
                    var img_name = $('#image_name' + id + i).val();


                    if (img_type == 'pdf')
                    {
                        console.log(img_type);
                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/pdf.png')?> )"></div><span class="delete_image" data-id="' + img_id + '" id="delete-image' + i + '"><img src="<?= asset('userassets/images/close.png')?>"/></span>' + img_name + '</li>');
                    } else if (img_type == 'zip')
                    {
                        console.log(img_type);
                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/zip.png')?> )"></div><span class="delete_image" data-id="' + img_id + '" id="delete-image' + i + '"><img src="<?= asset('userassets/images/close.png')?>"/></span>' + img_name + '</li>');

                    } else if (img_type == 'doc')
                    {
                        console.log(img_type);
                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/doc.png')?> )"></div><span class="delete_image" data-id="' + img_id + '" id="delete-image' + i + '"><img src="<?= asset('userassets/images/close.png')?>"/></span>' + img_name + '</li>');

                    } else if (img_type == 'image')
                    {
                        $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url(' + $('#image' + id + i).val() + ')"></div><span class="delete_image" data-id="' + img_id + '" id="delete-image' + i + '"><img src="<?= asset('userassets/images/close.png')?>"/></span>' + img_name + '</li>');

    //                 $('.images-lists').append('<li><img src="http://localhost/constructbid/userassets/images/close-icons.png" data-id="'+i+'" id="delete-image"' +i+' >' + $('#image_path' + i).val() + '</li>')
    //                console.log($('#image_path' + i).val());
                    }


                }
                var message = $('#message' + id).val();
                var subject = $('#subject' + id).val();
                var user_name = $('#user_name' + id).val();


    //            $('.images-lists').append('<li><img src="http://localhost/constructbid/userassets/images/close-icons.png" id="delete-image">' + image_path + '</li>')
                $('#user_name').val(user_name);
                $('#subject').val(subject);
                $('#message').val(message);
                $('#proposal_id').val(id);

            });

        });
        var path = [];
        var type = [];
        var image_name = [];
        var count = 0;
        $("#file-attach").on("change", function (e)
        {
    //        var name = document.getElementById("file-attach").files[0].name;
            var form_data = new FormData();
    //        var ext = name.split('.').pop().toLowerCase();
    //        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1)
    //        {
    //        }
    //        var oFReader = new FileReader();
    //        oFReader.readAsDataURL(document.getElementById("file-attach").files[0]);
    //        var f = document.getElementById("file-attach").files[0];
    //        var fsize = f.size || f.fileSize;
    //        if (fsize > 2000000)
    //        {
    //        } else
    //        {
            form_data.append("file", document.getElementById('file-attach').files[0]);


    //         $this = $(this);
    //         var image = $this.val();
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
                        type.push(data.type);
                        image_name.push(data.name);

                        if (data.type == 'pdf')
                        {

                            $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/pdf.png')?> )"></div><span data-index="' + count + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png')?>"/></span>' + data.name + '</li>');
                        } else if (data.type == 'zip')
                        {

                            $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/zip.png')?> )"></div><span data-index="' + count + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png')?>"/></span>' + data.name + '</li>');

                        } else if (data.type == 'doc')
                        {

                            $('.images-lists').append('<li><div class="upload-imgs"  style="background-image:url( <?= asset('userassets/images/doc.png')?> )"></div><span data-index="' + count + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png')?>"/></span>' + data.name + '</li>');

                        } else if (data.type == 'image') {
                            $('.images-lists').append('<li><div class="upload-imgs" style="background-image:url(' + data.path + ')"></div><span data-index="' + count + '" class="delete_image" ><img src="<?= asset('userassets/images/close.png')?>"/></span>' + data.name + '</li>');
                        }
                        count++;
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
    //        }
    //                      var x = document.getElementById("file-attach").files[0].name;
    

            var fileName = e.target.files[0].name;
    //          var filetype = e.target.files[0].type;

            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
    //          if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader

            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
    //                    $(".upload-imgs").css("background-image", "url(" + this.result + ")");

    //            $('.images-lists').append('<li><div class="upload-imgs" style="background-image:url(' + this.result + ')"></div><span  class="delete_image"><img src="http://localhost/constructbid/userassets/images/close.png"/></span>' + fileName + '</li>');

            };

    //          }

    //              console.log(event.target.files[0].name);

        });
        $('body').on('click', '.delete_image', function () {

            $this = $(this);
            var id = $this.data('id');
            var index = $this.data('index');

    //         for (var i = 0; i < path.length; i++) {
    //                        console.log(path[i]);
    //                    }
            path[index] = null;
            type[index] = null;
            image_name[index] = null;


            if (id) {
                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: "<?= asset('/delete_image') ?>",
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
        });

        $('body').on('click', '.upload', function () {
            $form = $(this).parents('form');
            $this = $(this);
    //       for(var i=0 ; i < path.length;i++)
    //       {
    //           $('#path').val(path[i]);
    //       }
            $('#path').val(path);
            $('#type').val(type);
            $('#name').val(image_name);
            //Form validation
            $form.validate({
                rules: {
                    user_name: {
                        required: true,
                    },
                    subject: {
                        required: true,

                    },
                    message: {
                        required: true,

                    },
                },
                messages: {
                    email: "Please enter Name",
                    password: "Please enter subject",
                    password_confirmation: "Please enter message"

                }

            });
            if ($form.valid()) {

                $('#upload').attr("disabled", true);


                var formData = new FormData($form[0]);
                $('#preloader').show();
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                },
                success: function (data) {
                    $('#preloader').hide();
                    if (data.success) {

                        $('#register').attr("disabled", false);

                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000)

                    } else {
                        $('#register').attr("disabled", false);

                        $('.ajax-label').show();
                        $(".ajax-label").removeClass("alert-danger");
                        $(".ajax-label").addClass("alert-success");
                        $(".ajax-label-body").html(data.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000)
                    }
                },
                error: function (data) {

$('#preloader').hide();
                    $('.ajax-label').show();
                    $(".ajax-label").addClass("alert-danger");
                    $(".ajax-label").removeClass("alert-success");
                }
            });
        }
    }); //End save label function
    $("#upload-img").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $(".profile-logo").css("background-image", "url(" + this.result + ")");
                $('.profile-logo').empty();
            };
        }
    });

</script>
<script>
    $('.edit_ser_btn').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
        $(this).next('.service-dropdown').toggleClass('service-dropdown-open');
    });
    $('body').click(function (e) {
        $('.service-dropdown.service-dropdown-open').removeClass('service-dropdown-open');
    });
</script>
