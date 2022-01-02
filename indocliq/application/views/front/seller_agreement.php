<style>
  /* Make the image fully responsive */

	.body1 {
	    /*position: relative;*/
	    top: 0;
	    left: 0;
	    z-index: 0;
	    width: 100%;
	    height: 100%;
	    background-attachment: fixed;
	}
	.pb-50{
		padding-bottom: 50px;
	}
	.right_text h3{
		font-weight: bold;
		color: #124b56;
	}
	.right_text p{
		/*text-align: justify;*/
		color: #757979;
		font-weight: 600;
	}
	.gift-sec .fa{
		font-size: 60px;
		color: #eeaf49;
	}
	.gift-sec p{
		font-size: 13px;
		color: #888;
		line-height: 22px;
	}
	.gift-sec h6{
		font-weight: bold;
		color: #de941be6;
		padding-top: 15px;
		padding-bottom: 10px;
		font-size: 20px;
	}
	.main_heading{
		padding: 50px;
	}
	.main_heading h2{
		font-weight: 600;
		color: #4b4c4c;
	}
	
	.main_sec1 {
    box-shadow: 0 0 7px 0px #00000094;
    /*background: white;*/
    border-radius: 10px;
    }
	/*<>*/
	.bg-back{
		height: 225px; 
		background-size: cover; 
		background-position: center center; 
		background-repeat: no-repeat;
	}
	.bg-img-text{
		padding-top: 86px; 
		color: white;
	}
	@media screen and (max-width: 768px){
		.bg-back{
			height: 81px;
		}
		.bg-img-text{
			padding-top: 23px;
	}
		.bg-img-text h2{
			font-size: 21px;
		}

	}
	.bg{
		position: relative;
	}
		.bg-back:before{
		content: '';
	    position: absolute;
	    left: 0;
	    top: 0;
	    background-color: rgba(0, 0, 0, 0.53); 
	    width: 100%;
	    height: 100%;	
		}
		.bg-img-text h2{
			display: inline-block;
			border-bottom: 2px solid #62e6ff;
		}

</style>
	<!-- <mobile fixed nav start> -->
	
	<!-- <map start>-->
		<!-- <sec2 start> -->
		<section class="pt-50 pb-50">
			<div class="container">
				<div class="row">
					<!--<div class="col-md-12" style="background-color: #8405127a;">-->
					<div class="col-sm-12" style="background-color:;">
                        <div class="main_sec1" style="background-color: whitesmoke;">
					
        					<div class="col-lg-12" style="padding-top: 30px; padding-bottom:20px;">
        						<div class="right_text">
        							<h3><?php echo $seller_data["title"]?></h3>
        							
        							<p><?php echo $seller_data["editor1"]?></p>
        						</div>
        					</div>
        				</div>	
    				</div>	
				</div>
			</div>
		</section>
		<!-- <sec2 end> -->
		
	<!-- <address detail sec start> -->
	
	<!-- <address detail sec end> -->