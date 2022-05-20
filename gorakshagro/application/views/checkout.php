<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>Checkout</h1>
              <ol class="breadcrumb">
                <li>
                  <?php echo anchor(base_url(),'Home'); ?>
                </li>
                <li class="active">
                  Checkout
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- Checkout -->
      <section class="section-wrap checkout">
        <div class="container relative">
          <div class="row">

            <div class="ecommerce col-xs-12">

              <div class="row mb-30">
                <div class="col-md-8">
                  <!-- <p class="ecommerce-info">
                    Returning Customer?
                    <a href="#" class="showlogin">Click here to login</a>
                  </p> -->
                </div>
              </div>

                <div class="col-md-8" id="customer_details">
                    <div>
                    <h2 class="heading relative uppercase bottom-line left-align mb-30">Delivery address</h2>

                    <div class="address_notification"></div>
                    <div class="choose_delivery_addresses">
                      <?php foreach($addresses as $address){ ?>
                      <div class="col-md-6">
                        
                        <div class="delivery_address_block">
                          <div class="title">
                            <div class="radio_custom">                            
                              <input id="delivery_address<?php echo $address->id; ?>" name="delivery_address" type="radio" value="<?php echo $address->id; ?>" class="delivery_address_options" <?php if($this->session->userdata('delivery_address_id')==$address->id){ echo 'checked'; } ?>>
                              <label for="delivery_address<?php echo $address->id; ?>"><?php echo $address->contact_name; ?></label>
                            </div>
                          </div>
                          <div class="address">
                            <p><?php echo $address->address; ?></p>
                          </div>
                        </div>

                      </div>
                      <?php } ?>
                    </div>
                    <div class="clear"></div>

                    <div class="form_container">
                      
                      <form name="form_address_new" id="form_address_new" class="form_address_new">
                          <div class="col-md-6">
                            <div class="error form_error form-error-contact_name" id="form-error-contact_name"></div>
                            <div class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="contact_name">Name
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value="<?php echo $this->session->userdata('fname').' '.$this->session->userdata('lname'); ?>" name="contact_name" id="contact_name">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-mobile" id="form-error-mobile"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="mobile">Mobile
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value="<?php echo $this->session->userdata('mobile'); ?>" name="mobile" id="mobile">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-pincode" id="form-error-pincode"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="pincode">Pincode
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="pincode" id="pincode">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-locality" id="form-error-locality"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="locality">Locality
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="locality" id="locality">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-12">
                            <div class="error form_error form-error-address" id="form-error-address"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="address">Address
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <textarea class="input-text" placeholder value name="address" id="address"></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-city" id="form-error-city"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="city">City/District/Town
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value="Thane" name="city" id="city">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-state" id="form-error-state"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="state">State
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <select name="state">
                                <option value="">--Select State--</option>
                                <?php
                                foreach($states as $state){
                                  if($state->name=='Maharashtra'){
                                ?>
                                  <option value="<?php echo $state->name; ?>"><?php echo $state->name; ?></option>  
                                <?php
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-landmark" id="form-error-landmark"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="landmark">Landmark
                              </label>
                              <input type="text" class="input-text" placeholder value name="landmark" id="landmark">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-alternate_phone" id="form-error-alternate_phone"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="alternate_phone">Alternate Phone Number
                              </label>
                              <input type="text" class="input-text" placeholder value name="alternate_phone" id="alternate_phone">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-address_code" id="form-error-address_code"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="state">Area Code
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <select name="address_code">
                                <option value="">--Select Code--</option>
                                <?php foreach($addresse_codes as $addresse_code){ ?>
                                  <option value="<?php echo $addresse_code->code; ?>"><?php echo $addresse_code->code; ?></option>  
                                <?php } ?>
                              </select>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="error form_error form-error-address_type" id="form-error-address_type"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="address_type">Address Type
                              </label>
                              <div class="radio_custom">
                                  <input id="home" name="address_type" type="radio" value="Home">
                                  <label for="home">Home</label>
                                  <input id="work" name="address_type" type="radio" value="Work">
                                  <label for="work">Work</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Add">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <a class="btn btn-lg btn-color2 btn_full" id="">Cancel</a>
                            </div>
                          </div>
                          </form>

                      <div class="clear"></div>
                    </div>
                    
                    </div>
                  <div class="clear"></div>

                </div> <!-- end col -->


                <div class="col-md-4">
                  <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                    <h2 class="heading relative uppercase bottom-line left-align mb-30">Your Order</h2>
                    <table class="table shop_table ecommerce-checkout-review-order-table">
                      <tbody>
                        <?php foreach ($this->cart->contents() as $items){ ?>
                        <tr>
                          <th><?php echo $items['name']; ?><!-- <span class="count"> x <?php //echo $items['qty']; ?></span> --></th>
                          <td>
                            <span class="amount"><?php echo $this->cart->format_number($items['subtotal']); ?></span>
                          </td>
                        </tr>
                      <?php } ?>
                        
                        <tr class="cart-subtotal">
                          <th>Cart Subtotal</th>
                          <td>
                            <span class="amount"><?php echo $this->cart->format_number($this->cart->total()); ?></span>
                          </td>
                        </tr>
                        <tr class="shipping">
                          <th>Packaging</th>
                          <td>
                            <span><?php echo $this->cart->format_number( $this->session->userdata('packaging_charges')); ?></span>
                          </td>
                        </tr>
                        <tr class="shipping">
                          <th>Shipping</th>
                          <td>
                            <span><?php echo $this->cart->format_number($this->session->userdata('shipping_charges')); ?></span>
                          </td>
                        </tr>
                        <tr class="order-total">
                          <th><strong>Order Total</strong></th>
                          <td>
                            <strong><span class="amount">Rs.<?php echo $this->cart->format_number($this->session->userdata('total_payable_amount')); ?></span></strong>
                          </td>
                        </tr>
                        <tr>
                          <th colspan="2">
                            <strong>Payment Mode</strong><br/>
                            <div class="form_row">
                              <div class="error form_error form-error-payment_mode" id="form-error-payment_mode"></div>
                              <select name="payment_mode" id="payment_mode" class="payment_mode_select">
                                <option value="">Select</option>
                                <option value="google_pay">Google Pay</option>
                                <option value="phone_pay">Phone Pay</option>
                                <option value="COD">COD</option>
                              </select>
                            </div>
                          </th>
                        </tr>
                        <tr class="upi_transaction_id_field">
                          <th colspan="2">
                            <strong>UPI Transaction Id <span>(Payments to be made on 9987794885)</span></strong><br/>
                            <div class="form_row">
                              <div class="error form_error form-error-upi_transaction_id" id="form-error-upi_transaction_id"></div>
                              <input type="text" class="input-text" placeholder="Enter UPI Transaction Id" name="upi_transaction_id" id="upi_transaction_id">
                            </div>
                          </th>
                        </tr>
                      </tbody>
                    </table>

                    <div id="payment" class="ecommerce-checkout-payment">                      
                      <div class="form-row place-order">
                        <input type="button" name="ecommerce_checkout_place_order" class="btn btn-lg btn-color" id="order_save" value="Confirm Order">
                      </div>
                    </div>
                  </div>
                </div> <!-- end order review -->

            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->