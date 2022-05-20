<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit <?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Please fill up the form</div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('users','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->id; ?>">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-2 col_details">
                                <?php echo $result[0]->first_name.' '.$result[0]->last_name;?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Account Status</label>
                            <div class="col-sm-2 col_details">
                                <?php if($result[0]->status=='s_act'){ echo 'Active'; }else{ echo 'Deactive'; } ?>
                            </div>
                            <div class="col-sm-3">
                                <div class="error form_error" id="form-error-status"></div>
                                <select class="form-control" name="status">
                                    <option value="s_act" <?php if($result[0]->status=='s_act'){ echo 'selected'; } ?>>Active</option>
                                    <option value="s_deact" <?php if($result[0]->status=='s_deact'){ echo 'selected'; } ?>>Deactive</option>                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Block Status</label>
                            <div class="col-sm-2 col_details">
                                <?php if($result[0]->block_status=='b_y'){ echo 'Blocked'; }else{ echo 'Not blocked'; } ?>
                            </div>
                            <div class="col-sm-3">
                                <div class="error form_error" id="form-error-block_status"></div>
                                <select class="form-control" name="block_status">
                                    <option value="b_y" <?php if($result[0]->block_status=='b_y'){ echo 'selected'; } ?>>blocked</option>
                                    <option value="b_n" <?php if($result[0]->block_status=='b_n'){ echo 'selected'; } ?>>Unblocked</option>                                    
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript">
$(document).ready(function() {


  
    $("#data_form").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/users/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/users";
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    $("#code_error").html(responseData.error.message);
                    $("#code_error").addClass('alert-danger');
                }
            }
        });

    }));

});
</script>