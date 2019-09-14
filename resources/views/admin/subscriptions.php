<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.modal-dialog -->

    <section class="content-header">
        <h1>
            Subscriptions
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
                                    <th>Company Name </th>
                                    <th>Plan </th>
                                    <th>Amount </th>
                                    <th>End Date </th>
                                    <th>Total Bids</th>
                                    <th>Remaining Bids</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($subscriptions)) {
                                    $count = 0;
                                    foreach ($subscriptions as $subscription) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count; ?></td>
                                            <td><?= $subscription->getUser->first_name; ?> </td>
                                            <td><?= ($subscription->stripe_id) ? get_subscription($subscription->stripe_id)['plan']->nickname : 'Free'; ?> </td>
                                            <td><?php echo '$';
                                                ($subscription->stripe_id) ? printf("%.2f", get_subscription($subscription->stripe_id)['plan']->amount / 100) : printf('0.00');
                                        ?> </td>
                                            <td><?= ($subscription->stripe_id) ? date('F , d Y', get_subscription($subscription->stripe_id)->current_period_end) : $subscription->created_at->addDays(30)->format('F , d Y'); ?> </td>
                                            <td><?php
                                                if ($subscription->stripe_plan == 'plan_FKCSaXgiW2R6bt') {
                                                    echo 'unlimited';
                                                } else if ($subscription->stripe_plan == 'plan_FKCRHwmswfjnkI') {
                                                    echo '60';
                                                } else {
                                                    echo '10';
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($subscription->stripe_plan == 'plan_FKCSaXgiW2R6bt') {
                                                    echo 'unlimited';
                                                } else if ($subscription->stripe_plan == 'plan_FKCRHwmswfjnkI') {
                                                    echo $procount = 60 - $subscription->getUser->get_proposals_count;
                                                } else {
                                                    echo $procount = 10 - $subscription->getUser->get_proposals_count;
                                                }
                                                ?>
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