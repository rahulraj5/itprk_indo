<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('shop_helper');
		$this->SessionModel->checkshoplogin(array("login","loginajax","registerajax","loginbyotpsubmit","verifyloginOtp","createCode","sendsmsdemo","login_otp_send"));
	}

	public function index()
	{
		$data = array();
		$whr = " WHERE status = 1 and delivery_status=4 and seller_id = ".shopsessionShopid()."";
		$data['ordersByMonth'] = $this->Common_model->getOrdersByMonth($whr);
		// print_r($data['ordersByMonth']);
		// die;
		// $data['ordersByMonth'] = array('years' => array_unique(array('2019','2020')),'orders' => array('2019'=>array('1'=>9,'2'=>9,'3'=>9,'4'=>9,'5'=>9,'6'=>9,'7'=>9,'8'=>9,'9'=>9,'10'=>9,'11'=>9,'12'=>1),'2020'=>array('1'=>9,'2'=>9,'3'=>9,'4'=>9,'5'=>9,'6'=>9,'7'=>9,'8'=>9,'9'=>9,'10'=>9,'11'=>9,'12'=>1)));
		$this->load->view('shop/header');
		$this->load->view('shop/dashboard',$data);
		$this->load->view('shop/footer');
	}

	public function sendsmsdemo($user_number){

        // $message = "your Txn OTP Demo ";

	    // $response = sendsms($user_number,"91",$message);

	 //    $welcomemsg = "Great,
	 //    				Welcome to IndoCliq. Congratulations on taking the first step to grow your business. You will have a great and unique selling experience here. Stay connected We will contact you soon .
	 //    				Thank you";
		// $resp = sendsms($user_number,"91",$welcomemsg);

		$resp = $this->login_otp_send($user_number,"91");
		var_dump($resp);

	    // var_dump($response);

    }

	public function login(){
		$edata = array();
		$this->load->view('shop/login_header');
		$this->load->view('shop/login');
		$this->load->view('shop/login_footer');
	}

	public function loginajax()
	{
		$mobile_no = base64_encode(trim($_POST['mobile_no']));
		$password = md5(trim($_POST['password']));
		if(isset($mobile_no) && !empty($mobile_no) && isset($password) && !empty($password))
		{
		    		$userdata = $this->Common_model->getSingleRecordById('shops',array('mobile_no' => $mobile_no,'password'=>$password));
		    		//print_r($userdata);
		    		if($userdata){
		    			if($userdata['status']==1){                            
		    	           
		    	           	$this->session->set_userdata(SHOP_SESSION, $userdata);
		    				echo json_encode(array('status'=>1,'msg'=>"successfully login"));
		    				exit();
		    			}
		    			if($userdata['status']== 0){
		    				echo json_encode(array('status'=>0,'msg'=>"Your account has been deactivated"));
		    				exit();
		    			}
		    			if($userdata['status']== 3){
		    				echo json_encode(array('status'=>0,'msg'=>"Your account has been deleted by admin"));
		    				exit();
		    			}
		    		}else{
		    			echo json_encode(array('status'=>0,'msg'=>" Invalid mobile number or password Please try again"));
		    		}
		}else
		{
		    echo json_encode(array('status'=>0,'msg'=>"Mobile number and password are required"));
		    	exit();
		}   
	}
	
	public  function registerajax(){
		print_r($_POST);
		if(isset($_POST) && !empty($_POST)){
			$post_data = array();
			$post_data['owner_name'] = $_POST['first_name'];
			$post_data['shop_registration_no'] = $_POST['shop_registration_no'];
			$mobile_no = base64_encode($_POST['mobile_no']);
			$password = $_POST['password'];
			$checkmobileno = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mobile_no));
			if(empty($checkmobileno)){
				$post_data['mobile_no'] = $mobile_no;
				$post_data['password'] = md5($password);
				// $respotp = $this->registration_otp_send($mobile_no,91);
				$post_data['shop_reg_id'] = $this->createCode('shops','shop_reg_id',8);

				$result_id = $this->Common_model->addrecords('shops',$post_data);
				if($result_id){
		    		
					$userdata = $this->Common_model->GetWhere('shops', array('shop_id'=>$result_id));
				    $this->session->set_userdata(SHOP_SESSION,$userdata[0]);

				    // redirect(base_url().'shop');
					// $userregid = userprefix.$result;
					// $this->Common_model->updateRecords('users',array('reg_id'=>$userregid),array('id'=> $result));


    	           	// $this->session->set_userdata(SHOP_SESSION, $result_id);
    				echo json_encode(array('status'=>1,'msg'=>"successfully Registration"));
    				exit();	
		    	}
 			}else if(!empty($checkmobileno)){
 				$msg = array('status'=>0, 'msg'=>'Mobile No. already exits please try again.');
				echo json_encode($msg);
				exit();
			}else{

			}
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
			$check_number = $this->Common_model->getwhere('shops',array('mobile_no'=> base64_encode($mobile_no)));
			if(!empty($check_number)){
                $user_number = $mobile_no;
                $user_country_isd_code = $country_isd_code;
                $user_number_isd_code =  $user_country_isd_code.$user_number;
                if(!empty($user_number_isd_code)){
	                $message = "Your indocliq login otp is ".$otp;
	                $response = sendotp($user_number,$user_country_isd_code,$otp);
	                // return json_encode($response);
					if($response){
						$msg = array('status'=>1, 'msg'=>'Your OTP has been sent successfully, please check your Number for getting OTP...@'); 
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
		$mn = base64_encode($_POST['moibleno']);
		$checkmobileno = $this->Common_model->GetWhere('shops', array('mobile_no'=>$mn));
		// print_r($checkmobileno);
		// die;
		$mobile_no = $_POST['moibleno'];
		if(!empty($checkmobileno)){
			$post_data = array();
			$post_data['mobile_no'] = $mobile_no;
			$respotp = $this->login_otp_send($mobile_no,"91");
			$resotparray = json_decode($respotp,true);
			// print_r($respotp);
			if(isset($resotparray) && $resotparray['status'] == 1){
				$set_data_id = $this->session->set_tempdata(array('login_otp_data'=>$post_data),"",240);
       	     	$registraiton_data = $this->session->tempdata('login_otp_data');
       	     	$data['login_otp_data'] = $registraiton_data;
       	     	$data['success'] = "Enter otp and verify mobile number for set password.";
       	     	$msg = array('status'=>1, 'msg'=>'Your OTP has been sent successfully, please check your Number for getting OTP...@'); 
				echo json_encode($msg);
				exit();
			}else{
       	    	$msg = array('status'=>0, 'msg'=>'Invalid Mobile No.'); 
				echo json_encode($msg);
				exit();
       	    }
		}else{
				$msg = array('status'=>0, 'msg'=>'Invalid mobile number. please try again.');
			echo json_encode($msg);
			exit();
		}
	}

	public function verifyloginOtp(){
		if(isset($_POST) && !empty($_POST)){
			$forgot_otp_data = $this->session->tempdata('login_otp_data');
			if(isset($forgot_otp_data) && !empty($forgot_otp_data)){
				if(isset($_POST['otp']) && !empty($_POST['otp'])){
					$mobile_no = $forgot_otp_data['mobile_no'];
					$checkmobilenootp = $this->Common_model->GetWhere('login_otp', array('mobile_no'=>$mobile_no,'otp'=>$_POST['otp']));
					if(isset($checkmobilenootp) && !empty($checkmobilenootp)){
						$checkuser = $this->Common_model->GetWhere('shops', array('mobile_no'=>base64_encode($mobile_no)));
				// 		print_r($checkuser);
						if(isset($checkuser) && !empty($checkuser)){
							$checkuserrow = $checkuser[0];
							if($checkuserrow['status'] == 1){
								$this->session->set_userdata(SHOP_SESSION, $checkuserrow);
								$msg = array('status'=>1, 'msg'=>'Success ! Welcome to eshop.');
								// redirect(base_url());
								echo json_encode($msg);
								exit();	
							}else{
								$msg = array('status'=>0, 'msg'=>'Your account has been deactivated ,please contact with admin');
								echo json_encode($msg);
								exit();	
							}
						}else{
							$msg = array('status'=>0, 'msg'=>'Oops something went wrong please try again.');
							echo json_encode($msg);
							exit();
						}
					}else{
						$msg = array('status'=>0, 'msg'=>'Invalid otp please enter valid otp.');
						echo json_encode($msg);
						exit();
					}

				}else{
					$msg = array('status'=>0, 'msg'=>'Please enter otp');
					echo json_encode($msg);
					exit();
				}
			}else{
				$msg = array('status'=>0, 'msg'=>'Your session has been expired please resubmit your registration detail.');
				echo json_encode($msg);
				exit();
			}
		}
	}

	// public function profile(){
	// 	$data = array();
	// 	$data['success'] = "";
	// 	$data['error'] = "";
	// 	$shop_id = shopsessionShopid();
	// 	if(isset($shop_id) && !empty($shop_id)){

	// 		if(isset($_POST['update']))
	// 		{
	// 			// print_r($_POST);
	// 			$user_data = $_POST;
	// 			unset($user_data['update']);
	// 			// unset($user_data['password']);
	// 			// $user_data['password'] = md5($password);
	// 			// $user_data['show_password'] = $password;
	// 			$email = $user_data['email'];
	// 			// $mobile_no = base64_encode($user_data['mobile_no']);
	// 			$filearray = array();
	// 			if (isset($_FILES)){
	// 			    //echo '<pre>';print_r($_FILES);die();
	// 			    if(isset($_FILES['owner_image']['name']) && !empty($_FILES['owner_image']['name'])){
	// 	        		$uploadpath = "./uploads/shop_images/shop_owner_images/";
	// 	        		$filearraydata = $this->uploadfilebypath('owner_image',$uploadpath);
	// 	            	if(isset($filearraydata)){
	// 						$user_data['owner_image'] = $filearraydata;
	// 					}
	// 	        	}
	// 	        	if(isset($_FILES['shop_logo']['name']) && !empty($_FILES['owner_image']['name'])){
	// 	        		$uploadpath = "./uploads/shop_images/shop_logos/";
	// 	        		$filearraydatalogo = $this->uploadfilebypath('shop_logo',$uploadpath);
	// 	            	if(isset($filearraydatalogo)){
	// 						$user_data['shop_logo'] = $filearraydatalogo;
	// 					}
	// 	        	}
	// 	        	if(isset($_FILES['shop_image_mobile']['name']) && !empty($_FILES['shop_image_mobile']['name'])){
	// 	        		$uploadpath = "./uploads/shop_images/shop_image_mobile/";
	// 	        		$filearraydatamobile = $this->uploadfilebypath('shop_image_mobile',$uploadpath);
	// 	            	if(isset($filearraydatamobile)){
	// 						$user_data['shop_image_mobile'] = $filearraydatamobile;
	// 					}
	// 	        	}
	// 	        	if(isset($_FILES['shop_image_desktop']['name']) && !empty($_FILES['shop_image_desktop']['name'])){
	// 	        		$uploadpath = "./uploads/shop_images/shop_image_desktop/";
	// 	        		$filearraydatadsk = $this->uploadfilebypath('shop_image_desktop',$uploadpath);
	// 	            	if(isset($filearraydatadsk)){
	// 						$user_data['shop_image_desktop'] = $filearraydatadsk;
	// 					}
	// 	        	}
	// 			}
	// 			if(isset($filearray['shop_logo'])) {
	// 				$user_data['shop_logo'] = $filearray['shop_logo'];
	// 			}
	// 			$result_id = $this->Common_model->updateRecords('shops',$user_data,array('shop_id'=>$shop_id));
	// 			if($result_id){
	// 				$data['success'] = "Shop has been updated sucessfully";
	// 				// redirect(base_url().'shop/profile/');
	// 			}else{
	// 				$data['error'] = "Something went wrong please try again";
	// 			}
	// 			$data['shop_data'] = $user_data;
	// 		}
	// 		$this->load->view('shop/header');
	// 		$this->load->view('shop/shopprofile',$data);
	// 		$this->load->view('shop/footer');	
	// 	}
	// }

	public function profile()
	{
		$data = array();
		$data['error_email'] = "";
		$data['success'] = "";
		$data['error'] = "";
		$data['shop_data'] = "";
		$shop_data = "";
		$shop_id = shopsessionShopid();
		if(isset($_POST['submit']))
		{
			
			// print_r($_POST);
			$user_data = $_POST;
			$password = $user_data['password'];
			unset($user_data['submit']);
			unset($user_data['password']);
			$user_data['password'] = md5($password);
			// $user_data['show_password'] = $password;
			$email = $user_data['email'];
			$mobile_no = base64_encode($user_data['mobile_no']);
			$user_data['mobile_no'] = $mobile_no;
			$user_data['gst_number'] = base64_encode($user_data['gst_number']);
			$user_data['pan_no'] = base64_encode($user_data['pan_no']);
			$user_data['adhar_no'] = base64_encode($user_data['adhar_no']);
			if(isset($_POST['shop_registration_no']) && !empty($_POST['shop_registration_no'])){
				$user_data['shop_registration_no'] = $user_data['shop_registration_no'];
			}
			if(isset($_POST['shop_type_id']) && !empty($_POST['shop_type_id'])){
				$user_data['shop_type_id'] = $user_data['shop_type_id'];
			}
			// print_r($_POST['shopping_categories']);
			if(isset($_POST['shopping_categories']) && !empty($_POST['shopping_categories'])){
				$user_data['shopping_categories'] = implode(",", $_POST['shopping_categories']);
			}
			if(isset($_POST['shopping_specialized']) && !empty($_POST['shopping_specialized'])){
				$user_data['shopping_specialized'] = implode(",", $_POST['shopping_specialized']);
			}
			$check_mobile_no = $this->Common_model->GetWhere('shops',array('mobile_no'=> $mobile_no));
			if(empty($check_mobile_no))
			{	
				$filearray = array();
				if (isset($_FILES)) {
				    //echo '<pre>';print_r($_FILES);die();
				    if(isset($_FILES['owner_image']['name']) && !empty($_FILES['owner_image']['name'])){
		        		$uploadpath = "./uploads/shop_images/shop_owner_images/";
		        		$filearraydata = $this->uploadfilebypath('owner_image',$uploadpath);
		            	if(isset($filearraydata)){
							$user_data['owner_image'] = $filearraydata;
						}
		        	}
		        	if(isset($_FILES['shop_logo']['name']) && !empty($_FILES['shop_logo']['name'])){
		        		$uploadpath = "./uploads/shop_images/shop_logos/";
		        		$filearraydatalogo = $this->uploadfilebypath('shop_logo',$uploadpath);
		            	if(isset($filearraydatalogo)){
							$user_data['shop_logo'] = $filearraydatalogo;
						}
		        	}
		        	if(isset($_FILES['shop_image_mobile']['name']) && !empty($_FILES['shop_image_mobile']['name'])){
		        		$uploadpath = "./uploads/shop_images/shop_image_mobile/";
		        		$filearraydatamobile = $this->uploadfilebypath('shop_image_mobile',$uploadpath);
		            	if(isset($filearraydatamobile)){
							$user_data['shop_image_mobile'] = $filearraydatamobile;
						}
		        	}
		        	if(isset($_FILES['shop_image_desktop']['name']) && !empty($_FILES['shop_image_desktop']['name'])){
		        		$uploadpath = "./uploads/shop_images/shop_image_desktop/";
		        		$filearraydatadsk = $this->uploadfilebypath('shop_image_desktop',$uploadpath);
		            	if(isset($filearraydatadsk)){
							$user_data['shop_image_desktop'] = $filearraydatadsk;
						}
		        	}
		        	if(isset($_FILES['adhar_image']['name']) && !empty($_FILES['adhar_image']['name'])){
		        		$uploadpath = "./uploads/shop_images/adhar_image/";
		        		$filearrayadharimage = $this->uploadfilebypath('adhar_image',$uploadpath);
		            	if(isset($filearrayadharimage)){
							$user_data['adhar_image'] = $filearrayadharimage;
						}
		        	}
		        	if(isset($_FILES['pan_image']['name']) && !empty($_FILES['pan_image']['name'])){
		        		$uploadpath = "./uploads/shop_images/pan_image/";
		        		$filearraypanimage = $this->uploadfilebypath('pan_image',$uploadpath);
		            	if(isset($filearrayadharimage)){
							$user_data['pan_image'] = $filearraypanimage;
						}
		        	}
		        	if(isset($_FILES['gumasta_image']['name']) && !empty($_FILES['gumasta_image']['name'])){
		        		$uploadpathgumasta = "./uploads/shop_images/gumasta_images/";
		        		$filearraydatagumasta = $this->uploadfilebypath('gumasta_image',$uploadpathgumasta);
		            	if(isset($filearraydatagumasta)){
							$user_data['gumasta_image'] = $filearraydatagumasta;
						}
		        	}

		        	if(isset($_FILES['cancel_check_image']['name']) && !empty($_FILES['cancel_check_image']['name'])){
		        		$uploadpathcancelcheck = "./uploads/shop_images/cancel_check_images/";
		        		$filearraydatacancelcheck = $this->uploadfilebypath('cancel_check_image',$uploadpathcancelcheck);
		            	if(isset($filearraydatacancelcheck)){
							$user_data['cancel_check_image'] = $filearraydatacancelcheck;
						}
		        	}
		        	if(isset($_FILES['gst_image']['name']) && !empty($_FILES['gst_image']['name'])){
		        		$uploadpath = "./uploads/shop_images/gst_image/";
		        		$filearraygstimage = $this->uploadfilebypath('gst_image',$uploadpath);
		            	if(isset($filearraygstimage)){
							$user_data['gst_image'] = $filearraygstimage;
						}
		        	}

		        }

				if(isset($filearray['shop_logo'])) {
					$user_data['shop_logo'] = $filearray['shop_logo'];
				}
				if(isset($_POST['meta_tags'])) {
					$user_data['meta_tags'] = $_POST['meta_tags'];
				}


				$user_data['shop_reg_id'] = $this->createCode('shops','shop_reg_id');
				$user_data['create_date'] = date('Y-m-d H:i:s');
				$result_id = $this->Common_model->addrecords('shops',$user_data);
				if($result_id){
					// $data['success'] = "Shop has been added sucessfully";
					$this->session->set_flashdata('addshop_success', 'Shop has been added sucessfully');
					redirect(base_url().'admin/shoplist/');
				}else{
					$data['error'] = "Something went wrong please try again";
				}
			}elseif(!empty($check_mobile_no)){
				$data['error_email'] = "Mobile Number alredy exits";	
			}else{
				$data['error'] = "Something went wrong please try again";
			}
			$shop_data = $_POST;
		}
		if(isset($_POST['update']))
		{
			// print_r($_POST);
			// $user_data = $_POST;
			// unset($user_data['update']);
			// unset($user_data['password']);
			// $user_data['password'] = md5($password);
			// $user_data['show_password'] = $password;
			$user_data = array();
			$user_data['owner_name'] = $_POST['owner_name'];
			$user_data['shop_name'] = $_POST['shop_name'];
			$user_data['email'] = $_POST['email'];
			$user_data['shop_address'] = trim($_POST['shop_address']);
			$user_data['shop_latitude'] = trim($_POST['shop_latitude']);
			$user_data['shop_longitude'] = trim($_POST['shop_longitude']);
			$user_data['account_holder_name'] = (isset($_POST['account_holder_name']) ? $_POST['account_holder_name'] : '');
			$user_data['bank_name'] = (isset($_POST['bank_name']) ? $_POST['bank_name'] : '');
			$user_data['bank_acc_no'] = (isset($_POST['bank_acc_no']) ? $_POST['bank_acc_no'] : '');
			$user_data['bank_ifsc_code'] = (isset($_POST['bank_ifsc_code']) ? $_POST['bank_ifsc_code'] : '');
			$user_data['bank_branch'] = (isset($_POST['bank_branch']) ? $_POST['bank_branch'] : '');
			$email = $user_data['email'];
			
			if(isset($_POST['shop_registration_no']) && !empty($_POST['shop_registration_no'])){
				$user_data['shop_registration_no'] = $_POST['shop_registration_no'];
			}
			if(isset($_POST['shop_type_id']) && !empty($_POST['shop_type_id'])){
				$user_data['shop_type_id'] = $_POST['shop_type_id'];
			}
			if(isset($_POST['adhar_no']) && !empty($_POST['adhar_no'])){
				$user_data['adhar_no'] = base64_encode($_POST['adhar_no']);
			}
			if(isset($_POST['pan_no']) && !empty($_POST['pan_no'])){
				$user_data['pan_no'] = base64_encode($_POST['pan_no']);
			}
			if(isset($_POST['gst_no']) && !empty($_POST['gst_no'])){
				$user_data['gst_no'] = base64_encode($_POST['gst_no']);
			}
			if(isset($_POST['mobile_no']) && !empty($_POST['mobile_no'])){
				$mobile_no = base64_encode($_POST['mobile_no']);
				$user_data['mobile_no'] = $mobile_no;
			}
			if(isset($_POST['shopping_categories']) && !empty($_POST['shopping_categories'])){
				$user_data['shopping_categories'] = implode(",", $_POST['shopping_categories']);
			}
			if(isset($_POST['shopping_specialized']) && !empty($_POST['shopping_specialized'])){
				$user_data['shopping_specialized'] = implode(",", $_POST['shopping_specialized']);
			}
			if(isset($_POST['meta_tags'])) {
				$user_data['meta_tags'] = $_POST['meta_tags'];
			}	
			$filearray = array();
			if (isset($_FILES)){
			    //echo '<pre>';print_r($_FILES);die();
			    if(isset($_FILES['owner_image']['name']) && !empty($_FILES['owner_image']['name'])){
	        		$uploadpath = "./uploads/shop_images/shop_owner_images/";
	        		$filearraydata = $this->uploadfilebypath('owner_image',$uploadpath);
	            	if(isset($filearraydata)){
						$user_data['owner_image'] = $filearraydata;
					}
	        	}
	        	if(isset($_FILES['shop_logo']['name']) && !empty($_FILES['owner_image']['name'])){
	        		$uploadpath = "./uploads/shop_images/shop_logos/";
	        		$filearraydatalogo = $this->uploadfilebypath('shop_logo',$uploadpath);
	            	if(isset($filearraydatalogo)){
						$user_data['shop_logo'] = $filearraydatalogo;
					}
	        	}
	        	if(isset($_FILES['shop_image_mobile']['name']) && !empty($_FILES['shop_image_mobile']['name'])){
	        		$uploadpath = "./uploads/shop_images/shop_image_mobile/";
	        		$filearraydatamobile = $this->uploadfilebypath('shop_image_mobile',$uploadpath);
	            	if(isset($filearraydatamobile)){
						$user_data['shop_image_mobile'] = $filearraydatamobile;
					}
	        	}
	        	if(isset($_FILES['shop_image_desktop']['name']) && !empty($_FILES['shop_image_desktop']['name'])){
	        		$uploadpath = "./uploads/shop_images/shop_image_desktop/";
	        		$filearraydatadsk = $this->uploadfilebypath('shop_image_desktop',$uploadpath);
	            	if(isset($filearraydatadsk)){
						$user_data['shop_image_desktop'] = $filearraydatadsk;
					}
	        	}
	        	if(isset($_FILES['adhar_image']['name']) && !empty($_FILES['adhar_image']['name'])){
	        		$uploadpath = "./uploads/shop_images/adhar_image/";
	        		$filearrayadharimage = $this->uploadfilebypath('adhar_image',$uploadpath);
	            	if(isset($filearrayadharimage)){
						$user_data['adhar_image'] = $filearrayadharimage;
					}
	        	}
	        	if(isset($_FILES['pan_image']['name']) && !empty($_FILES['pan_image']['name'])){
	        		$uploadpath = "./uploads/shop_images/pan_image/";
	        		$filearraypanimage = $this->uploadfilebypath('pan_image',$uploadpath);
	            	if(isset($filearrayadharimage)){
						$user_data['pan_image'] = $filearraypanimage;
					}
	        	}
	        	if(isset($_FILES['gumasta_image']['name']) && !empty($_FILES['gumasta_image']['name'])){
		        		$uploadpathgumasta = "./uploads/shop_images/gumasta_images/";
	        		$filearraydatagumasta = $this->uploadfilebypath('gumasta_image',$uploadpathgumasta);
	            	if(isset($filearraydatagumasta)){
	            		
						$user_data['gumasta_image'] = $filearraydatagumasta;
					}
	        	}
	        	if(isset($_FILES['cancel_check_image']['name']) && !empty($_FILES['cancel_check_image']['name'])){
		        		$uploadpathcancelcheck = "./uploads/shop_images/cancel_check_images/";
	        		$filearraydatacancelcheck = $this->uploadfilebypath('cancel_check_image',$uploadpathcancelcheck);
	            	if(isset($filearraydatacancelcheck)){
						$user_data['cancel_check_image'] = $filearraydatacancelcheck;
					}
				}
				if(isset($_FILES['gst_image']['name']) && !empty($_FILES['gst_image']['name'])){
					$uploadpath = "./uploads/shop_images/gst_image/";
					$filearraygstimage = $this->uploadfilebypath('gst_image',$uploadpath);
					if(isset($filearraygstimage)){
						$user_data['gst_image'] = $filearraygstimage;
					}
				}
			}

			if(isset($filearray['shop_logo'])) {
				$user_data['shop_logo'] = $filearray['shop_logo'];
			}
			$result_id = $this->Common_model->updateRecords('shops',$user_data,array('shop_id'=>$shop_id));
			if($result_id){
				// $data['success'] = "Shop has been updated sucessfully";
				$this->session->set_flashdata('addshop_success', 'Profile has been updated sucessfully');
				redirect(base_url().'shop/profile');

			}else{
				$data['error'] = "Something went wrong please try again";
			}
			$data['shop_data'] = $_POST;
		}
		if(!empty($shop_id)){
			$where = array('status !='=>3,'shop_id'=>$shop_id);
			$data['shop_data'] = $this->Common_model->GetWhere("shops",$where);
			if(!empty($data['shop_data']))
			{
				$shop_data = $data['shop_data'][0];
			}
		}
		$data['shop_type_list'] = $this->Common_model->GetWhere("shop_types",array('1'=>1));
		$data['shop_data'] = $shop_data;
			$this->load->view('shop/header');
			$this->load->view('shop/shopprofile',$data);
			$this->load->view('shop/footer');	
		
	}

	public function shopdetail(){
		$data = array();
		$shop_id = shopsessionShopid();
		if(!empty($shop_id)){
			$where = array('status !='=>3,'shop_id'=>$shop_id);
			$data['shop_data'] = $this->Common_model->GetWhere("shops",$where);
			if(!empty($data['shop_data']))
			{
				$shop_data = $data['shop_data'][0];
			}
		}
		$data['shop_type_list'] = $this->Common_model->GetWhere("shop_types",array('1'=>1));
		$data['shop_data'] = $shop_data;
		$this->load->view('shop/header');
		$this->load->view('shop/shopdetail',$data);
		$this->load->view('shop/footer');
	}

	public function coupon(){
		$data = array();
		$shopid = shopsessionShopid();
		if(isset($_POST) && !empty($_POST)){
			// print_r($_POST);
			$coupon_code = $_POST['coupon_code'];
			$post_data = array();
			$post_data['coupon_code'] = $_POST['coupon_code'];
			$post_data['offer_amount'] = $_POST['offer_amount'];
			$post_data['offer_amount_type'] = $_POST['offer_amount_type'];
			$post_data['start_date'] = $_POST['start_date'];
			$post_data['min_total_amount'] = $_POST['min_total_amount'];
			$post_data['end_date'] = $_POST['end_date'];
			$post_data['create_date'] = date('Y-m-d H:i:s');
			$whr2 = array('coupon_code'=>$_POST['coupon_code'],'added_by_id !='=>$shopid);
			$check_coupon_code = $this->Common_model->GetWhere('coupons', $whr2);
			if(empty($check_coupon_code)){
				$coupons_data = $this->Common_model->GetWhere('coupons', array('added_by_id' => $shopid,'added_by'=>'shop','added_by'=>'shop'));
				if(!empty($coupons_data)){
					$this->Common_model->updateRecords('coupons',$post_data,array('added_by_id'=>$shopid,'added_by'=>'shop'));
					$data['success'] = "Coupon has been updated sucessfully";
				}else{
					$post_data['added_by_id'] = $shopid;
					$post_data['added_by'] = 'shop';
					$rs = $this->Common_model->addRecords('coupons',$post_data);
					$data['success'] = "Coupon has been added sucessfully";	
				}
			}else{
				$data['error'] = "Coupon already exits please try again.";
			}
		}
		$data['coupons_data'] = $this->Common_model->getSingleRecordById('coupons', array('added_by_id' => $shopid,'added_by'=>'shop','added_by'=>'shop'));
		$this->load->view('shop/header');
		$this->load->view('shop/coupon',$data);
		$this->load->view('shop/footer');
	}

	public function checkCouponCode(){
		//print_r($_POST);
		if(isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])){
			$shopid = shopsessionShopid();
			$whr2 = array('coupon_code'=>$_POST['coupon_code'],'added_by_id !='=>$shopid);
			$coupons = $this->Common_model->GetWhere('coupons', $whr2);
			if(empty($coupons)){
				echo "<span style='color:green'>Copon code available.</span>";
			}else{
				echo "<span style='color:red'>Copon code already exits.</span>";
			}
		}else{
			echo "<span style='color:red'>Copon code is required.</span>";
		}
		exit();
	}

	public function changePassword(){
		$shopid = shopsessionShopid();
		$shopdata = shopprofilebysession();
		if(isset($shopid) && !empty($shopid)){
			$data = array();
			if(isset($_POST['changenormalpassword'])){
			  $old_current_password = $shopdata['password'];
			  $current_password = md5(trim($_POST['current_password']));
			  $new_password = md5(trim($_POST['new_password']));
			  $re_enter_password = md5(trim($_POST['re_enter_password']));
			  	  
			  if($old_current_password!=$current_password){
			   $data['error'] = "Invalid Current Password...!";
			  }
			  else{
			   if($new_password!=$re_enter_password){
			    $data['error'] = " password not matched please try again...!";
			   }
			   else{
			    $this->Common_model->updateRecords('shops',array('password'=>$re_enter_password),array('shop_id'=>$shopid));
				$data['success'] = "Password updating, please wait...!";
			   }
			  }
			 }
			$this->load->view('shop/header');
			$this->load->view('shop/changePassword',$data);
			$this->load->view('shop/footer');	
		}
	}

	function uploadfilebypath($key,$path)
	{
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

	public function addproduct($pid = false){
		$data = array();

		if(isset($_POST['submit']) && !empty($_POST['submit'])){

			// p($_POST);
			// die;
			$file = $_FILES;
			$product_galary = $file["product_galary"];
			$main_image = $file["main_image"];
			$meta_image = $file["meta_image"];

			// p($_FILES['meta_image']);
			$post_data = array();
			$post_data['categories_id'] = $_POST['categories_id'];
			$post_data['sub_categories_id'] = (isset($_POST['sub_categories_id']) ? $_POST['sub_categories_id'] : 0);
			$post_data['shop_id'] = shopsessionShopid();
			$post_data['name'] = $_POST['name'];
			$post_data['product_gst'] = $_POST['product_gst'];
			$post_data['description'] = $_POST['description'];
			$post_data['unit_price'] = $_POST['unit_price'];
			if(isset($_POST['discount']) && !empty($_POST['discount'])){
				$post_data['discount'] = $_POST['discount'];
			}
			if(isset($_POST['discount_type']) && !empty($_POST['discount_type'])){
				$post_data['discount_type'] = $_POST['discount_type'];
			}
			$post_data['quantity'] = $_POST['quantity'];
			$post_data['create_date'] = date('Y-m-d H:i:s');
			$post_data['return_policy'] = (isset($_POST['return_policy']) ? $_POST['return_policy'] : '');

			$post_data['tags'] = (isset($_POST['tags']) ? $_POST['tags'] : '');
			$post_data['meta_title'] = (isset($_POST['meta_title']) ? $_POST['meta_title'] : '');
			$post_data['meta_description'] = (isset($_POST['meta_description']) ? $_POST['meta_description'] : '');


			if(isset($_POST['colors_active']) && isset($_POST['colors']) && $_POST['colors'] && count($_POST['colors']) > 0){
	            $post_data['colors'] = json_encode($_POST['colors']);
	        }
	        else {
	            $colors = array();
	            $post_data['colors'] = json_encode($colors);
	        }

	        $choice_options = array();
	        if(isset($_POST['choice'])){
	            foreach ($_POST['choice_no'] as $key => $no) {
	                $str = 'choice_options_'.$no;
	                $item['name'] = 'choice_'.$no;
	                $item['title'] = $_POST['choice'][$key];
	                $item['options'] = explode(',', implode('|', $_POST[$str]));
	                array_push($choice_options, $item);
	            }
	        }

	        $post_data['choice_options'] = json_encode($choice_options);

	        $variations = array();
	        //combinations start
	        $options = array();
	        if(isset($_POST['colors_active']) && isset($_POST['colors']) && count($_POST['colors']) > 0){
	            $colors_active = 1;
	            array_push($options, $_POST['colors']);
	        }

	        if(isset($_POST['choice_no'])){
	            foreach ($_POST['choice_no'] as $key => $no) {
	                $name = 'choice_options_'.$no;
	                $my_str = implode('|',$_POST[$name]);
	                array_push($options, explode(',', $my_str));
	            }
	        }

	        //Generates the combinations of customer choice options
	        $combinations = combinations($options);
	        if(count($combinations[0]) > 0){
	            foreach ($combinations as $key => $combination){
	                $str = '';
	                foreach ($combination as $key => $item){
	                    if($key > 0 ){
	                        $str .= '-'.str_replace(' ', '', $item);
	                    }
	                    else{
	                        if(isset($_POST['colors_active']) && isset($_POST['colors']) && count($_POST['colors']) > 0){
	                            // $color_name = \App\Color::where('code', $item)->first()->name;
	                            $color_name = $this->UserModel->getWhereDataByCol("colors",array("code" => $item),"name");
	                            $str .= $color_name;
	                        }
	                        else{
	                            $str .= str_replace(' ', '', $item);
	                        }
	                    }
	                }
	                $item = array();
	                $item['price'] = $_POST['price_'.str_replace('.', '_', $str)];
	                $item['sku'] = $_POST['sku_'.str_replace('.', '_', $str)];
	                $item['qty'] = $_POST['qty_'.str_replace('.', '_', $str)];
	                $variations[$str] = $item;
	            }
	        }
	        //combinations end

	        $post_data['variations'] = json_encode($variations);

	        if(isset($_POST['previous_photos']) && !empty($_POST['previous_photos'])){
	            $photos = $_POST['previous_photos'];
	        }
	        else{
	            $photos = array();
	        }
	        // if($request->hasFile('photos')){
	        //     foreach ($request->photos as $key => $photo) {
	        //         $path = $photo->store('uploads/products/photos');
	        //         array_push($photos, $path);
	        //         //ImageOptimizer::optimize(base_path('public/').$path);
	        //     }
	        // }
	        if(!empty($product_galary))
			{
				$dgl = array();
				
				foreach($product_galary["size"] as $x => $y)
				{
					if($y > 0)
					{
						$iname = $product_galary["name"][$x];
						$itype = $product_galary["type"][$x];
						 $itmp_name = $product_galary["tmp_name"][$x];
						 $isize = $y;

						if($dge = $this->uploadproductImages($iname,$itype,$itmp_name,$isize))
						{
							// $jay = array();
							// // $jay["product_id"] = $product_id;
							// $jay[] = $dge;
							array_push($photos, $dge);
							// $jay["create_date"] = date('Y-m-d H:i:s');
							// array_push($dgl, $jay);
						}
					}
				}

				if(!empty($jay))
				{
					// print_r($jay);
					
					// $this->Common_model->insertMultiple("product_images",$dgl);
				}
			}
			// print_r($photos);
			// die;	
			$post_data['product_images'] = json_encode($photos);

			if(isset($main_image) && !empty($main_image)){

				// p($main_image);
				$main_iname = $main_image["name"];
				$main_itype = $main_image["type"];
				$main_itmp_name = $main_image["tmp_name"];
				$main_isize = $main_image["size"];
				if(isset($main_isize) && $main_isize > 0){	
					$main_image_res = $this->uploadproductImages($main_iname,$main_itype,$main_itmp_name,$main_isize);
					if($main_image_res){
						$post_data['main_image'] = $main_image_res;
					}
				}
			}

			if(isset($meta_image) && !empty($meta_image)){

				// p($meta_image);
				$meta_iname = $meta_image["name"];
				$meta_itype = $meta_image["type"];
				$meta_itmp_name = $meta_image["tmp_name"];
				$meta_isize = $meta_image["size"];
				if(isset($meta_isize) && $meta_isize > 0){	
					$meta_image_res = $this->uploadproductImages($meta_iname,$meta_itype,$meta_itmp_name,$meta_isize);
					if($meta_image_res){
						$post_data['meta_image'] = $meta_image_res;
					}
				}
			}
	        // p($post_data);
	         // die;
	        if(isset($_POST['product_id']) && !empty($_POST['product_id'])){
				$this->Common_model->updateRecords("product", $post_data, array('product_id'=>$_POST['product_id']));
				$data['success'] = "Product has been updated successfully";
			}else{
				$product_id = $this->Common_model->addRecords('product',$post_data);
				// print_r($product_id);
				if($product_id){
					$prdoduct_reg_id = trim(prduct_reg_prefix.$product_id);
					$this->Common_model->updateRecords("product", array('product_reg_id'=>$prdoduct_reg_id), array('product_id'=>$product_id));
					$data['success'] = "Product has been added successfully";
				}else{
					$data['error'] = "Oops Something went wrong please try again.";
				}
			}
		}
		if($pid){
			$data['product_data'] = $this->Common_model->getSingleRecordById("product",array('product_id'=>$pid));
// 			print_r($data['product_data']);
		}
		$data['color'] = $this->Common_model->getwhere("colors",array(1=>1));
		$data['categorylist'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));
// 		print_r($data['categorylist']);
        // $data['product_data'] = $this->Common_model->getAllRecords("product");
        // p($data['product_data']);
		$this->load->view('shop/header');
		$this->load->view('shop/addproduct',$data);
		$this->load->view('shop/footer');
	}

	public function subcategoryhtml(){
	  if(isset($_POST['categories_id']) && !empty($_POST['categories_id'])){
	  		$data = array();
			$categories_id = $_POST['categories_id'];
			$data['subcategory'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>$categories_id));
			echo $this->load->view('shop/subcategorylistbycatid',$data,true);
		}
	}

	public function sku_combination()
    {
    	// print_r($_REQUEST);
        $options = array();
        if(isset($_POST['colors_active'])  && isset($_POST['colors']) && count($_POST['colors']) > 0){
            $colors_active = 1;
            array_push($options, $_POST['colors']);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $_POST['unit_price'];
        $product_name = $_POST['name'];

        if(isset($_POST['choice_no'])){
            foreach ($_POST['choice_no'] as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|', $_POST[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        $data = array();
        $data['combinations'] = $combinations;
        $data['unit_price'] = $unit_price;
        $data['product_name'] = $product_name;
        $data['colors_active'] = $colors_active;
        $this->load->view('shop/partial/sku_combinations',$data);
    }

	// public function productlist(){
	// 	$data = array();
	// 	$data['productlist'] = $this->Common_model->getwhere("product",array('status'=>1));
	// 	$this->load->view('shop/header');
	// 	$this->load->view('shop/productlist',$data);
	// 	$this->load->view('shop/footer');
	// }

	public function productlist()
	{   
		$data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		$shop_id = shopsessionShopid();
		$whr = array();
		// $whr[] = "o.userid != 0";
		$whr = array();
		$whr[] = "status != 3";
		$whr[] = "shop_id = ".$shop_id;
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['rows'] = $this->Common_model->getwherecustome('product',$where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountbycol('product','product_id',$where); 
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);

    	$url = base_url()."shop/productlist".(isset($_GET['product_reg_id']) ? "?product_reg_id=".trim($_GET['product_reg_id'])."" : '').(isset($_GET['name']) ? "&name=".trim($_GET['name'])."":'').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('shop/header');
		$this->load->view('shop/productlist', $data);
		$this->load->view('shop/footer');
	}
	
	public function pending_productlist()
	{   
		$data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		
		$whr = array();
		// $whr[] = "o.userid != 0";
		$whr = array();
		if(isset($_GET['status'])){
			$whr[] = "status = ".$_GET['status'];
		}else{
			$whr[] = "status != 3";
		}
		
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['rows'] = $this->Common_model->getwherecustome('product',$where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountbycol('product','product_id',$where); 
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);

    	$url = base_url()."shop/productlist".(isset($_GET['product_reg_id']) ? "?product_reg_id=".trim($_GET['product_reg_id'])."" : '').(isset($_GET['name']) ? "&name=".trim($_GET['name'])."":'').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('shop/header');
		$this->load->view('shop/productlist', $data);
		$this->load->view('shop/footer');
		
	}	
	
	public function low_product_list()
	{
	    $data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		$shop_id = shopsessionShopid();
		$whr = array();
		// $whr[] = "o.userid != 0";
		$whr = array();
		$whr[] = "status != 3";
		$whr[] = "shop_id = ".$shop_id;
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['rows'] = $this->Common_model->getwherecustome('product',$where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountbycol('product','product_id',$where); 
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);

    	$url = base_url()."shop/productlist".(isset($_GET['product_reg_id']) ? "?product_reg_id=".trim($_GET['product_reg_id'])."" : '').(isset($_GET['name']) ? "&name=".trim($_GET['name'])."":'').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
	    $this->load->view('shop/header');
		$this->load->view('shop/low_product_list', $data);
		$this->load->view('shop/footer');
	}

	public function orderhistory(){
		$shop_id = shopsessionShopid();
    	$data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		$whr = array();
		// $whr[] = "o.userid != 0";
		$whr = array();
		$whr[] = "status != 3";
		$whr[] = "seller_id = ".$shop_id;
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwherecustome('orders',$where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountbycol('orders','id',$where); 
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."shop/orderhistory".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('shop/header');
		$this->load->view('shop/orderhistory', $data);
		$this->load->view('shop/footer');
    }

    public function neworders(){
		$shop_id = shopsessionShopid();
    	$data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		$whr = array();
		// $whr[] = "o.userid != 0";
		$whr = array();
		$whr[] = "o.status = 1";
		$whr[] = "o.delivery_status in(1,2,3)";
		$whr[] = "o.seller_id = ".$shop_id;
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);
    	// print_r($data['orders']);
    	// die;
		$data['pagination'] = $this->Common_model->getwhrcountordersbycol($where);
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."shop/neworders".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('shop/header');
		$this->load->view('shop/neworders', $data);
		$this->load->view('shop/footer');
    }

    public function invoice(){
    	$data = array();
    	$shop_id = shopsessionShopid();
    	
    	if(isset($_GET['invoice']) && !empty($_GET['invoice'])){
	    	$id = base64_decode($_GET['invoice']);
	    	$whr = array();
	    	$whr[] = "seller_id =".$shop_id;
	    	$whr[] = "id =".$id;
	    	$where = " WHERE ".implode(" AND ", $whr);
	    	$data['orderdata'] = $this->Common_model->getwheresingleorder($where);
	    	$this->load->view('shop/header');
			$this->load->view('shop/invoice', $data);
			$this->load->view('shop/footer');
		}
    }

    public function support_ticket(){
        $user_id = customersessionid();
        if(isset($_POST['query']) && !empty($_POST['query']) )
        {
            $insert_data = array();
            $insert_data['query'] = $_POST["query"];
            $insert_data['user_type'] = 'shop';
            $insert_data['create_date'] = date('Y-m-d H:i:s');
            $insert_data['user_id'] = $user_id;
            
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
        $data['support'] = $this->Common_model->getWhereData('support_ticket',array('user_type'=>'shop'));
        // print_r($data['support']);
        // die;
        $this->load->view('shop/header');
        $this->load->view('shop/support_ticket',$data);
        $this->load->view('shop/footer');   
    }

    public function support(){
    	$data = array();
        $user_id = customersessionid();
        // print_r($data);
        // die;
        $id = base64_decode($_GET['ticket_id']);
        // print_r($data);
        // die;
		$data['supportchat'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));
		$data['support'] = $this->Common_model->getSingleRecord('support_ticket',array('ticket_id'=>$id));
		$this->load->view('shop/header');
		$this->load->view('shop/support',$data);
		$this->load->view('shop/footer');
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
            $insert_data["user_type"] = 'shop';
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
    	$this->load->view('shop/partial/support_chat_message',$data);
    	// exit();
    }

	public function pagination($page_url,$total_rows,$get_page,$count_data)
    {
		$config["base_url"] = $page_url;
		$config["total_rows"] = $total_rows;
		$config['page_query_string'] = TRUE;
		$config["per_page"] = $count_data;
		// $config['use_page_numbers'] = TRUE;
		$config['num_links'] = 10;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$this->load->library('pagination', $config);
		if($get_page)
		{
			$page = $get_page;
		}else{
			$page = 0;
		}
       	return $this->pagination->create_links();
	}

	public function uploadproductImages($ImageName,$ImageType,$TempSrc,$ImageSize,$dir = false)
	{
		$ThumbSquareSize 		= 200; //Thumbnail will be 200x200
		$BigImageMaxSize 		= 1024; //Image Maximum height or width
		$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
		$DestinationDirectory	=  (!empty($dir))? $dir : 'uploads/product_images/'; //Upload Directory ends with / (slash)
		$Quality 				= 60;
		$processImage			= true;
		$RandomNumber			= time();  // We need same random name for both files.
		switch(strtolower($ImageType))
		{
			case 'image/png':
				$CreatedImage = imagecreatefrompng($TempSrc);
				break;

			case 'image/gif':
				$CreatedImage = imagecreatefromgif($TempSrc);
				break;

			case 'image/jpeg':

			case 'image/pjpeg':
				$CreatedImage = imagecreatefromjpeg($TempSrc);
				break;
			default:
				$processImage = false; //image format is not supported!
		}

		//get Image Size

		list($CurWidth,$CurHeight)=getimagesize($TempSrc);

		//Get file extension from Image name, this will be re-added after random name

		$Imagearray = explode(".", $ImageName);

		$ImageExt = array_pop($Imagearray);

		//Construct a new image name (with random number added) for our new image.
		$NewImageName = $ImageSize."_".$RandomNumber.'.'.$ImageExt;

		//Set the Destination Image path with Random Name
		$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name

		$DestRandImageName 			= $DestinationDirectory.$NewImageName; //Name for Big Image

		//Resize image to our Specified Size by calling resizeImage function.

		if($processImage && $this->resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
		{
			return $NewImageName;
		}else{
			return false;
		}
	}

	public function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
    {
    	//Check Image size is not 0
		if($CurWidth <= 0 || $CurHeight <= 0)
		{
				return false;

		}

		//Construct a proportional size of new image

		$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 

		$NewWidth  			= ceil($ImageScale*$CurWidth);

		$NewHeight 			= ceil($ImageScale*$CurHeight);

		

		if($CurWidth < $NewWidth || $CurHeight < $NewHeight)
		{
			$NewWidth = $CurWidth;
			$NewHeight = $CurHeight;

		}

		$NewCanves 	= imagecreatetruecolor($NewWidth, $NewHeight);

		// Resize Image

		if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))

		{

			switch(strtolower($ImageType))

			{

				case 'image/png':

					imagepng($NewCanves,$DestFolder);

					break;

				case 'image/gif':

					imagegif($NewCanves,$DestFolder);

					break;			

				case 'image/jpeg':

				case 'image/pjpeg':

					imagejpeg($NewCanves,$DestFolder,$Quality);

					break;

				default:

					return false;

			}

		if(is_resource($NewCanves)) { 

	      imagedestroy($NewCanves); 

	    } 

		return true;

		}
	}

	public function change_status(){
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


	
	public function logout()
	{
		// $this->session->sess_destroy();
		$this->session->unset_userdata(SHOP_SESSION);
		redirect(base_url('shop'),'refresh');
	}
}