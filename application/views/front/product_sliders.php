<style type="text/css">

	 @media screen and (max-width: 767px){

		.mobilemenu{

			display: block;

		}

		.desktopmenu{

			display: none;

		}

	}

	@media screen and (min-width: 768px){

		.mobilemenu{

			display: none;

		}

		.desktopmenu{

			display: block;

		}

	}



* {

  box-sizing: border-box;

}



body {

  margin: 0;

}



.navbar-mm {

	display: flex;

	justify-content: center;

	width: 100%;

  overflow: hidden;

  background-color: white;

  font-family: "Nunito",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";

}



.navbar-mm a {



  float: left;

  font-size: 16px;

  font-weight: bolder;

  color: #333;

  text-align: center;

  padding: 10px 16px;

  text-decoration: none;

}

/*------------------------------------*/



@media screen and (max-width: 767px){

		.navbar-mm{

			display: none;

		}

		

	}

	



/*------------------------------------*/

.dropdown-1 {

  float: left;

  overflow: hidden;

}



.dropdown-1 .dropbtn-1 {

  font-size: 15px; 

  font-weight: 500; 

  border: none;

  outline: none;

  color: #333;

  padding: 10px 35px;

  background-color: inherit;

  

  margin: 0;

}



.navbar-mm a:hover, .dropdown-1:hover .dropbtn-1 {

  

  color: #840512;

}



.dropdown-content-1 {

  display: none;

  position: absolute;

  

  width: 100%;

  left: 0;

  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

  z-index: 2;

}



.dropdown-content-1 .header-1 {

  background: #840512;

  padding: 1px !important;

  color: white;

  text-align: center;



}

.header-1 h2{

	font-size: 22px !important;

	font-weight: 500;

}

.dropdown-1:hover .dropdown-content-1 {

  display: block !important;

}



/* Create three equal columns that floats next to each other */

.megamenu_c {

	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

	position: relative; 
	
	background-color: white;

	}





.column-1 {

  float: left;

  width: 20%;

  padding: 16px;

  background-color:white;

  height: 250px;

   

}

.column-1 h3{

	margin-left: 16px;

	font-size: 13px !important;

	font-weight: bold;

	 

}



.column-1 a {

  font-size: 13px !important;

  float: none;

  color: black;

  /*margin-left: 24px;*/

  padding: 8px 16px;

  text-decoration: none;

  display: block;

  text-align: left;

}



.column-1 a:hover {

  background-color: #ddd;

}



/* Clear floats after the columns */

.row:after {

  content: "";

  display: table;

  clear: both;

}



/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */

@media screen and (max-width: 600px) {

  .column-1 {

    width: 100%;

    height: auto;

  }

}

</style>

<section>

    <div class="desktopmenu">

		<div class="">

			<div class="col-lg-12" style="padding: 0px">

				<div class="navbar-mm">

					

					<?php 

					$categorylist = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));

					if(isset($categorylist) && !empty($categorylist)){ 

						foreach ($categorylist as $kc=>$allcategoriesdatasec) {

					?>

					

  					<div class="dropdown-1">

					

    					<button class="dropbtn-1"><?php echo $allcategoriesdatasec['category_name']?> 

      					

						</button>

						

					

					  	

    					<div class="dropdown-content-1">

						      <!-- div class=" container header-1">

						        <h2>Dropdown-1</h2>

						      </div> -->

						      	<div class="container megamenu_c">

							      	<div class="row"> 
							      		<?php 

										$subcategorylist[$kc] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>$allcategoriesdatasec['categories_id']));

										if(isset($subcategorylist[$kc]) && !empty($subcategorylist[$kc])){ 

											foreach ($subcategorylist[$kc] as $ks=>$suballcategoriesdatasec) {

										?>
											<div class="column-1">

												<h3><?php echo $suballcategoriesdatasec['category_name']?> 
												
												<!--<?php echo $suballcategoriesdatasec['categories_id']?>-->
													
												<!--<?php echo $suballcategoriesdatasec['parent_category_id']?>-->
												</h3>

												<?php 

												$subsubcategorylist[$ks] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>$suballcategoriesdatasec['categories_id']));
												// print_r($subsubcategorylist[$ks]);
												if(isset($subsubcategorylist[$ks]) && !empty($subsubcategorylist[$ks])){ 
													foreach ($subsubcategorylist[$ks] as $kss=>$subsubcategorylistarry) {

												?>		

													<a href="#"><?php echo $subsubcategorylistarry['category_name']?> 
													
													<!--<?php echo $subsubcategorylistarry['categories_id']?>-->
													
													</a>
													
												<?php } }  ?>

											</div>
										<?php } } ?>

								   	</div>

								</div>

						</div>

						

						

  					</div>

  					

					<?php } } ?> 

  					

				</div>

			</div>

		</div>

    </div>
    
    <div class="mobilemenu">
		<div class="">
			<div class="col-lg-12" style="padding: 0px">
				<div class="menus m-1">
					<?php 
						$whrc = array('status'=>1,'parent_category_id'=>0);
						$allcategories = $this->Common_model->GetWhere('categories', $whrc);
					?>
					<ul class="customer-logos slider mb-0" style="padding-left: 0px;">
						<?php if(isset($allcategories) && !empty($allcategories)){ 
								foreach ($allcategories as $allcategoriesdata) {
						?>
						<li class="slide text-center">
							<a href="<?php echo base_url().'products?categories_id='.$allcategoriesdata['category_name']; ?>" >
							    <!--<?php echo base_url().'shops?categories_id='.$allcategoriesdata['category_id']; ?>-->
								<?php  echo (!empty($allcategoriesdata['category_image'])?'<img src='.base_url().'uploads/category/'.$allcategoriesdata['category_image'].' class="img-fluid menu-img">':'none'); ?>
								<!-- <img src="front_assets/images/slider1/1.jpg" class="img-fluid menu-img"> -->
								<span class="<?php echo (isset($_GET['categories_id']) && $_GET['categories_id'] == $allcategoriesdata['category_name'] ? 'activecolors' : ''); ?>"><?php echo $allcategoriesdata['category_name']?></span>
							</a>
						</li>
					<?php } } ?>
					
					</ul>
				</div>
			</div>
		</div>
    </div>

</section>

