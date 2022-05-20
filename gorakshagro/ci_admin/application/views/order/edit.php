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
                        <?php echo anchor('order','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <?php 
                    if($this->session->flashdata('response')){ 
                        $response = $this->session->flashdata('response');
                        
                        if(array_key_exists('error', $response)){
                            echo '<p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p>';
                        }else{
                            echo '<p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p>';
                        }
                    }
                    ?>
                    
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->id; ?>">
                        <input type="hidden" name="order_ref_id" id="order_ref_id" value="<?php echo $order_ref_id; ?>">
                        <input type="hidden" name="current_order_status" id="current_order_status" value="<?php echo $result[0]->order_status_id; ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Order Status</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-order_status"></div>
                                <select class="form-control" name="order_status">
                                    <option value="" disabled>Select status</option>
                                    <?php foreach($order_status_list as $order_status){ ?>
                                    <option value="<?php echo $order_status->id; ?>" <?php if($result[0]->order_status_id==$order_status->id){ echo 'selected'; } ?>><?php echo $order_status->status; ?></option> <?php } ?>                          
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address code</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-address_code"></div>
                                <select class="form-control" name="address_code">
                                    <option value="">Select code</option>
                                    <?php foreach($result_address_codes as $row_address_codes){ ?>
                                    <option value="<?php echo $row_address_codes->code; ?>" <?php if($result[0]->address_code==$row_address_codes->code){ echo 'selected'; } ?>><?php echo $row_address_codes->code; ?></option> <?php } ?>                          
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
            url: "<?php echo base_url(); ?>index.php/order/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.reload(true);
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