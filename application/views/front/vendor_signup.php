<!DOCTYPE html>

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Indocliq</title>

	<link rel="shortcut icon" href="<?php echo base_url() ?>front_assets/images/serlogo.png" type="image/x-icon" />

	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">

	<link href="<?php echo base_url() ?>front_assets/comcss/style.css" rel="stylesheet" type="text/css" />



	<link href="<?php echo base_url(); ?>common_assets/notify/notify-metro.css" rel="stylesheet" />



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

		.d-none {

			display: none;

		}

		.maincon {

			padding: 0px 0px;



		}

		.headv {

			text-align: center;

			font-size: 30px;

			margin-top: 12px;

			padding: 0px !important;

		}

		.headv h2 {

			text-align: center !important;



			padding: 8px;

			/* background-color: #03ff0b; */



			box-shadow: 1px 1px 4px 3px #efa22e;

			color: white;

		}



		.formv {

			display: inline-block;

			position: relative;

			width: 100%;

			margin-left: 273px;

			margin-top: 100px;

			background-color: #48404061;

			border-radius: 7px;

			padding: 10px 10px;

		}

		.btn {

			float: right;

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

			width: 75px;

			margin-right: 10px;

		}

		.mainreg {}

		#Mobile {

			width: 85% !important;

			display: inline-block;

		}



		.mobilebtn {

			background-color: #efa22e;

		}

		.mobilebtn:hover {

			background-color: #c73d18;

		}

		.otpp {

			display: block;

		}



		/*----------------------------------*/

		@media only screen and (max-width: 992px) {



			.formv {

				padding: 10px 10px;

				margin-left: 200px;

			}



		}



		@media only screen and (max-width:768px) {



			.headv {



				margin-top: 0px !important;

				padding: 0px !important;

			}



			.freg {

				padding: 20px 14px;

			}



			.rimg {

				width: 113px;

				margin-top: 7px;

				margin-right: 10px;

			}



			.formv {

				padding: 10px 10px;

				margin-left: 0px;

			}



		}



		@media only screen and (max-width: 576px) {

			.headv {

				padding: 0px !important;

			}

			.formv {

				margin-left: 0px !important;

				padding: 23px 23px;

			}

			.rimg {

				margin-left: 10px
			}

		}
	</style>

</head>

<body>



	<div class="row mainreg">

		<div class="container maincon">
					<!-- <div class="registrationmobile">

					</div> -->
					

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 formv">
			<div class="col-md-12" id="registrationmobile"></div>
			<!-- <div class="col-md-12" id="verifyloginotpmsg"></div> -->
			<!-- <div class="col-md-12" id="resendotp"></div> -->
				
			<!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 headv">
					<div class="alert alert-success alert-dismissible fade show">
						<div class="registrationmobile">

						</div>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
					</div> -->
				

				<div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 col-12 headv">



					<h2 class=""> <img class="rimg" src="<?php echo base_url() ?>front_assets/images/indocliq_orignal_rounded.png"> <br>Vendor Registration</h2>

				</div>





				<form method="post" id="contact_form" enctype="multipart/form-data">

					<div class="form-group form-group-1">

						<label for="text">Mobile No:</label>

						<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile No." ">

		  			</div>    

		  

		  			<div class=" form-group form-group-1">

						<button type="button" name="registrationmobile" id="registrationmobile" class="btn mobilebtn registrationmobile">Submit</button>

					</div>

					<!--<div class="form-group form-group-1">-->

					<!--  <label class="otpp" for="email">OTP:</label>-->

					<!--  <input  type="email" class="form-control" id="Mobile" placeholder="Enter Mobile No." name="Mobile No.">-->

					<!--  <button type="submit" class="btn btn-primary mobilebtn">Verify</button>-->

					<!--</div>-->

				</form>



				<form method="post" id="otp_form" class="d-none" enctype="multipart/form-data">

					<div class="form-group form-group-1">

						<label for="OTP" style="display: block;">OTP:</label>

						<input type="text" class="form-control" name="loginotpval" id="loginotpval" placeholder="Enter Your OTP.">

					</div>

					<div class="form-group form-group-1">

						<button type="button" style="margin-left: 10px;" name="" id="" class="btn mobilebtn resendotp">Resend</button>

						<button type="button" name="verifyloginotp" id="verifyloginotp" class="btn  mobilebtn verifyloginotp">Verify</button>

					</div>

				</form>

			</div>

		</div>

	</div>







