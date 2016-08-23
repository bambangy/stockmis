<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Add user</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">User Information</h3>
                </div>
                <form class="form-horizontal" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id'); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo set_value('name'); ?>" name="name" placeholder="Name"
                                        <?php if($view == TRUE){ echo "disabled"; } ?> required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" 
                                        <?php if($edit == TRUE){ echo "readonly"; } ?> required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('roleid', $roleoptions, set_value('roleid'), 'class="form-control" '.($view == true ? "disabled" : "" ).' required'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unit</label>
                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('unitid', $unitoptions, set_value('unitid'), 'class="form-control" '.($view == true ? "disabled" : "" )); ?>
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
                                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" value="<?php echo set_value('confirmpassword'); ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo base_url('user'); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('user/edit/'.set_value("id")); ?>" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                        <?php } ?>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>