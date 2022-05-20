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
                    
                    <div class="wishlist">

                      <?php foreach($products as $product){ ?>
                      <div class="product_details_row">
                        <div class="product_img">
                          <img src="images/uploads/products/thumbs/<?php echo $product->product_image; ?>">
                        </div>
                        <div class="product_info">
                          <div class="product_name"><?php echo anchor('products/details/'.$product->slug, $product->product_name); ?></div>
                          <div class="product_price">Rs.<?php echo $product->special_price; ?></div>
                          <!-- <div class="out_of_stock">Out of Stock</div> -->
                          <div class="clear"></div>
                        </div>
                        <div class="product-remove">
                          <a class="remove remove_wishlist_item" id="wi_<?php echo $product->id; ?>" data-id="<?php echo $product->id; ?>" title="Remove this item"></a>
                        </div>
                        <div class="clear"></div>
                      </div>
                      <div class="clear"></div>
                      <?php } ?>

            
                    </div>



                </div>

              </div>


            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->