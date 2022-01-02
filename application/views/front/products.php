<!-------CSS by VinayK-------->

<link rel="stylesheet" href="<?php echo base_url();?>front_assets/css/price-slider.css"/>

<style type="text/css">

  @media screen and (min-width: 768px)  {

    .productfillterb{

      display: none;

    }

  }

  .offer-tag{

        background: #840512 !important;

  }

</style>

<!-------CSS End-------->

<!-------HTML by VinayK-------->

<!----------------------------Widget Product---------------------------------------->

<section class="main-container col1-layout main-container-small">

  <div class="main container-fluid">

    <div class="col-main">

      <div class="row">

        

        <aside class="col-lg-2 col-md-3 sidebar close_now productlistsidebar " id="pmyfilter" >



          <div class="widget shop-categories">

            <div class="widget-content">

                <?php include('productfiltter.php');?>

            </div>

          </div>

        </aside>

        <!----------------------------Shop Sorting---------------------------------------->

        <div class=" col-lg-10 col-md-9 col-sm-12 col-xs-12 content" id="content">

          <div class="shop-sorting">

            <div class="row">

              <div id="myfilter" class="filter1  text-left">

                <div class="widget shop-categories">

                  <div class="widget-content">

                    <?php include('productfiltter.php');?>

                  </div>

                </div>

              </div>

              <div class="col-md-12 col-sm-12 col-xs-12 sort-item ">



                <!-- <i class="fa fa-filter openbtn" onclick="openNav1()"> Filter</i> -->

                  <button class="openbtn productfillterb" onclick="openNav1()" style="float: right">

                    <i class="fa fa-filter"></i>

                    <span style="color: black;">Filters</span>

                  </button>

                  <div class="form-group selectpicker-wrapper price-filter float-right">

                    <select class="selectpicker input-price sorter_search btn btn1" >

                      <option class="optiontitle" >Sort by</option>

                      <option class="optiontitle" value="">Price Low to High</option>

                      <option class="optiontitle" value="">Price High to Low</option>

                      <option class="optiontitle" value="">Oldest</option>

                      <option class="optiontitle" value="">Newest</option>

                      <option class="optiontitle" value="">Most viewed</option>

                    </select>

                  </div>                 

                

              </div>

            </div>

            

            <div class="row">

                <?php



              $whrp = array();

              $whrp[] = "status = 1";

              if(isset($_GET['categories_id']) && !empty($_GET['categories_id'])){

                  $catid = getcategoryidbyname($_GET['categories_id']);

                  // print_r($catid);

                  if(!empty($catid)){

                      $whrp[] = "categories_id = ".$catid."";

                  }

              }

              if(isset($_GET['tags']) && !empty($_GET['tags'])){

                $whrp[] = " FIND_IN_SET('".$_GET['tags']."',meta_title)";

              }

              $wherep = " WHERE ".implode(" AND ", $whrp);     

              $datea = $this->Common_model->getwhrclearanceproduct($wherep);

              if(isset($datea) && !empty($datea)){



                        foreach ($datea as $best_product_array) {

              ?>

                

              <div class="col-lg-3 col-md-3 col-sm-6 col-sm-6 col-xs-6 col-6 mb-10">

                <div class="card card-c">

                    <a href="<?php echo base_url().'productdetail?pid='.$best_product_array['product_id'];?>" class="">

                  <div class="offer-tag"><?php echo $best_product_array['discount']; ?><?php echo  ($best_product_array['discount_type'] == 1 ? "% OFF" : "FLAT OFF"); ?></div>

                   <img  class="imgtitle" src="<?php echo base_url()?>uploads/product_images/<?php echo $best_product_array['main_image']?>" style="width:100%;  height:230px;">

                   <div>

                     <div class="card-body" style="padding-bottom: 1px;">

                       <h6 class="card-title text-center"><?php echo (isset($best_product_array['name']) ? $best_product_array['name'] : '');?></h6></a> 

                       <h6 class="card-title-2 text-center"></h6> 

                       <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 amt">

                          <div class="care-rate text-center">₹:<?php echo (isset($best_product_array['unit_price']) ? $best_product_array['unit_price'] : '');?></div>

                        </div>  

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                          <a href="">

                            <i class="fa fa-shopping-cart float-right shopicon"></i>

                          </a>  

                        </div>  

                       </div>

                     </div>

                   </div>

                </div>

              </div>

              

               <?php  } } ?>

              

            </div>

            <!--<div class="col-md-3">

              <div class="card" style="width: 100%;">

                <img class="card-img-top" src="..." alt="Card image cap">

                  <div class="card-body">

                  <h5 class="card-title">Card title</h5>

                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                      <a href="#" class="btn btn-primary">Go somewhere</a>

                </div>

              </div>

            </div>-->

            <!--<div class="col-md-3">

              <div class="card" style="width: 100%;">

                <img class="card-img-top" src="..." alt="Card image cap">

                  <div class="card-body">

                  <h5 class="card-title">Card title</h5>

                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                      <a href="#" class="btn btn-primary">Go somewhere</a>

                </div>

              </div>

            </div>-->

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

<!-------HTML End-------->

<!-------CSS and JS-------->



<script src="<?php echo base_url();?>front_assets/js/price-slider.js"></script>

<script>

  $('.feat-btn').click(function(){

    $('nav ul .feat-show').toggleClass("show");

  });

</script>

<!--<script type="text/javascript">

  var $homeIcon = $('.vehicla');

  $(window).resize(function() {

  if (window.innerWidth <= 800) $homeIcon.addClass('dropdown-toggle');

  else $homeIcon.removeClass('dropdown-toggle');

});

</script>-->