<!DOCTYPE html>

<html>



<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo base_url(); ?>common_assets/notify/notify-metro.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>backend_assets/bower_components/select2/dist/css/select2.min.css">

    

  <link rel="shortcut icon" href="<?php echo base_url()?>front_assets/images/serlogo.png" type="image/x-icon" />

  <link href="<?php echo base_url()?>front_assets/comcss/style.css" rel="stylesheet" type="text/css" />



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <title>Indocliq</title>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->

    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>   -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  

  <?php $session_userdata = $this->session->userdata(USER_SESSION); ?>

  

   <style type="text/css">

    body {

      background-image: url("./front_assets/images/c.jpg");

      /* Full height */

      height: 100%;

      /* Center and scale the image nicely */

      background-position: center;

      background-repeat: repeat-y;

      background-size: cover;



    }

    .error {
      color: red;
      margin-left: 5px;
    }

    label.error {
      display: inline;
    }

    .headv {

      text-align: center;

      font-size: 30px;

      margin-top: 10px;

    }



    .headv h2 {

      text-align: center !important;

      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

      padding: 8px;

      /* background-color: #03ff0b; */



      box-shadow: 1px 1px 4px 3px #efa22e;

      color: white;

    }



    .formv {

      display: inline-block;

      position: relative;

      width: 100%;

      margin-left: 137px;

      margin-top: 25px;

      background-color: #48404061;

    }



    .btn {

      /* float: right; */

      margin-top: px;

    }



    .form-group-1 {

      margin-bottom: 8px !important;

    }



    .form-group-2 {

      margin-top: 47px !important;

      margin-bottom: 8px !important;

    }



    .rimg {

      width: 169px;

      margin-right: 10px;

    }



    .form-group label {

      color: white;

    }



    .form-group label strong {

      color: red;

    }



    .mobilebtn {

      background-color: #efa22e;

    }



    .mobilebtn:hover {

      background-color: #c73d18;

    }



    /*----------------------------*/

    @media only screen and (max-width: 992px) {

      .formv {

        margin-left: 82px

      }

    }





    @media only screen and (max-width:768px) {

      .headv {

        margin-top: 0px;

      }



      .formv {

        margin-left: 0px;

        margin-top: 0px;

      }



      .freg {

        padding: 20px 14px;

      }



      .rimg {

        width: 113px;

        margin-top: 36px;

        margin-right: 10px;

      }

    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #efa22e;
      border: 1px solid #efa22e;
    }

  </style>

</head>  

 





