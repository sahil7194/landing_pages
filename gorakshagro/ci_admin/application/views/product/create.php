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
                        <?php echo anchor('product','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-vendor_id"></div>
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    <?php foreach($result_vendors as $vendor){ ?>
                                        <option value="<?php echo $vendor->id; ?>"><?php echo $vendor->vendor_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-category_id"></div>                               
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0">Select Category</option>
                                    <?php
                                    foreach($result_categories as $row_categories){ 

                                        if($row_categories->parent_id==0){
                                    ?>
                                            <option value="<?php echo $row_categories->id; ?>"><?php echo $row_categories->category; ?></option>
                                    <?php
                                            foreach($result_categories as $row_subcategories){

                                                if($row_categories->id==$row_subcategories->parent_id){

                                    ?>
                                                    <option value="<?php echo $row_subcategories->id; ?>"><?php echo $row_categories->category.' >> '.$row_subcategories->category; ?></option>

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
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-description"></div>
                                <textarea name="description" id="description" class="toolbar" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_model"></div>
                                <input type="text" name="product_model" id="product_model" class="form-control" placeholder="Product Model">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">SKU</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-sku"></div>
                                <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-price"></div>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Special Price</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-special_price"></div>
                                <input type="text" name="special_price" id="special_price" class="form-control" placeholder="Special Price">
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-quantity"></div>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-brand"></div>
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    <?php foreach($brands as $brand){ ?>
                                        <option value="<?php echo $brand->id; ?>"><?php echo $brand->brand; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta title</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_title"></div>
                                <textarea name="meta_title" id="meta_title" class="form-control" placeholder="Meta title"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta Description</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_description"></div>
                                <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Meta Keywords</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-meta_keywords"></div>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Meta Keywords"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Tags (Comma Separated)</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_tags"></div>
                                <input type="text" name="product_tags" id="product_tags" class="form-control" placeholder="Product Tags">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-status"></div>
                                <select class="form-control" name="status">
                                    <option value="0">Deactive</option>
                                    <option value="1">Active</option>                                    
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
            url: "<?php echo base_url();?>index.php/product/store",
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

});
</script>