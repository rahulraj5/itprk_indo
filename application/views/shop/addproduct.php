<style type="text/css">
	.dropzone {
	  cursor: pointer;
	  border: 2px dashed #0087F7;
	  border-radius: 5px;
	  background: #fafafa;
	  min-height: 150px;
	  padding: 54px 54px;
	  margin-bottom: 25px;
	}
	.fileupload{
	  position: absolute;
	  width: 100%;
	  height: 100%;
	  top:0;
	  right: 0;
	  cursor: pointer;
	  opacity: 0;
	}
	.bspHasModal{
	  list-style-type: none;
	}
	.mb-3{
		margin-bottom: 10px;
	}
	input:checked + .slider {
	    background-color: rgb(100, 189, 99);
	}
	.slider {
	    position: absolute;
	    cursor: pointer;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    background-color: #888888;
	    -webkit-transition: .4s;
	    transition: .4s;
	}
	.slider.round {
	    border-radius: 20px;
	}
	.slider:before {
	    position: absolute;
	    content: "";
	    height: 18px;
	    width: 18px;
	    left: 0px;
	    bottom: 0px;
	    background-color: white;
	    -webkit-transition: .4s;
	    transition: .4s;
	}
	.switch {
	    position: relative;
	    display: inline-block;
	    width: 38px;
	    height: 18px;
	}
	.custom-input-file--4 + label {
	    background: transparent;
	    padding: 0;
	}
	.custom-input-file {
	    width: 0.1px;
	    height: 0.1px;
	    opacity: 0;
	    outline: none;
	    overflow: hidden;
	    position: absolute;
	    z-index: -1;
	}
	.custom-input-file + label {
	    max-width: 80%;
	    font-size: 0.875rem;
	    font-weight: 600;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    cursor: pointer;
	    display: block;
	    overflow: hidden;
	    padding: 0.625rem 1.25rem;
	    border: 1px solid #e6e6e6;
	    border-radius: 2px;
	    color: #FFF;
	    outline: none;
	}
	.custom-input-file--4+label strong {
	    color: #676767;
	    background-color: #e6e6e6;
	    font-size: 14px;
	    padding: 0.4rem 1.25rem;
	    font-weight: 400;
	}
	.custom-input-file--4 + label strong {
	    float: right;
	    height: 100%;
	    color: #000;
	    display: inline-block;
	    font-weight: 600;
	}
	label{
		font-size: 15px;
	}
	.box{
		padding: 10px;
		box-shadow: none;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>common_assets/editor/jodit.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
	    color: #000;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1> <img src="<?php echo base_url().'common_assets/images/productcarticon.png';?>" style="width: 30px"> <?php if(isset($product_data) && !empty($product_data)) { ?> Edit Product <?php } else { ?> Add Product<?php } ?></h1>
	</section>
	<section class="content">
	    <div class="row">
	    	<div class="col-xs-12" style="background-color: #fff">
	    		<div class="row">
			        <div class="box box-primary">
			          
			          <?php if(isset($success) && !empty($success)){ 
			                echo '<div class="alert alert-success alert-dismissible">
			                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
			                  <h4> '.$success.'</h4>
			                  </div>';
			               //echo '<meta http-equiv="refresh" content="2;url='.base_url('shop/productlist').'">';
			            } 
			            if(isset($error) && !empty($error)){
			          ?>
			            <div class="alert alert-danger" align="center">
			              <strong><?php echo $error; ?></strong>
			            </div>
			          <?php } ?>
			          <form role="form" enctype="multipart/form-data" method="post" action="" id="choice_form">
			          	<input type="hidden" name="product_id" value="<?php echo (isset($product_data) && !empty($product_data['product_id']) ? $product_data['product_id'] : "" )?>">
			            <div class="col-md-6">
			                
			            	<?php if(!empty($categorylist) ){ 
			            	// 		print_r($product_data);
			            	// 		p($product_data);
			            			
			            			
			            			
			            			$data = array();
                            		$shop_id = shopsessionShopid();
                            		if(!empty($shop_id)){
                            			$where = array('status !='=>3,'shop_id'=>$shop_id);
                            			$data['shop_dataa'] = $this->Common_model->GetWhere("shops",$where);
                            			if(!empty($data['shop_dataa']))
                            			{
                            				$shop_dataa = $data['shop_dataa'][0];
                            			}
                            		}
                            		
                            		if(!empty($data['shop_dataa']))
			                        {
                        				$shop_dataa = $data['shop_dataa'][0];
                        
                        				// print_r($shop_dataa);
                        				$shopping_categories = $shop_dataa['shopping_categories'];
                        				// print_r($shopping_categories);
                        				$result_string = "'" . str_replace(",", "','", $shopping_categories) . "'";
                        				// echo "Input String: ".$result_string;
                        				$whrc = " WHERE category_name in (".$result_string.")";
                        				// print_r($whrc);
                        				$data['shopping_categories'] = $this->Common_model->getwhrcategoiesbycatname($whrc);
                        				// print_r($data['shopping_categories']);
                        				$shop_cat_data = $data['shopping_categories'];
		                                //  print_r($shop_cat_data);
                        				// print_r($res);
                        				// die;
                        			}
                        			
                        			if(isset($shop_cat_data) && !empty($shop_cat_data)){
        				    			$scid = array();
        				    			foreach ($shop_cat_data as $scc) {
        				    				$scid[] = $scc['categories_id'];
        				    			}
        				    			// print_r($scid);
        
        				    			$scidi = implode(",", $scid);
        				    // 			print_r($scidi);
        				    			$scidii = "'" . str_replace(",", "','", $scidi) . "'";
                                        // print_r($scidii);
        				    		}
        				    		
        				    		if(isset($scidii) && !empty($scidii))
        				    		{
        
            				    		$whrcc = " WHERE categories_id in (".$scidii.") AND parent_category_id =0";
            				            //print_r($scidii);
            				    		$allcategoriesc = $this->Common_model->getwhrcategoiesbycatid($whrcc);
            				            //p($allcategoriesc);
                        			
        				    		}else{
        				    		    
        				    		}
                            		
			            		?>
			            		
			            		
			                  <div class="form-group">
			                    <label>Category</label>
			                    <select class="form-control" name="categories_id" id="category"  required>
			                      <option value="">Select Any Category</option>
			                      <?php 
			                      foreach ($allcategoriesc as $allcategoriesc) {
			                      ?>
			                        <option value="<?php echo $allcategoriesc['categories_id']?>" <?php echo (isset($product_data['categories_id']) && $product_data['categories_id'] == $allcategoriesc['categories_id'] ? "selected" : ''); ?>><?php echo $allcategoriesc['category_name'];?></option>
			                      <?php
			                      }
			                      ?>
			                    </select>
			                  </div>
			                  <div class="form-group subcategorylist">
			                  	<?php if(isset($product_data['sub_categories_id']) && !empty($product_data['sub_categories_id'])){ 
			                  		$subcategory =  $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>$product_data['categories_id']));
			                 // 		print_r($subcategory);
			                  		
			                  	?>
				                  	<select class="form-control" name="sub_categories_id" id="sub_categories_id">
									  <option value="">Select Sub Category</option>
									  <?php 
									  foreach ($subcategory as $subcategory){
									  ?>
									    <option value="<?php echo $subcategory['categories_id']?>" <?php echo (isset($product_data['sub_categories_id']) && $product_data['sub_categories_id'] == $subcategory['categories_id'] ? "selected" : ''); ?> ><?php echo $subcategory['category_name'];?></option>
									  <?php
									  }
									  ?>
									</select>
								<?php } ?>
			                  </div>
							<?php } ?>
			              <div class="form-group">
			                <label>Product Name</label>
			                <input type="text" class="form-control" name="name" value="<?php echo (!empty($product_data) && !empty($product_data['name']) ? $product_data['name'] : "" )?>" required>
			              </div>
			              <div class="form-group">
			                <label>GST</label>
			                <input type="number" class="form-control" name="product_gst" value="<?php echo (!empty($product_data) && !empty($product_data['product_gst']) ? $product_data['product_gst'] : "" )?>" >
			              </div>
			              <div class="form-group">
			                <label>Description &nbsp;<b style="color:#ff0000;">*</b></label>
			                            
                            <textarea class="form-control editor" rows="5" name="description" id="description" value="<?php echo (!empty($product_data['description']))? $product_data['description']:''; ?>" > <?php echo (!empty($product_data['description']))? $product_data['description']:''; ?> </textarea>
                            <div class="help-block with-errors"></div>
			              </div>
			              <div class="form-group">
			                <label>Quantity</label>
			                <input type="number" class="form-control" name="quantity" value="<?php echo (!empty($product_data) && !empty($product_data['quantity']) ? $product_data['quantity'] : "" )?>" required>
			                <?php if(isset($error_email) && !empty($error_email)){echo "<span class='error'>$error_email</span>";}?>
			              </div>
			            </div>
			            <div class="col-md-6">
			              	<div class="form-group">
			                  <label>Unit Price</label>
			                  <input type="text" class="form-control" step="0.01" name="unit_price" value="<?php echo (!empty($product_data) && !empty($product_data['unit_price']) ? $product_data['unit_price'] : "" )?>" required>
			                </div>
			                <div class="form-group">
			                  <label>Discount</label>
			                  <input type="number" step="0.01" class="form-control" name="discount" value="<?php echo (!empty($product_data) && !empty($product_data['discount']) ? $product_data['discount'] : "" )?>" >
			                </div>
			                <div class="form-group">
			                  <label>Discount Type</label>
			                  <select class="form-control" name="discount_type">
			                  	<option  value="">Select Discount Type</option>
			                  	<option value="1" <?php echo (isset($product_data['discount_type']) && $product_data['discount_type'] == 1 ? "selected" : ''); ?> >%</option>
			                  	<option value="2" <?php echo (isset($product_data['discount_type']) && $product_data['discount_type'] == 2 ? 'selected' : ''); ?> >FLAT</option>
			                  </select>
			                </div>

			                <div class="form-group">
				                <label>Return Policy &nbsp;<b style="color:#ff0000;">*</b></label>
				                            
	                            <textarea class="form-control editor" rows="5" name="return_policy" id="return_policy" value="<?php echo (!empty($product_data['return_policy']))? $product_data['return_policy']:''; ?>" > <?php echo (!empty($product_data['return_policy']))? $product_data['return_policy']:''; ?> </textarea>
	                            <div class="help-block with-errors"></div>
				              </div>
			            </div>
			           
						<div class="col-md-12">
							<?php if(isset($product_data['main_image']) && !empty($product_data['main_image'])){ ?>
									<img src="<?php echo base_url().'uploads/product_images/'.$product_data['main_image']?>" class="img-responsive" style="max-width: 290px;">
							<?php }else{ ?>
								    <img class="mainimgurl img-responsive" src="" style="max-width: 290px;">
							<?php }?>
                            <label>Main Image <small>(290x300)</small> <span class="required-star">*</span></label>
                            <div class="col-md-12" style="padding: 0px">
                                <input type="file" name="main_image" id="file-2" class="mainimg custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*">
                                <label for="file-2" class="mw-100 mb-3">
                                    <span></span>
                                    <strong>
                                        <i class="fa fa-upload"></i>
                                        Choose image
                                    </strong>
                                </label>
                            </div>
                        </div>
			            <div class="col-md-12">
							<div class="form-group" style="margin-bottom: 25px;">
								<div class="col-md-5" style="padding: 0px">
									<label>Image gallery</label>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="dropzone">
								<div class="text-center">
									<p>Drop files here or click to upload.</p>
								</div>
								<input type="file" name="product_galary[]" multiple class="fileupload" id="product_galary">
							</div>
							<ul class="row first" id="product_galary_list">
								<?php if(isset($product_data['product_images']) && !empty($product_data['product_images']) && !empty($product_data['product_images'])){ 

									 $product_images = json_decode($product_data['product_images'],true);
								?>
								<?php foreach($product_images as $dgl){ ?>
								<li class="col-lg-2 col-md-4 col-sm-3 col-xs-4 col-xxs-12 bspHasModal <?php echo $dgl; ?>" data-bsp-li-index="9">
									<div class="imgWrapper">
										<input type="hidden" name="previous_photos[]" value="<?php echo $dgl; ?>">
										<button type="button" class="btn btn-danger close-btn remove-files pull-right"><i class="fa fa-times"></i></button>
										<img alt="Cool colors" src="<?php echo base_url().'uploads/product_images/'.$dgl; ?>" class="img-responsive"></div>
								</li>
								<?php } } ?>
							</ul>
						</div>

						<div class="col-md-12 form-box bg-white mt-4">
                            <div class="form-box-title px-3 py-2">
                               <label> Customer Choice</label>
                            </div>
                            <div class="form-box-content p-3">
                                <div class="row mb-3">
                                    <div class="col-md-8 col-md-3 order-1 order-md-0">
    									<input type="text" class="form-control" value="Colors" disabled>
    								</div>
    								<div class="col-md-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
    									<select class="form-control color-var-select js-example-basic-multiple" name="colors[]" id="colors" multiple>
    										<?php if(isset($color) && !empty($color)){ 
    												foreach($color as $color){
    											?>
    												<option value="<?php echo $color['code']; ?>" <?php if(isset($product_data) && !empty($product_data) && in_array($color['code'], json_decode($product_data['colors']))) echo 'selected'?>><?php echo $color['name'];?></option>
    										<?php } } ?>
    									</select>
    								</div>
    								<div class="col-md-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
    									<label class="switch" style="margin-top:5px;padding: 0px 10px 0px 0px;">
    										<input value="1" type="checkbox" name="colors_active" <?php if(isset($product_data) && !empty($product_data) && count(json_decode($product_data['colors'])) > 0) echo "checked";?>>
    										<span class="slider round"></span>
    									</label>
    								</div>
                                </div>
                                <div id="customer_choice_options">
                                	<?php if(isset($product_data['choice_options'])) { 
                                			foreach(json_decode($product_data['choice_options'],true) as $key => $choice_option){

                                	?>
    									<div class="row mb-3">
    										<div class="col-8 col-md-3 order-1 order-md-0">
    											<input type="hidden" name="choice_no[]" value="<?php echo explode('_', $choice_option['name'])[1]; ?>">
    											<input type="text" class="form-control" name="choice[]" value="<?php echo $choice_option['title']; ?>" placeholder="Choice Title">
    										</div>
    										<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
    											<input type="text" class="form-control" name="choice_options_<?php  echo explode('_', $choice_option['name'])[1];?>[]" placeholder="Enter choice values" value="<?php echo implode(',', $choice_option['options']) ?>" data-role="tagsinput" onchange="update_sku()">
    										</div>
    										<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
                                                <button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                                            </div>
    									</div>
    								<?php } } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
    									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">'Add More Customer Choice Option</button>
    								</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="sku_combination"></div>
                        <div class="col-md-12">
	                        <div class="form-group">
				                <label>Tags</label>
				                <input type="text" class="form-control" name="tags" value="<?php echo (!empty($product_data) && !empty($product_data['tags']) ? $product_data['tags'] : "" )?>" placeholder="Examle : Tshir,Polotshirt,tshirt" required>
				             </div>
				        </div>
				        <div class="col-md-12">
	                        <div class="form-group">
				                <label>Meta Title</label>
				                <input type="text" class="form-control" name="meta_title" value="<?php echo (!empty($product_data) && !empty($product_data['meta_title']) ? $product_data['meta_title'] : "" )?>" placeholder="Examle : Polo Tshir" required>
				             </div>
				        </div>
				        <div class="col-md-12">
	                        <div class="form-group">
				                <label>Meta Description</label>
				                <input type="text" class="form-control" name="meta_description" value="<?php echo (!empty($product_data) && !empty($product_data['meta_description']) ? $product_data['meta_description'] : "" )?>" required>
				             </div>
				        </div>
                        <div class="col-md-12">
							<?php if(isset($product_data['meta_image']) && !empty($product_data['meta_image'])){ ?>
									<img src="<?php echo base_url().'uploads/product_images/'.$product_data['meta_image']?>" class="img-responsive">
							<?php } ?>
                            <label>Meta Image <small>(50*50)</small></label>
                            <div class="col-md-12" style="padding: 0px">
                                <input type="file" name="meta_image"  >
                                
                            </div>
                        </div>
			            <div class="col-md-12" style="margin: 10px;">
			              <?php if(isset($shop_data['shop_id']) && !empty($shop_data['shop_id'])){ ?>
			                <input type="hidden" name="shop_id" value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_id']) ? $shop_data['shop_id'] : "" )?>">
			                <button type="submit" name="update"  class="btn btn-primary pull-right">Update</button>
			              <?PHP  }else{ ?>
			                <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">Submit</button>
			              <?php } ?>
			            </div>
			          </form>
			        </div>
			     </div>
	    	</div>
	    </div>
	</section>
