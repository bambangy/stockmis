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
                <form id="form-order" class="form-horizontal" action="<?php echo base_url($form_action); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo set_value('id', isset($form_data->id)?$form_data->id : ''); ?>" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="btn btn-success" id="search-item"
                                data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-search"></i> Search Item
                                </span>
                            </div>
                        </div>
                        <br/>
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
                            <?php
                                foreach($form_data["details"] as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $row["itemname"]; ?></td>
                                        <td>
                                            <input type="number" name="detailtotal[]" value="<?php echo $row["total"]; ?>" class="form-control total" />
                                            <input type="hidden" name="detailitemid[]" value="<?php echo $row["itemid"]; ?>" />
                                            <input type="hidden" name="detailitemname[]" value="<?php echo $row["itemname"]; ?>" />
                                            <input type="hidden" name="detailitemlimit[]" value="<?php echo $row["limit"]; ?>" />
                                            <input type="hidden" name="detailitemunit[]" value="<?php echo $row["unit"]; ?>" />
                                        </td>
                                        <td class="limitstock"><?php echo $row["limit"]; ?></td>
                                        <td><?php echo $row["unit"]; ?></td>
                                        <td onClick="deleteitem(this)" style="cursor:pointer;"><i class="fa fa-trash"></i></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?php echo ($edit == true ? base_url('order/view/'.set_value('id', (isset($form_data->id)?$form_data->id : ''))) : base_url('order')); ?>" class="btn btn-default">Cancel</a>
                        <?php if($view == false){ ?>
                            <span id="submit-order" class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</span>
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
    $("#submit-order").click(function(){
        $(this).attr("disabled",true);
        $(this).html('<i class="fa fa-refresh fa-spin fa-fw" aria-hidden="true"></i><span class="sr-only">Please wait...</span>');
        if(checktotal()){
            $("#form-order").submit();
        }else{
            $(this).attr("disabled",false);
            $(this).html('<i class="fa fa-floppy-o"></i> Save');
        }
    });
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
    function checktotal(){
        var result = true;
        $("#table > tbody tr").each(function(){
            if($(this).find("td > input.total").val() <= 0){
                alert($(this).children("td:first-child").html()+" total must filled. At least 1.");
                result = false;
                return false;
            }
            if(parseFloat($(this).find("td.limitstock").html()) < $(this).find("td > input.total").val()){
                alert("Order of "+$(this).children("td:first-child").html()+" can not more than stock limit.");
                result = false;
                return false;
            }
        });
        if($("#table > tbody tr").length <= 0){
            alert("Order must contain at least 1 stock.");
            return false;
        }
        return result;
    }
});
function selectedItem(id,name,currentstock,stockunit){
    if(currentstock != 0){
        if(!checkifexists(name)){
            var row = "<tr>";
            row += "<td>"+name+"</td>";
            row += '<td>';
            row += '<input type="number" name="detailtotal[]" class="form-control total" />';
            row += '<input type="hidden" name="detailitemid[]" value="'+id+'" />';
            row += '<input type="hidden" name="detailitemname[]" value="'+name+'" />';
            row += '<input type="hidden" name="detailitemlimit[]" value="'+currentstock+'" />';
            row += '<input type="hidden" name="detailitemunit[]" value="'+stockunit+'" />';
            row += '</td>';
            row += '<td class="limitstock">'+currentstock+"</td>";
            row += "<td>"+stockunit+"</td>";
            row += '<td onClick="deleteitem(this)" style="cursor:pointer;"><i class="fa fa-trash"></i></td>';
            row += "</tr>";
            $("#table > tbody").append(row);
        }
    }else{
        alert("Stock not enough to ordered");
    }
    $("#modal-content").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i><span class="sr-only">Refreshing...</span>');
    $('#myModal').modal('hide')
}
function deleteitem(data){
    $(data).parent("tr").remove();
}
function checkifexists(name){
    var result = false;
    $("#table > tbody tr").each(function(){
        if($(this).children("td:first-child").html() === name){
            alert("Stock already exists");
            result = true;
        }
    });
    return result;
}
</script>