<body>

  <div class="row">



    <div class="container maincon">



      <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12 col-12 formv">



        <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 headv">



          <h2 class=""> <img class="rimg" src="<?php echo base_url()?>front_assets/images/indocliq_orignal_rounded.png"> <br>Vendor Registration Form</h2>

        </div>

        <div class="container">

          <form class="freg">



            <div class="form-group">

              <label for="inputAddress">Full Name: <strong id="namestar">*</strong></label>

              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Full Name">-->

              <input placeholder="Your name" id="name" name="name" type="text" class="form-control" required autofocus>

            </div>

            <div class="form-group">

              <label for="inputAddress">Email Id: <strong id="emailstar">*</strong></label>

              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Emil Id">-->

              <input placeholder="Your Email Address" id="email" class="form-control" name="email" type="email" required>

            </div>
            <div class="form-group">

              <label for="inputAddress">Password: <strong id="passwordstar">*</strong>(Password must be at least 8 characters long)</label>
              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Emil Id">-->
              <input placeholder="Enter your password" id="password" class="form-control" name="password" type="password" required>

            </div>


            <!--<div class="form-group">-->

            <!--  <label for="inputAddress">Coontact No.: </label>-->

              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Alternate No.">-->

            <!--  <input placeholder="Your Phone Number" id="mobile_no" class="form-control" name="mobile_no" type="text" required>-->

            <!--</div>-->

            <div class="form-group">

              <label for="inputAddress">Alternate No.: </label>

              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Alternate No.">-->

              <input placeholder="Your Alternate Phone Number" class="form-control" id="mobile_no" name="mobile_no" type="number" required pattern="[0-9.]{10}">

            </div>



            <div class="form-group">

              <label for="inputAddress">Company Name: <strong id="companystar">*</strong></label>

              <!--<input type="text" class="form-control" id="inputAddress" placeholder="Company Name">-->

              <input placeholder="Company Name" class="form-control" type="text" id="company" name="company" required>

            </div>

            <div class="form-group">

              <label for="inputAddress">GST No: </label>

              <input type="text" class="form-control" name="gst" id="gst" placeholder="Goods And Services Tax">

            </div>

            <!-- <div class="form-group">

              <label for="inputAddress2">Category: <strong>*</strong></label>

               <input placeholder="" class="form-control" type="text" id="" name="">

            </div> -->
            <div class="form-group">
              <?php
                if(isset($shop_data['shopping_categories']) && !empty($shop_data['shopping_categories'])){
                  $shopping_categories = explode(',', $shop_data['shopping_categories']);
                }
                $whrc = array('status'=>1,'parent_category_id'=>0);
                $allcategories = $this->Common_model->GetWhere('categories', $whrc);
              ?>
                
                <label>Categories : <strong id="catstar">*</strong></label>
                <select class="form-control select2 catselect" name="shopping_categories[]" id="shopping_categories" multiple="multiple" data-placeholder="Select a categories"
                        style="width: 100%;" >
                <?php if(isset($allcategories) && !empty($allcategories)){ 
                    foreach ($allcategories as $allcategoriesdata){
                ?>
                  <option value="<?php echo $allcategoriesdata['category_name']; ?>" <?php echo (isset($shopping_categories) && !empty($shopping_categories) && in_array($allcategoriesdata['category_name'], $shopping_categories) ? 'selected' : '')?>><?php echo $allcategoriesdata['category_name']; ?></option>
                <?php } } ?>
                </select>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">

                <label for="inputCity">City <strong id="citystar">*</strong></label>

                <!--<input type="text" class="form-control" id="inputCity">-->

                <input placeholder="City" class="form-control" type="text" id="city" name="city">

              </div>

              <div class="form-group col-md-4">

                <label for="inputState">State <strong id="statestar">*</strong></label>

                <!--<select id="inputState" class="form-control">-->

                <!--  <option selected>Choose...</option>-->

                <!--  <option>...</option>-->

                <!--</select>-->

                <input placeholder="State" class="form-control" type="text" id="state" name="state">

              </div>

              <div class="form-group col-md-2">

                <label for="inputZip">Zip <strong id="zipstar">*</strong></label>

                <!--<input type="text" class="form-control" id="inputZip">-->

                <input placeholder="Zip" class="form-control" type="number" id="zip" name="zip">

              </div>

            </div>

            <div class="form-group">

              <input type="checkbox" name="accept_terms" value="1" id="accept_terms" checked /> I agree Terms & Conditions . &nbsp;&nbsp; <a href="http://indocliq.com/indocliq/seller_agreement" target="_blank" ><span style="color: blue;"> Click here </span> </a>for read Terms & Condition.
              <br>
              <span class="termserror"></span>
            </div>

            <!-- <div class="form-group">

    <div class="form-check">

      <input class="form-check-input" type="checkbox" id="gridCheck">

      <label class="form-check-label" for="gridCheck">

        Check me out

      </label>

    </div>

  </div> -->

            
            <p> Note :  <strong style="color: red">*</strong> Fields are required , please fill all required fields.</p>
            <div class="text-center">

            <button type="button"  name="registrationmobile" id="registrationmobile" class="btn mobilebtn registrationmobile">Sumbit</button>
            </div>
          
            
          </form>

        </div>











      </div>





</body>





</html>



<script src="<?php echo base_url(); ?>common_assets/notify/notify.js"></script>

<script src="<?php echo base_url(); ?>common_assets/notify/notify-metro.js"></script>

<script src="<?php echo base_url(); ?>backend_assets/bower_components/select2/dist/js/select2.full.min.js"></script>



