<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>Product Details</h1>
              <ol class="breadcrumb">                
                <li>
                  <?php echo anchor(base_url(),'Home');?>
                </li>
                <li class="active">
                  Product Details
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- Single Product -->
      <section class="section-wrap single-product">
        <div class="container relative">
          <div class="row">

            <div class="col-sm-6 col-xs-12 mb-60">

              <div class="flickity" id="gallery-main">
                <?php foreach($product_images as $product_image){ ?>
                <div class="gallery-cell">
                  <a href="images/uploads/products/<?php echo $product_image->imagefile1; ?>">
                    <img src="images/uploads/products/<?php echo $product_image->imagefile1; ?>" alt="" />
                    <i class="ti-arrows-corner"></i>
                  </a>
                </div>
                <?php } ?>
              </div> <!-- end gallery main -->

              <div class="gallery-thumbs">
                <?php foreach($product_images as $product_image){ ?>
                <div class="gallery-cell">
                  <img src="images/uploads/products/thumbs/<?php echo $product_image->imagefile1; ?>" alt="" />
                </div>
                <?php } ?>

              </div> <!-- end gallery thumbs -->

            </div> <!-- end col img slider -->

            <form name="cart_add_form" id="cart_add_form" method="POST">
            <div class="col-sm-6 col-xs-12 product-description-wrap">
              <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_details[0]->id; ?>">
              <input type="hidden" name="product_price" id="product_price" value="<?php echo $product_details[0]->special_price; ?>">
              <input type="hidden" name="product_name" id="product_name" value="<?php echo $product_details[0]->product_name; ?>">
              <input type="hidden" name="product_image" id="product_image" value="<?php echo $product_details[0]->product_image; ?>">
              <input type="hidden" name="product_slug" id="product_slug" value="<?php echo $product_details[0]->slug; ?>">
              <h1 class="product-title"><?php echo $product_details[0]->product_name; ?></h1>
              <span class="rating">
                <a href="#">3 Reviews</a>
              </span>
              <span class="price">
                <del>
                  <span>Rs.<?php echo $product_details[0]->price; ?></span>
                </del>
                <ins>
                  <span class="ammount">Rs.</span><span class="ammount" id="special_price_display"><?php echo $product_details[0]->special_price; ?></span>
                </ins>
              </span>
              <div class="product-description">
              <?php echo $product_details[0]->description; ?>
              </div>

              <?php if($stock_status=='IN'){ ?>

                <div class="select-options">
                  <div class="row row-20">
                    
                    <?php 
                    foreach($result_product_option_groups as $product_option_group){

                      echo '<div class="col-sm-6">
                        <input type="hidden" name="required_options['.$product_option_group->group.']">
                        <div class="error form_error" id="form-error-'.$product_option_group->group.'"></div>
                        <select class="'.$product_option_group->group.'-select product_option_select" name="'.$product_option_group->group.'">
                        <option value>Select '.$product_option_group->group.'</option>';

                        foreach($result_product_options as $product_option){

                            if($product_option_group->option_group_id == $product_option->option_group_id){

                    ?>
                                <option value="<?php echo $product_option->option; ?>" <?php if($product_option->qty == 0){ echo 'disabled'; }?> data-amount="<?php echo $product_option->amount; ?>"><?php echo $product_option->option.' x Rs.'.$product_option->amount; ?></option>
                    <?php
                            }
                        }

                        echo '</select>
                        </div>';
                    }
                    ?>

                  </div>                

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
                

                <ul class="product-actions clearfix">
                  <li>
                    <div class="quantity buttons_added">
                      <input type="button" value="-" class="minus" /><input type="number" name="product_qty" id="product_qty" step="1" min="0" value="1" title="Qty" class="input-text qty text" /><input type="button" value="+" class="plus" />
                    </div>
                  </li>
                  <li>
                    <input type="submit" class="btn btn-color btn-lg add-to-cart left" value="Add to Cart">
                  </li>                
                  <li>
                    <div class="icon-add-to-wishlist left">
                      <a class="add_to_wishlist" data-id="<?php echo $product_details[0]->id; ?>"><i class="fa fa-heart"></i></a>
                    </div>
                  </li>           
                </ul>

               <?php }else{ ?>
                  <div class="out_of_stock">Out of stock</div>
               <?php } ?>



              <div class="product_meta">
                <span class="sku">Product Model: <?php echo $product_details[0]->product_model; ?></span>
                <span class="sku">Brand: <?php echo anchor('',$product_details[0]->brand); ?></span>
                <span class="posted_in">Category: <?php echo anchor('',$product_details[0]->category); ?></span>
                <span class="tagged_as">Tags: 
                  <?php 
                  $product_tags =  explode(',', $product_details[0]->product_tags); 
                  foreach ($product_tags as $product_tag) {
                    echo anchor('', $product_tag).' ';
                  }
                  ?>
                </span>
              </div>

            </div> <!-- end col product description -->
            </form>
          </div> <!-- end row -->

          

          <!-- tabs -->
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="tabs tabs-bb">
                
                <ul class="nav nav-tabs">                                 
                  <li class="active">
                    <a href="#tab-description" data-toggle="tab">Description</a>
                  </li>                                 
                  <li>
                    <a href="#tab-info" data-toggle="tab">Information</a>
                  </li>                                 
                  <li>
                    <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                  </li>                                 
                </ul>
                
                <div class="tab-content pb-0">
                  
                  <div class="tab-pane fade in active" id="tab-description">
                    <p>Dummy</p>
                  </div>
                  
                  <div class="tab-pane fade" id="tab-info">
                    <table class="table">

                      <tbody>
                        <tr>
                          <th>CPU</th>
                          <td>2.7GHz quad-core Intel Core i5 Turbo Boost up to 3.2GHz</td>
                        </tr>                                   
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="tab-pane fade" id="tab-reviews">

                    <div class="reviews">
                      <ul class="reviews-list">
                        <li>
                          <div class="review-body">
                            <div class="review-content">
                              <p class="review-author"><strong>Alexander Samokhin</strong> - May 6, 2014 at 12:48 pm</p>
                              <div class="rating">
                                <a href="#"></a>
                              </div>
                              <p>This template is so awesome. I didn’t expect so many features inside. E-commerce pages are very useful, you can launch your online store in few seconds. I will rate 5 stars.</p>
                            </div>
                          </div>
                        </li>

                        <li>
                          <div class="review-body">
                            <div class="review-content">
                              <p class="review-author"><strong>Christopher Robins</strong> - May 6, 2014 at 12:48 pm</p>
                              <div class="rating">
                                <a href="#"></a>
                              </div>
                              <p>This template is so awesome. I didn’t expect so many features inside. E-commerce pages are very useful, you can launch your online store in few seconds. I will rate 5 stars.</p>
                            </div>
                          </div>
                        </li>

                      </ul>         
                    </div>
                  </div>
                  
                </div>

              </div>
            </div>
          </div> -->
          <!-- end row -->

          
        </div>
        <!-- end container -->
      </section>
      <!-- end single product -->

      <!-- Related Items -->
      <section class="section-wrap shop-items-slider pt-0">
        <div class="container">
          <div class="row heading-row">
            <div class="col-md-12 text-center">
              <h2 class="heading uppercase bottom-line"><small>Other Items</small></h2>
            </div>
          </div>

          <div class="row">

            <div id="owl-shop-items-slider" class="owl-carousel owl-theme">

              <?php 
                foreach($other_products as $product){
              ?>
              <div class="product-item">
                <div class="product-img hover-1">
                  <?php echo anchor('products/details/'.$product->slug, '<img src="images/uploads/products/thumbs/'.$product->product_image.'" alt="'.$product->product_name.'">'); ?>

                  <div class="product-actions">
                    <!-- <a href="#" class="product-add-to-compare" data-toggle="tooltip" data-placement="bottom" title="Add to compare">
                      <i class="fa fa-exchange"></i>
                    </a> -->
                    <a class="product-add-to-wishlist add_to_wishlist" data-id="<?php echo $product->id; ?>" data-toggle="tooltip" data-placement="bottom" title="Add to wishlist">
                      <i class="fa fa-heart"></i>
                    </a>                    
                  </div>
                  <!-- <a href="#" class="product-quickview">Quick View</a> -->
                </div>
                <div class="product-details">
                  <h3>
                    <?php echo anchor('products/details/'.$product->slug,$product->product_name, array('class'=>'product-title')); ?>
                  </h3>
                  <span class="price">
                    <del>
                      <span>Rs.<?php echo $product->price; ?></span>
                    </del>
                    <ins>
                      <span class="ammount">Rs.<?php echo $product->special_price; ?></span>
                    </ins>
                  </span>
                </div>                        
              </div>
              <?php
                }
              ?>

            </div> <!-- end owl -->
          </div>
        </div>
      </section> <!-- end Related Items -->


<div>

</div>