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
                        <?php echo anchor('brand','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->id; ?>">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-brand"></div>
                                <input type="text" name="brand" id="brand" class="form-control" placeholder="brand" value="<?php echo $result[0]->brand; ?>">
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
            url: "<?php echo base_url();?>index.php/brand/getData_states",
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
            url: "<?php echo base_url();?>index.php/brand/getData_cities",
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
            url: "<?php echo base_url(); ?>index.php/brand/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/brand";
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