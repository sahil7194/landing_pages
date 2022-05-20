<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo base_url(); ?>">
  <script type="text/javascript">
    var BaseUrl = {};
    BaseUrl.siteRoot = "<?php echo base_url(); ?>index.php/";
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title><?php if(isset($result[0]->meta_title)){ echo $result[0]->meta_title; }else if(isset($meta_title)){ echo $meta_title; }else{ echo 'Buy Green Vegetables Online | Goraksha Agro Products'; } ?></title>
	<meta name="description" content="<?php if(isset($result[0]->meta_description)){ echo $result[0]->meta_description; }else if(isset($meta_description)){ echo $meta_description; }else{ echo 'Buy Green Vegetables Online | Goraksha Agro Products'; }  ?>" />
	<meta name="keywords" content="<?php if(isset($result[0]->meta_keywords)){ echo $result[0]->meta_keywords; }else if(isset($meta_keywords)){ echo $meta_keywords; }else{ echo 'Buy Green Vegetables Online | Goraksha Agro Products'; }  ?>" />
  
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700,600,800,400,300%7CRoboto:700,400,300%7CMerriweather:400,400italic' rel='stylesheet'>

  <!-- Css -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="revolution/css/settings.css" />
  <link rel="stylesheet" href="css/font-icons.css" />
  
  <link rel="stylesheet" href="css/sliders.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <link rel="stylesheet" href="css/form_elements.css" />
  <link rel="stylesheet" href="css/spacings.css" />
  <link rel="stylesheet" href="css/animate.min.css" />

  <!-- Favicons -->
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>

