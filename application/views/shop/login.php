 <style type="text/css">
    .bg { 
      /* The image used */
      background-image: url("<?php echo base_url().'uploads/'. getWebOptionValue('backedn_login_background_image');?>");
      height: auto; 
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    .login-box-body a {
    color: #005551 !important;
    text-decoration: underline;
    /*padding-left: 30px;*/
  }
  </style>
  <style type="text/css">
  .form-group.has-success label{
    color: #fff;
  }
  .login-box-body{
    color: #fff;
    font-weight: bold;
    font-size: 18px;
  }
  .form-control{
    /*border-radius: 15px 15px 15px 15px;*/
  }
  .form-group.has-success .form-control{
    background: #def1f9;
  }
  .btn-block{
    background-color: #840512;
    border-color: #d20c21;
    color: #fff;
    font-weight: bold;
    font-size: 15px;
  }
  .btn-block:hover{
    border-color: #651018;
  }
  .has-feedback label~.form-control-feedback {
    top: 30px;
    color: #840512;
}
.login-box-body{
  /*color: #333;*/
}
.login-box-body {
    background-color: rgb(204 80 93);
    /* background-color: rgba(0, 85, 81, 0.07); */
    border-radius: 8px 8px 8px 8px;
    padding-bottom: 4px;
    box-shadow: 1px 1px 6px 0px #ccc;
    box-shadow: 1px 1px 6px 0px rgba(0, 0, 0, 0.5);
    border-top: 5px solid #840512;
    border-bottom: 5px solid #840512;
}
.btn-design{
  border-radius: 20px 20px 20px 20px;
}
.login-logo {
    padding: 7px 0px;
    background-color: #840512;
    border-bottom: 4px solid #a00c1bde;
}

.addnewaddressview{
       display: none; 
    }

.verifyloginotpmodel{
    display: none; 
}    
.dnone{
  display: none; 
}  
.dbloc{
  display: block; 
}
.btn-success.focus, .btn-success:focus {
    color: #fff;
    background-color: #840512 !important;
    border-color: #840512 !important;
}
.btn-success:hover, .btn-success:active, .btn-success.hover {
    background-color: #840512;
}
.btn-success.disabled.focus, .btn-success.disabled:focus, .btn-success.disabled:hover, .btn-success[disabled].focus, .btn-success[disabled]:focus, .btn-success[disabled]:hover, fieldset[disabled] .btn-success.focus, fieldset[disabled] .btn-success:focus, fieldset[disabled] .btn-success:hover {
    background-color: #840512;
    border-color: #840512;
}

.btn-success.active.focus, .btn-success.active:focus, .btn-success.active:hover, .btn-success:active.focus, .btn-success:active:focus, .btn-success:active:hover, .open>.dropdown-toggle.btn-success.focus, .open>.dropdown-toggle.btn-success:focus, .open>.dropdown-toggle.btn-success:hover {
    color: #fff;
    background-color: #840512;
    border-color: #840512;
}
</style>


<div class="login-box loginformdisplay">
  <!-- /.login-logo -->
  <div class="login-box-body" id="login">
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getWebOptionValue('backlogo');?>" alt="<?php echo  getWebOptionValue('site_title');?>"></a>
    </div>
    <div class="col-md-12" id="alertmsg"></div>
    <div class="clearfix"></div>
    <form action=""  id="loginformpassword" method="post" style="padding: 15px;">
      <div class="form-group has-feedback">
        <label>Mobile No.</label>
        <input type="text" class="form-control loginmoibleno" id="Phone" placeholder="Mobile No.">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" style="padding-bottom: 14px;">
        <label>Password</label>
        <input type="password" class="form-control loginpassword" id="Password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-success btn-block btn-flat submitloginbypassword">Sign In</button>
        </div>
        <div class="col-xs-12">
        <div class="form-group text-center" style="color: #ffffff;">
              <h6 style="font-size: 12px;">OR</h6>
        </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group text-center">
              <button type="button" class="btn btn-success btn-block btn-flat sign_up">Login By OTP</button>
             </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="form-group text-center create">
          Click for <a href="<?php echo base_url()?>vendor_registration" class="" > Create an account</a>
      </div>

    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>

<div class="login-box addnewaddressview">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getWebOptionValue('backlogo');?>" alt="<?php echo  getWebOptionValue('site_title');?>"></a>
    </div>
    <div class="col-md-12" id="alertmotpmsg"></div>
    <div class="clearfix"></div>
    <form action="" id="loginbyotpsubmit" method="post" style="padding: 15px;">
      <!-- <div class="form-group has-feedback">
        <label>Name</label>
        <input type="text" class="form-control rfirstname" id="RFirstName" placeholder="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> -->
      
      <div class="form-group has-feedback">
        <label>Mobile No. </label>
        <input type="number" class="form-control rmobilenumber"  id="Rmobile" placeholder="Enter your 10 digit mobile no.">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <label>Shop Registration id</label>
        <input type="text" class="form-control rshop_reg_id" id="shop_reg_id" placeholder="shop registration id">
        <span class="glyphicon glyphicon- form-control-feedback"></span>
      </div> -->
      <!-- <div class="form-group has-feedback">
        <label>Password</label>
        <input type="password" class="form-control rpassword" id="Rpass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-success btn-block btn-flat loginbyotpsubmit">Submit</button>
        </div>
        <!-- /.col -->
      </div>
      <!-- <div class="form-group text-center create">
          Already have Account?  <a class="sign_in"> sign in</a>
      </div> -->
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>

<div class="login-box verifyloginotpmodel">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getWebOptionValue('backlogo');?>" alt="<?php echo  getWebOptionValue('site_title');?>"></a>
    </div>
    <div class="alertotpmsg"></div>
    <div class="clearfix"></div>
    <form action="" id="verifyloginotp" method="post" style="padding: 15px;">
      <!-- <div class="form-group has-feedback">
        <label>Name</label>
        <input type="text" class="form-control rfirstname" id="RFirstName" placeholder="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> -->
      
      <div class="form-group has-feedback">
        <label>Enter OTP</label>
        <input type="number" class="form-control rmobilenumber"  id="loginotpval" placeholder="OTP">
        
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <label>Shop Registration id</label>
        <input type="text" class="form-control rshop_reg_id" id="shop_reg_id" placeholder="shop registration id">
        <span class="glyphicon glyphicon- form-control-feedback"></span>
      </div> -->
      <!-- <div class="form-group has-feedback">
        <label>Password</label>
        <input type="password" class="form-control rpassword" id="Rpass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-success btn-block btn-flat verifyloginotp re">Submit</button>
        </div>
        <!-- /.col -->
      </div>
      <!-- <div class="form-group text-center create">
          Already have Account?  <a class="sign_in"> sign in</a>
      </div> -->
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>




<script>
   $(".sign_up").click(function(){

    $(".loginformdisplay").css("display","none");
    $(".addnewaddressview").css("display","block");
    $(".verifyloginotpmodel").css("display","none");
  })

  $(".sign_in").click(function(){

  $(".addnewaddressview").css("display","none");
  $(".loginformdisplay").css("display","block");
  $(".verifyloginotpmodel").css("display","none");
  })

  // $(".loginbyotpsubmit").click(function(){
  //   $(".verifyloginotpmodel").css("display","block");
  //   $(".addnewaddressview").css("display","none");
  //   $(".loginformdisplay").css("display","none");
  
    
  // })


  $(".submitloginbypassword").on("click", function(){
      $("#loginformpassword .submitloginbypassword").attr('disabled', true);
      $("#loginformpassword .submitloginbypassword").addClass('buttonload'); 
      $("#loginformpassword .submitloginbypassword").html('<i class="fa fa-spinner fa-spin"></i>Loading');
      // Initiate Variables With Form Content
      var loginmoibleno = $(".loginmoibleno").val();
      var loginpassword = $(".loginpassword").val();
      var clickbutton = $(".clickbutton").val();
      // alert(loginmoibleno);
      var href = "<?php echo base_url();?>shop/loginajax";
      if(loginmoibleno && loginpassword){
        $.ajax({
            type: "POST",
            url: href,
            data: { mobile_no:loginmoibleno,password:loginpassword},
            dataType: "json",
            success : function(data){
              if(data.status == 1){
                setTimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);
              }else{
                $("#alertmsg").html("<div class='alert alert-danger' role='alert'>"+data.msg+" <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                
              }
              $(".submitloginbypassword").removeAttr('disabled');
              $(".submitloginbypassword").removeClass('buttonload');
              $(".submitloginbypassword").html('Sign In');
               // setTimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);
              
              
            },
            error: function(data) {
              $(".submitloginbypassword").removeAttr('disabled');
              $(".submitloginbypassword").removeClass('buttonload');
              $(".submitloginbypassword").html('Sign In');  
            },
        });
      }else if(!loginmoibleno || !loginpassword){
          $("#alertmsg").html("<div class='alert alert-danger' role='alert'>Mobile number and Password fields are required. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
          $(".submitloginbypassword").removeAttr('disabled');
          $(".submitloginbypassword").removeClass('buttonload');
          $(".submitloginbypassword").html('Sign In');  
      }
  }); 

  $(".loginbyotpsubmit").on("click", function(){
      $("#loginbyotpsubmit .loginbyotpsubmit").attr('disabled', true);
      $("#loginbyotpsubmit .loginbyotpsubmit").addClass('buttonload'); 
      $("#loginbyotpsubmit .loginbyotpsubmit").html('<i class="fa fa-spinner fa-spin"></i>Loading');
      // Initiate Variables With Form Content
      var moibleno = $("#Rmobile").val();
      // alert(moibleno);
      // var href = "<?php echo base_url();?>shop/loginbyotpsubmit";
      // var href = base_url+"shop/loginbyotpsubmit";
      if(moibleno){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>shop/loginbyotpsubmit",
            data: { moibleno:moibleno},
           dataType: "json",
            success : function(data){
              // alert(data);
              
              if(data.status == 1){
                $(".verifyloginotpmodel").css("display","block");
                $(".addnewaddressview").css("display","none");
                $(".loginformdisplay").css("display","none");

                
              }else{
                $("#alertmotpmsg").html("<div class='alert alert-danger' role='alert'>"+data.msg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
              }
              $(".loginbyotpsubmit").removeAttr('disabled');
              $(".loginbyotpsubmit").removeClass('buttonload');
              $(".loginbyotpsubmit").html('Submit');
  
            },
            error: function(data) {
                $(".loginbyotpsubmit").removeAttr('disabled');
                $(".loginbyotpsubmit").removeClass('buttonload');
                $(".loginbyotpsubmit").html('Submit');
            },
        });
      }else{
        
        $("#alertmotpmsg").html("<div class='alert alert-danger' role='alert'>Mobile number are required. <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        $(".loginbyotpsubmit").removeAttr('disabled');
        $(".loginbyotpsubmit").removeClass('buttonload');
        $(".loginbyotpsubmit").html('Submit');
      }
  });
    
    // $(".loginbyotpsubmit").on("click",function(){
    //     $(".loginbyotpsubmit").attr('disabled', true);
    //     // $(".loginbyotpsubmit").addClass('buttonload'); 
    //     // $(".loginbyotpsubmit").html('<i class="fa fa-spinner fa-spin"></i>Loading');
    //     // Initiate Variables With Form Content
    //     var moibleno = $("#Rmobile").val();
    //     // alert(moibleno);
    //     // alert(first_name);
    //     var href = "<?php echo base_url();?>shop/loginbyotpsubmit";
    //     $.ajax({
    //         type: "POST",
    //         url: href,
    //         data: { moibleno:moibleno},
    //         dataType: "json",
    //         success : function(data){
    //             alert(data);
                
    //         },
    //         error: function(data) {
                
    //         },
    //     });
    // });

  $(".verifyloginotp").on("click", function(){
      $(".verifyloginotp").attr('disabled', true);
      $(".verifyloginotp").addClass('buttonload'); 
      $(".verifyloginotp").html('<i class="fa fa-spinner fa-spin"></i>Loading');
      
      // Initiate Variables With Form Content
      var loginotpval = $("#loginotpval").val();
      // var clickbutton = $(".clickbutton").val();
      // alert(first_name);
      // var href = base_url+"home/loginbypassword";
      // alert(forgototpval);
      var href = "<?php echo base_url();?>shop/verifyloginOtp";
      $.ajax({
          type: "POST",
          dataType: "json",
          url: href,
          data: {otp:loginotpval},
          success : function(data){
          // alert(data);
            if(data.status == 1){
              setTimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);
            }else{
              // alert(data.msg);
              $(".alertotpmsg").html("<div class='alert alert-danger' role='alert'>"+data.msg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            }
            $(".verifyloginotp").removeAttr('disabled');
            $(".verifyloginotp").removeClass('buttonload');
            $(".verifyloginotp").html('Submit');
            // setTimeout(function(){window.location.href=current_page_url},1000);
          },
          error: function(data) {
            $(".alertotpmsg").html("<div class='alert alert-danger' role='alert'>Oops something went wrong please try again.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            $(".verifyloginotp").removeAttr('disabled');
            $(".verifyloginotp").removeClass('buttonload');
            $(".verifyloginotp").html('Submit');
          },
      });
  });
    
    
    // $(".re").click(function(){
    //     setTimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);

     
    // });

    
    
    
</script>