</div>
<script src="<?php echo base_url();?>common_assets/editor/jodit.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    // $('.js-example-basic-multiple').select2();
	    update_sku();
	    $('.remove-files').on('click', function(){
            $(this).parents(".imgWrapper").remove();
        });

        function readURL(input) {
	  		if (input.files && input.files[0]) {
		    	var reader = new FileReader();
		    
			    reader.onload = function(e) {
			      	$('.mainimgurl').attr('src', e.target.result);
			      	// alert(e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]); // convert to base64 string
			 }
		}

		$(".mainimg").change(function() {
		    // alert("hi");
		    readURL(this);
		});

	    $('.color-var-select').select2({
	        templateResult: colorCodeSelect,
	        templateSelection: colorCodeSelect,
	        escapeMarkup: function(m) { return m; }
	    });
	    function colorCodeSelect(state) {
	        var colorCode = $(state.element).val();
	        if (!colorCode) return state.text;
	        return  "<span class='color-preview' style='background-color:"+colorCode+";'></span>" + state.text;
	    }

	    $(".demo-select2-max-4").select2({
        	maximumSelectionLength: 4
	    });

		$(".demo-select2-max-10").select2({
	        maximumSelectionLength: 10
	    });


		// SELECT2 PLACEHOLDER
		// =================================================================
		// Require Select2
		// https://github.com/select2/select2
		// =================================================================
		$(".demo-select2-placeholder").select2({
		    placeholder: "Select an option",
		    allowClear: true
		});



		// SELECT2 SELECT BOXES
		// =================================================================
		// Require Select2
		// https://github.com/select2/select2
		// =================================================================
		$(".demo-select2-multiple-selects").select2();

		$('.editor').each(function(el){
			var $this = $(this);
	        var buttons = $this.data('buttons');
	        buttons = !buttons ? "bold,underline,italic,hr,|,ul,ol,|,align,paragraph,|,image,table,link,undo,redo" : buttons;

			var editor = new Jodit(this, {
	            "uploader": {
	                "insertImageAsBase64URI": true
	            },
	            "toolbarAdaptive": false,
	            "defaultMode": "1",
	            "toolbarSticky": false,
	            "showXPathInStatusbar": false,
	            "buttons": buttons,
	        });
		});

		$('#category').on('change', function(){
		    var cat_id = $("#category").val();
		    // alert(cat_id);
		    $.ajax({
			   type:"POST",
			   url:base_url+ 'shop/subcategoryhtml',
			   data:{categories_id:cat_id},
			   success: function(data){
				   $('.subcategorylist').html(data);
			   }
		   });
		});
	});

	$("body").on("change","#product_galary", function(e){
        handleFileSelect(e);
    });
    function handleFileSelect(evt) 
	{
		var files = evt.target.files; // FileList object

		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) 
		{

		  // Only process image files.
		  if (!f.type.match('image.*')) {
		    continue;
		  }

		  var reader = new FileReader();

		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
		    return function(e) {
		      var fdata = e.target.result;

		      var jlist = "";
		      jlist +='<li class="col-lg-2 col-md-4 col-sm-3 col-xs-4 col-xxs-12 bspHasModal" data-bsp-li-index="1">';
		      jlist +='    <div class="imgWrapper"><img alt="Yellow sign" src="'+fdata+'" class="img-responsive"></div>';
		      jlist +='</li>';
		      
		      $("#product_galary_list").append(jlist);
		    };
		  })(f);

		  // Read in the image file as a data URL.
		   reader.readAsDataURL(f);
		  // reader.readAsBinaryString(f);
		  //reader.readAsText(f);
		}
	}

	// var i = 0;
	var i = $('input[name="choice_no[]"').last().val();
	// alert(i);
    if(isNaN(i)){
		i =0;
	}
	function add_more_customer_choice_option(){
		i++;
		$('#customer_choice_options').append('<div class="row mb-3"><div class="col-8 col-md-3 order-1 order-md-0"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="Choice Title"></div><div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0"><input type="text" class="form-control tagsInput" name="choice_options_'+i+'[]" placeholder="Enter choice values" onchange="update_sku()"></div><div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right"><button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button></div></div>');
		
        $('.C').tagsinput('items');
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
    	update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

    $('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.row').remove();
		update_sku();
	}

	function update_sku(){
        $.ajax({
		   type:"POST",
		   url:base_url+ 'shop/sku_combination',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
		   }
	   });
	}
	$(".clearance_status").click(function(e){
        var val = confirm("Sure you want to Add In Stock clearacne ?");
        var id = $(this).attr("href-id");
        if(val){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>shop/change_status",
            data:{tablename:'product',id:id,status:1,whrcol:'product_id',whrstatuscol:'clearance_status',action:"Stock clearacne"},
            dataType:'json',
            success: function(response) {
              if (response.status == 1){
                $.notify(response.msg, "success");
                setTimeout(function(){location.reload()},1000);
              }else{
                $.notify(response.msg, "error");
              }
            }
          });
        }
  });

  $(".remove_clearance_status").click(function(e){
        var val = confirm("Sure you want to Remove From Stock clearacne ?");
        var id = $(this).attr("href-id");
        if(val){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>shop/change_status",
            data:{tablename:'product',id:id,status:0,whrcol:'product_id',whrstatuscol:'clearance_status',action:"Stock clearacne"},
            dataType:'json',
            success: function(response) {
              if (response.status == 1){
                $.notify(response.msg, "success");
                setTimeout(function(){location.reload()},1000);
              }else{
                $.notify(response.msg, "error");
              }
            }
          });
        }
  });

  	
</script>

      