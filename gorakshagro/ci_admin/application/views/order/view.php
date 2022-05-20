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
                    <div class="col-sm-8">Order Ref Id: #<?php echo $result[0]->order_ref_id; ?></div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('order/edit/'.$result[0]->order_ref_id,'<button class="btn btn-primary">Edit</button>');?>
                        <?php echo anchor('order','<button class="btn btn-primary">Back</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Order date</label>
                            <div class="col-sm-9 col_details">
                                <?php echo date('d M Y', strtotime($result[0]->date_created)); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Payment Method</label>
                            <div class="col-sm-9 col_details">
                                <?php echo strtoupper($result[0]->payment_mode); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Transaction ID</label>
                            <div class="col-sm-9 col_details">
                                <?php echo strtoupper($result[0]->transaction_id); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9 col_details">
                                Rs. <?php echo $result[0]->total; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Customer name</label>
                            <div class="col-sm-9 col_details">
                                <?php echo anchor('customer/view/'.$result[0]->customer_id, $result[0]->firstname.' '.$result[0]->lastname, array('target'=>'_blank')); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->email; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->mobile; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9 col_details">
                                <strong><?php echo $result[0]->delivery_address_type; ?> :</strong> <?php echo $result[0]->delivery_address; ?>, <?php echo $result[0]->delivery_city; ?>, <?php echo $result[0]->delivery_state; ?>, Landmark - <?php echo $result[0]->delivery_landmark; ?>, Contact - <?php echo $result[0]->delivery_mobile; ?>
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

    

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">Products</div>
                    <div class="col-sm-4 buttons_panel float-right">
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">

                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="col-sm-4">Product</th>
                            <th class="col-sm-1">Price</th>
                            <th class="col-sm-1">Quantity</th>
                            <th class="col-sm-1" style="text-align: right;">Total</th>
                        </tr>
                        <?php foreach($products as $product){ ?>
                        <tr>
                            <td>
                                <img src="../images/uploads/products/thumbs/<?php echo $product->product_image; ?>" width="75">&nbsp;&nbsp;
                                <a href="../index.php/products/details/<?php echo $product->slug; ?>" target="_blank"><?php echo $product->product_name; ?></a><br/><br/>
                                <?php 
                                  $options = explode('--', $product->product_options);
                                  foreach ($options as $option) {
                                    echo $option.'<br/>';
                                  }
                                ?>
                            </td>
                            <td><?php echo $product->price; ?></td>
                            <td><?php echo $product->quantity; ?></td>
                            <td align="right"><?php echo $product->total; ?></td>                            
                        </tr>                               
                        <?php } ?>
                        <tr style="font-weight: bold">
                            <td>Order status: <?php echo $result[0]->order_status; ?></td>
                            <td></td>
                            <td align="right">Total </td>
                            <td align="right">Rs. <?php echo $result[0]->total; ?></td>
                        </tr>
                    </table>

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
