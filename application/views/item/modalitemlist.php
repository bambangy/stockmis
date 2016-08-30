<table id="tablemodal" class="table table-hover table-strip">
    <thead>
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Item Piece</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($itemlist as $row){
                ?>
                <tr onClick="selectedItem('<?php echo $row->id; ?>', '<?php echo $row->name; ?>', 
                '<?php echo $row->code; ?>', '<?php echo $row->stockunit; ?>');" style="cursor:pointer;">
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->code; ?></td>
                    <td><?php echo $row->stockunit; ?></td>
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