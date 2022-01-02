<link rel="stylesheet" href="<?php echo base_url(); ?>backend_assets/bower_components/select2/dist/css/select2.min.css">
<div class="content-wrapper">
  <section class="content-header">
    <?php if(isset($shop_data['shop_id']) && !empty($shop_data['shop_id'])){ ?>
      <h1><img src="<?php echo base_url().'common_assets/images/shop.png';?>" style="width: 30px"> Edit Vendor (<?php echo (isset($shop_data['shop_reg_id']) ? $shop_data['shop_reg_id'] : '');?>)</h1>
    <?php }else{ ?>
      <h1><img src="<?php echo base_url().'common_assets/images/shop.png';?>" style="width: 30px"> ADD Vendor</h1>
    <?php } ?>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url()?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a href="<?php echo base_url()?>admin/shoplist">Shoplist</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default">
      <div class="box-body">
        <div class="row" style="margin: 0px">
          <?php if(isset($success) && !empty($success)){ ?>
            <div class="alert alert-success" align="center">
              <strong><?php echo $success; ?></strong>
            </div>
          <?php } 
            if(isset($error) && !empty($error)){
          ?>
            <div class="alert alert-danger" align="center">
              <strong><?php echo $error; ?></strong>
            </div>
          <?php } ?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Shop Detail</a></li>
              <li><a href="#addbank" data-toggle="tab">Bank Detail</a></li>
              <li><a href="#gumasta" data-toggle="tab">Guamsta Image</a></li>
            </ul>
            <form role="form" enctype="multipart/form-data" method="post" action="">
              <div class="tab-content" style="padding: 0px">
                <div class="active tab-pane" style="margin: 10px" id="activity">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Registration Number</label>
                        <input type="text" class="form-control" name="shop_registration_no" value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_registration_no']) ? $shop_data['shop_registration_no'] : '' ); ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Owner Name</label>
                        <input type="text" class="form-control" name="owner_name" value="<?php echo (!empty($shop_data) && !empty($shop_data['owner_name']) ? $shop_data['owner_name'] : '' ); ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Shop Name</label>
                        <input type="text" class="form-control" name="shop_name" value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_name']) ? $shop_data['shop_name'] : '' )?>" required>
                      </div>
                      <div class="form-group">
                        <label>Email-ID</label>
                        <input type="email" class="form-control" name="email" value="<?php echo (!empty($shop_data) && !empty($shop_data['email']) ? $shop_data['email'] : '' )?>" required>
                      </div>
                      <?php if(!isset($shop_data['shop_id']) && empty($shop_data['shop_id'])){ ?>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password">
                        </div>
                      <?php } ?>
                      
                      <?php if(isset($shop_data['owner_image']) && !empty($shop_data['owner_image'])){ ?>
                        <div class="form-group">
                          <img src="<?php echo base_url()?>uploads/shop_images/shop_owner_images/<?php echo $shop_data['owner_image'];?>" class="img-responsive">
                        </div>
                      <?php  } ?>
                        <div class="form-group">
                          <label>Owner Image</label>
                          <input type="file" name="owner_image" class="form-control" value ="<?php echo (!empty($shop_data) && !empty($shop_data['owner_image']['name']) ? $shop_data['owner_image']['name'] : '' )?>" >
                        </div>
                        <!--isset($_FILES['owner_image']['name']) && !empty($_FILES['owner_image']['name'])-->
                        <div class="form-group">
                          <label>Adhar Number</label>
                          <input type="text" class="form-control" name="adhar_no" value="<?php echo (!empty($shop_data) && !empty($shop_data['adhar_no']) ? $shop_data['adhar_no'] : '' )?>" required>
                        </div>
                        <div class="form-group">
                            <label>Adhar Card Image For Desktop (265 * 165 px ) </label>
                            <input type="file" name=" adhar_image" class="form-control">
                        </div>
                      <?php if(isset($shop_data['adhar_image']) && !empty($shop_data['adhar_image'])){ ?>
                          <div class="form-group">
                            <img src="<?php echo base_url()?>uploads/shop_images/adhar_image/<?php echo $shop_data['adhar_image'];?>" class="img-responsive">
                          </div>
                      <?php } ?>
                    </div>
                    <div class="col-md-6">
                      <?php if(isset($shop_data['shop_id']) && !empty($shop_data['shop_id'])){ ?>
                          <!-- <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_no" value="<?php echo (!empty($shop_data) && !empty($shop_data['mobile_no']) ? $shop_data['mobile_no'] : '' )?>" required>
                          </div>
                          <div class="form-group">
                            <label>GST Number</label>
                            <input type="text" class="form-control" name="gst_number" value="<?php echo (!empty($shop_data) && !empty($shop_data['gst_number']) ? $shop_data['gst_number'] : '' )?>" required>
                          </div> -->
                      <?php }else{ ?>
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_no" value="" required>
                              </div>
                              <div class="form-group">
                                <label>GST Number</label>
                                <input type="text" class="form-control" name="gst_number" value="" required>
                              </div>
                      <?php } ?>
                      
                      <?php if(isset($shop_data['shop_image_desktop']) && !empty($shop_data['shop_image_desktop'])){ ?>
                          <div class="form-group">
                            <img src="<?php echo base_url()?>uploads/shop_images/shop_image_desktop/<?php echo $shop_data['shop_image_desktop'];?>" class="img-responsive">
                          </div>
                      <?php } ?>
                        <div class="form-group">
                          <label>shop Image For Desktop (265 * 165 px ) </label>
                          <input type="file" name="shop_image_mobile" class="form-control" >
                        </div>
                      <?php if(isset($shop_data['shop_image_mobile']) && !empty($shop_data['shop_image_mobile'])){ ?>
                        <div class="form-group">
                          <img src="<?php echo base_url()?>uploads/shop_images/shop_image_mobile/<?php echo $shop_data['shop_image_mobile'];?>" class="img-responsive">
                        </div>
                      <?php } ?>
                      <div class="form-group">
                        <label>shop Image For Mobile (265 * 100 px ) </label>
                        <input type="file" name="shop_image_desktop" class="form-control"  >
                      </div>
                      <div class="form-group">
                        <label>Shop Logo (150 * 150 px)</label>
                        <input type="file" name="shop_logo" class="form-control" >
                      </div>
                      <?php if(isset($shop_data['shop_logo']) && !empty($shop_data['shop_logo'])){ ?>
                      <div class="form-group">
                        <img src="<?php echo base_url()?>uploads/shop_images/shop_logos/<?php echo $shop_data['shop_logo'];?>" class="img-responsive">
                      </div>
                      <?php  } ?>
                      <?php if(!empty($shop_type_list)){ ?>
                          <div class="form-group">
                            <label>Select Shop Type</label>
                            <select class="form-control" name="shop_type_id"  required>
                              <option value="">Select Any Shop Type</option>
                              <?php 
                              foreach ($shop_type_list as $shop_type_list) {
                              ?>
                                <option value="<?php echo $shop_type_list['shop_type_id']; ?>" <?php echo (isset($shop_data['shop_type_id']) && $shop_data['shop_type_id'] == $shop_type_list['shop_type_id'] ? "selected" : ''); ?> ><?php echo $shop_type_list['shop_type_name'];?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                      <?php
                      }
                      ?>

                      <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text" class="form-control" name="pan_no" value="<?php echo (!empty($shop_data) && !empty($shop_data['pan_no']) ? $shop_data['pan_no'] : '' )?>" required>
                      </div>
                      <div class="form-group">
                        <label>Pan Card Image For Desktop (265 * 165 px ) </label>
                        <input type="file" name="pan_image" class="form-control" >
                      </div>
                      <?php if(isset($shop_data['pan_image']) && !empty($shop_data['pan_image'])){ ?>
                        <div class="form-group">
                          <img src="<?php echo base_url()?>uploads/shop_images/pan_image/<?php echo $shop_data['pan_image'];?>" class="img-responsive">
                        </div>
                      <?php } ?>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <?php
                              if(isset($shop_data['shopping_categories']) && !empty($shop_data['shopping_categories'])){
                                $shopping_categories = explode(',', $shop_data['shopping_categories']);
                              }
                              $whrc = array('status'=>1,'parent_category_id'=>0);
                              $allcategories = $this->Common_model->GetWhere('categories', $whrc);
                            ?>
                              
                              <label>Categories</label>
                              <select class="form-control select2 catselect" name="shopping_categories[]" multiple="multiple" data-placeholder="Select a categories"
                                      style="width: 100%;" >
                              <?php if(isset($allcategories) && !empty($allcategories)){ 
                                  foreach ($allcategories as $allcategoriesdata){
                              ?>
                                <option value="<?php echo $allcategoriesdata['category_name']; ?>" <?php echo (isset($shopping_categories) && !empty($shopping_categories) && in_array($allcategoriesdata['category_name'], $shopping_categories) ? 'selected' : '')?>><?php echo $allcategoriesdata['category_name']; ?></option>
                              <?php } } ?>
                              </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Upload GST Document</label>
                            <input type="file" name="gst_image" class="form-control" >
                          </div>
                          <?php if(isset($shop_data['gst_image']) && !empty($shop_data['gst_image'])){ ?>
                            <div class="form-group">
                              <img src="<?php echo base_url()?>uploads/shop_images/gst_image/<?php echo $shop_data['gst_image'];?>" class="img-responsive">
                            </div>
                          <?php } ?>
                        </div>

                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <?php
                              if(isset($shop_data['shopping_specialized']) && !empty($shop_data['shopping_specialized'])){
                                $shopping_specialized = explode(',', $shop_data['shopping_specialized']);
                              }
                              $swhrc = array('status'=>1,'parent_category_id !='=>0);
                              $sallcategories = $this->Common_model->GetWhere('categories', $swhrc);
                            ?>
                              
                              <label>Specialized Categories</label>
                              <select class="form-control select2 specialsubcat" name="shopping_specialized[]" multiple="multiple" data-placeholder="Select a categories"
                                      style="width: 100%;">
                              <?php if(isset($sallcategories) && !empty($sallcategories)){ 
                                  foreach ($sallcategories as $sallcategoriesdata){
                              ?>
                                <option  value="<?php echo $sallcategoriesdata['category_name']; ?>" <?php echo (isset($shopping_specialized) && !empty($shopping_specialized) && in_array($sallcategoriesdata['category_name'], $shopping_specialized) ? 'selected' : '')?>><?php echo $sallcategoriesdata['category_name']; ?></option>
                              <?php } } ?>
                              </select>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <link rel="stylesheet" href="<?php echo base_url();?>common_assets/bootstrap-tagsinput.css">
                      <div class="form-group">
                      <label>Shop tags</label><br>
                      <input type="text" style="width: 100%" class="form-control" name="meta_tags" value="<?php echo (isset($shop_data['meta_tags']) && !empty($shop_data['meta_tags']) ? $shop_data['meta_tags'] : '' )?>" data-role="tagsinput" />
                      </div>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                      <script src="<?php echo base_url();?>common_assets/bootstrap-tagsinput.min.js"></script>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input name="shop_address" class="form-control"  id="pac-input" value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_address']) ? $shop_data['shop_address'] : 'Indore Railway Station, Chhoti Gwaltoli, Indore, Madhya Pradesh, India' )?>"  >
                      </div>
                    </div>
                    <div class="col-md-12" style="padding: 0px">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Latitude</label>
                          <input type="text" name="shop_latitude"  class="form-control" id="latitude"  value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_latitude']) ? $shop_data['shop_latitude'] : "22.71720790" )?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Longitude</label>
                          <input type="text" name="shop_longitude"  class="form-control" id="longitude"  value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_longitude']) ? $shop_data['shop_longitude'] : "75.86841130" )?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" style="height: 243px;" id="gmap"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <!-- <span id="place-name"  class="title">Indore</span><br> -->
                      <span id="place-address"><?php echo (!empty($shop_data) && !empty($shop_data['address']) ? $shop_data['address'] : "Indore Railway Station, Chhoti Gwaltoli, Indore, Madhya Pradesh, India" )?></span>
                    </div>
                </div>
                <div class="tab-pane" id="addbank" style="margin: 10px">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Account Holder Name</label>
                          <input type="text" class="form-control" name="account_holder_name" value="<?php echo (!empty($shop_data) && !empty($shop_data['account_holder_name']) ? $shop_data['account_holder_name'] : "" )?>" required>
                        </div>
                    </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>BANK NAME</label>
                      <input type="text" class="form-control" name="bank_name" value="<?php echo (!empty($shop_data) && !empty($shop_data['bank_name']) ? $shop_data['bank_name'] : "" )?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Account Number</label>
                      <input type="text" class="form-control" name="bank_acc_no" value="<?php echo (!empty($shop_data) && !empty($shop_data['bank_acc_no']) ? $shop_data['bank_acc_no'] : "" )?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>IfSC CODE</label>
                      <input type="text" class="form-control" name="bank_ifsc_code" value="<?php echo (!empty($shop_data) && !empty($shop_data['bank_ifsc_code']) ? $shop_data['bank_ifsc_code'] : "" )?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Branch</label>
                      <input type="text" class="form-control" name="bank_branch" value="<?php echo (!empty($shop_data) && !empty($shop_data['bank_branch']) ? $shop_data['bank_branch'] : "" )?>" required>
                    </div>
                  </div>
                  <?php if(isset($shop_data['cancel_check_image']) && !empty($shop_data['cancel_check_image'])){ ?>
                      <div class="col-md-12">
                        <img src="<?php echo base_url()?>uploads/shop_images/cancel_check_images/<?php echo $shop_data['cancel_check_image'];?>" class="img-responsive">
                      </div>
                    <?php  } ?>
                    <div class="col-md-6">
                      <label>Cancel Check Image</label>
                      <input type="file" name="cancel_check_image" class="form-control">
                    </div>
                </div>
                <div class="tab-pane" id="gumasta" style="margin: 10px">
                    <?php if(isset($shop_data['owner_image']) && !empty($shop_data['owner_image'])){ ?>
                      <div class="form-group">
                        <img src="<?php echo base_url()?>uploads/shop_images/gumasta_images/<?php echo $shop_data['gumasta_image'];?>" class="img-responsive">
                      </div>
                    <?php  } ?>
                    <div class="form-group">
                      <label>Gumasta Image</label>
                      <input type="file" name="gumasta_image" class="form-control">
                    </div>
                </div>
              </div>
              <div class="col-md-12" style="margin: 10px">
                <?php if(isset($shop_data['shop_id']) && !empty($shop_data['shop_id'])){ ?>
                  <input type="hidden" name="shop_id" value="<?php echo (!empty($shop_data) && !empty($shop_data['shop_id']) ? $shop_data['shop_id'] : "" )?>">
                  <button type="submit" name="update"  class="btn btn-primary pull-right">Update</button>
                <?PHP  }else{ ?>
                  <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlk9jl3b8NvuKXQm6rft78c5T_PLe7gRg&libraries=places&callback=initMap" async defer></script>

<script src="<?php echo base_url(); ?>backend_assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    //Initialize Select2 Elements
    $(".catselect").on("change", function(){
        var cat = $(this).val();
        // alert(cat);
        // console.log(cat);

        $.ajax({
              type: "POST",
              url: "<?php echo base_url()?>admin/subcatbycatname",
              data: {cat:cat},
              dataType: "html",
              success : function(data){
                  // alert(data);
                  $('.specialsubcat').html(data);
              },
              error: function(data) {
                  $.notify(data.msg, "Empty");
              },
          });
      });
    $('.select2').select2();
    $('.mdb-select').materialSelect();
    $('#basicExample').timepicker({
      timeFormat: 'HH:mm',
      startTime: '07:00',
      minTime: '07:00', // 11:45:00 AM,
      maxHour: 23,
      interval: 30 
    });

    $('#basicExampleclose').timepicker({
      timeFormat: 'H:mm',
      startTime: '07:00',
      minTime: '07:00', // 11:45:00 AM,
      maxHour: 23,
      interval: 30 
    });


});


