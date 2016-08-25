<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <small><?php 
        if($edit == true || $view == true){
            echo "(".(isset($form_data->tagcode)?$form_data->tagcode : '').")";
        } 
        ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('stock'); ?>">Order</a></li>
        <li class="active"><?php echo ($view == true) ? "View" : (($edit) ? "Edit" : "Add")  ?> Order</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Information</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <table id="table" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Total Requsted</th>
                                    <th>Total Limit</th>
                                    <th>Piece</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo ($edit == true ? base_url('order/view/'.set_value('id', (isset($form_data->id)?$form_data->id : ''))) : base_url('order')); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                        <?php } ?>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Select Stock</h4>
            </div>
            <div class="modal-body" id="modal-content">
                <i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i>
                <span class="sr-only">Refreshing...</span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
$(function(){
    $("#delete-item").click(function(){
        if(confirm("Sure delete unit ?")){
            $("#delete-form").submit();
        }
    });
    $('#search-item').click(function () {
        $.get('<?php echo base_url("stock/stocklist"); ?>',[],function(result){
            $("#modal-content").html(result);
        });
    });
});
function selectedItem(id,name,currentstock,stockunit){
    if(currentstock != 0){
        var row = "<tr>";
        row += "<td>"+name+"</td>";
        row += '<td>';
        row += '<input type="number" name="detail.total[]" class="form-control" />';
        row += '<input type="hidden" name="detail.itemid[]" value="'+id+'" />';
        row += '<input type="hidden" name="detail.itemname[]" value="'+id+'" />';
        row += '</td>';
        row += "<td>"+currentstock+"</td>";
        row += "<td>"+stockunit+"</td>";
        row += '<td onClick="deleteitem(this)" style="cursor:pointer;"><i class="fa fa-trash"></i></td>';
        row += "</tr>";
        $("#table > tbody").append(row);
    }else{
        alert("Stock not enough");
    }
    $("#modal-content").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">Refreshing...</span>');
    $('#myModal').modal('hide')
}
function deleteitem(data){
    $(data).parent("tr").remove();
}
</script>