<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>Cart</h1>
              <ol class="breadcrumb">
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li>
                  <a href="index.html">Shop</a>
                </li>
                <li class="active">
                  Cart
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- Cart -->
      <section class="section-wrap shopping-cart">
        <div class="container relative">
          <div class="row">

            <?php if($this->cart->total_items() > 0){ ?>

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

              <div class="col-md-12">
                <div class="table-wrap mb-30">
                  
                  <form name="cart_update_form" id="cart_update_form" method="POST">
                  <table class="shop_table cart table">
                    <thead>
                      <tr>
                        <th class="product-name" colspan="2">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>

                      <?php foreach ($this->cart->contents() as $items){ ?>

                      <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                      <tr class="cart_item">
                        <td class="product-thumbnail">
                          <?php echo anchor('products/details/'.$items['slug'], '<img src="images/uploads/products/thumbs/'.$items['image'].'" alt="'.$items['name'].'">' ); ?>
                        </td>
                        <td class="product-name">
                          <?php echo anchor('products/details/'.$items['slug'],$items['name']); ?>

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
                            <input type="button" value="-" class="cart_qty_minus" data-row_id="<?php echo $items['rowid']; ?>"/>

                            <?php echo form_input(array('type'=>'number', 'name' => $i.'[qty]', 'step'=>1, 'min'=>0, 'max'=>3, 'value'=>$items['qty'], 'title'=>'Qty', 'maxlength' => '3', 'size' => '5', 'class'=>'input-text qty text')); ?>
                            <input type="button" value="+" class="cart_qty_plus" data-row_id="<?php echo $items['rowid']; ?>">
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
                  </form>
                </div>

                <!-- <div class="row mb-50">
                  <div class="col-md-5 col-sm-12">
                    <div class="coupon">
                      <input type="text" name="coupon_code" id="coupon_code" class="input-text form-control" value placeholder="Coupon code">
                      <input type="submit" name="apply_coupon" class="btn btn-md btn-dark" value="Apply">
                    </div>
                  </div>
                </div> -->

              </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
              <div class="col-md-6 shipping-calculator-form">
                <!-- <h2 class="heading relative uppercase bottom-line left-align mb-30">Calculate Shipping</h2>
                <div class="row row-10">
                  <div class="col-sm-6">
                    <p class="form-row form-row-wide">
                      <input type="text" class="input-text" value placeholder="Pincode" name="calc_shipping_postcode" id="calc_shipping_postcode">
                    </p>
                  </div>
                </div>   -->           
              </div> <!-- end col shipping calculator -->

              <div class="col-md-6">
                <div class="cart_totals">
                  <h2 class="heading relative uppercase bottom-line left-align mb-30">Cart Totals</h2>

                  <table class="table shop_table">
                    <tbody>
                      <tr class="cart-subtotal">
                        <th>Cart Subtotal</th>
                        <td>
                          <span class="amount">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></span>
                        </td>
                      </tr>
                      <tr class="shipping">
                        <th>Shipping</th>
                        <td>
                          <span>Free Shipping</span>
                        </td>
                      </tr>
                      <tr class="order-total">
                        <th><strong>Order Total</strong></th>
                        <td>
                          <strong><span class="amount">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></span></strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="actions right">
                    <div class="wc-proceed-to-checkout">
                      <a class="btn btn-lg btn-color checkout_btn">proceed to checkout</a>
                    </div>
                  </div>
                </div>
              </div> <!-- end col cart totals -->

            <?php }else{ ?>

              <div class="alert alert-danger fade in alert-dismissible" role="alert">
                Your cart is <strong>Empty!</strong> 
              </div>

            <?php } ?>

          </div> <!-- end row -->          
        </div> <!-- end container -->
      </section> <!-- end cart -->

