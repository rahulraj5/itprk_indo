<style type="text/css">
    .radio input {
        display: block !important;
        margin-left: 5px !important;
    }
    .radio-btn {
        display: inline-block;
        margin-right: 15px;
    }
    .content-wrapper{
      height: 1400px !important;
    }
  </style>

<div class="content-wrapper">
  <section class="content">
    <div class="col-md-12" style="background-color: #fff">
      <!-- /.col -->
      <div class="row">
          <?php 
                include("shoPprofileNav.php");
                $shop_data = shopprofilebysession();
          ?>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- left column -->
      <div class="row">
        <div class="box box-primary">
          
          <?php if(isset($success) && !empty($success)){ 
                echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                  <h4><i class="fa fa-spinner fa-spin"></i> '.$success.'</h4>
                  </div>';
               echo '<meta http-equiv="refresh" content="2;url='.base_url('shop/coupon').'">';
            } 
            if(isset($error) && !empty($error)){
          ?>
            <div class="alert alert-danger" align="center">
              <strong><?php echo $error; ?></strong>
            </div>
          <?php } ?>
          <div class="col-md-12">
            <br>
            <form action="" method="post">
              <div class="row">
                <div class="col-sm-4">
                  <fieldset class="form-group">
                  <label for="">Coupon Code<span style="color:#FF0000;">*</span></label>
                  <input name="coupon_code" id="coupon_code" value="<?php echo (isset($coupons_data['coupon_code']) ? $coupons_data['coupon_code'] : '')?>" type="text" class="form-control" placeholder="Coupon Code" autofocus required/>
                  <span id="coupon_code_status"></span>
                  </fieldset>
                </div>
                <div class="col-sm-4">
                  <fieldset class="form-group">
                  <label for="">Offer Amount<span style="color:#FF0000;">*</span></label>
                  <input name="offer_amount" type="number" value="<?php echo (isset($coupons_data['offer_amount']) ? $coupons_data['offer_amount'] : '')?>" class="form-control" step="0.01" placeholder="Offer amount" required/>
                  </fieldset>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Offer Amount Type <span style="color:#FF0000;">*</span></label>
                    <select class="form-control" name="offer_amount_type">
                      <option  value="">Select Discount Type</option>
                      <option value="1" <?php echo (isset($coupons_data['offer_amount_type']) && $coupons_data['offer_amount_type'] == 1 ? "selected" : ''); ?> >%</option>
                      <option value="2" <?php echo (isset($coupons_data['offer_amount_type']) && $coupons_data['offer_amount_type'] == 2 ? 'selected' : ''); ?> >FLAT</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Total amount limit <span style="color:#FF0000;">*</span></label>
                    <input name="min_total_amount" type="number" value="<?php echo (isset($coupons_data['min_total_amount']) ? $coupons_data['min_total_amount'] : '')?>" class="form-control" step="0.01" placeholder="Enter total amount limit" required/>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Start Date <span style="color:#FF0000;">*</span></label>
                    <input name="start_date" type="date" value="<?php echo (isset($coupons_data['start_date']) ? $coupons_data['start_date'] : '')?>" class="form-control" step="0.01" placeholder="Enter total amount limit" required/>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>End Date <span style="color:#FF0000;">*</span></label>
                    <input name="end_date" type="date" value="<?php echo (isset($coupons_data['end_date']) ? $coupons_data['end_date'] : '')?>" class="form-control" step="0.01" placeholder="End Date" required/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12" align="center">
                  <button type="submit" class="btn btn-primary btnSubmit pull-right " name="savecoupon" style="height: 40px;line-height: 27px;">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
  <script type="text/javascript">
    $('#coupon_code').change(function(){
    var coupon_code = $(this).val();    
    if(coupon_code){
        $.ajax({
           type:"POST",
           url:"<?php echo base_url()?>shop/checkCouponCode",
           data:{coupon_code:coupon_code},
           success:function(res){               
            if(res){
              $("#coupon_code_status").html(res);
            }else{
              $("#coupon_code_status").html(res);
            }
           }
        });
    }else{
        $("#coupon_code_status").empty();
    }      
   });
  </script>