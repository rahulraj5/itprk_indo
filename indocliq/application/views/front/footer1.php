<?php  $session_userdata = $this->session->userdata(USER_SESSION); ?>
<style>
	.fa-youtube 
	{
		content: "\f003";
		font-size: 12px;
		border-radius: 50%;
		/* border: 1px solid green; */
		padding: 2px;
		background-color: #db3236;
		color: white;
	}
	.fa-youtube:hover {
    border: 2px solid #3b5998;
    background-color: white;
    color: #3b5998;
	}

	.fa-linkedin 
	{
		content: "\f003";
		font-size: 12px;
		border-radius: 50%;
		/* border: 1px solid green; */
		padding: 2px;
		background-color: #0073b1;
		color: white;
	}
	.fa-linkedin:hover {
    border: 2px solid #3b5998;
    background-color: white;
    color: #3b5998;
	}
	.fa-pinterest 
	{
		content: "\f003";
		font-size: 12px;
		border-radius: 50%;
		/* border: 1px solid green; */
		padding: 2px;
		background-color: #e60023;
		color: white;
	}
	.fa-pinterest:hover {
    border: 2px solid #3b5998;
    background-color: white;
    color: #3b5998;
	}
	.cotag{
		text-align: center;
	}
	.maintag{
		display: flex;
		justify-content: space-between;
	}

</style>
<!-- <foooter section start> -->
			<footer style="color: white;">
				<div class="container">
					<div class="row pt-20 maintag">
						<div class="col-lg-2">
							<div class="footer-main f">
								<h5>Menu</h5>
								<ul>
									<li><a href="<?php echo base_url(); ?>">Home</a></li>
									<li><a href="<?php echo base_url(); ?>aboutus">About Us</a></li>
									<li><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>
									<?php if(isset($session_userdata) && !empty($session_userdata)){ ?>
									<li><a href="<?php echo base_url().'support_ticket';?>">Support</a></li>
									<?php } ?>								
									<li><a href="<?php echo base_url(); ?>seller_agreement">Seller Agreement</a></li>
									
									<li><a href="<?php echo base_url(); ?>terms_condition">Terms & condition</a>
									</li> 	
								</ul>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="footer-main2 f">
								<h5>Merchant Central</h5>
								<ul>
									<li><a href="<?php echo base_url(); ?>sell_on_indocliq">Sell on Indocliq</a></li>
									
								</ul>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="footer-main2 f">
								<h5>Social Media</h5>
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i>&nbsp;Facebook</a></li>
									<li><a href="#"><i class="fa fa-instagram"></i>&nbsp;Instagram</a></li>
									<li><a href="#"><i class="fa fa-twitter"></i>&nbsp;Twitter</a></li>
									<li><a href="#"><i class="fa fa-youtube"></i>&nbsp;Youtube</a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i>&nbsp;Linkedin</a></li>
									<li><a href="#"><i class="fa fa-pinterest"></i>&nbsp;</a>Pinterest</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="footer-main3 f">
								<h5>Download the app</h5>
								<div><a href>
								<img src="front_assets/images/googleplay.jpg" style="border-radius: 5px"></a></div>
								<div style="margin-top: 3px;"><a href>
								<img src="front_assets/images/appicon.jpg" style="border-radius: 5px">
								</a></div>
							</div>
						</div>
						
					</div>		
				</div>				
			</footer>
		<!-- <foooter section end> -->
	<!-- <bottom section start> -->
		<section class="copyright">
			<div class="container">
				<div class="row bottom-s text-center">
							<div class="col-lg-12 cotag"><p>© Copyright 2020. All Rights Reserved. by <a href="#"> Flyingfoxtradecom pvt. ltd.</a></p>
							</div>
							
				</div>
			</div>
		</section>
	<!-- <bottom section end> -->
		
		
	<script src="<?php echo base_url();?>common_assets/notify/notify.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>front_assets/js/commonjsnirbhay.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>front_assets/css/mdb.min.js"></script>
		<!-- <md bootstrap end> -->
	<script type="text/javascript" src="<?php echo base_url();?>front_assets/js/slider.js"></script>
	<!-- <slider js end> -->
	<script type="text/javascript" src="<?php echo base_url();?>front_assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>front_assets/js/jquery.flexslider.js"></script>
	<script>
	    showPosition();
	    function showPosition() {
	        if(navigator.geolocation) {
	            navigator.geolocation.getCurrentPosition(showMap, showError);
	        } else {
	            alert("Sorry, your browser does not support HTML5 geolocation.");
	        }
	    }
	     
	    // Define callback function for successful attempt
	    function showMap(position) {
	        // Get location data
	        lat = position.coords.latitude;
	        long = position.coords.longitude;
	        $("#latitude").val(lat);
	        $("#longitude").val(long);
	        var latlong = new google.maps.LatLng(lat, long);
	        
	        var myOptions = {
	            center: latlong,
	            zoom: 16,
	            mapTypeControl: true,
	            navigationControlOptions: {
	                style:google.maps.NavigationControlStyle.SMALL
	            }
	        }
	        
	        var map = new google.maps.Map(document.getElementById("embedMap"), myOptions);
	        var marker = new google.maps.Marker({ position:latlong, map:map, title:"You are here!" });
	    }
	     
	    // Define callback function for failed attempt
	    function showError(error) {
	        if(error.code == 1) {
	            // result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
	        } else if(error.code == 2) {
	            // result.innerHTML = "The network is down or the positioning service can't be reached.";
	        } else if(error.code == 3) {
	            // result.innerHTML = "The attempt timed out before it could get the location data.";
	        } else {
	            // result.innerHTML = "Geolocation failed due to unknown error.";
	        }
	    }

	    $(".loginModal").click(function(){

	    	var clickbutton = $(this).attr('href-btntype');
	    	//alert(clickbutton);
	    	$(".clickbutton").val(clickbutton);
	    })
	    
	    $(document).ready(function(){     

        $('#password2').keyup(function(){
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
        // alert(password1);
        
        if(password2!=password1){
          $('#showErrorPwd').html("** Password are not Matching");
          $('#showErrorPwd').css('color','red');
          return false;
        
        }else{
          $('#showErrorPwd').html('');
          return true;
        }
        
        })  
        });
	</script>
</body>

</html>