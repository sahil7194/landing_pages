<?php 

$car_service_color_scheme_one = get_theme_mod('car_service_color_scheme_one');

$car_service_color_scheme_css = "";

if($car_service_color_scheme_one != false){

  $car_service_color_scheme_css .='.header,
  .pagemore a:hover, 
  .serv-btn a:hover, 
  .woocommerce ul.products li.product .button:hover, 
  .woocommerce #respond input#submit.alt:hover, 
  .woocommerce a.button.alt:hover, 
  .woocommerce button.button.alt:hover, 
  .woocommerce input.button.alt:hover,
  .woocommerce a.button:hover, 
  .woocommerce button.button:hover, 
  #commentform input#submit:hover,
  .copywrap,
  #head-banner,
  span.onsale,
  #sidebar input.search-submit, 
  #footer input.search-submit, 
  form.woocommerce-product-search button,
  #footer,
  nav.woocommerce-MyAccount-navigation ul li{';

  $car_service_color_scheme_css .='background: '.esc_attr($car_service_color_scheme_one).';';

  $car_service_color_scheme_css .='}';

 $car_service_color_scheme_css .='span.onsale{';

  $car_service_color_scheme_css .='background: '.esc_attr($car_service_color_scheme_one).' !important;';

  $car_service_color_scheme_css .='}';

  $car_service_color_scheme_css .='.listarticle, 
  aside.widget,
  #sidebar .tagcloud a,
  #sidebar select,
  #sidebar input[type="text"], 
  #sidebar input[type="search"], 
  #footer input[type="search"],
  .woocommerce table.shop_table,
  .woocommerce .quantity .qty{';

  $car_service_color_scheme_css .='border-color: '.esc_attr($car_service_color_scheme_one).';';

  $car_service_color_scheme_css .='}';

  $car_service_color_scheme_css .='h1,h2,h3,h4,h5,h6.banner-btn a:hover,
  #sidebar .tagcloud a,.toggle-nav button{';

  $car_service_color_scheme_css .='color: '.esc_attr($car_service_color_scheme_one).';';

  $car_service_color_scheme_css .='}';
}

$car_service_color_scheme_two = get_theme_mod('car_service_color_scheme_two');

if($car_service_color_scheme_two != false){

  $car_service_color_scheme_css .='.banner-btn a, 
  .pagemore a, 
  .serv-btn a, 
  .woocommerce ul.products li.product .button, 
  .woocommerce #respond input#submit.alt, 
  .woocommerce a.button.alt, 
  .woocommerce button.button.alt, 
  .woocommerce input.button.alt, 
  .woocommerce a.button, 
  .woocommerce button.button, 
  .woocommerce #respond input#submit, 
  #commentform input#submit,
  nav.woocommerce-MyAccount-navigation ul li:hover{';

  $car_service_color_scheme_css .='background: '.esc_attr($car_service_color_scheme_two).';';

  $car_service_color_scheme_css .='}';

  $car_service_color_scheme_css .='
  nav.woocommerce-MyAccount-navigation ul li:hover{';

  $car_service_color_scheme_css .='background: '.esc_attr($car_service_color_scheme_two).';';

  $car_service_color_scheme_css .='}';

  $car_service_color_scheme_css .='{';

  $car_service_color_scheme_css .='border-color: '.esc_attr($car_service_color_scheme_two).';';

  $car_service_color_scheme_css .='}';

  $car_service_color_scheme_css .='a,.listarticle h2 a,
  h3.widget-title,
  .listarticle h2 a:hover, 
  #sidebar ul li a:hover, 
  .ftr-4-box ul li a:hover, 
  .ftr-4-box ul li.current_page_item a, 
  .main-nav ul ul a:hover,
  .main-nav a:hover,
  .ftr-4-box h5 span{';

  $car_service_color_scheme_css .='color: '.esc_attr($car_service_color_scheme_two).';';

  $car_service_color_scheme_css .='}';
}