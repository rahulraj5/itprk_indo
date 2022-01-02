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
               echo '<meta http-equiv="refresh" content="2;url='.base_url('shop/profile').'">';
            } 
            if(isset($error) && !empty($error)){
          ?>
            <div class="alert alert-danger" align="center">
              <strong><?php echo $error; ?></strong>
            </div>
          <?php } ?>
          <div class="col-md-6 col-sm-12 col-md-offset-3">
            <br>
            <form action="" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <fieldset class="form-group">
                  <label for="">Current Password<span style="color:#FF0000;">*</span></label>
                  <input name="current_password" type="password" class="form-control" placeholder="Current Password" autofocus required/>
                  </fieldset>
                </div>
                <div class="col-sm-12">
                  <fieldset class="form-group">
                  <label for="">New Password<span style="color:#FF0000;">*</span></label>
                  <input name="new_password" type="password" class="form-control" placeholder="New Password" required/>
                  </fieldset>
                </div>
                <div class="col-sm-12">
                  <fieldset class="form-group">
                  <label for="">Re-Enter Password<span style="color:#FF0000;">*</span></label>
                  <input name="re_enter_password" type="password" class="form-control" placeholder="Re-Enter Password" required/>
                  </fieldset>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12" align="center">
                  <button type="submit" class="btn btn-primary btnSubmit " name="changenormalpassword" style="height: 40px;line-height: 27px;text-align: center;"><i class="fa fa-refresh"></i> Update Password</button>
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
