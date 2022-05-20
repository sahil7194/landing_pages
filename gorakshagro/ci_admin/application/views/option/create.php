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
                        <?php echo anchor('option','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-name"></div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Option Value Name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-options"></div>
                                <div class="option_value_names">
                                    <div class="inner_row">
                                        <div class="inner_row_field"><input type="text" name="options[]" class="form-control" placeholder="Option Value Name"> </div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="inner_row">
                                        <div class="inner_row_field"><input type="text" name="options[]" class="form-control" placeholder="Option Value Name"> </div>
                                        <div class="clr"></div>
                                    </div>
                                </div>

                                <div class="inner_row">
                                    <input type="button" class="btn btn-primary" id="add_option" value="+ Add Option">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <input type="submit" class="btn btn-primary" id="submit" value="Submit">
                            </div>
                            <div class="col-sm-7">
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

    $("#add_option").on('click', function(){
        $(".option_value_names").append('<div class="inner_row"><div class="inner_row_field"><input type="text" name="options[]" class="form-control" placeholder="Option Value Name"> </div><div class="remove_field remove_icon"><i class="fa fa-minus-circle" aria-hidden="true"></i></div><div class="clr"></div></div>');
    });

    $(".option_value_names").on('click', '.remove_field', function(){
        $(this).closest(".inner_row").fadeOut(300);
    });

    $("#data_form").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/option/store",
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