<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form action="<?= asset('add_job') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Job Specialty</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="job" placeholder="Enter Specialty">
                        </div>

                        <!--                            <div class="form-group img_size">
                                                            <label>Upload Image</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <span class="btn btn-default btn-file">
                                                                        Browse… <input type="file" accept=".png,.jpeg,.jpg" name="path">
                                                                    </span>
                                                                </span>
                                                                <input type="text" class="form-control" readonly="">
                                                            </div>
                                                            <img id="img-upload" src="">
                                                        </div>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="attachment">

                                    <label class="attachment-link" for="file-attach">
                                        <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Add File</span>
                                        <input type="file" name="path" style="display:none;" id="file-attach"/>
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </form>
    <!-- /.modal-dialog -->

    <section class="content-header">
        <h1>
            Jobs Specialities
            <small><?= isset($title) ? $title : ''; ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= isset($title) ? $title . ' Details' : ''; ?></h3>
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#modal-default">Add Job Speciality
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php include resource_path('views/admin/includes/messages.php'); ?>

                        <table id="example1" class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Sr#</th>


                                    <th>Name </th>
                                    <th>Is Popular</th>
                                    <th>Image </th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($jobs_speciality)) {
                                    $count = 0;
                                    foreach ($jobs_speciality as $job) {
//                                        dd($job);
                                        ?>

                                        <tr> 
                                            <td><?= ++$count; ?></td>


                                            <td><?= $job->name; ?> </td>
                                            <td>
                                                <input type="checkbox" id="popular_user<?= $job->id; ?>" data-id="<?= $job->id ?>"
                                                        value="<?= $job->getJobSpecialty->is_popular ?>" name="popular_user"
                                                       <?= ($job->getJobSpecialty->is_popular == 1) ? 'checked' : ''; ?> onclick="return false;" >
                                            </td>
                                            <td style="text-align:center; vertical-align: middle;">
                                                
                                                <img src="<?= ($job->getspecialImage->image_path) ? asset($job->getspecialImage->image_path) : asset('public/images/images.png') ?>" class="img-circle" width="60px"> </td>




                                            <td ><a href="<?= asset('/delete_job' . $job->id) ?>" class='text-danger block delete'><i class='fa fa-trash-o'></i></a>

                                            </td>



                                        </tr>

                                        <?php
                                    }
                                } else if (isset($speciality)) {
                                    $count = 0;
                                    foreach ($speciality as $job) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count; ?></td>

                                            <td><?= $job->title; ?> </td>
                                             <td>
                                             <input type="checkbox" id="popular_user<?= $job->id; ?>" data-id="<?= $job->id ?>"
                                                       class="popular_user" value="<?= $job->is_popular ?>" name="popular_user"
                                                       <?= ($job->is_popular == 1) ? 'checked' : ''; ?> >
                                             </td>
                                            <td style="text-align:center; vertical-align: middle;">
                                                
                                                <img src="<?= ($job->image_path) ? asset($job->image_path) : asset('public/images/images.png') ?>" class="img-circle" width="60px"> </td>




                                            <td ><a href="<?= asset('/delete_job_special/' . $job->id) ?>" class='text-danger block delete'><i class='fa fa-trash-o'></i></a>

                                            </td>



                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>





<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function () {
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
        $('body').on('click', '.popular_user', function () {
            $this = $(this);
            swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change status of this specialty!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(function (result) {
                var id = $this.attr('data-id');
                var status = $this.val();
                if (result.value) {
                    $('#preloader').show();
                    $.ajax({
                        type: "POST",
                        url: "<?= asset('/job_specialty_status') ?>",
                        data: {id: id, 'status': status, '_token': '<?= csrf_token(); ?>'},
                        dataType: 'json',
                        success: function (data) {
                            $('#preloader').hide();
                            Swal.fire(
                                    'Status Changed!',
                                    'Status has been changed.',
                                    'success'
                                    )
                            
                            
                        },
                        error: function (data) {
                            $('#preloader').hide();
                        }
                    });

                } else
                {
//                     alert('dsd');
                    var id = $this.attr('data-id');
                    if ($('#popular_user' + id).prop('checked') === false)
                    {

                        $('#popular_user' + id).prop('checked', true);
                    } else {

                        $('#popular_user' + id).prop('checked', false);
                    }
                }

                // result.value will containt the input value
            })
        });
        $('body').on('click', '.block_user', function () {
            $this = $(this);
            swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change status of this user!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(function (result) {
                var id = $this.attr('data-id');
                var status = $this.val();
                if (result.value) {
                  
                    $('#preloader').show();
                    $.ajax({
                        type: "POST",
                        url: "<?= asset('/block_user') ?>",
                        data: {id: id, 'status': status, '_token': '<?= csrf_token(); ?>'},
                        dataType: 'json',
                        success: function (data) {
                            $('#preloader').hide();
                            Swal.fire(
                                    'Status Changed!',
                                    'Status has been changed.',
                                    'success'
                                    )
                            
                        },
                        error: function (data) {
                            $('#preloader').hide();
                        }
                    });

                } else
                {
                        
                    var id = $this.attr('data-id');
                    if ($('#block_user' + id).prop('checked') === false)
                    {

                        $('#block_user' + id).prop('checked', true);
                    } else {

                        $('#block_user' + id).prop('checked', false);
                    }
                }

                // result.value will containt the input value
            })
        });
//        $('body').on('click', '.delete', function () {
//
//            $this = $(this);
//            swal.fire({
//                title: 'Are you sure?',
//                text: "Do you want to change status of this user!",
//                type: 'warning',
//                showCancelButton: true,
//                confirmButtonColor: '#3085d6',
//                cancelButtonColor: '#d33',
//                confirmButtonText: 'Yes!'
//            }).then(function (result) {
//                var id = $this.attr('data-id');
//
//                if (result.value) {
//
//                    $.ajax({
//                        type: "POST",
//                        url: "<?= asset('/delete_user') ?>",
//                        data: {id: id, '_token': '<?= csrf_token(); ?>'},
//                        dataType: 'json',
//                        success: function (data) {
//                            Swal.fire({title: "Good job", text: "You clicked the button!", type: "success"}).then(
//                                    function () {
//                                        location.reload();
//                                    });
//                        },
//                        error: function (data) {
//
//                        }
//                    });
//
//                }
//
//                // result.value will containt the input value
//            })
//
//        });
    });
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>