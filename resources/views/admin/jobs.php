<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <form action="<?= asset('add_job')?>" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                  <input type="text" class="form-control" name="job">
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
    </form>
          <!-- /.modal-dialog -->
        </div>
    <section class="content-header">
        <h1>
            Jobs 
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

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
<!--                          <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#modal-default">
               Add Job Speciality
              </button>-->
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Sr#</th>


                                    <th>HomeOwner Name </th>
                                    <th>Title </th>
                                    <th>Budget </th>
                                    <th>Start Date </th>
                                    <th>Finish Date </th>
                                    <th>Description </th>
                                    <th>Location </th>
                                    <th>Specialties </th>
                                    <th>No of proposals </th>
                                 
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($jobs)) {
                                    $count = 0;
                                    foreach ($jobs as $job) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count; ?></td>

                                            <td><?= $job->getUser->first_name; ?> </td>
                                            <td><?= $job->title; ?> </td>
                                            <td>$<?= $job->budget_start; echo "- $"; echo $job->budget_end;?> </td>
                                            <td><?= $job->start;?> </td>
                                            <td><?= $job->finish;?> </td>
                                            <td><?= $job->description; ?> </td>
                                            <td><?= $job->location; ?> </td>
                                            <td><?= $job->get_speciality_count; echo "  ";?><a href="<?= asset('/job_specialities/' . $job->id) ?>" class='text-danger block delete'><i class='fa  fa-eye'></i></a> </td>
                                            <td><?= $job->get_proposal_count; echo "  ";?><a href="<?= asset('/proposals/' . $job->id) ?>" class='text-danger block delete'><i class='fa  fa-eye'></i></a> </td>
                                            
                                          
                                          
                                          
<!--                                            <td ><a href="<?= asset('/delete_job' . $job->id) ?>" class='text-danger block delete'><i class='fa fa-trash-o'></i></a>
                                                -->
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