<script>

    // $(".registrationmobile").on("click", function(){

    // $('#contact_form').addClass('d-none');

    // $('#otp_form').removeClass('d-none');

    // });



    $('.select2').select2();

    $(".registrationmobile").on("click", function() {
        

        // $("#registrationmobile .registrationmobile").attr('disabled', true);
        var name = $("#name").val();
        var email = $("#email").val();
        var mobile_no = $("#mobile_no").val();
        // var number2 = $("#number2").val();
        var company = $("#company").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
        var gst = $("#gst").val();
        var password = $("#password").val();
        var accept_terms = $("#accept_terms").val();
        //alert("hi");
        var shopping_categories = $("#shopping_categories").val();
        // alert(shopping_categories);
        // console.log(shopping_categories);
        $(".error").remove();
        var resp = true;
        if (email.length < 1) {
          $('#email').after('<span class="error">This field is required</span>');
          var resp = false;
        } else {
          var regEx = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
          var validEmail = regEx.test(email);
          if (!validEmail) {
            $('#email').after('<span class="error">Enter a valid email</span>');
            var resp = false;
          }
        }
        if (name.length < 1) {
          $('#name').after('<span class="error">This field is required</span>');
          var resp = false;
        }
        if (password.length < 8) {
          $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
          var resp = false;
        }
        if (company.length < 1) {
          $('#company').after('<span class="error">This field is required</span>');
          var resp = false;
        }
        if (city.length < 1) {
          $('#city').after('<span class="error">This field is required</span>');
          var resp = false;
        }else{
          var regExc = /^[a-zA-Z\s]+$/;
          var validCity = regExc.test(city);
          if (!validCity) {
            $('#city').after('<span class="error">Enter a valid city name</span>');
            var resp = false;
          }
        }
        
        
        if (state.length < 1) {
          $('#state').after('<span class="error">This field is required</span>');
          var resp = false;
        }else{
          var regExs = /^[a-zA-Z\s]+$/;
          var validState = regExs.test(state);
          if (!validState) {
            $('#state').after('<span class="error">Enter a valid state name</span>');
            var resp = false;
          }
        }
        if (zip.length < 6) {
          $('#zip').after('<span class="error">at least 6 digit long</span>');
          var resp = false;
        }
        if (shopping_categories.length < 1) {
          $('#shopping_categories').after('<span class="error">This field is required</span>');
          var resp = false;
        }

        
        

        if(resp){
          if ($('#accept_terms').is(':checked')) {    
            $.ajax({

                type: "POST",
                url: "<?php echo base_url(); ?>home/registrationFormSubmit",
                data: {name:name,email:email,mobile_no:mobile_no,company:company,shopping_categories:shopping_categories,city:city,state:state,zip:zip,gst:gst,password:password,accept_terms:accept_terms},
                dataType: "json",

                success: function(data) {

                    // alert(data);

                    if (data.status == 1) {

                        $.notify(data.msg, "success");

                        // $(".loginbyotpsubmitmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>"+data.msg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                        // $(".registrationmobile").removeAttr('disabled');

                        // $(".registrationmobile").removeClass('buttonload');

                        // $(".registrationmobile").html('Submit');


                        setTimeout(function() {

                          window.location.href = "<?php echo base_url(); ?>"

                        }, 1000);


                        $('#contact_form').addClass('d-none');

                        $('#otp_form').removeClass('d-none');

                        // $('#signup').addClass('d-none');

                        // $('#registerotp').removeClass('d-none');



                    } else {

                        $.notify(data.msg, "error");

                        // $(".loginbyotpsubmitmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                        // $(".registrationmobile").removeAttr('disabled');

                        // $(".registrationmobile").removeClass('buttonload');

                        // $(".registrationmobile").html('Submit');



                    }

                },

                error: function(data) {

                    $.notify(data.msg, "error");

                    // $(".loginbyotpsubmitmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                    // $(".registrationmobile").removeAttr('disabled');

                    // $(".registrationmobile").removeClass('buttonload');

                    // $(".registrationmobile").html('Submit');

                },

            });
          }else{
            $('.termserror').html('<span class="error">Please accept terms condition</span>');
          }
        }
            
           
    });





    $(".verifyloginotp").on("click", function() {

        $(".verifyloginotp").attr('disabled', true);

        $(".verifyloginotp").addClass('buttonload');

        $(".verifyloginotp").html('<i class="fa fa-spinner fa-spin"></i>Loading');



        // Initiate Variables With Form Content

        var loginotpval = $("#loginotpval").val();

        // var clickbutton = $(".clickbutton").val();

        // alert(first_name);

        // var href = base_url+"home/loginbypassword";

        // alert(forgototpval);

        var href = "<?php echo base_url(); ?>home/verifyloginOtp";

        $.ajax({

            type: "POST",

            dataType: "json",

            url: href,

            data: {

                otp: loginotpval

            },

            success: function(data) {

                if (data.status == 1) {

                    $.notify(data.msg, "success");

                    $(".verifyloginotpmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");



                    setTimeout(function() {

                        window.location.href = "<?php echo base_url(); ?>home/registration_form"

                    }, 1000);

                    // $('#signup').addClass('d-none');

                    // $('#registerotp').removeClass('d-none');



                } else {

                    $.notify(data.msg, "error");

                    $(".verifyloginotpmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                    $(".verifyloginotp").removeAttr('disabled');

                    $(".verifyloginotp").removeClass('buttonload');

                    $(".verifyloginotp").html('Verify');



                }

            },

            error: function(data) {

                $.notify(data.msg, "error");

                $(".verifyloginotpmsg").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

                $(".verifyloginotp").removeAttr('disabled');

                $(".verifyloginotp").removeClass('buttonload');

                $(".verifyloginotp").html('Verify');

            },

        });

    });

    
  $("#name").on('keyup', function(){
    $("#namestar").hide();
  });

  $("#email").on('keyup', function(){
    $("#emailstar").hide();
  });
  $("#password").on('keyup', function(){
    $("#passwordstar").hide();
  });
  $("#company").on('keyup', function(){
    $("#companystar").hide();
  });
  $("#shopping_categories").on('keyup', function(){
    $("#catstar").hide();
  });
  $("#city").on('keyup', function(){
    $("#citystar").hide();
  });  
  $("#state").on('keyup', function(){
    $("#statestar").hide();
  }); 
  $("#zip").on('keyup', function(){
    $("#zipstar").hide();
  }); 


</script>





