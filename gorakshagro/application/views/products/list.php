<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>Product List</h1>
              <ol class="breadcrumb">
                <li>
                  <?php echo anchor(base_url(),'Home');?>
                </li>
                <li class="active">
                  Products
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->      

      <!-- Catalogue -->
      <section class="section-wrap pt-80 pb-40 catalogue product_list_container">
        <div class="container relative">

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
      
          <div class="row">

            <?php  if($products !== false){ ?>
              
            <?php } ?>

            <div class="col-md-12 catalogue-col right mb-50">

              <div class="shop-filter">
                <div class="view-mode hidden-xs">
                  <span>View:</span>
                  <a class="grid grid-active" id="grid"></a>
                  <a class="list" id="list"></a>
                </div>
                <!-- <div class="filter-show hidden-xs">
                  <span>Show:</span>
                  <a href="#" class="active">12</a>
                  <a href="#">24</a>
                  <a href="#">36</a>
                </div> -->
                <form class="ecommerce-ordering">
                  <select name="sort_opt" id="sort_opt" class="sort_opt_select">
                    <option value="default-sorting">Default Sorting</option>
                    <option value="high_to_low" <?php if($this->session->userdata('sort_option') == 'high_to_low'){ echo 'selected'; } ?>>Price: high to low</option>
                    <option value="low_to_high" <?php if($this->session->userdata('sort_option') == 'low_to_high'){ echo 'selected'; } ?>>Price: low to high</option>
                  </select>
                </form>
              </div>

              <div class="shop-catalogue grid-view">

                <div class="row items-grid">

                  <?php 
                    foreach($products as $product){
                  ?>
                      <div class="col-md-3 col-xs-6 product product-grid">
                        <div class="product-item">
                          <div class="product-img hover-1">                            

                            <?php echo anchor('products/details/'.$product->slug, '<img src="images/uploads/products/thumbs/'.$product->product_image.'" alt="'.$product->product_name.'">'); ?>

                            <!-- <span class="sold-out valign">out of stock</span> -->
                            <!-- <div class="product-label">
                              <span class="sale">sale</span>
                            </div> -->
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

                          <!-- <div class="product-list-details">
                            <ul class="product-actions clearfix">
                              <li>
                                <a href="#" class="btn btn-color btn-md left">Add to Cart</a>
                              </li>
                              <li>
                                <div class="icon-add-to-wishlist left">
                                  <a href="#"><i class="fa fa-heart"></i></a>
                                </div>
                              </li>                                 
                            </ul>
                          </div> -->

                        </div>
                      </div>
                  <?php
                    }
                  ?>

                </div> <!-- end row -->
              </div> <!-- end grid mode -->

              <!-- Pagination -->
              <nav class="pagination text-center clear">
                <?php echo $links; ?>
              </nav>


            </div>
            <!-- end col -->
            

            <!-- Sidebar -->
            <!-- <aside class="col-md-3 sidebar left-sidebar">

              <?php //$this->load->view('products/list_sidebar'); ?>

            </aside> -->
            <!-- end sidebar -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end catalog --> 