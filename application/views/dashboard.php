<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>">
<script src="<?php echo base_url('assets/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/morris/morris.min.js'); ?>"></script>
<section class="content-header">
      <h1>
        Dashboard
        <small>Welcome <?php echo $this->session->userdata('name') ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
</section>
<!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Order Count</span>
              <span class="info-box-number"><?php echo $dashdata->totalorder ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-box-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Order Wait</span>
              <span class="info-box-number"><?php echo $dashdata->totalstock ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Order Taken</span>
              <span class="info-box-number"><?php echo $dashdata->totalordertaken ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-cancel"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Order Canceled</span>
              <span class="info-box-number"><?php echo $dashdata->totalordercanceled ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Order This Year</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Last 10 order in Month</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>Order Tag Code</th>
                        <th>Item</th>
                        <th>Status</th>
                        <?php
                        if($this->session->userdata("role") == "Admin"){
                            ?>
                            <th>Ordered By</th>
                            <?php
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                             foreach($dashdata->orderlist as $row){
                                 ?>
                                 <tr>
                                    <td><a href="<?php echo base_url('order/view/'.$row->id); ?>"><?php echo $row->tagcode; ?></a></td>
                                    <td><?php echo date("l, F d Y - H:i", strtotime($row->orderdate)); ?></td>
                                    <td><?php echo ($row->status != "CANCE" ? '<span class="label label-success">'.$row->statusname.'</span>' : '<span class="label label-danger">'.$row->statusname.'</span>'); ?></td>
                                    <?php
                                    if($this->session->userdata("role") == "Admin"){
                                        ?>
                                        <td><?php echo $row->username ?></td>
                                        <?php
                                    }
                                    ?>
                                 </tr>
                                 <?php
                             }
                        ?>
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                <a href="<?php echo base_url("order/add"); ?>" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                <a href="<?php echo base_url("order"); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
      </div>
</section>
<script>
$(function(){
    $.getJSON("<?php echo base_url("dashboard/graphdata"); ?>", function(result){
        var datas = [];
        jQuery.each(result, function(i, val){
        datas.push(val);
        });

        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: datas,
            xkey: 'y',
            ykeys: ['total', 'wait', 'taken', 'canceled'],
            labels: ['Total', 'Wait', 'Taken', 'Canceled'],
            lineColors: ['#3c8dbc', '#ff9900', '#009933', '#ff5050'],
            hideHover: 'auto',
            parseTime:false
        });
    })
})
</script>