<body class="relative">

  <!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <div class="main-wrapper">

    <header class="nav-type-3">

      <div class="top-bar hidden-xs">
        <div class="container">
          <div class="row">
            <div class="top-bar-links">
              <ul class="col-sm-6">
                <li class="top-bar-email">
                  <i class="fa fa-envelope"></i><a href="mailto:support@gorakshagro.com">support@gorakshagro.com</a>
                </li>
                <!-- <li class="top-bar-phone">
                  <i class="fa fa-phone"></i><span>+ 1 888 1554 456 123</span>
                </li> -->
              </ul>

              <div class="col-sm-6 dark text-right top_links">
                <?php 
                if($this->session->userdata('customer_logged_in')=='loggedIn'){
                  echo anchor('account/','My account');
                ?>
                  <a class="logout_btn last">Logout</a>
                <?php
                }else{ 
                ?>
                  <a class="register_login_btn">Login</a>
                  <a class="register_login_btn last">Register</a>
                <?php } ?>
              </div>

            </div>
          </div>
        </div>
      </div> <!-- end top bar -->

      <div class="search-wrap">
        <div class="search-inner">
          <div class="search-cell">
            <?php echo form_open('products/search', array('METHOD'=>'GET')); ?>
              <div class="search-field-holder">
                <input type="search" name="q" id="q" class="form-control main-search-input" placeholder="Search for">
                <input type="submit" class="search-submit" value="">
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
        <i class="icon-close search-close" id="search-close"></i>
      </div>
    
      <nav class="navbar navbar-static-top">
        <div class="navigation">
          <div class="container relative">

            <div class="row">

              <div class="navbar-header">
                <!-- Logo -->
                <div class="logo-container">
                  <div class="logo-wrap">
                    <?php echo anchor(base_url(),'<img class="logo-dark" src="images/logo.png" alt="logo">'); ?>
                  </div>
                </div>               

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

                <!-- Mobile Cart -->
                <div class="nav-cart-wrap style-1 mobile-cart hidden-lg hidden-md">
                  <div class="nav-cart">
                    <div class="cart-outer">
                      <div class="cart-inner">
                        <?php echo anchor('cart/','<i class="icon-bag"></i><span>'.count($this->cart->contents()).'</span>', array('class'=>'shopping-cart relative'));?>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- end navbar-header -->

              <div class="col-md-12 nav-wrap">
                <div class="collapse navbar-collapse text-center" id="navbar-collapse">
                  
                  <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown <?php if(isset($slug) && $slug=='vegetables'){ echo 'active'; } ?>"><?php echo anchor('products/c/vegetables','Vegetables'); ?></li>
                    <li class="dropdown <?php if(isset($slug) && $slug=='leafy-vegetables'){ echo 'active'; } ?>"><?php echo anchor('products/c/leafy-vegetables','Leafy vegetables'); ?></li>
                    <li class="dropdown <?php if(isset($slug) && $slug=='exotic'){ echo 'active'; } ?>"><?php echo anchor('products/c/exotic','Exotic'); ?></li>
                    <li class="dropdown <?php if(isset($slug) && $slug=='cuts'){ echo 'active'; } ?>"><?php echo anchor('products/c/cuts','Cuts'); ?></li>
                    <li class="dropdown <?php if(isset($slug) && $slug=='mixes--ready-to-cook'){ echo 'active'; } ?>"><?php echo anchor('products/c/mixes--ready-to-cook','Mixes & ready to cook '); ?></li>
                    <li class="dropdown"><?php echo anchor('products/c/fruits','Fruits'); ?></li>

                    <!-- Nav Right -->
                    <li class="nav-right hidden-sm hidden-xs">
                      <ul>
                        <!-- Cart -->
                        <li class="nav-cart-wrap style-1">
                          <div class="nav-cart">
                            <div class="cart-outer">
                              <div class="cart-inner">
                                <a class="shopping-cart relative">
                                  <i class="icon-bag"></i>
                                  <span><?php echo count($this->cart->contents()); ?></span>
                                </a>
                              </div>
                            </div>
                            <div class="nav-cart-container">
                              <div class="nav-cart-items">

                                <?php foreach ($this->cart->contents() as $items){ ?>
                                <div class="nav-cart-item clearfix">
                                  <div class="nav-cart-img">
                                    <?php echo anchor('products/details/'.$items['slug'], '<img src="images/uploads/products/thumbs/'.$items['image'].'" alt="'.$items['name'].'">' ); ?>
                                  </div>
                                  <div class="nav-cart-title">
                                    <?php echo anchor('products/details/'.$items['slug'],$items['name']); ?>
                                    <div class="nav-cart-price">
                                      <span><?php echo $items['qty']; ?> x</span>
                                      <span><?php echo $this->cart->format_number($items['price']); ?></span>
                                    </div>
                                  </div>
                                  <div class="nav-cart-remove">
                                    <a class="remove remove_item" title="Remove this item" data-row_id="<?php echo $items['rowid']; ?>"></a>
                                  </div>
                                </div>
                                <?php } ?>


                              </div>

                              <div class="nav-cart-summary">
                                <span>Cart Subtotal</span>
                                <span class="total-price">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></span>
                              </div>

                              <div class="nav-cart-actions mt-20">                                
                                <?php echo anchor('cart/', 'View Cart', array('class'=>'btn btn-md btn-dark')); ?>
                                <?php echo anchor('checkout/', 'Proceed to Checkout', array('class'=>'btn btn-md btn-color mt-10')); ?>
                              </div>
                            </div>

                          </div>
                        </li> <!-- end cart -->

                        <li class="nav-search-wrap hidden-sm hidden-xs">
                            <a href="#" class="nav-search">
                              <i class="icon-magnifier search-trigger"></i>
                            </a>
                        </li>
                      </ul>
                    </li>

                    <li id="mobile-search" class="hidden-lg hidden-md">
                      <?php echo form_open('products/search', array('METHOD'=>'GET','class'=>'mobile-search')); ?>
                        <input type="search" name="q" id="q" class="form-control" placeholder="Search...">
                        <button type="submit" class="search-button">
                          <i class="fa fa-search"></i>
                        </button>
                      <?php echo form_close(); ?>
                    </li>
        
                  </ul> <!-- end menu -->
                </div> <!-- end collapse -->
              </div> <!-- end col -->   
          
            </div> <!-- end row -->
          </div> <!-- end container -->
        </div> <!-- end navigation -->
      </nav> <!-- end navbar -->
    </header>

    <?php //$this->session->userdata('otp_forgot_password');?>