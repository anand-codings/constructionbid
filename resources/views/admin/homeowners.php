<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Home Owners
            <small><?= isset($title) ? $title : ''; ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= isset($title) ? $title.' Details' : '';  ?></h3>
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-2">
                           <a href="<?= asset('/edit_user') ?>" class="btn  btn-primary">Add HomeOwners</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                     
                    <div class="box-body">
                       
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Sr#</th>


                                    <th>Name </th>
                                    <th>Profile Photo</th>
                                    <th>Email </th>
                                    <th>Blocked</th>
                                    <th>Home Address</th>
                                    <th>Login As</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($homeowners)) {
                                    $count = 0;
                                    foreach ($homeowners as $homeowner) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count; ?></td>

                                            <td><?= $homeowner->first_name; ?> </td>
                                            <td style="text-align:center; vertical-align: middle;"><img src="<?= getUserImage($homeowner->profile_image); ?>" class="img-circle" width="60px"> </td>
                                            <td><?= $homeowner->email; ?></td>
                                            <td><input type="checkbox" id="block_user<?= $homeowner->id; ?>" data-id="<?= $homeowner->id ?>"
                                                       class="block_user" value="<?= $homeowner->is_blocked ?>" name="block_user"
                                                       <?= ($homeowner->is_blocked == 1) ? 'checked' : ''; ?>></td>
                                            <td><?= $homeowner->home_address ?></td>
                                            <td><a target="_blank" href="<?= asset('login_as/' .$homeowner->id) ?>">Login</a></td>
                                            <td style="text-align:center; vertical-align: middle;"><a href="<?= asset('/edit_user/' . $homeowner->id) ?>" class='text-success edit'><i class='fa fa-edit'></i></a>
                                                
                                                <a  class="text-danger block delete" data-id="<?= $homeowner->id; ?>"><i class='fa fa-trash-o'></i></a></td>



                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <td><h1>No data</h1></td>

                            <?php }
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
        $('body').on('click', '.delete', function () {

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

                if (result.value) {

                    $.ajax({
                        type: "POST",
                        url: "<?= asset('/delete_user') ?>",
                        data: {id: id, '_token': '<?= csrf_token(); ?>'},
                        dataType: 'json',
                        success: function (data) {
                            Swal.fire({title: "HomeOwner Deleted", type: "success"}).then(
                                    function () {
                                        location.reload();
                                    });
                        },
                        error: function (data) {

                        }
                    });

                }

                // result.value will containt the input value
            })

        });
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