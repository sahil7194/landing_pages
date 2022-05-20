<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add <?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
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
                        <?php echo anchor('subscriptions','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">FB-PSID</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-fb_id"></div>
                                <input type="text" name="fb_id" id="fb_id" class="form-control" placeholder="FB-PSID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Package</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-package"></div>
                                <select class="form-control" name="package">
                                    <?php foreach($result_package as $row_package){ ?>
                                    <option value="<?php echo $row_package->id; ?>_<?php echo $row_package->months; ?>_<?php echo $row_package->price; ?>"><?php echo $row_package->package_name; ?></option>
                                    <?php } ?>                                  
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Order Status</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-order_status"></div>
                                <select class="form-control" name="order_status">
                                    <option value="">Select status</option>
                                    <option value="attempted">Attempted</option>
                                    <option value="success">Success</option>                                    
                                    <option value="failed">Failed</option>                                    
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <p class="alert" id="code_error"></p>
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
            url: "<?php echo base_url();?>index.php/subscriptions/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/subscriptions";
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