function initMap() {
    var latt = ($("#latitude").val() != "")? parseFloat($("#latitude").val()) : 22.71720790;
    var longg = ($("#longitude").val() != "")? parseFloat($("#longitude").val()) : 75.86841130;
    console.log("latt =",latt," longg =",longg);
    var map = new google.maps.Map(document.getElementById('gmap'), {
      center: {lat: latt, lng: longg},
      zoom: 13
    });
    var input = document.getElementById('pac-input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    // Bind the map's bounds (viewport) property to the autocomplete object,

    // so that the autocomplete requests use the current map bounds for the

    // bounds option in the request.

    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
      map: map,
      position : new google.maps.LatLng(latt, longg),
    });
    infowindow.open(map, marker);
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
    });
    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      $("#latitude").val(place.geometry.location.lat().toFixed(8));
      $("#longitude").val(place.geometry.location.lng().toFixed(8));
      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {

        map.setCenter(place.geometry.location);

        map.setZoom(17);  // Why 17? Because it looks good.

      }

      marker.setPosition(place.geometry.location);

      marker.setVisible(true);



      var address = '';

      if (place.address_components) {

        address = [

          (place.address_components[0] && place.address_components[0].short_name || ''),

          (place.address_components[1] && place.address_components[1].short_name || ''),

          (place.address_components[2] && place.address_components[2].short_name || '')

        ].join(' ');

      }



      infowindowContent.children['place-icon'].src = place.icon;

      infowindowContent.children['place-name'].textContent = place.name;

      infowindowContent.children['place-address'].textContent = address;

      infowindow.open(map, marker);

    });
}

</script>