<style>
    .get_into .logo_top {
    position: relative;
    /*margin: 0 15px;*/
    display: block;
    height: auto;
    padding: 15px 0px;
    background: #840512;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    }
    .page-section {
    padding-top: 25px;
    padding-bottom: 25px;
    }
    .btn-theme-dark {
    background-color: #840512;
    border-color: #840512;
    color: #ffffff;
    }
    
    @media (min-width: 768px){
.col-sm-offset-2 {
    margin-left: 16.66666667%;
}}
@media (min-width: 768px){
.col-sm-8 {
    width: 66.66666667%;
}}
</style>

<section class="page-section color get_into">
    <div class="container">
        <!--<div class= margin-top-10px" style="background-color: #f5f5f5;">-->
            <div class="col-sm-8 col-sm-offset-2" style="background-color: #f5f5f5; padding-top: 20px;"  >
                
                
                <?php if($this->session->flashdata('regiter_success')){ 
                 echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i>
                  </button>
                  <h5 style="color:#840512;"><i class=""></i>'.$this->session->flashdata('regiter_success').'</h5>
                  
                  </div>';
                echo '<meta http-equiv="refresh" content="2;url='.base_url('shop').'">';
                
                }elseif($this->session->flashdata('regitered_error')){
                    echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i>
                  </button>
                  <h5 style="color:#840512;"><i class=""></i>'.$this->session->flashdata('regitered_error').'</h5>
                  
                  </div>';
                  echo '<meta http-equiv="" content="2;url='.base_url('home/vendor_registration').'">';
                }
                ?>
                
                
                
                <div class="logo_top" style="margin-bottom: 20px;">
                    <p>
                        <h2 style="text-align: center; color:#f5f7f9 !important;">Registration Form</h2>
                        <!--<img style="width: 100px;" class="img-responsive" src="<?php echo base_url().'uploads/'.getWebOptionValue('front_logo');?>" alt="Shop" style="z-index:200">-->
                    </p>
                </div>
				<form action="" class="form-login" method="post" id="sign_form" enctype="multipart/form-data">
                        
                	    <div class="row box_shape">
                    
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="name" id="name" type="text" placeholder="Name" data-toggle="tooltip" title="Name" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="mobile_no" id="mobile_no" type="text" placeholder="Mobile No." data-toggle="tooltip" title="Mobile No." required pattern="[0-9.]{10}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control emails required" name="email" id="email" type="email" placeholder="Email" data-toggle="tooltip" title="Email" required>
                            </div>
                            <div id='email_note'></div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control pass1 required" type="password" id="password1" name="password1" placeholder="Password" data-toggle="tooltip" title="Password" required>
                            </div>
                        </div>
                        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
                        <!--<h5 id="showErrorPwd"></h6>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control pass2 required" type="password" name="password2" id="password2" placeholder="Confirm Password" data-toggle="tooltip" title="Confirm Password" required>
                            </div>
                            <div id='showErrorPwd'></div> 
                        </div>
                        <!--<h5 id="showErrorPwd"></h6>-->
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" name="company" type="text" placeholder="Company" id="company" data-toggle="tooltip" title="Company">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control required" name="address" id="address" type="text" placeholder="Address" data-toggle="tooltip" title="Address" required>
                            </div>
                        </div>
                        <!--<div class="col-md-12">-->
                        <!--    <div class="form-group">-->
                        <!--        <input class="form-control required" name="address2" type="text" placeholder="Address Line 2" data-toggle="tooltip" title="Address Line 2">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="city" id="city" type="text" placeholder="City" data-toggle="tooltip" title="City" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="state" id="state" type="text" placeholder="State" data-toggle="tooltip" title="State" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="country" id="country" type="text" placeholder="Country" data-toggle="tooltip" title="Country" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="zip" id="zip" type="text" placeholder="ZIP" data-toggle="tooltip" title="ZIP" required pattern="[0-9.]{6}">
                            </div>
                        </div>
                        
                        <div class="col-md-12" style="padding-bottom: 20px;">
                            <button type="submit" class="btn btn-theme-sm btn-block btn-theme-dark" id="logup_btn">
                                Register                            
                            </button>
                        </div>
                        <div class="col-md-12 terms">
                        <!--    <input  name="terms_check" type="checkbox" value="ok" > -->
                           <b style="color:black;">Already A Vendor ? Click To <a href="<?php echo base_url();?>shop" target="_blank">Login As Vendor </a></b>
                        </div>
                    </div>
            	</form>
            </div>
        <!--</div>-->
    </div>
</section>


<script type="text/javascript">
  
//   $(document).ready(function(){     

//     $('#password2').keyup(function(){
//     var password1 = $('#password1').val();
//     var password2 = $('#password2').val();
//     // alert(password1);

//     if(password2!=password1){
//       $('#showErrorPwd').html("** Password are not Matching");
//       $('#showErrorPwd').css('color','red');
//       return false;

//     }else{
//       $('#showErrorPwd').html('');
//       return true;
//     }

//   })  
//   });

    // $(document).on("click", "#logup_btn", function() {
        
    //         var ename = $("#name").val();
    //         var eemail = $("#email").val();
    //         /*var emessage = $("#emessage").val();*/
    //         /*var ecity = $("#city").val();*/
    //         var emobile_no = $("#mobile_no").val();
    //         var epassword1 = $("#password1").val();
    //         var ecompany = $("#company").val();
    //         var eaddress = $("#address").val();
    //         var ecity = $("#zip").val();
    //         var ecity = $("#city").val();
    //         var estate = $("#state").val();
    //         var ecountry = $("#country").val();
           
    //         $.ajax({
    //             type: 'POST',
    //             url:"<?php echo base_url()?>home/vendor_registration",
    //             data:{name:ename,email:eemail,password1:epassword1,company:ecompany,address:eaddress,city:ecity,state:estate,country:ecountry,zip:ezip,mobile_no:emobile_no,},
    //             dataType: 'html',
    //             success : function(data)
    //             {
    //                 swal({
    //                     title: "Registration has been Successfully",
    //                     text: "Please click on Login",
    //                     type: "success",
    //                     confirmButtonClass: 'btn-success',
    //                     confirmButtonText: 'Login !',
    //                     closeOnConfirm: false
    //                     },
    //                     function (Confirm) {
    //                       window.location.href="<?php echo base_url();?>shop";
    //                 });

    //                 // alert(data);
                    
    //             },
    //             error: function(data) 
    //             {
    //             },
    //         });

    //      });
    //      function notify(style,msg,title){
    //         $.notify({
    //             title: title,
    //             text: msg
    //         }, {
    //             style: 'metro',
    //             className: style,
    //             autoHide: true,
    //             clickToHide: true
    //         });
    //     }
</script>