</body>

</html>

<script src="<?php echo base_url(); ?>common_assets/notify/notify.js"></script>

<script src="<?php echo base_url(); ?>common_assets/notify/notify-metro.js"></script>



<script>
	$(".registrationmobile").on("click", function() {
		// alert("hi");

		$(".registrationmobile").attr('disabled', true);

		$(".registrationmobile").addClass('buttonload');

		$(".registrationmobile").html('<i class="fa fa-spinner fa-spin"></i>Loading');

		// Initiate Variables With Form Content

		var moibleno = $("#mobile_no").val();

		// alert(moibleno);

		// var href = "<?php echo base_url(); ?>shop/loginbyotpsubmit";

		// var href = base_url+"shop/loginbyotpsubmit";



		$.ajax({

			type: "POST",

			url: "<?php echo base_url(); ?>home/loginbyotpsubmit",

			data: {

				moibleno: moibleno,

			},

			dataType: "json",

			success: function(data) {

				// alert(data);

				if (data.status == 1) {

					// $.notify(data.msg, "success");

					$("#registrationmobile").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>"+data.msg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

					// $(".registrationmobile").removeAttr('disabled');

					// $(".registrationmobile").removeClass('buttonload');

					// $(".registrationmobile").html('Submit');





					$('#contact_form').addClass('d-none');

					$('#otp_form').removeClass('d-none');

					// $('#signup').addClass('d-none');

					// $('#registerotp').removeClass('d-none');



				} else {

					// $.notify(data.msg, "error");

					$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

					$(".registrationmobile").removeAttr('disabled');

					$(".registrationmobile").removeClass('buttonload');

					$(".registrationmobile").html('Submit');



				}

			},

			error: function(data) {

				// $.notify(data.msg, "error");
				$(".registrationmobile").removeAttr('disabled');

				$(".registrationmobile").removeClass('buttonload');

				$(".registrationmobile").html('Submit');

				$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

				// $(".registrationmobile").removeAttr('disabled');

				// $(".registrationmobile").removeClass('buttonload');

				// $(".registrationmobile").html('Submit');

			},

		});

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

					// $.notify(data.msg, "success");

					$("#registrationmobile").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");



					setTimeout(function() {

						window.location.href = "<?php echo base_url(); ?>registration_form"

					}, 1000);

					// $('#signup').addClass('d-none');

					// $('#registerotp').removeClass('d-none');



				} else {

					// $.notify(data.msg, "error");

					$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

					$(".verifyloginotp").removeAttr('disabled');

					$(".verifyloginotp").removeClass('buttonload');

					$(".verifyloginotp").html('Verify');



				}

			},

			error: function(data) {

				// $.notify(data.msg, "error");

				$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

				$(".verifyloginotp").removeAttr('disabled');

				$(".verifyloginotp").removeClass('buttonload');

				$(".verifyloginotp").html('Verify');

			},

		});
	});


	$(".resendotp").on("click", function() {

		$(".resendotp").attr('disabled', true);

		$(".resendotp").addClass('buttonload');

		$(".resendotp").html('<i class="fa fa-spinner fa-spin"></i>Loading');



		// Initiate Variables With Form Content

		var loginotpval = $("#loginotpval").val();

		// var clickbutton = $(".clickbutton").val();

		// alert(first_name);

		// var href = base_url+"home/loginbypassword";

		// alert(forgototpval);

		var href = "<?php echo base_url(); ?>home/resendotp";

		$.ajax({

			type: "POST",

			dataType: "json",

			url: href,

			data: {

				otp: loginotpval

			},

			success: function(data) {

				if (data.status == 1) {

					// $.notify(data.msg, "success");
					$("#registrationmobile").html("<div class='alert alert-warning alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");

					$(".resendotp").removeAttr('disabled');

					$(".resendotp").removeClass('buttonload');

					$(".resendotp").html('Resend');


				} else {

					// $.notify(data.msg, "error");
					$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
					$(".resendotp").removeAttr('disabled');

					$(".resendotp").removeClass('buttonload');

					$(".resendotp").html('Resend');



				}

			},

			error: function(data) {

				// $.notify(data.msg, "error");
				$("#registrationmobile").html("<div class='alert alert-danger alert-dismissible fade show' role='lert'>" + data.msg + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
				$(".resendotp").removeAttr('disabled');

				$(".resendotp").removeClass('buttonload');

				$(".resendotp").html('Resend');

			},

		});
	});
</script>