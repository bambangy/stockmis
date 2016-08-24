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
        <li><a href="<?php echo base_url('user'); ?>">User</a></li>
        <li class="active"><?php echo ($view == true) ? "View" : (($edit) ? "Edit" : "Add")  ?> User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Information</h3>
                </div>
                <form class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" 
                                        value="<?php echo set_value('name', isset($form_data->name)?$form_data->name : ''); ?>" name="name" placeholder="Name"
                                        <?php if($view == TRUE){ echo "disabled"; } ?> required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" 
                                        value="<?php echo set_value('username', isset($form_data->username)?$form_data->username : ''); ?>" placeholder="Username" 
                                        <?php if($edit == TRUE){ echo "readonly"; } ?> <?php if($view == TRUE){ echo "disabled"; } ?> required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('roleid', $roleoptions, 
                                        set_value('roleid', isset($form_data->roleid)?$form_data->roleid : ''), 
                                        'class="form-control" '.($view == true ? "disabled" : "" ).' required'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unit</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('unitid', $unitoptions, 
                                        set_value('unitid', isset($form_data->unitid)?$form_data->unitid : ''), 
                                        'class="form-control" '.($view == true ? "disabled" : "" )); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($view != true){ ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" placeholder="Password" 
                                        value="<?php echo set_value('password', isset($form_data->password)?$form_data->password : ''); ?>"
                                        <?php if($edit != true){ echo "required"; } ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" 
                                        value="<?php echo set_value('confirmpassword', isset($form_data->confirmpassword)?$form_data->confirmpassword : ''); ?>"
                                        <?php if($edit != true){ echo "required"; } ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('status', $statusoptions, 
                                        set_value('status', isset($form_data->isactive)?$form_data->isactive : ''), 
                                        'class="form-control" '.($view == true ? "disabled" : "" )); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo ($edit == true ? base_url('user/view/'.set_value('id', (isset($form_data->id)?$form_data->id : ''))) : base_url('user')); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('user/edit/'.(isset($form_data->id)?$form_data->id : '')); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                        <?php }
                        if($edit == true){
                         ?>
                            <span id="delete-user" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete</span>
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
    <form id="delete-form" action="<?php echo base_url('user/delete'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
    </form>
    <?php
}
?>
<script>
$(function(){
    $("#delete-user").click(function(){
        if(confirm("Sure delete user ?")){
            $("#delete-form").submit();
        }
    });
});
</script>