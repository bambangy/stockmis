<table id="tablemodal" class="table table-hover table-strip">
    <thead>
        <tr>
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
                <tr onClick="selectedItem('<?php echo $row->id; ?>', '<?php echo $row->name; ?>', 
                <?php echo $row->currentstock; ?>, '<?php echo $row->stockunit; ?>');" style="cursor:pointer;">
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
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script>
    $("#tablemodal").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
</script>