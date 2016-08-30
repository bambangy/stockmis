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
        <li><a href="<?php echo base_url('Category'); ?>">Category</a></li>
        <li class="active"><?php echo ($view == true) ? "View" : (($edit) ? "Edit" : "Add")  ?> Category</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Category Information</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Parent</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('parent', $catoptions, 
                                        set_value('parent', isset($form_data->parent)?$form_data->parent : ''), 
                                        'class="form-control" '.($view == true ? "disabled" : "" )); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" 
                                        value="<?php echo set_value('name', isset($form_data->name)?$form_data->name : ''); ?>" placeholder="Unit Name" 
                                        <?php if($view == TRUE){ echo "disabled"; } ?> required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo ($edit == true ? base_url('category/view/'.set_value('id', (isset($form_data->id)?$form_data->id : ''))) : base_url('category')); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('category/edit/'.(isset($form_data->id)?$form_data->id : '')); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                        <?php }
                        if($edit == true){
                         ?>
                            <span id="delete-unit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete</span>
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
    <form id="delete-form" action="<?php echo base_url('category/delete'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
    </form>
    <?php
}
?>
<script>
$(function(){
    $("#delete-unit").click(function(){
        if(confirm("Sure delete unit ?")){
            $("#delete-form").submit();
        }
    });
});
</script>