<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= isset($title) ? $title : ''; ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= isset($title) ? $title : ''; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-header with-border">

                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php include resource_path('views/admin/includes/messages.php'); ?>
                        <form role="form" action="<?= asset('add_user') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="id" value="<?= (isset($result->id) ? $result->id : ''); ?>">
                            <div class="box-body">
                                <?php if (isset($type) && $type == 'homeowner') {
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" name="first_name"  value="<?= (old('first_name')) ? old('first_name') : (isset($result->first_name) ? $result->first_name : ''); ?>" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"  value="<?= (old('last_name')) ? old('last_name') : (isset($result->last_name) ? $result->last_name : ''); ?>" placeholder="Last Name">
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name</label>
                                        <input type="text" class="form-control" name="first_name"  value="<?= (old('first_name')) ? old('first_name') : (isset($result->first_name) ? $result->first_name : ''); ?>" placeholder="Company Name">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" value="<?= (old('email')) ? old('email') : (isset($result->email) ? $result->email : ''); ?>" placeholder="Enter email" <?= isset($result->email) ? 'disabled' : '' ?>>
                                </div>
                                <?php
                                if (isset($result)) {
                                    
                                } else {
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control" name="password"  placeholder="Enter password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm password">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Home Address</label>
                                    <input type="text" class="form-control" name="home_address" value="<?= (old('home_address')) ? old('home_address') : (isset($result->home_address) ? $result->home_address : ''); ?>" placeholder="Enter Address">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="type" value="<?= (($type == 'company') ? 'company' : 'homeowner'); ?>">
                                    <label>Type</label>
                                    <select class="form-control select2" disabled="disabled" style="width: 100%;">
                                        <?php if ($type == 'homeowner') { ?>
                                            <option selected="selected" >HomeOwner</option>
                                        <?php } else { ?>
                                            <option selected="selected" >Company</option>
                                        <?php } ?>
                                        <option>Company</option>

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="attachment">

                                            <label class="attachment-link" for="file-attach">
                                                <img src="<?= asset('userassets/images/plus-circle.png') ?>"/><span>Upload Profile Image</span>
                                                <input type="file" name="image" style="display:none;" id="file-attach"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class='images-lists'>
                                            <?php if (isset($result->profile_image)) { ?>
                                                <li>
                                                    <div class="upload-imgs"  style="background-image:url(' + this.result + ')">

                                                    </div>
                                                    <span data-index="" class="delete_image" >
                                                        <img src="<?= asset(getUserImage($result->profile_image)) ?>"/>
                                                    </span></li>
                                                <?php } ?>
                                            </ul>  
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
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
//      To Append Image View
//        $(document).on('change', '.btn-file :file', function () {
//            var input = $(this),
//                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
//            input.trigger('fileselect', [label]);
//        });
//
//        $('.btn-file :file').on('fileselect', function (event, label) {
//
//            var input = $(this).parents('.input-group').find(':text'),
//                    log = label;
//
//            if (input.length) {
//                input.val(log);
//            } else {
//                if (log)
//            }
//
//        });
//        function readURL(input) {
//            if (input.files && input.files[0]) {
//                var reader = new FileReader();
//
//                reader.onload = function (e) {
//                    $('#img-upload').attr('src', e.target.result);
//                }
//
//                reader.readAsDataURL(input.files[0]);
//            }
//        }
//
//        $("#imgInp").change(function () {
//            readURL(this);
//        });
    });
</script>