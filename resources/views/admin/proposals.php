<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.modal-dialog -->

    <section class="content-header">
        <h1>
            Proposals
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

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Sr#</th>

                                    <th>Home Owner Name </th>
                                    <th>Company Name </th>

                                    <th>Subject </th>
                                    <th>Message </th>
                                    <th>Status </th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($proposal)) {

                                    $count = 0;
                                    foreach ($proposal as $prop) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count; ?></td>

                                            <td><?= $prop->user_name; ?> </td>
                                            <td><?= $prop->getUser->first_name; ?> </td>
                                            <td><?= $prop->subject; ?> </td>
                                            <td><?= $prop->message; ?> </td>
                                            <td> <?php if ($prop->status == 'accept') { ?>
                                                    <a href="#" class="btn btn_sm_green mr-2">Accepted </a>

                                                <?php } elseif ($prop->status == 'reject') { ?>
                                                    <a href="#" class="btn btn_sm_red mr-2">Rejected </a>
                                                <?php } elseif ($prop->status == 'pending') { ?>
                                                    <a href="#" class="btn btn_sm_grey mr-2">Pending </a>

                                                <?php } ?> </td>









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