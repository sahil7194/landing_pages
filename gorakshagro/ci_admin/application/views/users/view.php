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
                    <div class="col-sm-8"><?php echo $result_userdetails[0]->first_name.' '.$result_userdetails[0]->last_name; ?></div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('users','<button class="btn btn-primary">Back</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Created at</label>
                            <div class="col-sm-9 col_details">
                                <?php echo date('d M Y H:i:s', strtotime($result_userdetails[0]->created_at)); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Updated at</label>
                            <div class="col-sm-9 col_details">
                                <?php echo date('d M Y H:i:s', strtotime($result_userdetails[0]->updated_at)); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9 col_details">
                                <?php if($result_userdetails[0]->status=='s_act'){ echo 'Active'; }else{ echo 'Deactive'; } ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Block Status</label>
                            <div class="col-sm-9 col_details">
                                <?php if($result_userdetails[0]->block_status=='b_y'){ echo 'Blocked'; }else{ echo 'Not blocked'; } ?>
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

    
    <div class="row user_details">

        <!-- Basic Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Basic Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->gender; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Marital Status</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->status; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Date of birth</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->dob; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->city.', '.$result_userdetails[0]->state; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Mother Tongue</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->language; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Basic Details -->

        <!-- Religion Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Religion Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Religion</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->gender; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Cast</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->caste; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <?php if($result_userdetails[0]->sub_caste){ ?>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Sub Caste</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->sub_caste; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Religion Details -->

    </div>
    <!-- /.row -->



    <div class="row user_details">

        <!-- Education Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Education Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Education level</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->education_level; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Education field</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->education_field; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Education Details -->

        <!-- Employment Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Employment Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Profession</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->profession; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Working sector</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->working_sector; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Annual Income</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->income; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Employment Details -->

    </div>
    <!-- /.row -->



    <div class="row user_details">

        <!-- Physical Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Physical Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Height</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->height; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Body type</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->body_type; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Skin type</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->skin_type; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Physical Details -->

        <!-- Other Details -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Other Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Diet</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->diet_type; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Smoke</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->smoke_type; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Drink</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->drink_type; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Steps Completed?</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result_userdetails[0]->step_status; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Other Details -->

    </div>
    <!-- /.row -->


    <div class="row user_details">

        <!-- Photos -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    Photos
                </div>
                <div class="panel-body">
                    <?php foreach($result_photos as $row){ ?>
                    <div class="col-sm-3">
                        <img src="../images/users/profile/<?php echo $row->imagefile1; ?>">
                    </div>
                    <?php } ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- Ends Photos -->


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