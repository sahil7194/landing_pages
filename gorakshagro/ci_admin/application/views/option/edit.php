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
                        <?php echo anchor('option','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->group_id; ?>">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-name"></div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="name" value="<?php echo $result[0]->group; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Option Value Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-options"></div>
                                <div class="option_value_names">
                                    <?php foreach($result as $row){ ?>
                                    <div class="inner_row">                                        
                                        <div class="inner_row_field">
                                            <input type="hidden" name="options_id[]" value="<?php echo $row->id; ?>">
                                            <input type="text" name="options[]" class="form-control" placeholder="Option Value Name" value="<?php echo $row->option; ?>">
                                        </div>

                                        <div class="remove_field remove_icon" data-id="<?php echo $row->id; ?>" id="rm_<?php echo $row->id; ?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></div>
                                        <div class="clr"></div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="inner_row">
                                    <input type="button" class="btn btn-primary" id="add_option" value="+ Add Option">
                                </div>
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

    $("#add_option").on('click', function(){
        $(".option_value_names").append('<div class="inner_row"><div class="inner_row_field"><input type="hidden" name="options_id_new[]" value="<?php echo $row->id; ?>"><input type="text" name="options_new[]" class="form-control" placeholder="Option Value Name"> </div><div class="remove_field_new remove_icon"><i class="fa fa-minus-circle" aria-hidden="true"></i></div><div class="clr"></div></div>');
    });

    $(".option_value_names").on('click', '.remove_field_new', function(){
        $(this).closest(".inner_row").fadeOut(300);
    });

    $(".option_value_names").on('click', '.remove_field', function(){

        var data_id = $(this).data('id');     

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/option/remove_option_value_name",
            data: {data_id:data_id},
            dataType: 'json',
            success: function(result) {
                $("#rm_"+data_id).closest(".inner_row").fadeOut(300);
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });

    });
  
    $("#data_form").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/option/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/option";
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