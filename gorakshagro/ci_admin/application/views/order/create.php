<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create <?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <?php 
      if($this->session->flashdata('response')){
        $response = $this->session->flashdata('response');
        if(array_key_exists('error', $response)){
            echo '<div class="notification"><p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p></div>';
        }else{
            echo '<div class="notification"><p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p></div>';
        }
      }
    ?>


    <?php if($this->cart->total_items() > 0){ ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">Records</div>                    
                    <div class="clr"></div>
                </div>                

                <div class="panel-body">

                  <table class="table table-striped table-bordered">
                        <tr>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                        <tbody>
                      <?php $i = 1; ?>

                      <?php foreach ($this->cart->contents() as $items){ ?>

                      <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                      <tr class="cart_item">
                        <td class="product-name">
                          <?php echo $items['name']; ?>

                          <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                          <ul>
                            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                            <li><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?></li>

                            <?php endforeach; ?>
                          </ul>
                          <?php endif; ?>

                        </td>
                        <td class="product-price">
                          <span class="amount">Rs.<?php echo $this->cart->format_number($items['price']); ?></span>
                        </td>
                        <td class="product-quantity">
                          <div class="quantity buttons_added">
                            <?php echo $items['qty']; ?>
                          </div>
                          <div class="remove_item_box"><a class="remove remove_item" title="Remove this item" data-row_id="<?php echo $items['rowid']; ?>">Remove</a></div>
                        </td>
                        <td class="product-subtotal">
                          <span class="amount">Rs.<?php echo $this->cart->format_number($items['subtotal']); ?></span>
                        </td>
                        <td class="product-remove">
                          <a class="remove remove_item" title="Remove this item" data-row_id="<?php echo $items['rowid']; ?>"></a>
                        </td>
                      </tr>

                      <?php
                        $i++;
                      }
                      ?>

                    </tbody>
                  </table>

                  <strong><span class="amount">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></span></strong>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <?php } ?>


<?php if($this->cart->total_items() > 0){ ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">Customer Details</div>                    
                    <div class="clr"></div>
                </div>                

                <div class="panel-body">
                  
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Customer</label>
                      <div class="col-sm-4">
                          <div class="error form_error" id="form-error-customer_id"></div>
                          <select name="customer_id" id="customer_id" class="form-control">
                            <option value="">Select</option>
                            <?php foreach($result_customers as $row_customers){ ?>
                            <option value="<?php echo $row_customers->id; ?>" <?php if($this->session->userdata('order_customer_id')==$row_customers->id){ echo 'selected'; } ?>><?php echo $row_customers->fname.' '.$row_customers->lname; ?></option>
                            <?php } ?>
                          </select>
                      </div>

                      <?php if(count($this->session->userdata('addresses')) > 0){  ?>
                      <div class="col-sm-4">
                          <div class="error form_error" id="form-error-address_id"></div>
                          <select name="address_id" id="address_id" class="form-control">
                            <option value="">Select</option>
                            <?php foreach($this->session->userdata('addresses') as $row_address){ ?>
                              <option value="<?php echo $row_address['address_id']; ?>"><?php echo $row_address['address']; ?></option>                              
                            <?php } ?>
                          </select>
                      </div>
                      <?php } ?>                      

                  </div>

                  <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-primary" id="place_order" value="Place Order">
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

<?php } ?>


    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Add Products</div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('attribute','<button class="btn btn-primary">Cancel</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST" id="data_form" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Products</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_id"></div>
                                <input type="hidden" name="product_name" id="product_name" value="<?php echo $this->session->userdata('product_name'); ?>">
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">Select</option>
                                <?php foreach($result_products as $row_products){ ?>
                                    <option value="<?php echo $row_products->id; ?>" data-product_name="<?php echo $row_products->product_name; ?>" <?php if($this->session->userdata('product_id')==$row_products->id){ echo 'selected'; } ?>><?php echo $row_products->product_name; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Options</label>
                            <div class="col-sm-10">
                                <div class="error form_error" id="form-error-product_id"></div>
                                <?php 
                                $admin_product_options = $this->session->userdata('product_options');
                                $count = count($admin_product_options);
                                ?>
                                <input type="hidden" name="product_options[<?php echo $admin_product_options[0]['option_group']; ?>]">
                                <input type="hidden" name="product_price" id="product_price" value="">

                                <select name="<?php echo $admin_product_options[0]['option_group']; ?>" class="form-control product_option_select" >
                                <option value="">Select</option>
                                <?php
                                for($i=0;$i<$count;$i++){                        
                                ?>
                                    <option value="<?php echo $admin_product_options[$i]['option_name']; ?>" <?php if($admin_product_options[$i]['option_qty'] == 0){ echo 'disabled'; }?> data-amount="<?php echo $admin_product_options[$i]['option_amount']; ?>">
                                        <?php echo $admin_product_options[$i]['option_name'].' x Rs.'.$admin_product_options[$i]['option_amount']; ?>                                
                                    </option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Qty</label>
                            <div class="col-sm-10">
                                <select name="product_qty" id="product_qty" class="form-control" >
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label"><?php echo $admin_product_options[$i]['option_name']; ?></label>
                                <div class="col-sm-10">
                                    <div class="error form_error" id="form-error-rate"></div>
                                    <div class="error form_error" id="form-error-qty"></div>
                                    <input type="hidden" name="option_name[]" id="option_name[]" value="<?php echo $admin_product_options[$i]['option_name']; ?>">
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Rate</label>
                                        <input type="text" name="rate[]" id="rate" class="form-control" placeholder="rate" value="<?php echo $admin_product_options[$i]['option_amount']; ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Qty</label>
                                        <input type="text" name="qty[]" id="qty" class="form-control" placeholder="Qty">
                                    </div>
                                </div>
                            </div> -->                      

                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" id="submit" value="Add to Cart">
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

    $("#product_id").on('change', function(){
        
        var product_name = $(this).find(":selected").data('product_name');        
        var product_id = $(this).val();        
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/order/getProduct_options",
            data:  {product_name:product_name,product_id:product_id},
            dataType: 'json',
            success: function(result) {
                location.reload(true);
            },
            error: function(data){
                
            }
        });

    });

    $("#customer_id").on('change', function(){
        
        var customer_id = $(this).find(":selected").val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/order/getCustomer_address",
            data:  {customer_id:customer_id},
            dataType: 'json',
            success: function(result) {
                location.reload(true);
            },
            error: function(data){
                
            }
        });

    });

    $(".product_option_select").on('change', function(e) {
        var amount = $(this).find(":selected").data('amount');
        $("#product_price").val(amount);
    });



    $("#place_order").on('click', function(){
        
        var address_id = $("#address_id").find(":selected").val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/order/place_order",
            data:  {address_id:address_id},
            dataType: 'json',
            success: function(result) {
                location.reload(true);
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
            url: "<?php echo base_url();?>index.php/order/cart_add",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.reload(true);
                //location.href="<?php echo base_url();?>index.php/order";
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