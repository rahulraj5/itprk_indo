<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->SessionModel->checkuserlogin(array("registration_form","registrationFormSubmit","sendsmsdemo","vendor_registration","user_agreement","seller_agreement","sell_on_indocliq","login","loginajax","registerajax","index","registration_otp_send","confirmregisterajax","loginbypassword","createCode","shops","shopdetail","productdetail","variant_price","buynow","addToCart","contact","updateNavCart","cart","removeCartProduct","updateQuantity","addshippinginfo","uploadfilebypath","contactinfo","aboutus","privacy_policy","terms_condition","products","clearance_product","forgotpasswordsubmit","verifyForgotOtp","changeforgotpasswrodsubmit","loginbyotpsubmit","verifyloginOtp","clearance_detail","subcatbycatname","resendotp"));

	}



	public function index(){

// 		$this->load->view('front/header');

		$this->load->view('front/home');

// 		$this->load->view('front/footer');

	}



    public function aboutus(){

        $this->load->view('front/header');

        $this->load->view('front/aboutus');

        $this->load->view('front/footer');

    }

    

    public function sell_on_indocliq(){

        $this->load->view('front/header');

        $this->load->view('front/sell_on_indocliq');

        $this->load->view('front/footer');

    } 

    

    public function login_otp_send($mobile_no,$country_isd_code){

		

		if($mobile_no){

			$otp = $this->createCode('login_otp','otp',6);

			$check_user = $this->Common_model->getSingleRecordById('login_otp',array('mobile_no'=> $mobile_no));

			$post_data = array();

			$post_data['mobile_no'] = $mobile_no;

			$post_data['create_date'] = date('Y-m-d H:i:s');

			$post_data['otp'] = $otp;

			if($check_user){

				$update = $this->Common_model->updateRecords('login_otp', $post_data,array('mobile_no'=> $mobile_no));

			}else{

				$add_otp = $this->Common_model->addRecords('login_otp',$post_data);

			}

			$check_number = $this->Common_model->getwhere('shops',array('mobile_no'=> $mobile_no));

			if(empty($check_number)){

                $user_number = $mobile_no;

                $user_country_isd_code = $country_isd_code;

                $user_number_isd_code =  $user_country_isd_code.$user_number;

                if(!empty($user_number_isd_code)){

	                $message = "your Txn OTP ".$otp;

	                $response = sendotp($user_number,$user_country_isd_code,$otp);

					if($response){

						$msg = array('status'=>1, 'msg'=>'Your OTP has been sent successfully'); 

						  return json_encode($msg);

						  exit();

						//echo json_encode($msg);

					}else{

					     $msg = array('status'=>1, 'msg'=>'Error submitting!'); 

						  return json_encode($msg);

						  exit();

						// $data['message'] = "Error please try again!";

					}

				}else{

					$msg = array('status'=>1, 'msg'=>'Your Number has been not registered!'); 

					return json_encode($msg);

					exit();

				}

			}

		}
	}

	public function loginbyotpsubmit(){

	   // print_r($_POST['moibleno']);

	   	$mobile_no = base64_encode($_POST['moibleno']);

		$mobile_no = $mobile_no;

		$checkmobileno = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mobile_no));

		// print_r($checkmobileno[0]['mobile_no']);



		// $mobile_no_g = $checkmobileno[0]['mobile_no'];

		// $mobile_no_d = base64_decode($mobile_no_g);



		// print_r($mobile_no_d);

        // print_r($checkmobileno);

		// die;

		if((isset($checkmobileno) && !empty($checkmobileno))){
			$registration_form_status = $checkmobileno[0]['registration_form_status'];
			if($registration_form_status != 1){
				$mobile_no_g = $checkmobileno[0]['mobile_no'];

				$mobile_no_d = base64_decode($mobile_no_g);

				$post_data = array();

				$post_data['mobile_no'] = $mobile_no_d;

				$mob="/^[1-9][0-9]*$/";

				if(preg_match($mob, $mobile_no_d)){
					$respotp = $this->login_otp_send($mobile_no_d,91);

					$resotparray = json_decode($respotp,true);

					// print_r($resotparray);

					if(isset($resotparray) && $resotparray['status'] == 1){

						$set_data_id = $this->session->set_tempdata(array('login_otp_data'=>$post_data),"",240);

		       	     	$registraiton_data = $this->session->tempdata('login_otp_data');

		       	     	$data['login_otp_data'] = $registraiton_data;

		       	     	$data['success'] = "Enter otp and verify mobile number for set password.";

		       	     	$msg = array('status'=>1, 'msg'=>'Your OTP has been sent successfully'); 

						echo json_encode($msg);

						exit();

					}else{

		       	    	$msg = array('status'=>0, 'msg'=>'Invalid Mobile No.'); 

						echo json_encode($msg);

						exit();

		       	    }
		       	}else{
		       		$msg = array('status'=>0, 'msg'=>'Invalid Mobile No formate please try again.'); 

						echo json_encode($msg);

						exit();
		       	}
	       	}else{
	       		$msg = array('status'=>0, 'msg'=>'You have already registered by these mobile number.'); 

				echo json_encode($msg);

				exit();
	       	}

		}else{

			// $mobile_no_g = $checkmobileno[0]['mobile_no'];

			// $mobile_no_d = base64_decode($mobile_no_g);

			$mobile_no = $_POST['moibleno'];

			$post_data = array();

			$post_data['mobile_no'] = $mobile_no;
			$mob="/^[1-9][0-9]*$/";

			if(preg_match($mob, $mobile_no)){

				$mobilelenth = strlen($mobile_no);
				if($mobilelenth == 10){
					$respotp = $this->login_otp_send($mobile_no,91);

					$resotparray = json_decode($respotp,true);
					
					// print_r($resotparray);

					if(isset($resotparray) && $resotparray['status'] == 1){

						$set_data_id = $this->session->set_tempdata(array('login_otp_data'=>$post_data),"",240);

		       	     	$registraiton_data = $this->session->tempdata('login_otp_data');

		       	     	$data['login_otp_data'] = $registraiton_data;

		       	     	$data['success'] = "Enter otp and verify mobile number for set password.";

		       	     	$msg = array('status'=>1, 'msg'=>'Your OTP has been sent successfully'); 

						echo json_encode($msg);

						exit();

					}else{

		       	    	$msg = array('status'=>0, 'msg'=>'Invalid Mobile No.'); 

						echo json_encode($msg);

						exit();

		       	    }
		       	}else{
		       		$msg = array('status'=>0, 'msg'=>'Please enter valid 10 digit mobile number'); 

					echo json_encode($msg);

					exit();
		       	}
	       	}else{
	       		$msg = array('status'=>0, 'msg'=>'Please enter valid 10 digit mobile number'); 

				echo json_encode($msg);

				exit();
	       	}

		}
	}

	public function verifyloginOtp(){

		if(isset($_POST) && !empty($_POST)){

			$forgot_otp_data = $this->session->tempdata('login_otp_data');

			if(isset($forgot_otp_data) && !empty($forgot_otp_data)){

				if(isset($_POST['otp']) && !empty($_POST['otp'])){

					$mobile_no = $forgot_otp_data['mobile_no'];

				// 	$mobile_no = base64_encode($mobile_no);

					$checkmobilenootp = $this->Common_model->GetWhere('login_otp', array('mobile_no'=>$mobile_no,'otp'=>$_POST['otp']));

					// print_r($checkmobilenootp[0]['mobile_no']);

					// print_r($checkmobilenootp);

					

						// print_r($mobile_no);

						if(isset($checkmobilenootp) && !empty($checkmobilenootp))

						{

						    $mobile_no = $forgot_otp_data['mobile_no'];

				        	$mobile_no = base64_encode($mobile_no);

							$checkuser = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mobile_no));

							// print_r($checkuser);

							

								if(isset($checkuser) && !empty($checkuser)){

									$checkuserrow = $checkuser[0];

									if($checkuserrow['status'] == 1){

										$this->session->set_userdata(USER_SESSION, $checkuserrow);
										$this->session->set_tempdata(array('shopregistrationdata'=>$checkuserrow),"",300);

										$msg = array('status'=>1, 'msg'=>'OTP Verified Successfully.');

										// redirect(base_url());

										echo json_encode($msg);

										exit();	

									}else{

										$msg = array('status'=>0, 'msg'=>'Your account has been deactivated ,please contact with admin');

										echo json_encode($msg);

										exit();	

									}

								}elseif(empty($checkuser)){

									$mobile_no = $forgot_otp_data['mobile_no'];

									$checkmobilenootp = $this->Common_model->GetWhere('login_otp', array('mobile_no'=>$mobile_no,'otp'=>$_POST['otp']));

									// print_r($checkmobilenootp);

									$mobile_no = $checkmobilenootp[0]['mobile_no'];

									$mobile_no = base64_encode($mobile_no);

									$user_data = array();
									$user_data['status'] = 1;
									$user_data['mobile_no'] = $mobile_no;

									$user_data['shop_reg_id'] = $this->createCode('shops','shop_reg_id',8);

									$user_data['shop_registration_no'] = $this->createCode('shops','shop_registration_no',6);

									

									$user_data['create_date'] = date('Y-m-d H:i:s');

									$result = $this->Common_model->addrecords('shops',$user_data);

									if($result){
										$checkusershop = $this->Common_model->GetWhere('shops', array('shop_id'=>$result));
										if(isset($checkusershop) && !empty($checkusershop)){
											$this->session->set_userdata(USER_SESSION, $checkusershop[0]);
											$this->session->set_tempdata(array('shopregistrationdata'=>$checkusershop[0]),"",300);
										}

										$msg = array('status'=>1, 'msg'=>'Successfully Registered ! Welcome to Indocliq.');

										echo json_encode($msg);

										exit();

									}



									



								}else{

									$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');

									echo json_encode($msg);

									exit();

								}

							

						}else{

							$msg = array('status'=>0, 'msg'=>'Invalid otp please try again.');

							echo json_encode($msg);

							exit();

						}

						



				}else{

					$msg = array('status'=>0, 'msg'=>'Please enter otp');

					echo json_encode($msg);

					exit();

				}

			}else{

				$msg = array('status'=>0, 'msg'=>'Your session has been expired.');

				echo json_encode($msg);

				exit();

			}

		}
	}

	public function resendotp(){
		if(isset($_POST) && !empty($_POST)){

			$forgot_otp_data = $this->session->tempdata('login_otp_data');

			if(isset($forgot_otp_data) && !empty($forgot_otp_data)){

				$post_data = array();
				$mobile_no = $forgot_otp_data['mobile_no'];

				$post_data['mobile_no'] = $forgot_otp_data['mobile_no'];

				$respotp = $this->login_otp_send($mobile_no,91);

				$resotparray = json_decode($respotp,true);

				// print_r($resotparray);

				if(isset($resotparray) && $resotparray['status'] == 1){

					$set_data_id = $this->session->set_tempdata(array('login_otp_data'=>$post_data),"",240);
					$msg = array('status'=>1, 'msg'=>'Otp resend successfully .');

					echo json_encode($msg);

					exit();

				}else{

					$msg = array('status'=>0, 'msg'=>'Your session has been expired.');

					echo json_encode($msg);

					exit();

				}
			}else{
				$msg = array('status'=>0, 'msg'=>'your session has been expired please go home and process again.');

					echo json_encode($msg);

					exit();
			}
		}
	}

	public function registration_form(){

		// print_r($_POST);

		// die;
    	$data = array();
		$cid = customersessionid();
		// $sessionshopdata = $this->session->set_userdata(USER_SESSION);
		$sessionshopdata = $this->session->tempdata('shopregistrationdata');
		if(isset($sessionshopdata['mobile_no']) && !empty($sessionshopdata['mobile_no'])){


			$data['error_email'] = "";
			$data['success'] = "";
			$data['error'] = "";
			$data['shop_data'] = "";
			$shop_data = "";
			$data['shop_data'] = $shop_data;

			$this->load->view('front/registration_form');
		}else{
			redirect(base_url());
		}
	}

	public function regi_form(){

		// print_r($_POST);

		// die;
    	$data = array();
		// $cid = customersessionid();
		// $sessionshopdata = $this->session->set_userdata(USER_SESSION);
		// $sessionshopdata = $this->session->tempdata('shopregistrationdata');
		// if(isset($sessionshopdata['mobile_no']) && !empty($sessionshopdata['mobile_no'])){


		$data['error_email'] = "";
		$data['success'] = "";
		$data['error'] = "";
		$data['shop_data'] = "";
		$shop_data = "";
		$data['shop_data'] = $shop_data;

		$this->load->view('front/registration_form');
		// }else{
			// redirect(base_url());
		// }
	}



	public function registrationFormSubmit(){
		$data = array();
		$cid = customersessionid();
		// $sessionshopdata = $this->session->set_userdata(USER_SESSION);
		$sessionshopdata = $this->session->tempdata('shopregistrationdata');
		// print_r($sessionshopdata);

		// print_r($cid);
		// print_r($_POST);
		// die;
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) &&  !empty($_POST['email']) && isset($_POST['company']) && !empty($_POST['company']) && isset($_POST['city']) && !empty($_POST['city'])
		 && isset($_POST['state']) &&  !empty($_POST['state']) && isset($_POST['zip']) &&  !empty($_POST['zip']) && isset($_POST['shopping_categories']) &&  !empty($_POST['shopping_categories']) && isset($_POST['password']) &&  !empty($_POST['password']) && isset($_POST['accept_terms']) &&  !empty($_POST['accept_terms']))
		 {

		 	if($_POST['accept_terms'] == 1){
				if(isset($sessionshopdata['mobile_no']) && !empty($sessionshopdata['mobile_no'])){

					$mobile_no = $sessionshopdata['mobile_no'];

					$checkmobile = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mobile_no));

					if(!empty($checkmobile[0]['mobile_no'] && empty($checkmobile[0]['email'])))

					{

							$data = array();

							//$data['user_id'] = customersessionid();

							$data['owner_name'] = $_POST['name'];
							$data['email'] = $_POST['email'];
							$data['shop_name'] = $_POST['company'];
							// $data['shop_address'] = $_POST['address'];
							$data['gst_number'] = isset($_POST['gst']) ? $_POST['gst'] : '';
							$data['city_name'] = $_POST['city'];
							$data['state_name'] = $_POST['state'];
							$data['shop_pincode'] = $_POST['zip'];
							$data['password'] = md5($_POST['password']);
							$password = $_POST['password'];
							$data['accept_terms'] = $_POST['accept_terms'];
							

							$data['number2'] = $_POST['mobile_no'];

							if(isset($_POST['shopping_categories']) && !empty($_POST['shopping_categories'])){
								// print_r($_POST['shopping_categories']);
								// exit();

								$data['shopping_categories'] = implode(",", $_POST['shopping_categories']);

							}

							// $mobile_no = base64_decode($_POST['mobile_no']);

							// $data['mobile_no'] = $mobile_no;

							// $data['shop_reg_id'] = $this->createCode('shops','shop_reg_id',8);

							// $data['shop_registration_no'] = $this->createCode('shops','shop_registration_no',6);

							// print_r($data);

							// die;

							if($data){

								// $mobile_no = base64_encode($_POST['mobile_no']);

								$checkmobile = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mobile_no));

								$shop_id = $checkmobile[0]['shop_id'];
								$data['registration_form_status'] = 1;
								// $result = $this->Common_model->addRecords('shops',$data);

								$result = $this->Common_model->updateRecords('shops',$data,array('shop_id'=>$shop_id));

								// print_r($result);

								if($result){
									$mobile_no_decode = base64_decode($mobile_no);

									$welcomemsg = "Great, 
												   Welcome to IndoCliq. Congratulations on taking the first step to grow your business. You will have a great and unique selling experience here. Stay connected We will contact you soon .
												   Mobile no  ".$mobile_no_decode."
												   password is ".$password."
												   login here http://indocliq.com/shop
												   Thank you 
												   ";
									sendsms($mobile_no_decode,"91",$welcomemsg);
									// var_dump($resp);

									$msg = array('status'=>1, 'msg'=>'Successfully Registered ! Welcome to Indocliq.');

									echo json_encode($msg);

									exit();

								}else{

									$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');

									echo json_encode($msg);

									exit();

								}

							}else{

									$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');

									echo json_encode($msg);

									exit();

							}

					}elseif(!empty($checkmobile[0]['email']) && !empty($checkmobile[0]['mobile_no']))

					{

						$msg = array('status'=>0, 'msg'=>'You Already Registered.');

						echo json_encode($msg);

						exit();  

					}else{

						$msg = array('status'=>0, 'msg'=>'something went wrong please try again');

						echo json_encode($msg);

						exit();

					}   

				}else{
					$msg = array('status'=>0, 'msg'=>'Your session has been timeout please try again. ');

					echo json_encode($msg);

					exit();
				}
			}else{
				$msg = array('status'=>0, 'msg'=>'Mandetory(*) Fields are Required.');

				echo json_encode($msg);

				exit();
			}
		}else{
			$msg = array('status'=>0, 'msg'=>'Mandetory(*) Fields are Required.');

			echo json_encode($msg);

			exit();
		}	
	}

  	public function vendor_registration(){

        

        // $this->load->view('front/header');

        $this->load->view('front/vendor_signup');

        // $this->load->view('front/footer');
	} 

	public function subcatbycatname(){

		if(isset($_POST) && !empty($_POST['cat'])){

			$allcats = $_POST['cat'];

			// $allcats = implode("', '", $cats);

			$whr2 = "WHERE status = 1 AND category_name = '".$allcats."'";

			$orderby = " ORDER BY categories_id asc";

			$categories_data = $this->Common_model->getwherecustomesingle('categories',$whr2,$orderby);

			if(isset($categories_data) && !empty($categories_data)){

				// $catids = array();

				// foreach ($categories_data as $key => $catdataarray) {

				// 	$catids[] = $catdataarray['categories_id'];

				// }



				$whr3 = "WHERE status = 1 AND parent_category_id in ('".$categories_data['categories_id']."')";

				$orderby3 = " ORDER BY categories_id asc";

				$subcategories_data = $this->Common_model->getwherecustome('categories',$whr3,$orderby3);

				// print_r($subcategories_data);

				if(isset($subcategories_data) && !empty($subcategories_data)){

					foreach($subcategories_data as $subcategories_data_array){

						echo "<option value='".$subcategories_data_array['category_name']."'>".$subcategories_data_array['category_name']."</option>";

					}

				}

			}else{



			}

		}else{



		}

	}

    

    public function sendsmsdemo($user_number){

        // $message = "your Txn OTP Demo ";

	    // $response = sendsms($user_number,"91",$message);

	    $welcomemsg = "Demo";
		$resp = sendersmsdemo2($user_number,"91",$welcomemsg);
		echo json_encode($resp);
		var_dump($resp);

	    // var_dump($response);

    }

    public function saveReview(){

        // print_r($_POST);

        $cid = customersessionid();

        $order_id = $_POST['order_id'];

        $shop_id = $_POST['shop_id'];

        $checkreviewstatus = $this->Common_model->GetWhere('shopreviewrating', array('user_id'=>$cid,'order_id'=>$order_id));

        if(empty($checkreviewstatus)){

        	$post_data = array();

        	$post_data['rating'] = $_POST['rating'];

        	$post_data['shop_id'] = $shop_id;

        	$post_data['order_id'] = $order_id;

        	$post_data['user_id'] = $cid;

        	$post_data['create_date'] = date('Y-m-d H:i:s');

        	$result = $this->Common_model->addRecords('shopreviewrating',$post_data);

        	if($result){

				$msg = array('status'=>1, 'msg'=>'Thanks for submit your feedback');

				echo json_encode($msg);

				exit();

			}else{

				$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');

				echo json_encode($msg);

				exit();

			}

        }else{

        	$msg = array('status'=>0, 'msg'=>'You have already sent your feedback.');

			echo json_encode($msg);

			exit();

        }

    }



    public function saveProductReview(){

        $cid = customersessionid();

        $order_id = $_POST['order_id'];

        $product_id = $_POST['product_id'];

        $checkreviewstatus = $this->Common_model->GetWhere('productreviewrating', array('user_id'=>$cid,'order_id'=>$order_id,'product_id'=>$product_id));

        if(empty($checkreviewstatus)){

        	$post_data = array();

        	$post_data['rating'] = $_POST['rating'];

        	$post_data['product_id'] = $product_id;

        	$post_data['order_id'] = $order_id;

        	$post_data['user_id'] = $cid;

        	$post_data['create_date'] = date('Y-m-d H:i:s');

        	$result = $this->Common_model->addRecords('productreviewrating',$post_data);

        	if($result){

				$msg = array('status'=>1, 'msg'=>'Thanks for submit your feedback');

				echo json_encode($msg);

				exit();

			}else{

				$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');

				echo json_encode($msg);

				exit();

			}

        }else{

        	$msg = array('status'=>0, 'msg'=>'You have already sent your feedback.');

			echo json_encode($msg);

			exit();

        }

    }



	









	





	public function createCode($table,$column_name,$length)

	{

		$jc = "";

		$jay = generateRandomStringbylnth($length);

		$js = $this->Common_model->getSingleRecordById($table,array($column_name => $jay));

		if($js){

			$jc = $this->createCode($table,$column_name);

		}else{

			$jc = $jay;

		}

		return $jc;

    }



    public function orderhistory(){

    	$data = array();



    	$userid = customersessionid();

    	

    	// if(isset($_GET['delivery_status']) && !empty($_GET['delivery_status']) && isset($userid)){

    	  

    	  

    	// 	$whr = array();

    	// 	$whr[] = "o.status = 1";

    	// 	$whr[] = "o.delivery_status = 1";

    	// 	$orderby = " ORDER BY o.id desc";

    	// 	$where = " WHERE ".implode(" AND ", $whr);

     //    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);

    	//    // $data['orders'] = $this->Common_model->getWhereDatanew($where,array('user_id'=>$userid,'status'=>1,'delivery_status'=>1));

    	// }

    	

    	  

		$whr = array();

		$whr[] = "o.status = 1";

		$whr[] = "o.user_id = ".$userid."";

		if(isset($_GET['delivery_status']) && !empty($_GET['delivery_status'])){

    		$whr[] = "o.delivery_status = ".$_GET['delivery_status']."";

    	}



		$orderby = " ORDER BY o.id desc";

		$where = " WHERE ".implode(" AND ", $whr);

    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);   

    // 	print_r($data['orders']);

        // die;

    	$this->load->view('front/header');

        $this->load->view('front/orderhistory',$data);

        $this->load->view('front/footer');

    }

    

    public function productdetail(){

    	$pid = $_GET['pid'];

    // 	print_r($pid);

    	$data = array();

    // 	$data = array();

    	$userid = customersessionid();

    //     $whr = array();

    //     $whr[] = "status = 1";

    //     $whr[] = "user_id = ".$userid."";

    //     if(isset($_GET['pid']) && !empty($_GET['pid'])){

    //     		$whr[] = "product_id = ".$pid."";

    //     	}

    //     $where = " WHERE ".implode(" AND ", $whr);	

    //     $data['rating'] = $this->Common_model->getwhrproductrating($where); 

    //     $abcd = $data['rating'][0];

    //     $dsas = $abcd['rating'];

    //     // print_r($dsas);

    //     print_r($data['rating']);

    //     die;

    

        // $whr = array();

        // $whr[] = "status = 1";

        // if(isset($_GET['pid']) && !empty($_GET['pid'])){

        // 		$whr[] = "product_id = ".$pid."";

        // 	}

        // $where = " WHERE ".implode(" AND ", $whr);	

        // $data['review'] = $this->Common_model->getwhrproductratingdetail($where); 

        // $abcd = $data['rating'][0];

        // $dsas = $abcd['rating'];

        // print_r($dsas);

        // print_r($data['review']);

        // die;

        

    //     $whr = array();

    //     $whr[] = "status = 1";

       

    //     if(isset($_GET['pid']) && !empty($_GET['pid'])){

    // 		$whr[] = "product_id = ".$pid."";

    // 	}

    //     // print_r($whr);	

    //     $where = " WHERE ".implode(" AND ", $whr);	

    //     $data['ratingavg'] = $this->Common_model->getwhrproductratingaverage($where); 

        

    //     print_r($data['ratingavg']);

    //     die;

    

        // $whr = array();

        // $whr[] = "status = 1";

        // if(isset($_GET['pid']) && !empty($_GET['pid'])){

        // 		$whr[] = "product_id = ".$pid."";

        // 	}

        // $where = " WHERE ".implode(" AND ", $whr);	

        // $datareview = $this->Common_model->getwhrproductratingdetail($where); 

        // // print_r($data['review']);

        // print_r($datareview);

        // die;

		$data['product_data'] = $this->Common_model->getSingleRecordById("product",array('product_id'=>$pid));

		$data['color'] = $this->Common_model->getwhere("colors",array(1=>1));

		$data['categorylist'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));

    	$this->load->view('front/header');

		$this->load->view('front/productdetail',$data);

		$this->load->view('front/footer');

    }

    

    public function products()

    {

    	// $categorylist = $this->Common_model->getwhrproducts("product",array('status'=>1,'parent_category_id'=>0));

    // 	$categorylist = $this->Common_model->getwhrproducts('product');

    	// die;

    	// print_r($categorylist);

        // print_r($best_shop_data['datea']);

		$this->load->view('front/header');

		$this->load->view('front/products');

		$this->load->view('front/footer');

	}



    public function clearance_product(){

    	$data = array();

    	$cid = customersessionid();

    	$whr = array();

    	$u_lat = '';

    	$u_long = '';

    	$whr[] = 'status = 1';

    	if(isset($cid) && !empty($cid)){

    		$customerdata = customerdata(customersessionid());

    		// p($customerdata);

    		 $u_lat = $customerdata['latitude'];

    		 $u_long = $customerdata['longitude'];

    	}

    	

    	if(isset($_GET['categories_id']) && !empty($_GET['categories_id'])){

    		$whr[] = " FIND_IN_SET('".$_GET['categories_id']."',shopping_categories)";

    	}



    	if(isset($_GET['special_cat_id']) && !empty($_GET['special_cat_id'])){

    		$whr[] = " FIND_IN_SET('".$_GET['special_cat_id']."',shopping_specialized)";

    	}



    	if(isset($_GET['tags']) && !empty($_GET['tags'])){

    		$whr[] = " FIND_IN_SET('".$_GET['tags']."',meta_tags)";

    	}



    	$where = " WHERE ".implode(" AND ", $whr);

    	$cols = "s.*";

    	if(isset($u_lat) && !empty($u_lat) & isset($u_long) && !empty($u_long)){

    		$orderby = "ORDER BY distance ASC";

    		$all_shop_data = $this->Common_model->getshopsbylatlong($cols,$where,$u_lat,$u_long,$orderby);



    		$data['u_lat'] = $u_lat;

    		$data['u_long'] = $u_long;

    	}else{

    		$orderby = "ORDER BY shop_id ASC";

    		$all_shop_data = $this->Common_model->getshopswhr($cols,$where,$orderby);

    	}

    	// p($all_shop_data);

    	$data['all_shop_data'] = $all_shop_data;



    	// p($all_shop_data);

    	$data['categorylist'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));

    	// die;

    	$this->load->view('front/header');

		$this->load->view('front/clearance_product',$data);

		$this->load->view('front/footer');

    }

    

    public function clearance_detail(){

    	$data = array();

    	$shop_id = $_GET['shop_id'];

    	// $cid = customersessionid();

    	// $whr = array();

    	// $u_lat = '';

    	// $u_long = '';

    	// $whr[] = 'status = 1';

    	// if(isset($cid) && !empty($cid)){

    	// 	$customerdata = customerdata(customersessionid());

    	// 	// p($customerdata);

    	// 	 $u_lat = $customerdata['latitude'];

    	// 	 $u_long = $customerdata['longitude'];

    	// }

    	

    	// $where = " WHERE ".implode(" AND ", $whr);

    	// $cols = "s.*";

    	// if(isset($u_lat) && !empty($u_lat) & isset($u_long) && !empty($u_long)){

    	// 	$orderby = "ORDER BY distance ASC";

    	// 	$all_shop_data = $this->Common_model->getshopsbylatlong($cols,$where,$u_lat,$u_long,$orderby);



    	// 	$data['u_lat'] = $u_lat;

    	// 	$data['u_long'] = $u_long;

    	// }else{

    	// 	$orderby = "ORDER BY shop_id ASC";

    	// 	$all_shop_data = $this->Common_model->getshopswhr($cols,$where,$orderby);

    	// }

    	// // p($all_shop_data);

    	// $data['all_shop_data'] = $all_shop_data;

    	// echo $shop_id;

    	// die;

    	$whr = array();

    	$whr[] = 's.status != 3';

    	$whr[] = 's.shop_id = '.$shop_id;

    	$where = " WHERE ".implode(" AND ", $whr);

		if(!empty($shop_id)){

			//$where = array('status !='=>3,'shop_id'=>$shop_id);

			// $data['shop_data'] = $this->Common_model->GetWhere("shops",$where);

			$orderby = "ORDER BY s.shop_id ASC";

    		$data['shop_data'] = $this->Common_model->getshopswhr("s.*",$where,$orderby);

    // 		print_r($data['shop_data']);

			if(!empty($data['shop_data']))

			{

				$shop_data = $data['shop_data'][0];



				// print_r($shop_data);

				$shopping_categories = $shop_data['shopping_categories'];

				// print_r($shopping_categories);

				$result_string = "'" . str_replace(",", "','", $shopping_categories) . "'";

				// echo "Input String: ".$result_string;

				$whrc = " WHERE category_name in (".$result_string.")";

				// print_r($whrc);

				$data['shopping_categories'] = $this->Common_model->getwhrcategoiesbycatname($whrc);

				// print_r($data['shopping_categories']);

				// print_r($res);

				// die;

			}

		}

		$data['shop_id'] = $shop_id;

		$data['shop_type_list'] = $this->Common_model->GetWhere("shop_types",array('1'=>1));

		$data['shop_data'] = $shop_data;

    	$this->load->view('front/header');

		$this->load->view('front/clearance_detail',$data);

		$this->load->view('front/footer');

    }



    public function shops(){

    	$data = array();

    	$cid = customersessionid();

    	$whr = array();

    	$u_lat = '';

    	$u_long = '';

    	$whr[] = 'status = 1';

    	if(isset($cid) && !empty($cid)){

    		$customerdata = customerdata(customersessionid());

    		// p($customerdata);

    		 $u_lat = $customerdata['latitude'];

    		 $u_long = $customerdata['longitude'];

    	}

    	

    	if(isset($_GET['categories_id']) && !empty($_GET['categories_id'])){

    		$whr[] = " FIND_IN_SET('".$_GET['categories_id']."',shopping_categories)";

    	}



    	if(isset($_GET['special_cat_id']) && !empty($_GET['special_cat_id'])){

    		$whr[] = " FIND_IN_SET('".$_GET['special_cat_id']."',shopping_specialized)";

    	}



    	if(isset($_GET['tags']) && !empty($_GET['tags'])){

    		$whr[] = " FIND_IN_SET('".$_GET['tags']."',meta_tags)";

    	}



    	$where = " WHERE ".implode(" AND ", $whr);

    	$cols = "s.*";

    	if(isset($u_lat) && !empty($u_lat) & isset($u_long) && !empty($u_long)){

    		$orderby = "ORDER BY distance ASC";

    		$all_shop_data = $this->Common_model->getshopsbylatlong($cols,$where,$u_lat,$u_long,$orderby);



    		$data['u_lat'] = $u_lat;

    		$data['u_long'] = $u_long;

    	}else{

    		$orderby = "ORDER BY shop_id ASC";

    		$all_shop_data = $this->Common_model->getshopswhr($cols,$where,$orderby);

    	}

    	// p($all_shop_data);

    	$data['categorylist'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));

    	$subcategorylist = $this->Common_model->getwhrsubcatgo('categories');

    // 	$subcategory =  $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>$subcategorylist['categories_id']));

    // 	print_r($data['categorylist']);

    // 	print_r($subcategorylist);

        // print_r($subcategory);

        // die;

    	$data['all_shop_data'] = $all_shop_data;

    	$this->load->view('front/header');

		$this->load->view('front/shops',$data);

		$this->load->view('front/footer');

    }



    public function shopdetail(){

    	$data = array();

    	$shop_id = $_GET['shop_id'];

    	// $cid = customersessionid();

    	// $whr = array();

    	// $u_lat = '';

    	// $u_long = '';

    	// $whr[] = 'status = 1';

    	// if(isset($cid) && !empty($cid)){

    	// 	$customerdata = customerdata(customersessionid());

    	// 	// p($customerdata);

    	// 	 $u_lat = $customerdata['latitude'];

    	// 	 $u_long = $customerdata['longitude'];

    	// }

    	

    	// $where = " WHERE ".implode(" AND ", $whr);

    	// $cols = "s.*";

    	// if(isset($u_lat) && !empty($u_lat) & isset($u_long) && !empty($u_long)){

    	// 	$orderby = "ORDER BY distance ASC";

    	// 	$all_shop_data = $this->Common_model->getshopsbylatlong($cols,$where,$u_lat,$u_long,$orderby);



    	// 	$data['u_lat'] = $u_lat;

    	// 	$data['u_long'] = $u_long;

    	// }else{

    	// 	$orderby = "ORDER BY shop_id ASC";

    	// 	$all_shop_data = $this->Common_model->getshopswhr($cols,$where,$orderby);

    	// }

    	// // p($all_shop_data);

    	// $data['all_shop_data'] = $all_shop_data;

    	// echo $shop_id;

    	// die;

    	$whr = array();

    	$whr[] = 's.status != 3';

    	$whr[] = 's.shop_id = '.$shop_id;

    	$where = " WHERE ".implode(" AND ", $whr);

		if(!empty($shop_id)){

			//$where = array('status !='=>3,'shop_id'=>$shop_id);

			// $data['shop_data'] = $this->Common_model->GetWhere("shops",$where);

			$orderby = "ORDER BY s.shop_id ASC";

    		$data['shop_data'] = $this->Common_model->getshopswhr("s.*",$where,$orderby);

    // 		print_r($data['shop_data']);

			if(!empty($data['shop_data']))

			{

				$shop_data = $data['shop_data'][0];



				// print_r($shop_data);

				$shopping_categories = $shop_data['shopping_categories'];

				// print_r($shopping_categories);

				$result_string = "'" . str_replace(",", "','", $shopping_categories) . "'";

				// echo "Input String: ".$result_string;

				$whrc = " WHERE category_name in (".$result_string.")";

				// print_r($whrc);

				$data['shopping_categories'] = $this->Common_model->getwhrcategoiesbycatname($whrc);

				// print_r($data['shopping_categories']);

				// print_r($res);

				// die;

			}

		}

		$data['shop_id'] = $shop_id;

		$data['shop_type_list'] = $this->Common_model->GetWhere("shop_types",array('1'=>1));

		$data['shop_data'] = $shop_data;

    	$this->load->view('front/header');

		$this->load->view('front/shopdetail',$data);

		$this->load->view('front/footer');

    }

    

    public function variant_price()

    {

    	//print_r($_POST);

        $product= $this->Common_model->getSingleRecordById("product",array('product_id'=>$_POST['id']));



        $str = '';

        $quantity = 0;



        if(isset($_POST['color'])){

            $data['color'] = $_POST['color'];

            // $str = Color::where('code', $request['color'])->first()->name;

            $str = $this->Common_model->getWhereDataByCol('colors',array('code'=>$_POST['color']),'name');

        }

        

        foreach (json_decode($product['choice_options']) as $key => $choice) {

            if($str != null){

                $str .= '-'.str_replace(' ', '', $_POST[$choice->name]);

            }

            else{

                $str .= str_replace(' ', '', $_POST[$choice->name]);

            }

        }

        //echo $str;

        if($str != null){

        	// $rsp = json_decode($product['variations'],true);

        	// $qty = $rsp[$str]['qty'];

        	// print_r($rsp);

        	// die;

           $price = json_decode($product['variations'])->$str->price;

           $quantity = json_decode($product['variations'])->$str->qty;

        }

        else{

            $price = $product['unit_price'];

        }



        //discount calculation

        // $flash_deal = \App\FlashDeal::where('status', 1)->first();

        // if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {

        //     $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();

        //     if($flash_deal_product->discount_type == 'percent'){

        //         $price -= ($price*$flash_deal_product->discount)/100;

        //     }

        //     elseif($flash_deal_product->discount_type == 'amount'){

        //         $price -= $flash_deal_product->discount;

        //     }

        // }

        // else{

        //     if($product->discount_type == 'percent'){

        //         $price -= ($price*$product->discount)/100;

        //     }

        //     elseif($product->discount_type == 'amount'){

        //         $price -= $product->discount;

        //     }

        // }



        // if($product->tax_type == 'percent'){

        //     $price += ($price*$product->tax)/100;

        // }

        // elseif($product->tax_type == 'amount'){

        //     $price += $product->tax;

        // }

        if($product['discount_type'] == 1){

            $price -= ($price*$product['discount'])/100;

        }

        elseif($product['discount_type'] == 2){

            $price -= $product['discount'];

        }

        echo json_encode(array('price' => $price*$_POST['quantity'], 'quantity' => $quantity));

    }



    public function dashboard(){

    	$this->load->view('front/header');

		$this->load->view('front/dashboard');

		$this->load->view('front/footer');

    }

    

    public function change_status(){

        if($_POST)

        {

        $tablename = $_POST['tablename'];

        $status = $_POST['status'];

        $id = $_POST['id'];

        $action = $_POST['action'];

        $whrcol = $_POST['whrcol'];

        $whrstatuscol = $_POST['whrstatuscol'];

        $res = $this->Common_model->updateRecords($tablename, array($whrstatuscol=>$status), array($whrcol => $id));

        // $resp = array('code'=>SUCCESS,'message'=>'Record has been '.$action.'successfully');

        // echo json_encode($resp);

        $msg = array('status'=>1, 'msg'=>'Record has been '.$action.' successfully');

		echo json_encode($msg);

		exit();

        }

    }

    

     public function reset_status(){



    	// print_r($_POST);

    	// die;

        $tablename = $_POST['tablename'];

        $status = $_POST['status'];

        $id = $_POST['add_id'];

        $userid = $_POST['userid'];

        $action = $_POST['action'];

        $whrcol = $_POST['whrcol']; //id

        $whrcolu = $_POST['whrcolu']; //user_id

        $whrstatuscol = $_POST['whrstatuscol']; //status

        $res = $this->Common_model->updateRecords($tablename, array($whrstatuscol=> 0), array($whrcolu => $userid));

        // $resp = array('code'=>SUCCESS,'message'=>'Record has been '.$action.'successfully');

        $this->Common_model->updateRecords($tablename, array($whrstatuscol=>1), array($whrcol => $id));

        

        // $insert_data = $this->Common_model->getSingleRecordById('multiple_address',array('add_id' => $id, 'status' =>1));

        // $in_data = $insert_data['add_id'];

        // print_r($insert_data);

        // $this->Common_model->updateRecords('users',$insert_data,array('id' => customersessionid()));

        // echo json_encode($resp);

        $msg = array('status'=>1, 'msg'=>'Record has been '.$action.' successfully');

		echo json_encode($msg);

		exit();

    }

    

    public function addmultiaddress($id=false){

        $data = array();

        if(isset($_POST['addressm']) && !empty($_POST['addressm']) && !empty($_POST['pin_codem']))

        {

            $data = array();

			$data['user_id'] = customersessionid();

			$data['address'] = $_POST['addressm'];

			$data['zipcode'] = $_POST['pin_codem'];

			$data['latitude'] = $_POST['latitudem'];

			$data['longitude'] = $_POST['longitudem'];

			$data['name'] = $_POST['name'];

			$data['email'] = $_POST['email'];

			$data['phone'] = $_POST['phone'];



            if(isset($_POST['add_id']) && !empty($_POST['add_id'])){

				$result = $this->Common_model->updateRecords('multiple_address',$data,array('add_id'=>$_POST['add_id']));

				$data['SUCCESS'] = "Successfully Updated";

				// redirect(base_url()."home/profile");



			}else{

			

				$result = $this->Common_model->addRecords('multiple_address',$data);

				$data['SUCCESS'] = "Added successfully";

				// redirect(base_url()."home/profile");

			}  

        }

        if($id){

			$multiple_address_data = $this->Common_model->getsingledata('multiple_address',array('add_id' => $id));

			$data['multiple_address_data'] = $multiple_address_data;

		}

		

        $this->load->view('front/header');

        $this->load->view('front/addmultiaddress',$data);

        $this->load->view('front/footer');

    }



    public function profile(){

        $data = array();

        // $multiple_address_data = $this->Common_model->getAllRecordsById('multiple_address',array('user_id' => customersessionid()));

        // print_r($multiple_address_data);

        // die;

        // $data['multiple_address_data'] = $this->Common_model->getsingledata('multiple_address',array('user_id' => customersessionid()));

        // $data['info_data'] = $info_data;

        // print_r($data);

    //     $choice_options = array();

	   //     if(isset($_POST['addressm'])){

	   //         foreach ($_POST['choice_no'] as $key => $no) {

	   //             $str = 'choice_options_'.$no;

	   //             $item['name'] = 'choice_'.$no;

	   //             $item['title'] = $_POST['choice'][$key];

	   //             $item['options'] = explode(',', implode('|', $_POST[$str]));

	   //             array_push($choice_options, $item);

	   //         }

	   //     }



	   // $post_data['choice_options'] = json_encode($choice_options);

	    

//         if(isset($_POST['addressm']) && !empty($_POST['addressm'])){

//             $data = array();

// 			$data['user_id'] = customersessionid();

// 			$data['address_multi'] = $_POST['addressm'];

// 			$data['zipcode'] = $_POST['pin_codem'];

// 			$data['latitude'] = $_POST['latitudem'];

// 			$data['longitude'] = $_POST['longitudem'];

// 			$result = $this->Common_model->addRecords('multiple_address',$data);

//         }

//         if(isset($_POST['addressm']) && !empty($_POST['addressm']) && !empty($_POST['pin_codem']))

//         {

//             $data = array();

// 			$data['user_id'] = $_POST['user_id'];

// 			$data['address_multi'] = $_POST['addressm'];

// 			$data['zipcode'] = $_POST['pin_codem'];

// 			$data['latitude'] = $_POST['latitudem'];

// 			$data['longitude'] = $_POST['longitudem'];

// // 			$result = $this->Common_model->addRecords('multiple_address',$data);

//             $result = $this->Common_model->updateData('multiple_address',$data,array('user_id' => customersessionid()));

//             if(['success']){

//                 echo "Successfully Updated";

//             }

//         }

        // else{

        // echo "All fields are required";

        // }

    	$this->load->view('front/header');

		$this->load->view('front/profile',$data);

		$this->load->view('front/footer');

    }



    public function contact()

    {

    	$data = array();

    	// print_r($_POST);

    	// if(isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['number']))

    	// {

	    // 	$insert_data = array();

	    // 	$insert_data['name'] = $_POST['name'];

	    // 	$insert_data['email'] = $_POST['email'];

	    // 	$insert_data['number'] = $_POST['number'];

	    // 	$insert_data['message'] = $_POST['message'];

	    // 	$result = $this->Common_model->addrecords('contactus',$insert_data);

    	// }

    	$this->load->view('front/header');

		$this->load->view('front/contact',$data);

		$this->load->view('front/footer');

    }



    public function contactinfo()

    {

    	// print_r($_POST);

    	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['number']) && !empty($_POST['number']))

    	{

    		// print_r($_POST);

	    	$insert_data = array();

	    	$insert_data['name'] = $_POST['name'];

	    	$insert_data['email'] = $_POST['email'];

	    	$insert_data['number'] = $_POST['number'];

	    	$insert_data['message'] = $_POST['message'];

	    	// $checkemail = $this->Common_model->getWhereData('contactus', array('email' => $_POST["email"]));

			$result = $this->Common_model->addrecords('contactus',$insert_data);

			// redirect(base_url()."home/contactus");

			if(!empty($result))

			{

			// $result = $this->Common_model->addrecords('contactus',$insert_data);

	 	 	$status = 1;

	  		$msg = "Contact has been Send successfully";

	        // redirect(base_url()."home/contact");	

			}

			echo $response = json_encode(array("status" => $status, "msg" => $msg));

			exit();	

    	}else{

    		$status = 0;

    		$msg = "Email and name are required ";

    		echo $response = json_encode(array("status" => $status, "msg" => $msg));

			exit();

    	}

    }



    public function career()

    {

    	

    	$this->load->view('front/header');

		$this->load->view('front/career');

		$this->load->view('front/footer');

    }

    

    public function user_agreement()

    {

    	$data = array();

		$seller_data = $this->Common_model->getSingleData('user_agreement',array('id' =>1));

		$data['seller_data'] = $seller_data;

    	$this->load->view('front/header');

		$this->load->view('front/user_agreement',$data);

		$this->load->view('front/footer');

    }

    

    public function seller_agreement()

    {

    	$data = array();

		$seller_data = $this->Common_model->getSingleData('seller_agreement',array('id' =>1));

		$data['seller_data'] = $seller_data;

    	$this->load->view('front/header');

		$this->load->view('front/seller_agreement',$data);

		$this->load->view('front/footer');

    }



    public function privacy_policy()

    {

    	

    	$this->load->view('front/header');

		$this->load->view('front/privacy_policy');

		$this->load->view('front/footer');

    }



    public function green_grocery()

    {

    	

    	$this->load->view('front/header');

		$this->load->view('front/green_grocery');

		$this->load->view('front/footer');

    }



    public function terms_condition(){

        

        $this->load->view('front/header');

        $this->load->view('front/terms_condition');

        $this->load->view('front/footer');

 	} 



    public function addToCart(){

    	//print_r($_POST);

    	$product= $this->Common_model->getSingleRecordById("product",array('product_id'=>$_POST['id']));

    	$data = array();

    	$shop_id = $product['shop_id'];

        $data['id'] = $_POST['id'];

        $data['name'] = $product['name'];

        $str = '';



        if(isset($_POST['color'])){

            $data['color'] = $_POST['color'];

            // $str = Color::where('code', $request['color'])->first()->name;

            $str = $this->Common_model->getWhereDataByCol('colors',array('code'=>$_POST['color']),'name');

        }



        // print_r($_POST);

        // print_r($product['choice_options']);

        $d = array();

        foreach(json_decode($product['choice_options']) as $key => $choice) {

        	$data[$choice->name] = $_POST[$choice->name];

            $d[][$choice->title] = $_POST[$choice->name];

            if($str != null){

                $str .= '-'.str_replace(' ', '', $_POST[$choice->name]);

            }

            else{

                $str .= str_replace(' ', '', $_POST[$choice->name]);

            }

        }

        $data['variations'] = json_encode($d);

        if($str != null){

            $variations = json_decode($product['variations']);

            // print_r($variations);

            // echo $str;

            $price = $variations->$str->price;

            if($variations->$str->qty >= $_POST['quantity']){

                // $variations->$str->qty -= $request['quantity'];

                // $product->variations = json_encode($variations);

                // $product->save();

            }

            else{

                //return view('frontend.partials.outOfStockCart');

                //echo "this product has been out of stock";

                $msg = array('status'=>0, 'msg'=>'this product has been out of stock.'); 

				echo json_encode($msg);

                exit();

            }

        }

        else{

            $price = $product['unit_price'];

        }



        if($str != null){

        	// $rsp = json_decode($product['variations'],true);

        	// $qty = $rsp[$str]['qty'];

        	// print_r($rsp);

        	// die;

           $price = json_decode($product['variations'])->$str->price;

           $mrpprice = json_decode($product['variations'])->$str->price;

           $quantity = json_decode($product['variations'])->$str->qty;

        }

        else{

            $price = $product['unit_price'];

            $mrpprice = $product['unit_price'];

        }

        $discount_amount = 0;

        if($product['discount_type'] == 1){

            $discount_amount = ($price*$product['discount'])/100;

            $price -= ($price*$product['discount'])/100;

        }

        elseif($product['discount_type'] == 2){

            $discount_amount = $product['discount'];

            $price -= $product['discount'];

        }



        $data['quantity'] = $_POST['quantity'];

        $data['main_image'] = $product['main_image'];

        $data['mrp_price'] = $mrpprice;

        $data['price'] = $price;

        $data['discount'] = $product['discount'];

        $data['discount_type'] = $product['discount_type'];

        $data['discount_amount'] = $discount_amount;

        $data['subtotal_price'] = $price * $_POST['quantity'];

        $data['shop_id'] = $product['shop_id'];

        $cdata = $this->session->userdata('cart');

        // $ccdata = array();

        // print_r($cdata);

        if(isset($cdata) && !empty($cdata)){

            // $new_array = array_merge($this->session->userdata('cart'),$data);

			$ccdata = $this->session->userdata('cart');

	        $oldshopid = $ccdata[0]['shop_id'];

	        if($shop_id == $oldshopid){

		        $ccdata[] = $data;

		        $this->session->set_userdata('cart', $ccdata);

		        //echo "Product has been added successfully";

		        $msg = array('status'=>1, 'msg'=>'Product has been added successfully.'); 

		        

    			

				echo json_encode($msg);

		        exit();

		    }else{

		    	$ccdata[] = $data;

		        $this->session->set_userdata('cart', $ccdata);

		        //echo "Product has been added successfully";

		        $msg = array('status'=>0,'msg'=>'This product is different shop.'); 

				echo json_encode($msg);

		        exit();

		    }

        }else{

			$ccdata[] = $data;

        	$this->session->set_userdata('cart', $ccdata);

        	$msg = array('status'=>1, 'msg'=>'Product has been added successfully.'); 

			echo json_encode($msg);

	        exit();

        }

        // return $this->load->view('front/partials/addToCart',$data,true);

  		// $this->load->view('front/header');

		// $this->load->view('front/contactus');

	}



    public function updateNavCart()

    {

        // return view('frontend.partials.cart');

        $this->load->view('front/partials/cart');

    }

    

    public function couoncodeapply(){

    	if(isset($_POST['couponcode']) && !empty($_POST['couponcode'])){

    		$cid = customersessionid();

    		if(isset($cid) && !empty($cid)){

	    		$couponcode = $_POST['couponcode'];

	    		$check_couponcode = $this->Common_model->getSingleRecord("coupons",array('coupon_code'=>$couponcode));

	    		if(isset($check_couponcode) && !empty($check_couponcode)){

	    			if($check_couponcode['status'] == 1){



	    				$startdate = strtotime($check_couponcode['start_date']);

						$expire = strtotime($check_couponcode['end_date']);

						$today = strtotime(date('Y-m-d'));



						if($today <= $expire && $today >= $startdate){

							$check_orders = $this->Common_model->getSingleRecord("orders",array('coupon_code'=>$couponcode,'user_id'=>$cid));

							if(isset($check_orders) && !empty($check_orders)){	

							    $msg = array('status'=>0, 'msg'=>'you have already used thease coupon code;');

								echo json_encode($msg);

						        exit();

						    }else{

						    	$this->session->set_userdata('couponcode', $check_couponcode);

					    		$msg = array('status'=>1, 'msg'=>'Coupn code has been Applied successfully.');

								echo json_encode($msg);

						        exit();

						    }

						} else {

						    $msg = array('status'=>0, 'msg'=>'Thease coupon code currently not acivated.');

							echo json_encode($msg);

					        exit();

						}

	    				$msg = array('status'=>0, 'msg'=>'Thease coupon code has been deactivated.');

						echo json_encode($msg);

				        exit();

	    			}else{

	    				$msg = array('status'=>0, 'msg'=>'Thease coupon code has been deactivated.');

						echo json_encode($msg);

				        exit();

	    			}



	    		}else{

	    			$msg = array('status'=>0, 'msg'=>'Invalid coupon code');

					echo json_encode($msg);

			        exit();

	    		}

	    	}else{

	    		$msg = array('status'=>0, 'msg'=>'your session has been expired');

				echo json_encode($msg);

		        exit();

	    	}



    		

    	}else{

    		$msg = array('status'=>0, 'msg'=>'Enter coupon code');

			echo json_encode($msg);

	        exit();

    	}

    }



    public function removecouponcode(){

    	$this->session->unset_userdata('couponcode');

		$msg = array('status'=>1, 'msg'=>'Coupon code has been remove successfully.');

		echo json_encode($msg);

        exit();

    }



    public function cart(){

    	$this->load->view('front/header');

    	$this->load->view('front/view_cart');

    	$this->load->view('front/footer');

    }



    public function removeCartProduct(){

    	$pindex = $_POST['pindex'];

		$ccdata = $this->session->userdata('cart');

    	unset($ccdata[$pindex]);

    	//print_r($ccdata);

    	$this->session->set_userdata('cart', $ccdata);

    	$msg = array('status'=>1, 'msg'=>'Product has been Removed successfully.');

		echo json_encode($msg);

        exit();

    }



    public function updateQuantity()

    {

        $cart = $this->session->userdata('cart');

        $kkey = $_POST['key'];

        $quantity = $_POST['quantity'];

        // $cart = $cart->map(function ($object, $)key use ($request){

        //     if($key == $request->key){

        //         $object['quantity'] = $request->quantity;

        //     }

        //     return $object;

        // });

        $ccdata = $cart;

        foreach($cart as $key => $value)

		{

			if($key == $kkey){

			  $ccdata[$kkey]['quantity'] = $quantity;

			  $ccdata[$kkey]['price'] = $value['price'];

			  $ccdata[$kkey]['subtotal_price'] = $value['price'] * $quantity;

			}

		}

        $this->session->set_userdata('cart', $ccdata);

        $this->load->view('front/partials/cart_details');

    }



    public function addshippinginfo(){

        // echo "hi";

        $data = array();

        $data['customerData'] = customerdata(customersessionid());

        if(isset($_POST['submitshippinginfo']) && !empty($_POST['submitshippinginfo'])){

            unset($_POST['submitshippinginfo']);

            $allzipcodes = $this->Common_model->getWhereDatanew('area',array('status'=>1),'area_zipcode');

            $allzipcodesarray = array();

            if(isset($allzipcodes) && !empty($allzipcodes)){

                foreach($allzipcodes as $allzipcodesa){

                    $allzipcodesarray[] = $allzipcodesa['area_zipcode'];

                }

            }

            if($_POST['address_id'] == "newadd"){

            	// print_r($_POST);

            	// die;

            	if (in_array($_POST['postal_code'], $allzipcodesarray))

	            {

	                $this->session->set_userdata('shippinginfo',$_POST);

	                redirect(base_url().'paymentcheckout');

	            }

	            else

	            {

	                $data['error'] = "Your pin code is not available, please use valid pin code";

	            }

            }else{

	            $oldaddress = $this->Common_model->getSingleRecord("multiple_address",array('add_id' => $_POST['address_id']));

	            if(isset($oldaddress) && !empty($oldaddress)){

		            $post_data = array();

		            $post_data['name'] = $oldaddress['name'];

		            $post_data['email'] = $oldaddress['email'];

		            $post_data['postal_code'] = $oldaddress['zipcode'];

		            $post_data['phone'] = $oldaddress['phone'];

		            $post_data['address'] = $oldaddress['address'];

		            $post_data['latitude'] = $oldaddress['latitude'];

		            $post_data['longitude'] = $oldaddress['longitude'];



		            //$people = array("Peter", "Joe", "Glenn", "Cleveland");

		            // print_r( $people);

		            // echo $_POST['postal_code'];

		            if (in_array($oldaddress['zipcode'], $allzipcodesarray))

		            {

		                $this->session->set_userdata('shippinginfo',$post_data);

		                redirect(base_url().'paymentcheckout');

		            }

		            else

		            {

		                $data['error'] = "Your pin code is not available, please use valid pin code";

		            }

		        }

	        }

        }

           

        $this->load->view('front/header');

        $this->load->view('front/addshippinginfo',$data);

        $this->load->view('front/footer');

    }



    public function paymentcheckout(){

        $data = array();

        $userid = customersessionid();

        if(isset($_POST['submitCheckout']) && !empty($_POST['submitCheckout'])){

            $payment_type = $_POST['payment_option'];

            $shippinginfo = $this->session->userdata('shippinginfo');

            $cart_data = $this->session->userdata('cart');

            $couponcoded = $this->session->userdata('couponcode');

            // print_r($cart_data);

            $subtotal_price = array();

            foreach($cart_data as $cart_data_array){

            	$subtotal_price[] = $cart_data_array['subtotal_price'];

                $shop_id = $cart_data_array['shop_id'];

            }

            $total_price = array_sum($subtotal_price);

            $insert_orderData = array();

            if(isset($couponcoded) && !empty($couponcoded)){

                $offter_amount = $couponcoded['offer_amount'];

                

                $offteramount_type = $couponcoded['offer_amount_type'];

                if($offteramount_type == 1){

                    $offter_amount = $total_price * $couponcoded['offer_amount']/100;

                }

                $total_price = $total_price - $offter_amount;

                $insert_orderData['coupon_code'] = $couponcoded['coupon_code'];

                $insert_orderData['	coupon_discount'] = $offter_amount;

            }

            if(isset($cart_data) && !empty($cart_data)){

	            if($payment_type == "cash"){

                    

	                $insert_orderData['user_id'] = $userid;

	                $insert_orderData['seller_id'] = $shop_id;

	                $insert_orderData['shipping_address'] = json_encode($shippinginfo,true);

	                $insert_orderData['payment_type'] = $payment_type;

	                $insert_orderData['delivery_status'] = 1;

	                $insert_orderData['grand_total'] = $total_price;

	                $insert_orderData['create_date'] = date('Y-m-d H:i:s');

	                $insert_orderData['prduct_details'] = json_encode($cart_data,true);

                    // foreach (Session::get('cart') as $key => $cartItem){

                    // $product_variation = null;

                    // if(isset($cartItem['color'])){

                    //     $product_variation .= Color::where('code', $cartItem['color'])->first()->name;

                    // }

                    // foreach (json_decode($product->choice_options) as $choice){

                    //     $str = $choice->name; // example $str =  choice_0

                    //     if ($product_variation != null) {

                    //         $product_variation .= '-'.str_replace(' ', '', $cartItem[$str]);

                    //     }

                    //     else {

                    //         $product_variation .= str_replace(' ', '', $cartItem[$str]);

                    //     }

                    // }

	                $rid = $this->Common_model->addRecords('orders',$insert_orderData);

	                if($rid){

	                	$u_data = array();

	                	$u_data['invoice_no'] = "INC".date('Y')."I".$rid;

	                	$update = $this->Common_model->updateRecords('orders', $u_data,array('id'=> $rid));

	                	$this->session->unset_userdata('shippinginfo');

	                	$this->session->unset_userdata('cart');

	                	$this->session->unset_userdata('couponcode');

	                	$data['success'] = "Order has been created successfully";

	                	redirect(base_url());

	                }else{

	                	$data['error'] = "Oops something went wrong please try again.";

	                }

	            }

	        }else{

	        	redirect(base_url().'shops');

	        }

        }

        $this->load->view('front/header');

        $this->load->view('front/paymentcheckout',$data);

        $this->load->view('front/footer');

    }



 



    public function changebasicinfo()

    {

        // print_r($_POST);

        // print_r($_FILES);

        if(isset($_POST['first_name']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['mobile_no']) )

        {

            $check_data = $this->Common_model->getWhereData("users",array('id' => customersessionid()));

            // print_r($check_data);

            // die;

            $current_mobile_no = $_POST["mobile_no"];

            $current_email = $_POST["email"];

            $check_email = $this->Common_model->getWhereData("users",array('id !=' => customersessionid(),'email'=>$current_email));

            $check_mobile_no = $this->Common_model->getWhereData("users",array('id !=' => customersessionid(),'mobile_no'=>$current_mobile_no));

            if(empty($check_email) && empty($check_mobile_no)){



                $insert_data = array();

                $insert_data['first_name'] = $_POST["first_name"];

                $insert_data['last_name'] = $_POST["last_name"];

                $insert_data['mobile_no'] = $_POST["mobile_no"];

                $insert_data['email'] = $_POST["email"];

                if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){

                    $uploadpath = "./uploads/customerprofilepic/";

                    $filearrayddata = $this->uploadfilebypath('image',$uploadpath);

                    if(isset($filearrayddata)){

                        $insert_data['image'] = $filearrayddata;

                    }

                }

                

                    

                $result = $this->Common_model->updateData('users',$insert_data,array('id' => customersessionid()));

                // redirect(base_url().'profile');

                echo "Profile has been updated successfully";

            }elseif(!empty($check_email) && !empty($check_mobile_no)){

                echo "Email and Mobile number already exits please try again";

            }

            elseif(!empty($check_email)){

                echo "Email already exits please try again";

            }

            elseif(!empty($check_mobile_no)){

                echo "Mobile No. already exits please try again";

            }

                        

        }else{

            echo "All fields are required";

        }      

    }



    public function changepwdinfo(){

     	// print_r($_POST);

	    if(isset($_POST['new_password']) && !empty($_POST['new_password']) && !empty($_POST['re_enter_password']) && !empty($_POST['current_password'])){

	          // $data = array();

	        $check_admin_password = $this->Common_model->getSingleRecord("users",array('id' => customersessionid()));
	        $admin_current_password = $check_admin_password['password'];
	        // print_r($data); 

	        $current_password = md5(trim($_POST['current_password']));

	        $new_password = md5(trim($_POST['new_password']));

	        $re_enter_password = md5(trim($_POST['re_enter_password']));    

	        $today_date = date('Y-m-d h:i:s A',time());

	        if($admin_current_password!=$current_password)

	          {

	            echo "Invalid Current Password...!";

	          }

	        else{

	            if($new_password!=$re_enter_password)

	            {

	               echo "New password not matched...!";

	            }

	            else

	            {

	                $result = $this->Common_model->updateRecords('users',array('password'=>$re_enter_password,'show_password'=>$_POST['re_enter_password']),array('id'=> customersessionid()));

	                echo  "Password updated successfully!";



	            }

	          }

	     }else{

	        echo "All fields are required";

	     }

	    // $result = $this->Common_model->getSingleRecord("users",array('id'=> customersessionid())); 

	    // print_r($data);    
	} 



    public function changeshippinginfo(){

        // print_r($_POST);

        // print_r($_FILES);

        $data =  array();

        if(isset($_POST['address']) && !empty($_POST['address']) && !empty($_POST['zipcode']))

        {

            $insert_data = array();

            $insert_data['address'] = $_POST["address"];

            $insert_data['zipcode'] = $_POST["zipcode"];

            $insert_data['latitude'] = $_POST["latitude"];

            $insert_data['longitude'] = $_POST["longitude"];

            $result = $this->Common_model->updateData('users',$insert_data,array('id' => customersessionid()));

            if(['success']){

                echo "Successfully Updated";

            }

        }else{

        echo "All fields are required";

        }
	}  

	public function uploadfilebypath($key,$path){

        $message = array();

        $data = array();

        if($_FILES[$key]['size'] > 0)

        {

            $config = array(

                'upload_path' => $path,

                'allowed_types' => "gif|jpg|png|jpeg|pdf",

                /*'overwrite' => TRUE*/

                'max_size' => 60000,

                'max_height' => "",

                'max_width' => ""

            );

            $config['remove_spaces'] = true;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);



            if($this->upload->do_upload($key))

            {

                $uploadData = $this->upload->data();

                $image_name = $uploadData['file_name'];

                return $image_name;

            }else{

                echo $this->upload->display_errors();

            }

        }

        else

        {

            return 'Your uploaded image file is blank.';

        }
	}

	public function invoice(){

        $data = array();

        $user_id = customersessionid();

        

        if(isset($_GET['invoice']) && !empty($_GET['invoice'])){

            $id = base64_decode($_GET['invoice']);

            $whr = array();

            $whr[] = "user_id =".$user_id;

            $whr[] = "id =".$id;

            $where = " WHERE ".implode(" AND ", $whr);

            $data['orderdata'] = $this->Common_model->getwheresingleorder($where);

            $this->load->view('front/header');

            $this->load->view('front/invoice', $data);

            $this->load->view('front/footer');

        }
	}



	public function invoiceprint(){

	    $data = array();

	    $user_id = customersessionid();

	    

	    if(isset($_GET['invoice']) && !empty($_GET['invoice'])){

	        $id = base64_decode($_GET['invoice']);

	        $whr = array();

	        $whr[] = "user_id =".$user_id;

	        $whr[] = "id =".$id;

	        $where = " WHERE ".implode(" AND ", $whr);

	        $data['orderdata'] = $this->Common_model->getwheresingleorder($where);

	        

	        $this->load->view('front/invoiceprint', $data);

	    }

	}



    public function support_ticket(){

        $user_id = customersessionid();

        if(isset($_POST['query']) && !empty($_POST['query']) )

        {

            $insert_data = array();

            $insert_data['query'] = $_POST["query"];

            $insert_data['user_type'] = 'customer';

            $insert_data['create_date'] = date('Y-m-d H:i:s');

            $insert_data['user_id'] = $user_id;

            // print_r($insert_data);

            // die;

            $result = $this->Common_model->addRecords('support_ticket',$insert_data);

            if(isset($result)){

                

                $newid = ticketid_prefix.date("Y").$result;

                if(isset($newid)){

                    $updata = array();

                    $updata['ticket_reg_id'] = $newid;

                }

               

            }

            $this->Common_model->updateData('support_ticket',$updata,array('ticket_id' => $result));

            echo "Successfully Updated";

            exit();        

            

        }else{

            // echo "All fields are required";

        }

        $data = array();

        $data['support'] = $this->Common_model->getWhereData('support_ticket',array('user_type'=>'customer'));

        // print_r($data['support']);

        // die;

        $this->load->view('front/header');

        $this->load->view('front/support_ticket',$data);

        $this->load->view('front/footer');   

    }



    public function support_chat(){

        $data = array();

        $user_id = customersessionid();

        $id = base64_decode($_GET['ticket_id']);



        $data['supportchat'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));

        $data['support'] = $this->Common_model->getSingleRecord('support_ticket',array('ticket_id'=>$id));

        // $js = $this->Common_model->getSingleRecordById($table,array($column_name => $jay));

        // $check_admin_password = $this->Common_model->getSingleRecord("users",array('id' => customersessionid()));

        // print_r($support);

        // die;    

        $this->load->view('front/header');

        $this->load->view('front/support_chat',$data);

        $this->load->view('front/footer');

        // }

    } 



    public function submitmessage(){

        if(isset($_REQUEST['message']) && !empty($_REQUEST['message']) && !empty($_REQUEST['ticket_id']))

        {

      

            $user_id = customersessionid();

            $id = base64_decode($_REQUEST['ticket_id']);

            $insert_data = array();

            $insert_data["ticket_id"] = $id;

            $insert_data["from_id"] = $user_id;

            $insert_data["to_id"] = 1;

            $insert_data["user_type"] = 'customer';

            $insert_data["message"] = $_POST["message"];

            $insert_data['create_date'] = date('Y-m-d H:i:s');



            $result = $this->Common_model->addRecords('support_message',$insert_data);

            exit();

        }

    }



    public function support_chat_message(){

    	$id = base64_decode($_POST['ticket_id']);

    	$data = array();

    	$data['support'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));

        // print_r($data['support']);

    	$this->load->view('front/partials/support_chat_message',$data);

    	// exit();

    }



    // public function chat(){

    //     $user_id = customersessionid();

    //     $data = array();

    //     $insert_data["message"] = $_POST["message"];

    //     $insert_data['create_date'] = date('Y-m-d H:i:s');

        

    //     $result = $this->Common_model->addRecords('support_message',$insert_data);

    //     if(isset($result)){

    //         $newid = $result;

    //         if(isset($newid)){

    //             $updata = array();

    //             $updata['ticket_id'] = $newid;

    //         }   

    //     }

    //     $result = $this->Common_model->updateData('support_message',$updata,array('ticket_id' => $result));

    //     echo "Successfully Updated";

    // }



    public function deleterecord()   

    {

        $id = $_POST['id'];

        $colwhr = $_POST['colwhr'];

        $table = $_POST['table'];

      	$this->Common_model->deleteRecords($table,array($colwhr=>$id));

      	$msg = array('status'=>1, 'msg'=>'Deleted successfully!');

		echo json_encode($msg);

		exit();

     	// redirect(base_url().'admin/Service_list', 'refresh');

    }



	public function logout(){

    	$this->session->unset_userdata(USER_SESSION);

    	$this->session->unset_userdata('cart');

    	$this->session->unset_userdata('couponcode');

		redirect(base_url('home'),'refresh');

    }

}