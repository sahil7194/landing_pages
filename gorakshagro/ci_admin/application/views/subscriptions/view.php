<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View <?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Order Id: #<?php echo $result[0]->receipt; ?></div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('subscriptions/edit/'.$result[0]->id,'<button class="btn btn-primary">Edit</button>');?>
                        <?php echo anchor('subscriptions','<button class="btn btn-primary">Back</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9 col_details">
                                <?php echo date('d M Y H:i:s', strtotime($result[0]->datentime)); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Customer Name</label>
                            <div class="col-sm-9 col_details">
                                <?php echo anchor('users/view/'.$result[0]->fb_id, $result[0]->first_name.' '.$result[0]->last_name, array('target'=>'_blank')); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Razorpay Order ID</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->razorpay_order_id; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Razorpay Signature</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->razorpay_signature; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Package</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->package_name; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->amount; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Expire Date</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->expire_date; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Order Status</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->order_status; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                    

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

    $("#country").on('change', function(){
        
        var country_id = $(this).val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/users/regionsGetData",
            data:  {country_id:country_id},
            dataType: 'json',
            success: function(result) {
                $("#region option").remove();
                $("#region").append('<option value="">Select Region</option>');
                jQuery.each( result.success, function( i, val ) {                    
                    $("#region").append('<option value="'+val['id']+'">'+val['region']+'</option>');
                });
            },
            error: function(data){
                
            }
        });

    });

  
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