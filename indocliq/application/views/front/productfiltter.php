<style type="text/css">
  @media screen and (min-width: 768px) {

    .productclosebtn {

      display: none !important;

    }

  }

  .filter1 a {

    display: block;

    float: none !important;

    padding: 8px 8px 8px 12px;

    text-decoration: none;

    font-size: 16px;

    color: #666;

    display: block;

    transition: 0.3s;

    font-weight: 300;

    border-bottom: 1px solid #9e9e9e36;

    font-family: normal;

  }
</style>

<nav class="sidebaar">

  <a href="javascript:void(0)" class="productclosebtn closebtn" onclick="closeNav1()" style="border:none; color: #fff!important;">×</a>

  <div class="text" style="background: #840512;">Products</div>

  <ul>

    <?php

    $whrc = array('status' => 1, 'parent_category_id' => 0);

    $allcategories = $this->Common_model->GetWhere('categories', $whrc);

    if (isset($allcategories) && !empty($allcategories)) {

      foreach ($allcategories as $allcategoriesdata) {

    ?>

        <li>

          <a href="<?php echo base_url() . 'products?categories_id=' . $allcategoriesdata['category_name']; ?>"><?php echo $allcategoriesdata['category_name'] ?></a>





          <!-- <ul class="brand-show">

        <li><a href="#">Mobile Accssories</a></li>

        

      </ul> -->

        </li>

    <?php }
    } ?>

    <li><a href="#" class="col-md-12 col-sm-12 col-xs-12 feat-btn">Brands

        <i class="fa fa-caret-down cado first" aria-hidden="true"></i>

      </a>

      <ul class="feat-show">

        <?php

        $whrc = array('status' => 1, 'parent_category_id' => 0);

        $allcategories = $this->Common_model->GetWhere('categories', $whrc);

        if (isset($allcategories) && !empty($allcategories)) {

          foreach ($allcategories as $allcategoriesdata) {

        ?>

            <li>

              <div class="form-check">

                <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                <input type="checkbox" id="exampleCheck1" name="" value="<?php echo $allcategoriesdata['categories_id'] ?>">

                <label class="form-check-label checkb" for="exampleCheck1"><?php echo $allcategoriesdata['category_name'] ?></label>

              </div>

            </li>
        <?php }
        } ?>
      </ul>



    </li>

    <li><a href="#" class="serv-btn col-md-12 col-sm-12 col-xs-12">Made In Bharat

        <i class="fa fa-caret-down cado second" aria-hidden="true"></i>

      </a>

      <ul>

        <li><a href="#">Pages</a></li>

        <li><a href="#">Elements</a></li>

      </ul>

    </li>

    <li><a href="#">Dashbord</a></li>

    <li><a href="#">Dashbord</a></li>

  </ul>

</nav>

<!----------------------------Widget Price Filter---------------------------------------->

<div class="container">

  <div class="row">

    <div class="col-sm-11">

      <div id="slider-range"></div>

    </div>

  </div>

  <div class="row slider-labels">

    <div class="col-sm-6 caption ">

      <strong>Min:</strong> <span id="slider-range-value1"></span>

    </div>

    <div class="col-sm-6 text-right caption">

      <strong>Max:</strong> <span id="slider-range-value2"></span>

    </div>

  </div>

  <div class="row">

    <div class="col-sm-12">

      <form>

        <input type="hidden" name="min-value" value="">

        <input type="hidden" name="max-value" value="">

      </form>

    </div>

  </div>

</div>

<!-------------Widget Customer Review------------------>

<ul class="sidebar_1">

  <li>

    <a href="#">Avg. Customer Review</a>

    <ul class="electronics">

      <li><span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span>& Up</span>

      </li>

      <li><span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star"></span>

        <span>& Up</span>

      </li>

      <li><span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span>& Up</span>

      </li>

      <li><span class="fa fa-star checked"></span>

        <span class="fa fa-star checked"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span>& Up</span>

      </li>

      <li><span class="fa fa-star checked"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span class="fa fa-star"></span>

        <span>& Up</span>

      </li>

    </ul>

  </li>

</ul>



<!-- <div class="container">

  <div class="row">

    <div class="col-sm-11">

      <div id="checke_box">
        <p>klasjhdkljfhasd</p>
        <form action="">
          <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
          <label for="vehicle1"> I have a bike</label><br>
          <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
          <label for="vehicle2"> I have a car</label><br>
          <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
          <label for="vehicle3"> I have a boat</label><br><br>
          <input type="submit" value="Submit">
        </form>

      </div>

    </div>

  </div>



</div> -->