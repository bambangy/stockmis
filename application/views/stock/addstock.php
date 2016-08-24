<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <small><?php 
        if($edit == true || $view == true){
            echo "(".set_value('name', isset($form_data->name)?$form_data->name : '').")";
        } 
        ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('stock'); ?>">Stock</a></li>
        <li class="active"><?php echo ($view == true) ? "View" : (($edit) ? "Edit" : "Add")  ?> Stock</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Stock Information</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Item</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" 
                                            value="<?php echo set_value('itemname', isset($form_data->itemname)?$form_data->itemname : ''); ?>" 
                                            name="itemname" id="itemname" placeholder="Select Item" required>
                                            <span class="input-group-btn">
                                                <button type="button" id="search-item" 
                                                data-toggle="modal" data-target="#myModal"
                                                class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="itemid" name="itemid" 
                                    value="<?php echo set_value('itemid', isset($form_data->itemid)?$form_data->itemid : ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Current Stock</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="currentstock" 
                                        value="<?php echo set_value('currentstock', isset($form_data->currentstock)?$form_data->currentstock : ''); ?>"
                                        placeholder="Current Stock" 
                                        required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Note</label>
                                    <div class="col-sm-11">
                                        <textarea
                                        name="note" class="form-control"  rows="10"
                                        ><?php echo set_value('note', isset($form_data->note)?$form_data->note : ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo ($edit == true ? base_url('item/view/'.set_value('id', (isset($form_data->id)?$form_data->id : ''))) : base_url('item')); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('item/edit/'.(isset($form_data->id)?$form_data->id : '')); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
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
            <h4 class="modal-title">Select Item</h4>
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
        $.get('<?php echo base_url("item/itemlist"); ?>',[],function(result){
            $("#modal-content").html(result);
        });
    });
});
function selectedItem(id,name,code,piece){
    $("#itemid").val(id);
    $("#itemname").val(name);
    $("#modal-content").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">Refreshing...</span>');
    $('#myModal').modal('hide')
}
</script>