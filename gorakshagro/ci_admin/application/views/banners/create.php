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
                        <?php echo anchor('banners','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">						
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Device</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-device"></div>
                                <select class="form-control" name="device">
                                    <option value="desktop">Desktop (1600x600)</option>
                                    <option value="mobile">Mobile (500x500)</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <div class="error form_error" id="form-error-imagefile1"></div>
                              <input type="file" name="imagefile1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alt</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-alt"></div>
                                <input type="text" name="alt" id="alt" class="form-control"  placeholder="Alt">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Url</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-url"></div>
                                <input type="text" name="url" id="url" class="form-control"  placeholder="Url">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sort Order</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-sort_order"></div>
                                <input type="text" name="sort_order" id="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-status"></div>
                                <select class="form-control" name="status">
                                    <option value="s_act">Active</option>
                                    <option value="s_deact">Deactive</option>                                    
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
        $(".form_error").html("");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/banners/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href='<?php echo base_url(); ?>index.php/banners';
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='file'){
                    $("#form-error-"+responseData.error.error_field).html(responseData.error.errors);
                }else{
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }
              
            }
        });

    }));

});
</script>