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
        <li><a href="<?php echo base_url('item'); ?>">Item</a></li>
        <li class="active">Add Item</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Item Information</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" 
                                        value="<?php echo set_value('code', isset($form_data->code)?$form_data->code : ''); ?>" name="code" placeholder="Code"
                                        <?php if($view == TRUE){ echo "disabled"; } ?> maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" 
                                        value="<?php echo set_value('name', isset($form_data->name)?$form_data->name : ''); ?>" placeholder="Item Name" 
                                        <?php if($view == TRUE){ echo "disabled"; } ?> required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Item Piece</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('stockunit', $pieceoptions, 
                                        set_value('stockunit', isset($form_data->stockunit)?$form_data->stockunit : ''), 
                                        'class="form-control" '.($view == true ? "disabled" : "" ).' required'); ?>
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
                        <?php }
                        if($edit == true){
                         ?>
                            <span id="delete-item" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete</span>
                         <?php } ?>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<?php
if($edit == true){
    ?>
    <form id="delete-form" action="<?php echo base_url('item/delete'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
    </form>
    <?php
}
?>
<script>
$(function(){
    $("#delete-item").click(function(){
        if(confirm("Sure delete unit ?")){
            $("#delete-form").submit();
        }
    });
});
</script>