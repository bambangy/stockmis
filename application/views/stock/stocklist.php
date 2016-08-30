<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Stock List
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Stock</a></li>
        <li class="active">Stock List</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('stock/add');  ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Stock</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-hover table-strip">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Item Name</th>
                                <th>Current Stock</th>
                                <th>Item Piece</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($stocklist as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row->catname; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->currentstock; ?></td>
                                        <td><?php echo $row->stockunit; ?></td>
                                        <td><?php echo date("l, F d Y - H:i", strtotime($row->stockdate)); ?></td>
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