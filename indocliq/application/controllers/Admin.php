<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->SessionModel->checkadminlogin(array("login","loginajax"));
	}

	public function index()
	{
		$data = array();
		$whr = " WHERE status = 1 and delivery_status = 4";
		$data['ordersByMonth'] = $this->Common_model->getOrdersByMonth($whr);
		// $data['ordersByMonth'] = array('years' => array_unique(array('2019')),'orders' => array('2019'=>array('1'=>9,'2'=>9,'3'=>9,'4'=>9,'5'=>9,'6'=>9,'7'=>9,'8'=>9,'9'=>9,'10'=>9,'11'=>9,'12'=>1)));
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer');
	}

	public function login(){
		$edata = array();
		$this->load->view('admin/login_header');
		$this->load->view('admin/login');
		$this->load->view('admin/login_footer');
	}

	public function loginajax()
	{
		$email_id = trim($_POST['email_id']);
		$password = md5(trim($_POST['password']));
		if(isset($email_id) && !empty($email_id) && isset($password) && !empty($password))
		{
		    		$userdata = $this->Common_model->getSingleRecordById('admin',array('email' => $email_id,'password'=>$password));
		    		//print_r($userdata);
		    		if($userdata){
		    			if($userdata['status']==1){                            
		    	           
		    	           $this->session->set_userdata(ADMIN_SESSION, $userdata);
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
		    			echo json_encode(array('status'=>0,'msg'=>" Invalid Membership id or password Please try again"));
		    		}
		}else
		{
		    echo json_encode(array('status'=>0,'msg'=>"Membership id and password has been required"));
		    	exit();
		}   
	}

	public function manageprofile()
	{
	 $data = array();
	 $check_admin_password = $this->Common_model->getSingleRecord("admin",array('id'=>1));
	 $admin_current_password = $check_admin_password['password'];
	 $admin_txn_current_password = $check_admin_password['txn_password'];
	 
	 if(isset($_POST['changeprofileinformation'])){
	  $yourfirstname = $_POST['yourfirstname'];
	  $yourlastname = $_POST['yourlastname'];
	  $youremailid = $_POST['youremailid'];
	  $today_date = date('Y-m-d h:i:s A',time());
	  
	  $this->Common_model->updateRecords('admin',array('first_name'=>$yourfirstname,'last_name'=>$yourlastname,'email'=>$youremailid),array('id'=>1));
	  $data['success'] = "Updating please wait...!";
	 }
	 if(isset($_POST['changenormalpassword'])){
	  $current_password = md5(trim($_POST['current_password']));
	  $new_password = md5(trim($_POST['new_password']));
	  $re_enter_password = md5(trim($_POST['re_enter_password']));	  
	  $today_date = date('Y-m-d h:i:s A',time());
	  	  
	  if($admin_current_password!=$current_password){
	   $data['error'] = "Invalid Current Password...!";
	  }
	  else{
	   if($new_password!=$re_enter_password){
	    $data['error'] = "New password not matched...!";
	   }
	   else{
	    $this->Common_model->updateRecords('admin',array('password'=>$re_enter_password),array('id'=>1));
		$data['success'] = "Password updating, please wait...!";
	   }
	  }
	 }	 
	 if(isset($_POST['changetxnpassword'])){
	  $current_txn_password = md5(trim($_POST['current_txn_password']));
	  $new_txn_password = md5(trim($_POST['new_txn_password']));
	  $re_enter_txn_password = md5(trim($_POST['re_enter_txn_password']));	  
	  $today_date = date('Y-m-d h:i:s A',time());
	  	  
	  if($admin_txn_current_password!=$current_txn_password){
	   $data['error'] = "Invalid Current TXN Password...!";
	  }
	  else{
	   if($new_txn_password!=$re_enter_txn_password){
	    $data['error'] = "New TXN password not matched...!";
	   }
	   else{
	    $this->Common_model->updateRecords('admin',array('txn_password'=>$re_enter_txn_password),array('id'=>1));
		$data['success'] = "TXN Password updating, please wait...!";
	   }
	  }
	 }
	 $data['admin_information'] = $this->Common_model->getSingleRecord("admin",array('id'=>1));
	 $this->load->view('admin/header');
	 $this->load->view('admin/manageprofile',$data);
	 $this->load->view('admin/footer');
	}

	public function commonsettings()
	{
		$edata = array();
		if(isset($_POST['configure_common_settings']))
		{
		   
		   $filearray = array();
			if (isset($_FILES)) {
			    //echo '<pre>';print_r($_FILES);die();
			    foreach ($_FILES as $key => $value) {
			        //print_r($value['size']);
			        if($value['size'] > 0) {

			            $filearraydata = $this->uploadfile($key);
			            $filearray[$key] = $filearraydata;
			            
			        }else{
			            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
			        }
			    }
				//$post_data = $_POST+$filearray;
			}

			//print_r($filearray);
			/*Upload file end*/
			
			//creating query
			$query = "INSERT INTO `common_setting`
			(`option_name`, `option_value`)
			VALUES ";
			$query .= "('email','".$_POST['email']."' ),
				('address','".$_POST['address']."' ),
				('mobile_no','".$_POST['mobile_no']."' ),
				('facebook_url','".$_POST['facebook_url']."' ),
				('linkedin_url','".$_POST['linkedin_url']."' ),
				('instagram_url','".$_POST['instagram_url']."' ),
				('twitter_url','".$_POST['twitter_url']."' ),";
			if (isset($filearray['front_logo'])) {
				$query .= "('front_logo','".$filearray['front_logo']."' ),";
			}
			if (isset($filearray['backedn_login_background_image'])) {
				$query .= "('backedn_login_background_image','".$filearray['backedn_login_background_image']."' ),";
			}
			if (isset($filearray['backlogo'])) {
				$query .= "('backlogo','".$filearray['backlogo']."' ),";
			}
			
			$query .="('facebook_url','".$_POST['facebook_url']."' ) ON DUPLICATE KEY UPDATE option_value=VALUES(option_value)";
			//creating query end

			$response = $this->db->query($query);
			// echo $this->db->last_query();
			if ($response) {
				//$msg = array('status'=>1, 'msg'=>'Cofugration Successfully!');
				//echo json_encode($msg);
				$edata['SUCCESS'] = 'Configuring your system, please wait...!';
				}else{
				$edata['ERROR'] = 'Ops! Something went wrong...!';
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/common-settings',$edata);
		$this->load->view('admin/footer');
	}

	

	public function productlist()
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
		
		$this->load->view('admin/header');
		$this->load->view('admin/productlist', $data);
		$this->load->view('admin/footer');
	}

	public function productdetail($pid = false){
		if($pid){
			$data = array();
			$data['product_data'] = $this->Common_model->getSingleRecordById("product",array('product_id'=>$pid));
			$data['color'] = $this->Common_model->getwhere("colors",array(1=>1));
			$data['categorylist'] = $this->Common_model->getwhere("categories",array('status'=>1,'parent_category_id'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/productdetail',$data);
			$this->load->view('admin/footer');
		}			
	}

	public function neworders(){
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
		$whr[] = "o.delivery_status in(1)";
		$orderby = " ORDER BY o.id desc LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);
    	// print_r($data['orders']);
    	// die;
		$data['pagination'] = $this->Common_model->getwhrcountordersbycol($where);
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."admin/neworders".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('admin/header');
		$this->load->view('admin/neworders', $data);
		$this->load->view('admin/footer');
    }

    public function orderhistory(){
    	$data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		
		// $whr[] = "o.userid != 0";
		$whr = array();
		$whr[] = "o.status = 1";
		$orderby = " ORDER BY o.id desc LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);
    	// print_r($data['orders']);
    	// die;
		$data['pagination'] = $this->Common_model->getwhrcountordersbycol($where);
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."admin/orderhistory".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('admin/header');
		$this->load->view('admin/neworders', $data);
		$this->load->view('admin/footer');
    }

    public function cancelorders(){
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
		$whr[] = "o.delivery_status = 5";
		$whr[] = "o.deliveryboy_id = 0";
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountordersbycol($where);
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."admin/cancelorders".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('admin/header');
		$this->load->view('admin/neworders', $data);
		$this->load->view('admin/footer');
    }
    
    public function pending_product(){
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
		$whr[] = "o.delivery_status in(1)";
		$orderby = " ORDER BY o.id desc LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['orders'] = $this->Common_model->getwhereorders($where,$orderby);
    	// print_r($data['orders']);
    	// die;
		$data['pagination'] = $this->Common_model->getwhrcountordersbycol($where);
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);
		$url = base_url()."admin/neworders".(isset($_GET['invoice_no']) ? "?invoice_no=".trim($_GET['invoice_no'])."" : '').(isset($_GET['status']) ? "&status=".trim($_GET['status'])."":'');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
		
		$this->load->view('admin/header');
		$this->load->view('admin/neworders', $data);
		$this->load->view('admin/footer');
    }

    public function invoice(){
    	$data = array();
    	
    	if(isset($_GET['invoice']) && !empty($_GET['invoice'])){
	    	$id = base64_decode($_GET['invoice']);
	    	$whr = array();
	    	// $whr[] = "deliveryboy =".$shop_id;
	    	$whr[] = "id =".$id;
	    	$where = " WHERE ".implode(" AND ", $whr);
	    	$data['orderdata'] = $this->Common_model->getwheresingleorder($where);
	    	$this->load->view('admin/header');
			$this->load->view('admin/invoice', $data);
			$this->load->view('admin/footer');
		}
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
	
	public function categories()
	{
		$data = array();
		$whr2 = array('status !='=>3,'parent_category_id'=>0);
		$data['categories_data'] = $this->Common_model->GetWhere('categories', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/categories',$data);
		$this->load->view('admin/footer');
	}

	public function subcategories()
	{
		$data = array();
		// $whr2 = array('status !='=>3,'parent_category_id !='=>0);
		$whr2 = "WHERE c2.categories_id = c1.parent_category_id and c1.status != 3 and c2.parent_sub_category_id = 0";
		$data['categories_data'] = $this->Common_model->GetWheresubcategory($whr2);

		// print_r($data['categories_data']);
		// die;
		$this->load->view('admin/header');
		$this->load->view('admin/subcategories',$data);
		$this->load->view('admin/footer');
	}
	
	

	public function subcatbycatname(){
		if(isset($_POST) && !empty($_POST['cat'])){
			$cats = $_POST['cat'];
			$allcats = implode("', '", $cats);
			$whr2 = "WHERE status != 3 AND category_name in ('".$allcats."')";
			$orderby = " ORDER BY categories_id asc";
			$categories_data = $this->Common_model->getwherecustome('categories',$whr2,$orderby);
			if(isset($categories_data) && !empty($categories_data)){
				$catids = array();
				foreach ($categories_data as $key => $catdataarray) {
					$catids[] = $catdataarray['categories_id'];
				}

				$allcatids =  implode("','", $catids);

				$whr3 = "WHERE status != 3 AND parent_category_id in ('".$allcatids."')";
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
	
	public function addsubcategory($cat_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['cat_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();

			$filearray = array();
			if (isset($_FILES)) {
			    //echo '<pre>';print_r($_FILES);die();
			    foreach ($_FILES as $key => $value) {
			        //print_r($value['size']);
			        if($value['size'] > 0) {
						$filearraydata = $this->uploadsubcategoryfile($key);
			            $filearray[$key] = $filearraydata;
			        }else{
			            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
			        }
			    }
				//$post_data = $_POST+$filearray;
			}

			if(isset($filearray['category_image'])) {
				$user_data['category_image'] = $filearray['category_image'];
			}

			// print_r($filearray);
			// die;
			// $parent_id = $_POST['parent_id'];
			$user_data['category_name'] = $_POST['category_name'];
			$user_data['parent_category_id'] = $_POST['parent_category_id'];
			$user_data['parent_sub_category_id'] = 1;
			$user_data['create_date'] = date('Y-m-d H:i:s');
			
			
			if (isset($_POST['categories_id']) &&  !empty($_POST['categories_id'])){
				$result_id = $this->Common_model->updateRecords('categories',$user_data,array('categories_id'=>$_POST['categories_id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('categories',$user_data);
				
			}
			if($result_id)
			{
				$data['success'] = "Categories has been added successfully";
				redirect(base_url().'admin/subcategories/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($cat_id))
		{
		    $whr = array('status !='=>3,'categories_id'=>$cat_id);
			$data['cat_data'] = $this->Common_model->getSingleRecordById('categories', $whr);
			// print_r($data['cat_data']);
			// die;
		}
		$whr2 = array('status !='=>3,'parent_category_id'=>0);
		$data['parent_categories'] = $this->Common_model->GetWhere('categories', $whr2);
		

		
		$this->load->view('admin/header');
		$this->load->view('admin/addsubcategory',$data);
		$this->load->view('admin/footer');
	}
	
	public function sub_subcategories()
	{
		$data = array();
		// $whr2 = array('status !='=>3,'parent_category_id !='=>0);
		$whr2 = "WHERE c2.categories_id = c1.parent_sub_category_id and c1.status != 3";
		$data['categories_data'] = $this->Common_model->GetWheresuboncategory($whr2);
        // echo '<pre>';
// 		print_r($data['categories_data']);
		// die;
		$this->load->view('admin/header');
		$this->load->view('admin/sub_on_categories',$data);
		$this->load->view('admin/footer');
	}
	
	public function add_on_subcategory($cat_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['cat_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();

			$filearray = array();
			if (isset($_FILES)) {
			    //echo '<pre>';print_r($_FILES);die();
			    foreach ($_FILES as $key => $value) {
			        //print_r($value['size']);
			        if($value['size'] > 0) {
						$filearraydata = $this->uploadsubsubcategoryfile($key);
			            $filearray[$key] = $filearraydata;
			        }else{
			            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
			        }
			    }
				//$post_data = $_POST+$filearray;
			}

			if(isset($filearray['category_image'])) {
				$user_data['category_image'] = $filearray['category_image'];
			}

			// print_r($filearray);
			// die;
			// $parent_id = $_POST['parent_id'];
			$user_data['category_name'] = $_POST['category_name'];
			$user_data['parent_subcategory_id'] = $_POST['parent_category_id'];
			
			$user_data['create_date'] = date('Y-m-d H:i:s');
			
			if (isset($_POST['categories_id']) &&  !empty($_POST['categories_id'])){
				$result_id = $this->Common_model->updateRecords('categories',$user_data,array('categories_id'=>$_POST['categories_id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('categories',$user_data);
				// echo '<pre>';
    // 			print_r($result_id);
    // 			die;
			}
			if($result_id)
			{
				$data['success'] = "Categories has been added successfully";
				redirect(base_url().'admin/sub_subcategories/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($cat_id))
		{
		    $whr = array('status !='=>3,'categories_id'=>$cat_id);
			$data['cat_data'] = $this->Common_model->getSingleRecordById('categories', $whr);
// 			print_r($data['cat_data']);
			// die;
		}
		$whr2 = array('status !='=>3,'status !='=>0,'parent_category_id !='=>0,'parent_sub_category_id'=>1);
		$data['parent_categories'] = $this->Common_model->GetWhere('categories', $whr2);
        // echo '<pre>';
        // print_r($data['parent_categories']);
		
		$this->load->view('admin/header');
		$this->load->view('admin/add_on_subcategory',$data);
		$this->load->view('admin/footer');
	}

	public function addcategories($cat_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['cat_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();

			$filearray = array();
			if (isset($_FILES)) {
			    //echo '<pre>';print_r($_FILES);die();
			    foreach ($_FILES as $key => $value) {
			        //print_r($value['size']);
			        if($value['size'] > 0) {
						$filearraydata = $this->uploadcategoryfile($key);
			            $filearray[$key] = $filearraydata;
			        }else{
			            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
			        }
			    }
				//$post_data = $_POST+$filearray;
			}

			if(isset($filearray['category_image'])) {
				$user_data['category_image'] = $filearray['category_image'];
			}

			// print_r($filearray);
			// die;
			// $parent_id = $_POST['parent_id'];
			$user_data['category_name'] = $_POST['category_name'];
			$user_data['category_percentage'] = $_POST['category_percentage'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['categories_id']) &&  !empty($_POST['categories_id'])){
				$result_id = $this->Common_model->updateRecords('categories',$user_data,array('categories_id'=>$_POST['categories_id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('categories',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Categories has been added successfully";
				redirect(base_url().'admin/categories/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($cat_id))
		{
		    $whr = array('status !='=>3,'categories_id'=>$cat_id);
			$data['cat_data'] = $this->Common_model->getSingleRecordById('categories', $whr);
		}
		$whr2 = array('status !='=>3);
		$data['all_categories'] = $this->Common_model->GetWhere('categories', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addcategories',$data);
		$this->load->view('admin/footer');
	}
	
	public function homepopupimage(){
		$data = array();
		$whr2 = array('status !='=>3);
		$data['popup_data'] = $this->Common_model->GetWhere('homepopupimage', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/homepopupimage',$data);
		$this->load->view('admin/footer');
	}

	public function addhomepopupimage($popup_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['popup_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        		$uploadpath = "./uploads/homepopupimage/";
        		$filearrayddata = $this->uploadfilebypath('image',$uploadpath);
            	if(isset($filearrayddata)){
					$user_data['image'] = $filearrayddata;
				}
        	}
			// $user_data['title'] = $_POST['title'];
			// $user_data['price'] = $_POST['price'];
			$user_data['link'] = $_POST['link'];
			// $user_data['start_date'] = $_POST['start_date'];
			// $user_data['end_date'] = $_POST['end_date'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				// print_r($user_data);
				// die;
				$result_id = $this->Common_model->updateRecords('homepopupimage',$user_data,array('id'=>$_POST['id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('homepopupimage',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Banner has been added successfully";
				redirect(base_url().'admin/homepopupimage/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($popup_id))
		{
		    $whr = array('status !='=>3,'id'=>$popup_id);
			$data['popup_data'] = $this->Common_model->getSingleRecordById('homepopupimage', $whr);
		}
		$whr2 = array('status !='=>3);
		// $data['all_banners'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addhomepopupimage',$data);
		$this->load->view('admin/footer');
	}

	public function homebannerslider(){
		$data = array();
		$whr2 = array('status !='=>3);
		$data['banner_data'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/homebannerslider',$data);
		$this->load->view('admin/footer');
	}

	public function addhomebannerslider($banner_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['banner_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        		$uploadpath = "./uploads/homebannerslider/";
        		$filearrayddata = $this->uploadfilebypath('image',$uploadpath);
            	if(isset($filearrayddata)){
					$user_data['image'] = $filearrayddata;
				}
        	}
			$user_data['title'] = $_POST['title'];
			$user_data['price'] = $_POST['price'];
			$user_data['link'] = $_POST['link'];
			$user_data['start_date'] = $_POST['start_date'];
			$user_data['end_date'] = $_POST['end_date'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				// print_r($user_data);
				// die;
				$result_id = $this->Common_model->updateRecords('homebannerslider',$user_data,array('id'=>$_POST['id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('homebannerslider',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Banner has been added successfully";
				redirect(base_url().'admin/homebannerslider/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($banner_id))
		{
		    $whr = array('status !='=>3,'id'=>$banner_id);
			$data['banner_data'] = $this->Common_model->getSingleRecordById('homebannerslider', $whr);
		}
		$whr2 = array('status !='=>3);
		// $data['all_banners'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addhomebannerslider',$data);
		$this->load->view('admin/footer');
	}

	public function homebannerslidersec(){
		$data = array();
		$whr2 = array('status !='=>3);
		$data['banner_data'] = $this->Common_model->GetWhere('homebannerslidersec', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/homebannerslidersec',$data);
		$this->load->view('admin/footer');
	}

	public function addhomebannerslidersec($banner_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['banner_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        		$uploadpath = "./uploads/homebannerslidersec/";
        		$filearrayddata = $this->uploadfilebypath('image',$uploadpath);
            	if(isset($filearrayddata)){
					$user_data['image'] = $filearrayddata;
				}
        	}
			$user_data['title'] = $_POST['title'];
			$user_data['price'] = $_POST['price'];
			$user_data['link'] = $_POST['link'];
			$user_data['start_date'] = $_POST['start_date'];
			$user_data['end_date'] = $_POST['end_date'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				// print_r($user_data);
				// die;
				$result_id = $this->Common_model->updateRecords('homebannerslidersec',$user_data,array('id'=>$_POST['id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('homebannerslidersec',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Banner has been added successfully";
				redirect(base_url().'admin/homebannerslidersec/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($banner_id))
		{
		    $whr = array('status !='=>3,'id'=>$banner_id);
			$data['banner_data'] = $this->Common_model->getSingleRecordById('homebannerslidersec', $whr);
		}
		$whr2 = array('status !='=>3);
		// $data['all_banners'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addhomebannerslidersec',$data);
		$this->load->view('admin/footer');
	}

	public function homebannersliderthird(){
		$data = array();
		$whr2 = array('status !='=>3);
		$data['banner_data'] = $this->Common_model->GetWhere('homebannersliderthird', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/homebannersliderthird',$data);
		$this->load->view('admin/footer');
	}

	public function addhomebannersliderthird($banner_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['banner_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        		$uploadpath = "./uploads/homebannersliderthird/";
        		$filearrayddata = $this->uploadfilebypath('image',$uploadpath);
            	if(isset($filearrayddata)){
					$user_data['image'] = $filearrayddata;
				}
        	}
			$user_data['title'] = $_POST['title'];
			$user_data['price'] = $_POST['price'];
			$user_data['link'] = $_POST['link'];
			$user_data['start_date'] = $_POST['start_date'];
			$user_data['end_date'] = $_POST['end_date'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				// print_r($user_data);
				// die;
				$result_id = $this->Common_model->updateRecords('homebannersliderthird',$user_data,array('id'=>$_POST['id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('homebannersliderthird',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Banner has been added successfully";
				redirect(base_url().'admin/homebannersliderthird/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($banner_id))
		{
		    $whr = array('status !='=>3,'id'=>$banner_id);
			$data['banner_data'] = $this->Common_model->getSingleRecordById('homebannersliderthird', $whr);
		}
		$whr2 = array('status !='=>3);
		// $data['all_banners'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addhomebannersliderthird',$data);
		$this->load->view('admin/footer');
	}

	public function homebannersliderfourth(){
		$data = array();
		$whr2 = array('status !='=>3);
		$data['banner_data'] = $this->Common_model->GetWhere('homebannersliderfourth', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/homebannersliderfourth',$data);
		$this->load->view('admin/footer');
	}

	public function addhomebannersliderfourth($banner_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['banner_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();
			if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        		$uploadpath = "./uploads/homebannersliderfourth/";
        		$filearrayddata = $this->uploadfilebypath('image',$uploadpath);
            	if(isset($filearrayddata)){
					$user_data['image'] = $filearrayddata;
				}
        	}
			$user_data['title'] = $_POST['title'];
			$user_data['price'] = $_POST['price'];
			$user_data['link'] = $_POST['link'];
			$user_data['start_date'] = $_POST['start_date'];
			$user_data['end_date'] = $_POST['end_date'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				// print_r($user_data);
				// die;
				$result_id = $this->Common_model->updateRecords('homebannersliderfourth',$user_data,array('id'=>$_POST['id']));
			}
			else
			{
				$result_id = $this->Common_model->addRecords('homebannersliderfourth',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Banner has been added successfully";
				redirect(base_url().'admin/homebannersliderfourth/');
			}
			else
			{
				$data['error'] = "Some thing went wrong please try again";
			}
		}
		if(!empty($banner_id))
		{
		    $whr = array('status !='=>3,'id'=>$banner_id);
			$data['banner_data'] = $this->Common_model->getSingleRecordById('homebannersliderfourth', $whr);
		}
		$whr2 = array('status !='=>3);
		// $data['all_banners'] = $this->Common_model->GetWhere('homebannerslider', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addhomebannersliderfourth',$data);
		$this->load->view('admin/footer');
	}

	public function areas()
	{
		$data = array();
		$whr2 = array('status !='=>3);
		$data['area_data'] = $this->Common_model->GetWhere('area', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/arealist',$data);
		$this->load->view('admin/footer');
	}

	public function addarea($area_id = "")
	{
		$data = array();
		$data['success'] = "";
		$data['error'] = "";
		$data['area_data'] = "";

		if(isset($_POST['submit']))
		{
			$user_data = array();

			// print_r($filearray);
			// die;
			// $parent_id = $_POST['parent_id'];
			$user_data['area_name'] = $_POST['area_name'];
			$user_data['create_date'] = date('Y-m-d H:i:s');
			if (isset($_POST['area_id']) &&  !empty($_POST['area_id'])){
				$result_id = $this->Common_model->updateRecords('area',$user_data,array('area_id'=>$_POST['area_id']));
			}else{
				$result_id = $this->Common_model->addRecords('area',$user_data);
			}
			if($result_id)
			{
				$data['success'] = "Area has been added successfully";
				redirect(base_url().'admin/areas/');
			}else{
				$data['error'] = "Some thing went wrong please try again";
			}
		}

		if(!empty($cat_id))
		{
		    $whr = array('status !='=>3,'area_id'=>$area_id);
			$data['area_data'] = $this->Common_model->getSingleRecordById('area', $whr);
		}

		$whr2 = array('status !='=>3);
		$data['all_areas'] = $this->Common_model->GetWhere('area', $whr2);
		$this->load->view('admin/header');
		$this->load->view('admin/addarea',$data);
		$this->load->view('admin/footer');
	}

	public function Customerslist()
	{
		$where = array('status !='=>3);
		$data['customer_data'] = $this->Common_model->getAllRecordsOrderById("users",'id','DESC',$where);
		$this->load->view('admin/header');
		$this->load->view('admin/Customerslist',$data);
		$this->load->view('admin/footer');
	}

	public function AddCustomer($user_id = ""){

		$data = array();
		$data['error_mobile'] = "";
		$data['success'] = "";
		$data['error'] = "";
		$data['customer_data'] = "";
		if(isset($_POST['submit']))
		{
			// print_r($_POST);
			$user_data = $_POST;
			$password = $user_data['password'];
			unset($user_data['submit']);
			unset($user_data['password']);
			$user_data['password'] = md5($password);
			$user_data['show_password'] = $password;
			$email = $user_data['email'];
			$mobile_no = $user_data['mobile_no'];
			$check_mobile_no = $this->Common_model->GetWhere('users',array('mobile_no'=> $mobile_no));
			if(empty($check_mobile_no))
			{
				$filearray = array();
				if (isset($_FILES)) {
				    //echo '<pre>';print_r($_FILES);die();
				    $uploadpath = "./uploads/user_images/";
				    foreach ($_FILES as $key => $value) {
				        //print_r($value['size']);
				        if($value['size'] > 0) {
							$filearraydata = $this->uploadfilebypath($key,$uploadpath);
				            $filearray[$key] = $filearraydata;
				        }else{
				            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
				        }
				    }
					//$post_data = $_POST+$filearray;
				}

				if(isset($filearray['image'])) {
					$user_data['image'] = $filearray['image'];
				}
				$user_data['reg_id'] = $this->createCode('users','reg_id');
				$user_data['create_date'] = date('Y-m-d H:i:s');
				$result_id = $this->Common_model->addrecords('users',$user_data);
				if($result_id){
					$data['success'] = "Customer has been added sucessfully";
					redirect(base_url().'admin/AddCustomer/'.$result_id);
				}else{
					$data['error'] = "Something went wrong please try again";
				}
			}elseif(!empty($check_email)){
				$data['error_email'] = "Mobile Number alredy exits";	
			}else{
				$data['error'] = "Something went wrong please try again";

			}
			$data['customer_data'] = $user_data;
		}

		if(isset($_POST['update']))
		{
			$user_data = $_POST;
			$user_id = $user_data['id'];
			unset($user_data['update']);
			$password = $user_data['password'];
			unset($user_data['password']);
			if(isset($password)&& !empty($password))
			{
				$user_data['password'] = md5($password);
				$user_data['show_password'] = $password;
			}
			$email = $user_data['email'];
			$mobile_no = $user_data['mobile_no'];
			$check_mobile_no = $this->Common_model->GetWhere('users',array('mobile_no'=> $mobile_no,'id !='=> $user_id));

			if(empty($check_mobile_no))
			{
				// print_r($user_data);
				// die;
				$filearray = array();
				if (isset($_FILES)) {
				    //echo '<pre>';print_r($_FILES);die();
				    $uploadpath = "./uploads/user_images/";
				    foreach ($_FILES as $key => $value) {
				        //print_r($value['size']);
				        if($value['size'] > 0) {
							$filearraydata = $this->uploadfilebypath($key,$uploadpath);
				            $filearray[$key] = $filearraydata;
				        }else{
				            $this->session->set_flashdata('error_fileupload', 'File size is empty!');
				        }
				    }
					//$post_data = $_POST+$filearray;
				}

				if(isset($filearray['image'])) {
					$user_data['image'] = $filearray['image'];
				}


				$result = $this->Common_model->updateRecords('users',$user_data,array('id'=>$user_id));
				if($result)
				{
					$data['success'] = "Customer has been Updated sucessfully";

				}else{
					$data['error'] = "Something went wrong please try again";

				}
			}
			elseif(!empty($check_mobile_no))
			{
				$data['error'] = "Mobile Number alredy exits";
				// $data['error_mobile'] = "Mobile no. alredy exits";	
			}else{
				$data['error'] = "Something went wrong please try again";
			}
		}

		if(!empty($user_id)){
			$where = array('status !='=>3,'id'=>$user_id);
			$data['customer_data'] = $this->Common_model->GetWhere("users",$where);
			if(!empty($data['customer_data']))
			{
				$data['customer_data'] = $data['customer_data'][0];
			}
		}

		$where = array('status !='=>3);
		$data['arealist'] = $this->Common_model->GetWhere("area",$where);
		$this->load->view('admin/header');
		$this->load->view('admin/AddCustomer',$data);
		$this->load->view('admin/footer');
	}

	public function shoplist()
	{
		$where = array('status !='=>3);
		$data['shop_data'] = $this->Common_model->getAllRecordsOrderById("shops",'shop_id','DESC',$where);
		$this->load->view('admin/header');
		$this->load->view('admin/shoplist',$data);
		$this->load->view('admin/footer');
	}

	public function addShop($shop_id = false){
		$data = array();
		$data['error_email'] = "";
		$data['success'] = "";
		$data['error'] = "";
		$data['shop_data'] = "";
		$shop_data = "";
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
			}

			if(isset($filearray['shop_logo'])) {
				$user_data['shop_logo'] = $filearray['shop_logo'];
			}
			$result_id = $this->Common_model->updateRecords('shops',$user_data,array('shop_id'=>$shop_id));
			if($result_id){
				// $data['success'] = "Shop has been updated sucessfully";
				$this->session->set_flashdata('addshop_success', 'Shop has been updated sucessfully');
				redirect(base_url().'admin/shoplist?shop_id='.$shop_id);

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
// 		print_r($data['shop_data']);die;
		$this->load->view('admin/header');
		$this->load->view('admin/addShop',$data);
		$this->load->view('admin/footer');
	}

	public function shopdetail($shop_id = false){
		$data = array();
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
		$this->load->view('admin/header');
		$this->load->view('admin/shopdetail',$data);
		$this->load->view('admin/footer');
	}

	function uploadfile($key)
	{
		$message = array();
		$data = array();
		
		if($_FILES[$key]['size'] > 0)
		{
			$config = array(
				'upload_path' => "./uploads/",
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
			//$data = array('upload_data' => $this->upload->data());
				$uploadData = $this->upload->data();
				//$this->resizeImage($uploadData['file_name']);
				$image_name = $uploadData['file_name'];
				return $image_name;
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}
		else
		{
			return 'Your uploaded image file is blank.';
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

	function uploadcategoryfile($key)
	{
		$message = array();
		$data = array();
		if($_FILES[$key]['size'] > 0)
		{
			$config = array(
				'upload_path' => "./uploads/category/",
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
			//$data = array('upload_data' => $this->upload->data());
				$uploadData = $this->upload->data();
				//$this->resizeImage($uploadData['file_name']);
				$image_name = $uploadData['file_name'];
				return $image_name;
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}
		else
		{
			return 'Your uploaded image file is blank.';
		}
	}
	
	function uploadsubcategoryfile($key)
	{
		$message = array();
		$data = array();
		if($_FILES[$key]['size'] > 0)
		{
			$config = array(
				'upload_path' => "./uploads/subcategory/",
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
			//$data = array('upload_data' => $this->upload->data());
				$uploadData = $this->upload->data();
				//$this->resizeImage($uploadData['file_name']);
				$image_name = $uploadData['file_name'];
				return $image_name;
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}
		else
		{
			return 'Your uploaded image file is blank.';
		}
	}
	
	function uploadsubsubcategoryfile($key)
	{
		$message = array();
		$data = array();
		if($_FILES[$key]['size'] > 0)
		{
			$config = array(
				'upload_path' => "./uploads/subsubcategory/",
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
			//$data = array('upload_data' => $this->upload->data());
				$uploadData = $this->upload->data();
				//$this->resizeImage($uploadData['file_name']);
				$image_name = $uploadData['file_name'];
				return $image_name;
			}
			else
			{
				echo $this->upload->display_errors();
			}
		}
		else
		{
			return 'Your uploaded image file is blank.';
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

    public function createCode($table,$column_name)
	{

        $jc = ""; 
		$jay = createRandomCode();
		$js = $this->Common_model->getSingleRecordById($table,array($column_name => $jay));
		if(!empty($js))
		{

          $jc = $this->createCode($table,$column_name);
		}else
		{

          $jc = $jay;
		}
		return $jc;
    }

	public function logout()
	{
		// $this->session->sess_destroy();
		$this->session->unset_userdata(ADMIN_SESSION);
		redirect(base_url('admin'),'refresh');
	}

	public function deliveryBoylist()
	{
		$where = array('status !='=>3);
		$data['customer_data'] = $this->Common_model->getAllRecordsOrderById("deliveryboys",'id','DESC',$where);
		$this->load->view('admin/header');
		$this->load->view('admin/deliveryBoylist',$data);
		$this->load->view('admin/footer');
	}

	public function AddDeliveryboy($user_id = ""){

		$data = array();
		$data['error_email'] = "";
		$data['success'] = "";
		$data['error'] = "";
		$data['customer_data'] = "";
		if(isset($_POST['submit']))
		{
			// print_r($_POST);
			$user_data = $_POST;
			$password = $user_data['password'];
			unset($user_data['submit']);
			unset($user_data['password']);
			$user_data['password'] = md5($password);
			$user_data['show_password'] = $password;
			$email = $user_data['email'];
			$mobile_no = $user_data['mobile_no'];
			$check_mobile_no = $this->Common_model->GetWhere('deliveryboys',array('mobile_no'=> $mobile_no));
			if(empty($check_mobile_no))
			{
				// $filearray = array();
				// if (isset($_FILES)) {
				//     //echo '<pre>';print_r($_FILES);die();
				//     $uploadpath = "./uploads/deliveryboy_images/";
				//     foreach ($_FILES as $key => $value) {
				//         //print_r($value['size']);
				//         if($value['size'] > 0) {
				// 			$filearraydata = $this->uploadfilebypath($key,$uploadpath);
				//             $filearray[$key] = $filearraydata;
				//         }else{
				//             $this->session->set_flashdata('error_fileupload', 'File size is empty!');
				//         }
				//     }
				// 	//$post_data = $_POST+$filearray;
				// }

				if (isset($_FILES)){
			    //echo '<pre>';print_r($_FILES);die();
				    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
		        		$uploadpathd = "./uploads/deliveryboy_images/";
		        		$filearrayddata = $this->uploadfilebypath('image',$uploadpathd);
		            	if(isset($filearrayddata)){
							$user_data['image'] = $filearrayddata;
						}
		        	}
		  	
		        	if(isset($_FILES['adhar_image']['name']) && !empty($_FILES['adhar_image']['name'])){
		        		$uploadpatha = "./uploads/deliveryboy_images/adhar_image/";
		        		$filearrayadharimage = $this->uploadfilebypath('adhar_image',$uploadpatha);
		            	if(isset($filearrayadharimage)){
							$user_data['adhar_image'] = $filearrayadharimage;
						}
		        	}
		        	if(isset($_FILES['id_proof_image']['name']) && !empty($_FILES['id_proof_image']['name'])){
		        		$uploadpathid = "./uploads/deliveryboy_images/id_proof_image/";
		        		$filearrayidproogimage = $this->uploadfilebypath('id_proof_image',$uploadpathid);
		            	if(isset($filearrayadharimage)){
							$user_data['id_proof_image'] = $filearrayidproogimage;
						}
		        	}
		        	if(isset($_FILES['cancel_check_images']['name']) && !empty($_FILES['cancel_check_images']['name'])){
		        		$uploadpathcancelcheck = "./uploads/deliveryboy_images/cancel_check_images/";
		        		$filearraycancelcheck = $this->uploadfilebypath('cancel_check_images',$uploadpathcancelcheck);
		            	if(isset($filearraycancelcheck)){
							$user_data['cancel_check_images'] = $filearraycancelcheck;
						}
		        	}
				}
				// p($user_data);
				// if(isset($filearray['image'])) {
				// 	$user_data['image'] = $filearray['image'];
				// }
				$user_data['id_proof_id'] = $_POST['id_proof_id'];
				$user_data['id_proof_type'] = $_POST['id_proof_type'];
				$user_data['reg_id'] = $this->createCode('deliveryboys','reg_id');
				$user_data['create_date'] = date('Y-m-d H:i:s');
				$result_id = $this->Common_model->addrecords('deliveryboys',$user_data);
				//die;
				if($result_id){
					$data['success'] = "Delivery Boy has been added sucessfully";
					redirect(base_url().'admin/deliveryBoylist');
				}else{
					$data['error'] = "Something went wrong please try again";
				}
			}elseif(!empty($check_mobile_no)){
				$data['error_email'] = "Mobile Number alredy exits";	
			}else{
				$data['error'] = "Something went wrong please try again";

			}
			$data['customer_data'] = $user_data;
		}
		if(isset($_POST['update']))
		{
			$user_data = $_POST;
			$user_id = $user_data['id'];
			unset($user_data['update']);
			$password = $user_data['password'];
			unset($user_data['password']);
			if(isset($password)&& !empty($password))
			{
				$user_data['password'] = md5($password);
				$user_data['show_password'] = $password;
			}
			$email = $user_data['email'];
			$mobile_no = $user_data['mobile_no'];
			$check_mobile_no = $this->Common_model->GetWhere('deliveryboys',array('mobile_no'=> $mobile_no,'id !='=> $user_id));
			if(empty($check_mobile_no))
			{
				if (isset($_FILES)){
			    //echo '<pre>';print_r($_FILES);die();
				    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
		        		$uploadpathd = "./uploads/deliveryboy_images/";
		        		$filearrayddata = $this->uploadfilebypath('image',$uploadpathd);
		            	if(isset($filearrayddata)){
							$user_data['image'] = $filearrayddata;
						}
		        	}
		        	
		        	if(isset($_FILES['adhar_image']['name']) && !empty($_FILES['adhar_image']['name'])){
		        		$uploadpatha = "./uploads/deliveryboy_images/adhar_image/";
		        		$filearrayadharimage = $this->uploadfilebypath('adhar_image',$uploadpatha);
		            	if(isset($filearrayadharimage)){
							$user_data['adhar_image'] = $filearrayadharimage;
						}
		        	}
		        	if(isset($_FILES['id_proof_image']['name']) && !empty($_FILES['id_proof_image']['name'])){
		        		$uploadpathid = "./uploads/deliveryboy_images/id_proof_image/";
		        		$filearrayidproogimage = $this->uploadfilebypath('id_proof_image',$uploadpathid);
		            	if(isset($filearrayadharimage)){
							$user_data['id_proof_image'] = $filearrayidproogimage;
						}
		        	}
		        	if(isset($_FILES['cancel_check_images']['name']) && !empty($_FILES['cancel_check_images']['name'])){
		        		$uploadpathcancelcheck = "./uploads/deliveryboy_images/cancel_check_images/";
		        		$filearraycancelcheck = $this->uploadfilebypath('cancel_check_images',$uploadpathcancelcheck);
		            	if(isset($filearraycancelcheck)){
							$user_data['cancel_check_images'] = $filearraycancelcheck;
						}
		        	}
				}
				$user_data['id_proof_id'] = $_POST['id_proof_id'];
				$user_data['id_proof_type'] = $_POST['id_proof_type'];
				$result = $this->Common_model->updateRecords('deliveryboys',$user_data,array('id'=>$user_id));
				if($result)
				{
					$data['success'] = "Delivery Boy has been Updated sucessfully";

				}else{
					$data['error'] = "Something went wrong please try again";

				}
			}
			elseif(!empty($check_mobile_no))
			{
				$data['error'] = "Something went wrong please try again";
				$data['error_email'] = "Mobile no. alredy exits";	
			}else{
				$data['error'] = "Something went wrong please try again";
			}
		}
		if(!empty($user_id)){
			$where = array('status !='=>3,'id'=>$user_id);
			$data['customer_data'] = $this->Common_model->GetWhere("deliveryboys",$where);
			if(!empty($data['customer_data']))
			{
				$data['customer_data'] = $data['customer_data'][0];
			}
		}

		$where = array('status !='=>3);
		$data['arealist'] = $this->Common_model->GetWhere("area",$where);
		$this->load->view('admin/header');
		$this->load->view('admin/AddDeliveryboy',$data);
		$this->load->view('admin/footer');
	}

	public function support_ticket(){
        //$user_id = customersessionid();
        $user_type = $_GET['user_type'];
        

        $data = array();
		if($this->input->get('per_page'))
		{
			$page = $this->input->get('per_page');
		}else{
			$page=0;
		}
		
		$whr = array();
		$whr[] = "status != 3";
		$whr[] = "user_type = '".$user_type."'";
		
		$orderby = " LIMIT " .$page.", ".total_per_page;
		$where = " WHERE ".implode(" AND ", $whr);
    	$data['support'] = $this->Common_model->getwherecustome('support_ticket',$where,$orderby);
		$data['pagination'] = $this->Common_model->getwhrcountbycol('support_ticket','ticket_id',$where); 
		//$data['totalorderamount'] = $this->Common_model->getWhrOrderssum('o.total',$where);

    	$url = base_url()."admin/support_ticket".(isset($_GET['user_type']) ? "?user_type=".trim($_GET['user_type'])."" : '');
		$data["links"] = $this->pagination($url,$data['pagination'],$this->input->get('per_page'),total_per_page);
        $this->load->view('admin/header');
        $this->load->view('admin/support_ticket',$data);
        $this->load->view('admin/footer');   
    }

	public function submitmessage(){
        if(isset($_REQUEST['message']) && !empty($_REQUEST['message']) && !empty($_REQUEST['ticket_id']))
        {
            $user_id = 1;
            $id = base64_decode($_REQUEST['ticket_id']);
            $sdata = $this->Common_model->getSingleRecordById('support_ticket',array('ticket_id' => $id));

            $insert_data = array();
            $insert_data["ticket_id"] = $id;
            $insert_data["from_id"] = 1;
            $insert_data["to_id"] = $sdata['user_id'];
            $insert_data["user_type"] = 'admin';
            $insert_data["message"] = $_POST["message"];
            $insert_data['create_date'] = date('Y-m-d H:i:s');

            $result = $this->Common_model->addRecords('support_message',$insert_data);
            exit();
        }
    }

    public function support_chat()
	{
		$data = array();
        $user_id = customersessionid();
        $id = base64_decode($_GET['ticket_id']);
		$data['support'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));
		$this->load->view('admin/header');
		$this->load->view('admin/user_chat',$data);
		$this->load->view('admin/footer');
	}

	public function shop_chat()
	{
		$data = array();
        $user_id = customersessionid();
        $id = base64_decode($_GET['ticket_id']);
		$data['support'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));
		// print_r($data);
		// die;
		$this->load->view('admin/header');
		$this->load->view('admin/shop_chat',$data);
		$this->load->view('admin/footer');
	}

	public function delivery_boy_chat()
	{
		$data = array();
        $user_id = customersessionid();
        $id = base64_decode($_GET['ticket_id']);
		$data['support'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));
		$this->load->view('admin/header');
		$this->load->view('admin/delivery_boy_chat',$data);
		$this->load->view('admin/footer');
	} 

	public function support_chat_message(){
    	$id = base64_decode($_POST['ticket_id']);
    	$data = array();
    	$data['support'] = $this->Common_model->getWhereData('support_message',array('ticket_id'=>$id));
        // print_r($data['support']);
    	$this->load->view('admin/support_chat_message',$data);
    	// exit();
    }

    public function testimonial()
	{
        $data = array();
		$data['area_data'] = $this->Common_model->GetWhere('testimonial', $data);
		$this->load->view('admin/header');
		$this->load->view('admin/testimonial',$data);
		$this->load->view('admin/footer');
	}
	
	public function seller_agreement($id = "")
	{
        $data = array();
        if(isset($_POST) && !empty($_POST)){
			$insert_data = array();
			$insert_data['title'] = $_POST["title"];
		    $insert_data['editor1'] = $_POST["editor1"];
		  	$insert_data['create_date'] = date('Y-m-d h:i:s');
			
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				$result_id = $this->Common_model->updateRecords('seller_agreement',$insert_data,array('id'=>$_POST['id']));
			}else{
				$result_id = $this->Common_model->addRecords('seller_agreement',$insert_data);
			}
		}
		$whr = array('id'=>1);
		$data['seller_data'] = $this->Common_model->getSingleRecordById('seller_agreement', $whr);
// 		$data['seller_data'] = $this->Common_model->GetWhere('seller_agreement',$data);
		$this->load->view('admin/header');
		$this->load->view('admin/seller_agreement',$data);
		$this->load->view('admin/footer');
	}
	
	public function user_agreement($id = "")
	{
        $data = array();
		if(isset($_POST) && !empty($_POST)){
			$insert_data = array();
			$insert_data['title'] = $_POST["title"];
		    $insert_data['editor1'] = $_POST["editor1"];
		  	$insert_data['create_date'] = date('Y-m-d h:i:s');
			
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				$result_id = $this->Common_model->updateRecords('user_agreement',$insert_data,array('id'=>$_POST['id']));
			}else{
				$result_id = $this->Common_model->addRecords('user_agreement',$insert_data);
			}
		}
	
		$whr = array('id'=>1);
		$data['seller_data'] = $this->Common_model->getSingleRecordById('user_agreement', $whr);
		
		$this->load->view('admin/header');
		$this->load->view('admin/user_agreement',$data);
		$this->load->view('admin/footer');
	}
	
	public function aboutus($id = "")
	{
        $data = array();
		if(isset($_POST) && !empty($_POST)){
			$insert_data = array();
			$insert_data['title'] = $_POST["title"];
		    $insert_data['editor1'] = $_POST["editor1"];
		  	$insert_data['create_date'] = date('Y-m-d h:i:s');
			
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				$result_id = $this->Common_model->updateRecords('aboutus',$insert_data,array('id'=>$_POST['id']));
			}else{
				$result_id = $this->Common_model->addRecords('aboutus',$insert_data);
			}
		}
	
		$whr = array('id'=>1);
		$data['seller_data'] = $this->Common_model->getSingleRecordById('aboutus', $whr);
		
		$this->load->view('admin/header');
		$this->load->view('admin/aboutus',$data);
		$this->load->view('admin/footer');
	}

	 public function brand_logo()
	{
        $data = array();
		$data['area_data'] = $this->Common_model->GetWhere('brand_logo', $data);
		$this->load->view('admin/header');
		$this->load->view('admin/brand_logo',$data);
		$this->load->view('admin/footer');
	}

	public function add_testimonial($id = ""){
		$data = array();
		if(isset($_POST) && !empty($_POST)){
			$insert_data = array();
			$insert_data['name'] = $_POST["name"];
			$insert_data['description'] = $_POST["description"];
		 	   	//echo '<pre>';print_r($_FILES);die();
		    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
	  	      		$uploadpathd = "./uploads/testimonial_image/";
  		      		$filearrayddata = $this->uploadfilebypath('image',$uploadpathd);
  		          	if(isset($filearrayddata)){
					$insert_data['image'] = $filearrayddata;
					}
  		    }
		  	$insert_data['create_date'] = date('Y-m-d h:i:s');
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				$result_id = $this->Common_model->updateRecords('testimonial',$insert_data,array('id'=>$_POST['id']));
			}else{
				$result_id = $this->Common_model->addRecords('testimonial',$insert_data);
			}
			if($result_id)
			{
				$data['success'] = "Added successfully";
				redirect(base_url().'admin/testimonial/');
			}else{
				$data['error'] = "Some thing went wrong please try again";
			}  	
		// $data['area_data'] = "";testimonial_image
		}
		$whr = array('id'=>$id);
		$data['area_data'] = $this->Common_model->getSingleRecordById('testimonial', $whr);
		$this->load->view('admin/header');
		$this->load->view('admin/add_testimonial',$data);
		$this->load->view('admin/footer');
	}

	public function add_brand_logo($id = "")
	{
		$data = array();
		if(isset($_POST) && !empty($_POST)){
			$insert_data = array();
			$insert_data['name'] = $_POST["name"];
			   	//echo '<pre>';print_r($_FILES);die();
		    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
	  	      		$uploadpathd = "./uploads/brand_image/";
  		      		$filearrayddata = $this->uploadfilebypath('image',$uploadpathd);
  		          	if(isset($filearrayddata)){
					$insert_data['image'] = $filearrayddata;
					}
  		    }
		  	$insert_data['create_date'] = date('Y-m-d h:i:s');
			
			if (isset($_POST['id']) &&  !empty($_POST['id'])){
				$result_id = $this->Common_model->updateRecords('brand_logo',$insert_data,array('id'=>$_POST['id']));
			}else{
				$result_id = $this->Common_model->addRecords('brand_logo',$insert_data);
			}
			if($result_id)
			{
				$data['success'] = "Added successfully";
				redirect(base_url().'admin/brand_logo/');
			}else{
				$data['error'] = "Some thing went wrong please try again";
			}  	
		// $data['area_data'] = "";testimonial_image
		}
	    $whr = array('id'=>$id);
		$data['area_data'] = $this->Common_model->getSingleRecordById('brand_logo', $whr);
		$this->load->view('admin/header');
		$this->load->view('admin/add_brand_logo',$data);
		$this->load->view('admin/footer');
	}

	public function deleteRecord()   
    {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $colwhr = $_POST['colwhr'];
      	$this->Common_model->deleteRecords($table,array($colwhr=>$id));
      	$msg = array('status'=>1, 'msg'=>'Deleted successfully!');
		echo json_encode($msg);
		exit();
     	// redirect(base_url().'admin/Service_list', 'refresh');
    }
}