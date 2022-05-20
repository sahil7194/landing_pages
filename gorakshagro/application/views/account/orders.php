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
                    
                    <?php foreach($orders as $order){ ?>
                    <div class="order_details_row">

                      <div class="order_top_box">
                        <button class="order_id button"><?php echo $order->order_ref_id; ?></button>
                        <!-- <button class="button_2">Track</button> -->
                        <div class="ordered_date">Ordered On <span><?php echo date('d M Y', strtotime($order->date_created)); ?></span></div>
                      </div>

                      <div class="order_middle_box">

                        <?php 
                        $this->db->select('orders_product.product_options,
                        orders_product.quantity,
                        orders_product.price,
                        orders_product.total,
                        product.product_name,
                        product.product_image,
                        product.slug');
                        $this->db->from('orders_product');
                        $this->db->join('product', 'orders_product.product_id=product.id');
                        $this->db->where('orders_product.order_ref_id', $order->order_ref_id);
                        $query_order_products = $this->db->get();
                        ?>

                        <?php foreach($query_order_products->result() as $product){ ?>
                        <div class="product_details_row">
                          <div class="product_img">
                            <img src="images/uploads/products/thumbs/<?php echo $product->product_image; ?>">
                          </div>
                          <div class="product_info">
                            <div class="product_name"><?php echo anchor('products/details/'.$product->slug, $product->product_name); ?></div>
                            <div class="product_attribute">
                              <?php 
                              $options = explode('--', $product->product_options);
                              foreach ($options as $option) {
                                echo $option.'<br/>';
                              }
                              ?>
                              </div>
                            <div class="clear"></div>
                          </div>
                          <div class="product_price">
                            <div class="price">Rs.<?php echo $product->total; ?></div>
                            <div class="clear"></div>
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <?php } ?>

                      </div>

                      <div class="order_bottom_box">
                        <div class="order_status">Order Status - <span><?php echo $order->status; ?></span></div>
                        <div class="total_price">Order Total &nbsp;&nbsp;<span>Rs.<?php echo $order->total; ?></span></div>
                      </div>  

                      <div class="clear"></div>              
                    </div>
                    <!-- End order_details_row -->
                  <?php } ?>

                  <!-- Pagination -->
                  <nav class="pagination text-center clear">
                    <?php echo $links; ?>
                  </nav>

                </div>

              </div>


            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->