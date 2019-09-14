
<?php include 'includes/head.php'; ?>

<?php include'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
      
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <input type="hidden" id="homeowner" value="<?= (isset($homeowners) ? $homeowners : ''); ?>">
                        <input type="hidden" id="company" value="<?= (isset($company) ? $company : ''); ?>">
                        <input type="hidden" id="proposal" value="<?= (isset($proposals) ? $proposals : ''); ?>">
                        <input type="hidden" id="job" value="<?= (isset($jobs) ? $jobs : ''); ?>">
                        <h3><?= $homeowners?></h3>

                        <p>Home Owner Registrations</p>
                    </div>
                    <a href="<?= asset('home_owner')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $company?></h3>

                        <p>Company Registrations</p>
                    </div>
                    <a href="<?= asset('companies')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $jobs?><sup style="font-size: 20px"></sup></h3>

              <p>Jobs</p>
            </div>
            <a href="<?= asset('jobs')?>" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
                  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $proposals?><sup style="font-size: 20px"></sup></h3>

              <p>Proposals</p>
            </div>
            <a href="<?= asset('proposals')?>" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
            <!-- ./col -->
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right"  style="display: none">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="donut-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
        </div>
       
                     <div class="col-md-6">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right" style="display: none">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
        </div>
        </div>

        <!-- /.row -->
        <!-- Main row -->


        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
        
   <?php include 'includes/footer.php'; ?>
      <script>
            $(function () {
               
              
               
                  var bar_data = {
      data : [['Home Owners',  $("#homeowner").val()], ['Company', $("#company").val()], ['Jobs', $("#job").val()], ['Proposals', $("#proposal").val()]],
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
               
          var donutData = [
      { label: 'Jobs', data: $("#job").val(), color: '#3c8dbc' },
      { label: 'proposals', data: $("#proposal").val(), color: '#0073b7' }
//      { label: 'Jobs', data: 50, color: '#00c0ef' }
    ]
       var donutData2 = [
      { label: 'Home Owner', data: $("#homeowner").val(), color: '#009900' },
      { label: 'Company', data: $("#company").val(), color: '#33ff33' }
//      { label: 'Jobs', data: 50, color: '#00c0ef' }
    ]

        $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
       $.plot('#donut-chart2', donutData2, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
     })
       function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
         </script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
