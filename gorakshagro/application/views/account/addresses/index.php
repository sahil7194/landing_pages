<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>My Account</h1>
              <ol class="breadcrumb">
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li class="active">
                  My Account
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- My Account -->
      <section class="section-wrap">
        <div class="container relative">
          <div class="row">

            <div class="ecommerce col-xs-12 my_account_section">              

              <div class="col-md-2">
                <?php $this->load->view('account/links');?>
              </div> <!-- end col -->

              <div class="col-md-10">

                <div class="my_account_details">

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
                    
                    <div class="addresses">

                      <?php 
                      $i=1;
                      foreach($addresses as $address){
                      ?>
                      <div class="addresses_row" id="address_row_<?php echo $address->id; ?>">
                      	<div class="top">
	                        <div class="contact_person">
	                          <?php echo $address->contact_name; ?>
	                        </div>
	                        <div class="address_action">
                            <a class="address_edit_btn" data-id="<?php echo $address->id; ?>" title="Edit this address"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
	                          <a title="Remove this address"><i class="fa fa-trash" aria-hidden="true"></i></a>	
	                        </div>
                        </div>

                        <div class="contact_info">
                          <div class="address"><?php echo $address->address; ?></div>
                          <div class="address"><strong>Pincode:</strong> <?php echo $address->pincode; ?>, <strong>Locality:</strong> <?php echo $address->locality; ?></div>
                          <div class="address"><strong>City:</strong> <?php echo $address->city; ?>, <strong>State:</strong> <?php echo $address->state; ?></div>
                          <div class="address"><strong>Landmark:</strong> <?php echo $address->landmark; ?></div>
                          <div class="address"><strong>Area Code:</strong> <?php echo $address->address_code; ?></div>
                          <div class="mobile"><strong>Phone No:</strong> <?php echo $address->mobile; ?></div>
                          <?php if($address->alternate_phone){ ?>
                          <div class="mobile"><strong>Alternate Phone:</strong> <?php echo $address->alternate_phone; ?></div>
                          <?php } ?>

                          <div class="clear"></div>
                        </div>                        
                        <div class="clear"></div>

                      </div>


                      <div class="form_container form_address_edit_container" id="form_id_<?php echo $address->id; ?>">
                          <form name="form_address_new" id="form_address_new" class="form_address_new">
                            <input type="hidden" name="address_id" id="address_id" value="<?php echo $address->id; ?>">
                          <div class="col-md-6">
                            <div class="error form_error form-error-contact_name" id="form-error-contact_name"></div>
                            <div class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="contact_name">Name
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="contact_name" id="contact_name" value="<?php echo $address->contact_name; ?>">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-mobile" id="form-error-mobile"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="mobile">Mobile
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="mobile" id="mobile" value="<?php echo $address->mobile; ?>">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-pincode" id="form-error-pincode"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="pincode">Pincode
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="pincode" id="pincode" value="<?php echo $address->pincode; ?>">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-locality" id="form-error-locality"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="locality">Locality
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="locality" id="locality" value="<?php echo $address->locality; ?>">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-12">
                            <div class="error form_error form-error-address" id="form-error-address"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="address">Address
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <textarea class="input-text" placeholder name="address" id="address"> <?php echo $address->address; ?></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-city" id="form-error-city"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="city">City/District/Town
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="city" id="city" value="<?php echo $address->city; ?>">
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
                                <?php foreach($states as $state){ ?>
                                  <option value="<?php echo $state->name; ?>" <?php if($state->name==$address->state){ echo 'selected'; } ?>><?php echo $state->name; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-landmark" id="form-error-landmark"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="landmark">Landmark
                              </label>
                              <input type="text" class="input-text" placeholder name="landmark" id="landmark" value="<?php echo $address->landmark; ?>">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-alternate_phone" id="form-error-alternate_phone"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="alternate_phone">Alternate Phone Number
                              </label>
                              <input type="text" class="input-text" placeholder name="alternate_phone" id="alternate_phone" value="<?php echo $address->alternate_phone; ?>">
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
                                  <option value="<?php echo $addresse_code->code; ?>" <?php if($addresse_code->code==$address->address_code){ echo 'selected'; } ?>><?php echo $addresse_code->code; ?></option>
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
                                  <input id="home_<?php echo $address->id; ?>" name="address_type" type="radio" value="Home" <?php if($address->address_type=='Home'){ echo 'checked'; } ?> >
                                  <label for="home_<?php echo $address->id; ?>">Home</label>
                                  <input id="work_<?php echo $address->id; ?>" name="address_type" type="radio" value="Work" <?php if($address->address_type=='Work'){ echo 'checked'; } ?>>
                                  <label for="work_<?php echo $address->id; ?>">Work</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Update">
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




                      <div class="clear"></div>
                      <?php 
                        $i++;
                      }
                      ?>

                      <div class="add_new right">
                        <?php echo anchor('account/addresses_create','Add New',array('class'=>'btn btn-lg btn-color')); ?>
                      </div>


            
                    </div>



                </div>

              </div>


            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->