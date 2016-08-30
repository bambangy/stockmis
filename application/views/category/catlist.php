<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<section class="content-header">
    <h1>
        Category List
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
        <li class="active">Category List</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('category/add');  ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Category</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-hover table-strip">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Parent category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($catlist as $row){
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo base_url('category/view/'.$row->id); ?>"><?php echo $row->name; ?></a></td>
                                        <td><a href="<?php echo base_url('category/view/'.$row->parentid); ?>"><?php echo $row->parentname; ?></a></td>
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