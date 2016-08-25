<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Order List
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Order</a></li>
        <li class="active">Order List</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('order/add');  ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Order</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-hover table-strip">
                        <thead>
                            <tr>
                                <th>Tag Code</th>
                                <th>Username</th>
                                <th>Item Ordered</th>
                                <th>Process Status</th>
                                <th>Data Status</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($orderlist as $row){
                                    ?>
                                    <tr>
                                        <a href="<?php echo base_url('order/view/'.$row->id); ?>">
                                        <td><?php echo $row->tagcode; ?></td>
                                        <td><?php echo $row->username; ?></td>
                                        <td><?php echo $row->itemcount; ?></td>
                                        <td><?php echo $row->statusname; ?></td>
                                        <td><?php echo ($row->isdeleted != true ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'); ?></td>
                                        <td><?php echo date("l, F d Y - H:i", strtotime($row->orderdate)); ?></td>
                                        </a>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $("#table").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    })
</script>