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
                        <?php echo anchor('vendors','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->id; ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vendor Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-vendor_name"></div>
                                <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Vendor Name" value="<?php echo $result[0]->vendor_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-first_name"></div>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $result[0]->first_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-last_name"></div>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $result[0]->last_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-email"></div>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $result[0]->email; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-phone"></div>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="<?php echo $result[0]->phone; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-mobile"></div>
                                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="<?php echo $result[0]->mobile; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fax</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-fax"></div>
                                <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax" value="<?php echo $result[0]->fax; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address1</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-address1"></div>
                                <input type="text" name="address1" id="address1" class="form-control" placeholder="Address1" value="<?php echo $result[0]->address1; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address2</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-address2"></div>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Address2" value="<?php echo $result[0]->address2; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pincode</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-pincode"></div>
                                <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" value="<?php echo $result[0]->pincode; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-country_id"></div>                               
                                <select class="form-control" name="country_id" id="country_id">
                                    <option value="">Select Country</option>
                                    <?php foreach($result_countries as $row_countries){ ?>
                                        <option value="<?php echo $row_countries->id; ?>" <?php if($result[0]->country_id==$row_countries->id){ echo 'selected'; } ?>><?php echo $row_countries->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">State</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-state_id"></div>                               
                                <select class="form-control" name="state_id" id="state_id">
                                    <option value="">Select State</option>
                                    <?php foreach($result_states as $row_states){ ?>
                                        <option value="<?php echo $row_states->id; ?>" <?php if($result[0]->state_id==$row_states->id){ echo 'selected'; } ?>><?php echo $row_states->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-city_id"></div>                               
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="">Select City</option>
                                    <?php foreach($result_cities as $row_cities){ ?>
                                        <option value="<?php echo $row_cities->id; ?>" <?php if($result[0]->city_id==$row_cities->id){ echo 'selected'; } ?>><?php echo $row_cities->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-status"></div>
                                <select class="form-control" name="status">
                                    <option value="1" <?php if($result[0]->status=='1'){ echo 'selected'; } ?>>Active</option>
                                    <option value="0" <?php if($result[0]->status=='0'){ echo 'selected'; } ?>>Deactive</option>                                    
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

    $("#country_id").on('change', function(){
        
        var country_id = $(this).val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/vendors/getData_states",
            data:  {country_id:country_id},
            dataType: 'json',
            success: function(result) {
                $("#state_id option").remove();
                $("#state_id").append('<option value="">Select State</option>');
                jQuery.each( result.success, function( i, val ) {                    
                    $("#state_id").append('<option value="'+val['id']+'">'+val['name']+'</option>');
                });
            },
            error: function(data){
                
            }
        });

    });


    $("#state_id").on('change', function(){
        
        var state_id = $(this).val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/vendors/getData_cities",
            data:  {state_id:state_id},
            dataType: 'json',
            success: function(result) {
                $("#city_id option").remove();
                $("#city_id").append('<option value="">Select City</option>');
                jQuery.each( result.success, function( i, val ) {                    
                    $("#city_id").append('<option value="'+val['id']+'">'+val['name']+'</option>');
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
            url: "<?php echo base_url(); ?>index.php/vendors/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/vendors";
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