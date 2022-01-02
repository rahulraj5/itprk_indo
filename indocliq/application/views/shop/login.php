 <style type="text/css">
    .bg { 
      /* the image used */
      background-image: url("<?php echo base_url().'uploads/'. getweboptionvalue('backedn_login_background_image');?>");
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
</style>
<div class="login-box loginformdisplay">
  <!-- /.login-logo -->
  <div class="login-box-body" id="login">
    <!-- <p class="login-box-msg">sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getweboptionvalue('backlogo');?>" alt="<?php echo  getweboptionvalue('site_title');?>"></a>
    </div>
    <form action=""  id="loginformpassword" method="post" style="padding: 15px;">
      <div class="form-group has-feedback">
        <label>mobile no.</label>
        <input type="text" class="form-control loginmoibleno" id="phone" placeholder="mobile no.">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" style="padding-bottom: 14px;">
        <label>password</label>
        <input type="password" class="form-control loginpassword" id="password" placeholder="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!--<div class="col-xs-8">-->
        <!--  <div class="checkbox icheck">-->
        <!--    <label>-->
        <!--      <input type="checkbox"> remember me-->
        <!--    </label>-->
        <!--  </div>-->
        <!--</div>-->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="button" class="btn btn-success btn-block btn-flat submitloginbypassword">sign in</button>
        </div>
        <div class="col-xs-12">
        <div class="form-group text-center" style="color: #ffffff;">
              <h6 style="font-size: 12px;">or</h6>
        </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group text-center">
              <button type="button" class="btn btn-success btn-block btn-flat sign_up">login by otp</button>
             </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="form-group text-center create">
          click for <a href="<?php echo base_url()?>vendor_registration" class="" >  create an account</a>
      </div>

    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>

<div class="login-box addnewaddressview">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getweboptionvalue('backlogo');?>" alt="<?php echo  getweboptionvalue('site_title');?>"></a>
    </div>
    <form action="" id="loginbyotpsubmit" method="post" style="padding: 15px;">
      <!-- <div class="form-group has-feedback">
        <label>name</label>
        <input type="text" class="form-control rfirstname" id="rfirstname" placeholder="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> -->
      
      <div class="form-group has-feedback">
        <label>mobile no.</label>
        <input type="number" class="form-control rmobilenumber"  id="rmobile" placeholder="mobile no.">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <label>shop registration id</label>
        <input type="text" class="form-control rshop_reg_id" id="shop_reg_id" placeholder="shop registration id">
        <span class="glyphicon glyphicon- form-control-feedback"></span>
      </div> -->
      <!-- <div class="form-group has-feedback">
        <label>password</label>
        <input type="password" class="form-control rpassword" id="rpass" placeholder="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> remember me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-success btn-block btn-flat loginbyotpsubmit">submit</button>
        </div>
        <!-- /.col -->
      </div>
      <!-- <div class="form-group text-center create">
          already have account?  <a class="sign_in"> sign in</a>
      </div> -->
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>

<div class="login-box verifyloginotpmodel">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <!-- <p class="login-box-msg">sign in to start your session</p> -->
    <div class="login-logo">
      <a href="<?php echo base_url();?>"><img style="width: 100px;" src="<?php echo base_url().'uploads/'. getweboptionvalue('backlogo');?>" alt="<?php echo  getweboptionvalue('site_title');?>"></a>
    </div>
    <form action="" id="verifyloginotp" method="post" style="padding: 15px;">
      <!-- <div class="form-group has-feedback">
        <label>name</label>
        <input type="text" class="form-control rfirstname" id="rfirstname" placeholder="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> -->
      
      <div class="form-group has-feedback">
        <label>Enter OTP</label>
        <input type="number" class="form-control rmobilenumber"  id="loginotpval" placeholder="OPT">
        
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <!-- <div class="form-group has-feedback">
        <label>shop registration id</label>
        <input type="text" class="form-control rshop_reg_id" id="shop_reg_id" placeholder="shop registration id">
        <span class="glyphicon glyphicon- form-control-feedback"></span>
      </div> -->
      <!-- <div class="form-group has-feedback">
        <label>password</label>
        <input type="password" class="form-control rpassword" id="rpass" placeholder="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> remember me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-success btn-block btn-flat verifyloginotp re">submit</button>
        </div>
        <!-- /.col -->
      </div>
      <!-- <div class="form-group text-center create">
          already have account?  <a class="sign_in"> sign in</a>
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

  


    $(".submitloginbypassword").on("click", function(){
        $("#loginformpassword .submitloginbypassword").attr('disabled', true);
        $("#loginformpassword .submitloginbypassword").addclass('buttonload'); 
        $("#loginformpassword .submitloginbypassword").html('<i class="fa fa-spinner fa-spin"></i>loading');
        // initiate variables with form content
        var loginmoibleno = $(".loginmoibleno").val();
        var loginpassword = $(".loginpassword").val();
        var clickbutton = $(".clickbutton").val();
        // alert(loginmoibleno);
        var href = "<?php echo base_url();?>shop/loginajax";
        $.ajax({
            type: "post",
            url: href,
            data: { mobile_no:loginmoibleno,password:loginpassword},
            datatype: "json",
            success : function(data){
            settimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);
            },
            error: function(data) {
                
            },
        });
    }); 


	// $(".loginbyotpsubmit").click(function(){
		
	// })
    $(document).on("click",".loginbyotpsubmit",function() {
        $("#loginbyotpsubmit .loginbyotpsubmit").attr('disabled', true);
        // $("#loginbyotpsubmit .loginbyotpsubmit").addclass('buttonload'); 
        // $("#loginbyotpsubmit .loginbyotpsubmit").html('<i class="fa fa-spinner fa-spin"></i>loading');
        // initiate variables with form content
        var moibleno = $("#rmobile").val();
		if($.trim(moibleno) != ''){
			// alert(moibleno);
			// var href = "<?php echo base_url();?>shop/loginbyotpsubmit";
			// var href = base_url+"shop/loginbyotpsubmit";
			
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>shop/loginbyotpsubmit",
				data: { moibleno:moibleno},
				datatype: "json",
				success : function(data){
					//console.log(data);
					data = JSON.parse(data);
					if(data.status === 1){
						$.notify(data.msg, "success");
						$(".verifyloginotpmodel").css("display","block");
						$(".addnewaddressview").css("display","none");
						$(".loginformdisplay").css("display","none");
						return true;
					}else{
						$.notify(data.msg, "error");
						return false;
					}
				},
				error: function(data) {
					$.notify('somthing went wronge.', "error");
					return false;
				},
			});
		}else{
			$.notify('Please enter mobile no.', "error");
			return false;
		}
    });

	$(document).on("click",".verifyloginotp",function() {
        var loginotpval = $.trim($("#loginotpval").val());
		if(loginotpval != ''){
			
			$(".verifyloginotp").addClass('buttonload'); 
			$(".verifyloginotp").html('<i class="fa fa-spinner fa-spin"></i>loading');
			// initiate variables with form content
			// var clickbutton = $(".clickbutton").val();
			// alert(first_name);
			// var href = base_url+"home/loginbypassword";
			// alert(forgototpval);
			var href = "<?php echo base_url();?>shop/verifyloginotp";
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>shop/verifyloginotp",
				data: {otp:loginotpval},
				datatype: "json",
				success : function(data){
					console.log(data);
					data = JSON.parse(data);
					if(data.status === 1){
						$(".verifyloginotp").attr('disabled', true);
						$.notify(data.msg, "success");
						settimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);
					}else{
						$(".verifyloginotp").html('submit');
						$(".verifyloginotp").removeClass('buttonload');
						$.notify(data.msg, "error");
						return false;
					}
				// settimeout(function(){window.location.href=current_page_url},1000);
				},
				error: function(data) {
					$.notify('somthing went wronge.', "error");
					$(".verifyloginotp").removeClass('buttonload');
					$(".verifyloginotp").html('submit');
					return false;
				},
			});
		}else{
			$(".verifyloginotp").html('submit');
			$(".verifyloginotp").removeClass('buttonload');
			$.notify('Please enter OTP.', "error");
			return false;
		}
    });
    
    // $(".loginbyotpsubmit").on("click",function(){
    //     $(".loginbyotpsubmit").attr('disabled', true);
    //     // $(".loginbyotpsubmit").addclass('buttonload'); 
    //     // $(".loginbyotpsubmit").html('<i class="fa fa-spinner fa-spin"></i>loading');
    //     // initiate variables with form content
    //     var moibleno = $("#rmobile").val();
    //     // alert(moibleno);
    //     // alert(first_name);
    //     var href = "<?php echo base_url();?>shop/loginbyotpsubmit";
    //     $.ajax({
    //         type: "post",
    //         url: href,
    //         data: { moibleno:moibleno},
    //         datatype: "json",
    //         success : function(data){
    //             alert(data);
                
    //         },
    //         error: function(data) {
                
    //         },
    //     });
    // });
    
    
    // $(".re").click(function(){
    //     settimeout(function(){window.location.href="<?php echo base_url();?>shop"},500);

     
    // });

    
    
    
</script>