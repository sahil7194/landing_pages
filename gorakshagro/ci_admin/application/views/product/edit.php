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
                        <?php echo anchor('product/create','<button class="btn btn-primary">Add new</button>');?>
                        <?php echo anchor('product','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" id="dataId" value="<?php echo $result[0]->id; ?>">
                        <input type="hidden" name="existing_slug" id="existing_slug" value="<?php echo $result[0]->slug; ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-vendor_id"></div>
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    <?php foreach($result_vendors as $vendor){ ?>
                                        <option value="<?php echo $vendor->id; ?>" <?php if($result[0]->vendor_id==$vendor->id){ echo 'selected'; } ?>><?php echo $vendor->vendor_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Parent Category</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-category_id"></div>                               
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0">Select Category</option>
                                    <?php
                                    foreach($result_categories as $row_categories){ 

                                        if($row_categories->parent_id==0){
                                    ?>
                                            <option value="<?php echo $row_categories->id; ?>" <?php if($row_categories->id==$result[0]->category_id){ echo 'selected'; } ?>><?php echo $row_categories->category; ?></option>
                                    <?php
                                            foreach($result_categories as $row_subcategories){

                                                if($row_categories->id==$row_subcategories->parent_id){

                                    ?>
                                                    <option value="<?php echo $row_subcategories->id; ?>" <?php if($row_subcategories->id==$result[0]->category_id){ echo 'selected'; } ?>><?php echo $row_categories->category.' >> '.$row_subcategories->category; ?></option>

                                    <?php
                                                }

                                            }

                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product name</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_name"></div>
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product name" value="<?php echo $result[0]->product_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-description"></div>
                                <textarea name="description" id="description" class="toolbar" placeholder="Description"><?php echo $result[0]->description; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_model"></div>
                                <input type="text" name="product_model" id="product_model" class="form-control" placeholder="Product Model" value="<?php echo $result[0]->product_model; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">SKU</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-sku"></div>
                                <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU" value="<?php echo $result[0]->sku; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-price"></div>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="<?php echo $result[0]->price; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Special Price</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-special_price"></div>
                                <input type="text" name="special_price" id="special_price" class="form-control" placeholder="Special Price" value="<?php echo $result[0]->special_price; ?>">
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-quantity"></div>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="<?php echo $result[0]->quantity; ?>">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-brand"></div>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    <?php foreach($brands as $brand){ ?>
                                        <option value="<?php echo $brand->id; ?>" <?php if($result[0]->brand_id==$brand->id){ echo 'selected'; } ?>><?php echo $brand->brand; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta title</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_title"></div>
                                <textarea name="meta_title" id="meta_title" class="form-control" placeholder="Meta title"><?php echo $result[0]->meta_title; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta Description</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_description"></div>
                                <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description"><?php echo $result[0]->meta_description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta Keywords</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_keywords"></div>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Meta Keywords"><?php echo $result[0]->meta_keywords; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Tags (Comma Separated)</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_tags"></div>
                                <input type="text" name="product_tags" id="product_tags" class="form-control" placeholder="Product Tags" value="<?php echo $result[0]->product_tags; ?>">
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




    <!--Product Images -->

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
    <!-- /.row -->
    <div class="row" id="product_images_section">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Product Images</div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Images</label>
                        <div class="col-sm-10">
                        <?php 
                            foreach ($images as $image) {
                        ?>
                                <div class="product_images_box" id="pib_<?php echo $image->id; ?>">
                                    <div class="select_display_image"><input type="radio" name="display_image" class="set_display_image" value="<?php echo $image->imagefile1; ?>" title="Set Display Image" <?php if($result[0]->product_image==$image->imagefile1){ echo 'checked'; } ?>></div>
                                    <div class="product_image">
                                        <a class="venobox" data-gall="myGallery" href="../images/uploads/products/<?php echo $image->imagefile1; ?>"><img src="../images/uploads/products/thumbs/<?php echo $image->imagefile1; ?>"></a>
                                    </div>
                                    <div class="remove_image remove_icon" data-id="<?php echo $image->id; ?>" title="Remove this image">
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
                        <?php 
                            }
                        ?>
                        </div>
                    </div>
                    
                    <form action="" method="POST" id="dataImage_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" value="<?php echo $result[0]->id; ?>">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image (570x675)</label>
                            <div class="col-sm-10">
                              <div class="error form_error" id="form-error-imagefile1"></div>
                              <input type="file" name="imagefile1">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submitImage" value="Add">
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





    <!--Product Options -->

    <?php 
    if($this->session->flashdata('responseOptions')){ 
        $response = $this->session->flashdata('responseOptions');
        
        if(array_key_exists('error', $response)){
            echo '<p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p>';
        }else{
            echo '<p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p>';
        }
    }
    ?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Product Options</div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Options</label>
                        <div class="col-sm-10">
                            <?php 
                            foreach($result_product_option_groups as $product_option_group){

                                echo '<strong>'.$product_option_group->group.'</strong>';

                                foreach($result_product_options as $product_option){

                                    if($product_option_group->option_group_id == $product_option->option_group_id){

                            ?>
                                        <div class="remove_icon" id="po_<?php echo $product_option->product_option_id; ?>" title="Remove this option">

                                            <?php echo $product_option->option; ?>
                                            - Rs. <input type="text" class="input_db" id="po_price_<?php echo $product_option->product_option_id; ?>" value="<?php echo $product_option->amount; ?>">
                                            - Qty. <input type="text" class="input_db" id="po_qty_<?php echo $product_option->product_option_id; ?>" value="<?php echo $product_option->qty; ?>">

                                            <input type="button" class="update_product_option" data-id="<?php echo $product_option->product_option_id; ?>" value="Update">

                                            <i class="fa fa-minus-circle remove_product_option" aria-hidden="true" data-id="<?php echo $product_option->product_option_id; ?>"></i>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                    <form action="" method="POST" id="dataOption_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" value="<?php echo $result[0]->id; ?>">
                        <input type="hidden" name="selected_option"  id="selected_option" value="">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select</label>
                            <div class="col-sm-10">
                                <div class="col-sm-4">
                                    <div class="error form_error" id="form-error-option_id"></div>
                                    <select class="form-control" name="option_id" id="option_id">
                                        <option value="">Select Option</option>
                                        <?php foreach($result_option_groups as $group){ ?>
                                            <option value="" disabled><?php echo $group->name; ?></option>
                                            <?php 
                                            foreach($result_options as $option){ 
                                                if($option->option_group_id==$group->id){
                                            ?>
                                                <option value="<?php echo $option->id; ?>">- <?php echo $option->name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>        
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="error form_error" id="form-error-qty"></div>
                                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Qty">
                                </div>                                
                                <div class="col-sm-4">
                                    <div class="error form_error" id="form-error-option_amount"></div>
                                    <input type="text" name="option_amount" id="option_amount" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submitImage" value="Add">
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





    <!--Product Status -->

    <?php 
    if($this->session->flashdata('responseStatus')){ 
        $response = $this->session->flashdata('responseStatus');
        
        if(array_key_exists('error', $response)){
            echo '<p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p>';
        }else{
            echo '<p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p>';
        }
    }
    ?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Product Status</div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">                    
                    
                    <form action="" method="POST" id="dataStatus_form" enctype="multipart/form-data">
                        <input type="hidden" name="dataId" value="<?php echo $result[0]->id; ?>">
                        
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
                                <input type="submit" class="btn btn-primary" id="submitImage" value="Update">
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
            url: "<?php echo base_url(); ?>index.php/product/store",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href="<?php echo base_url();?>index.php/product";
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

    $("#dataImage_form").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/storeImage",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload(true);
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

    $(".set_display_image").on('click',function(){
        var product_id = $("#dataId").val();
        var image = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/set_display_image",
            data: {product_id:product_id,image:image},
            dataType: 'json',
            success: function(result) {
              
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });
    });

    $(".remove_image").on('click',function(){
        var data_id = $(this).data('id');
        var product_id = <?php echo $result[0]->id; ?>;        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/delete_image",
            data: {data_id:data_id,product_id:product_id},
            dataType: 'json',
            success: function(result) {
              $("#pib_"+data_id).fadeOut();
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });
    });    


    // $("#attribute_id").change(function(){
    //     var attribute = $("#attribute_id option:selected").html();
    //     $("#selected_attribute").val(attribute);        
    // });

    $(".update_product_option").on('click',function(){
        var product_option_id = $(this).data('id');
        var product_option_price = $("#po_price_"+product_option_id).val();
        var product_option_qty = $("#po_qty_"+product_option_id).val();
        var product_id = <?php echo $result[0]->id; ?>;        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/update_product_option",
            data: {product_option_id:product_option_id,product_option_price:product_option_price,product_option_qty:product_option_qty,product_id:product_id},
            dataType: 'json',
            success: function(result) {
              location.reload(true);
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });
    });

    $(".remove_product_option").on('click',function(){
        var product_option_id = $(this).data('id');
        var product_id = <?php echo $result[0]->id; ?>;     


        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/remove_product_option",
            data: {product_option_id:product_option_id,product_id:product_id},
            dataType: 'json',
            success: function(result) {
              $("#po_"+product_option_id).fadeOut();
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });
    });

    
    $("#dataOption_form").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/storeOptions",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload(true);
            },
            error: function(data){
                var responseData = data.responseJSON;

                jQuery.each( responseData.error.errors, function( i, val ) {
                    $("#form-error-"+i).html(val);
                });              
            }
        });

    }));

    $("#dataStatus_form").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/product/updateStatus",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload(true);
            },
            error: function(data){
                var responseData = data.responseJSON;

                jQuery.each( responseData.error.errors, function( i, val ) {
                    $("#form-error-"+i).html(val);
                });              
            }
        });

    }));


});
</script>

<script src="venobox/venobox.min.js"></script>
    <script>
    $(document).ready(function(){
      $('.venobox').venobox({
        framewidth: '800px'
      }); 
    });
</script>