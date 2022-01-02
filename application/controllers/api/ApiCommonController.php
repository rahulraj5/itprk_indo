<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class ApiCommonController extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    /**
     * Get All  product category list.
     *
     * @return Response
    */
	public function product_category_list_get()
	{
        
        $product_categorys = $this->db->get("categories")->result();
        foreach($product_categorys as $product_category){
            $product_category_array['categories_id'] = $product_category->categories_id;
            $product_category_array['category_name'] = $product_category->category_name;
            $product_category_array['category_percentage'] = $product_category->category_percentage;
            $product_category_array['parent_category_id'] = $product_category->parent_category_id;
            $product_category_array['parent_sub_category_id'] = $product_category->parent_sub_category_id;
            if($product_category->category_image != ''){
                $product_category_array['category_image'] = base_url().'uploads/category/'.$product_category->category_image;
            }else{
                $product_category_array['category_image'] = '';
            }
            $product_category_array['status'] = $product_category->status;
            $product_category_array['create_date'] = $product_category->create_date;
            $product_category_array['modify_date'] = $product_category->modify_date;
            $data[] = $product_category_array;
        }
        if($data){
            $this->response(['success' => true,'message'=>"Product category found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
     
    }
    
    /**
     * Get All featured product list.
     *
     * @return Response
    */
	public function featured_product_list_get()
	{
        $featured_products = $this->db->get_where("product", ['featured_status' => 1])->result();
        foreach($featured_products as $super_sell_product){
            $featured_array['product_id'] = $super_sell_product->product_id;
            $featured_array['product_reg_id'] = $super_sell_product->product_reg_id;
            $featured_array['shop_id'] = $super_sell_product->shop_id;
            $featured_array['categories_id'] = $super_sell_product->categories_id;
            $featured_array['sub_categories_id'] = $super_sell_product->sub_categories_id;
            $featured_array['name'] = $super_sell_product->name;
            $featured_array['description'] = $super_sell_product->description;
            $featured_array['quantity'] = $super_sell_product->quantity;
            $featured_array['unit_price'] = $super_sell_product->unit_price;
            $featured_array['discount'] = $super_sell_product->discount;
            $featured_array['discount_type'] = $super_sell_product->discount_type;
            $featured_array['colors'] = $super_sell_product->colors;
            $featured_array['choice_options'] = $super_sell_product->choice_options;
            $featured_array['variations'] = $super_sell_product->variations;
            $featured_array['unit'] = $super_sell_product->unit;
            $featured_array['return_policy'] = $super_sell_product->return_policy;
            foreach(json_decode($super_sell_product->product_images) as $product_image){
                $product_images = base_url().'uploads/product_images/'.$product_image;
                $product_img[] = json_decode($product_images);
            }
            $featured_array['product_images'] = $product_img;
            $featured_array['main_image'] = base_url().'uploads/product_images/'.$super_sell_product->main_image;
            $featured_array['tags'] = $super_sell_product->tags;
            $featured_array['meta_title'] = $super_sell_product->meta_title;
            $featured_array['meta_image'] = $super_sell_product->meta_image;
            $featured_array['num_of_sale'] = $super_sell_product->num_of_sale;
            $featured_array['status'] = $super_sell_product->status;
            $featured_array['featured_status'] = $super_sell_product->featured_status;
            $featured_array['bestseller_status'] = $super_sell_product->bestseller_status;
            $featured_array['clearance_status'] = $super_sell_product->clearance_status;
            $featured_array['create_date'] = $super_sell_product->create_date;
            $data[] = $featured_array;
        }

        if($data){
            $this->response(['success' => true,'message'=>"Featured product found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * Get All best seller products
     *
     * @return Response
    */
	public function best_seller_products_get()
	{
        $best_sellers = $this->db->get_where("product", ['bestseller_status' => 1, 'status' => 1])->result_array();
        foreach($best_sellers as $best_seller){
            $best_seller_array['product_id'] = $best_seller['product_id'];
            $best_seller_array['product_reg_id'] = $best_seller['product_reg_id'];
            $best_seller_array['shop_id'] = $best_seller['shop_id'];
            $best_seller_array['categories_id'] = $best_seller['categories_id'];
            $best_seller_array['sub_categories_id'] = $best_seller['sub_categories_id'];
            $best_seller_array['name'] = $best_seller['name'];
            $best_seller_array['description'] = $best_seller['description'];
            $best_seller_array['quantity'] = $best_seller['quantity'];
            $best_seller_array['unit_price'] = $best_seller['unit_price'];
            $best_seller_array['discount'] = $best_seller['discount'];
            $best_seller_array['discount_type'] = $best_seller['discount_type'];
            $best_seller_array['colors'] = $best_seller['colors'];
            $best_seller_array['choice_options'] = $best_seller['choice_options'];
            $best_seller_array['variations'] = $best_seller['variations'];
            $best_seller_array['unit'] = $best_seller['unit'];
            $best_seller_array['return_policy'] = $best_seller['return_policy'];
            foreach(json_decode($best_seller['product_images']) as $product_image){
                $product_images = base_url().'uploads/product_images/'.$product_image;
                $product_img[] = $product_images;
            }
            $best_seller_array['product_images'] = json_encode($product_img);
            $best_seller_array['main_image'] = base_url().'uploads/product_images/'.$best_seller['main_image'];
            $best_seller_array['tags'] = $best_seller['tags'];
            $best_seller_array['meta_title'] = $best_seller['meta_title'];
            $best_seller_array['meta_image'] = $best_seller['meta_image'];
            $best_seller_array['num_of_sale'] = $best_seller['num_of_sale'];
            $best_seller_array['status'] = $best_seller['status'];
            $best_seller_array['featured_status'] = $best_seller['featured_status'];
            $best_seller_array['bestseller_status'] = $best_seller['bestseller_status'];
            $best_seller_array['clearance_status'] = $best_seller['clearance_status'];
            $best_seller_array['create_date'] = $best_seller['create_date'];
            $data[] = $best_seller_array;
        }
        if($data){
            $this->response(['success' => true,'message'=>"Best Seller found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * Get All trending product list
     *
     * @return Response
    */
	public function trending_product_list_get()
	{
        $trending_products = $this->Common_model->getLatestRecords("product",'num_of_sale',10);
        foreach($trending_products as $trending_product){
            $trending_product_array['product_id'] = $trending_product['product_id'];
            $trending_product_array['product_reg_id'] = $trending_product['product_reg_id'];
            $trending_product_array['shop_id'] = $trending_product['shop_id'];
            $trending_product_array['categories_id'] = $trending_product['categories_id'];
            $trending_product_array['sub_categories_id'] = $trending_product['sub_categories_id'];
            $trending_product_array['name'] = $trending_product['name'];
            $trending_product_array['description'] = $trending_product['description'];
            $trending_product_array['quantity'] = $trending_product['quantity'];
            $trending_product_array['unit_price'] = $trending_product['unit_price'];
            $trending_product_array['discount'] = $trending_product['discount'];
            $trending_product_array['discount_type'] = $trending_product['discount_type'];
            $trending_product_array['colors'] = $trending_product['colors'];
            $trending_product_array['choice_options'] = $trending_product['choice_options'];
            $trending_product_array['variations'] = $trending_product['variations'];
            $trending_product_array['unit'] = $trending_product['unit'];
            $trending_product_array['return_policy'] = $trending_product['return_policy'];
            if(!empty(json_decode($trending_product['product_images']))){
                foreach(json_decode($trending_product['product_images']) as $product_image){
                    $product_images = base_url().'uploads/product_images'.$product_image;
                    $product_img[] = $product_images;
                }
                $trending_product_array['product_images'] = json_encode($product_img);
            }else{
                $trending_product_array['product_images'] = '';
            }
            $trending_product_array['main_image'] = base_url().'uploads/product_images/'.$trending_product['main_image'];
            $trending_product_array['tags'] = $trending_product['tags'];
            $trending_product_array['meta_title'] = $trending_product['meta_title'];
            $trending_product_array['meta_image'] = $trending_product['meta_image'];
            $trending_product_array['num_of_sale'] = $trending_product['num_of_sale'];
            $trending_product_array['status'] = $trending_product['status'];
            $trending_product_array['featured_status'] = $trending_product['featured_status'];
            $trending_product_array['bestseller_status'] = $trending_product['bestseller_status'];
            $trending_product_array['clearance_status'] = $trending_product['clearance_status'];
            $trending_product_array['create_date'] = $trending_product['create_date'];
            $data[] = $trending_product_array;
        }
        if($data){
            $this->response(['success' => true,'message'=>"Trending product found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * Get All super sell product list
     *
     * @return Response
    */
	public function super_sell_product_list_get()
	{
        $super_sell_products = $this->Common_model->getAllRecordsByLimitId("product",['clearance_status' => 1, 'status' => 1], 10);
        foreach($super_sell_products as $super_sell_product){
            $super_sell_array['product_id'] = $super_sell_product['product_id'];
            $super_sell_array['product_reg_id'] = $super_sell_product['product_reg_id'];
            $super_sell_array['shop_id'] = $super_sell_product['shop_id'];
            $super_sell_array['categories_id'] = $super_sell_product['categories_id'];
            $super_sell_array['sub_categories_id'] = $super_sell_product['sub_categories_id'];
            $super_sell_array['name'] = $super_sell_product['name'];
            $super_sell_array['description'] = $super_sell_product['description'];
            $super_sell_array['quantity'] = $super_sell_product['quantity'];
            $super_sell_array['unit_price'] = $super_sell_product['unit_price'];
            $super_sell_array['discount'] = $super_sell_product['discount'];
            $super_sell_array['discount_type'] = $super_sell_product['discount_type'];
            $super_sell_array['colors'] = $super_sell_product['colors'];
            $super_sell_array['choice_options'] = $super_sell_product['choice_options'];
            $super_sell_array['variations'] = $super_sell_product['variations'];
            $super_sell_array['unit'] = $super_sell_product['unit'];
            $super_sell_array['return_policy'] = $super_sell_product['return_policy'];
            foreach(json_decode($super_sell_product['product_images']) as $product_image){
                $product_images = base_url().'uploads/product_images/'.$product_image;
                $product_img[] = $product_images;
            }
            $super_sell_array['product_images'] = json_encode($product_img);
            $super_sell_array['main_image'] = base_url().'uploads/product_images/'.$super_sell_product['main_image'];
            $super_sell_array['tags'] = $super_sell_product['tags'];
            $super_sell_array['meta_title'] = $super_sell_product['meta_title'];
            $super_sell_array['meta_image'] = $super_sell_product['meta_image'];
            $super_sell_array['num_of_sale'] = $super_sell_product['num_of_sale'];
            $super_sell_array['status'] = $super_sell_product['status'];
            $super_sell_array['featured_status'] = $super_sell_product['featured_status'];
            $super_sell_array['bestseller_status'] = $super_sell_product['bestseller_status'];
            $super_sell_array['clearance_status'] = $super_sell_product['clearance_status'];
            $super_sell_array['create_date'] = $super_sell_product['create_date'];
            $data[] = $super_sell_array;
        }
        if($data){
            $this->response(['success' => true,'message'=>"Super sell found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * Get common images
     *
     * @return Response
    */
	public function common_images_get()
	{
        $common_images = $this->db->get_where("common_setting", ['status' => 1])->result();

        foreach($common_images as $common_image){

            if($common_image->option_name == 'backedn_login_background_image'){
                $data['background_image'] = base_url().'/uploads/'.$common_image->option_value;
            }

            if($common_image->option_name == 'backlogo'){
                $data['background_logo'] = base_url().'/uploads/'.$common_image->option_value;
            }

            if($common_image->option_name == 'backedn_login_background_image'){
                $data['front_logo'] = base_url().'/uploads/'.$common_image->option_value;
            }
        }
        if($data){
            $this->response(['success' => true,'message'=>"Super sell found successfully.",'data'=>$data], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    /**
     * Get Banner images
     *
     * @return Response
    */
	public function banner_slider_images_get()
	{
        $banner_slider_images = $this->db->get_where("homebannerslider", ['status' => 1])->result();
        foreach($banner_slider_images as $banner_slider_image){
            $data['title'] = $banner_slider_image->title;
            $data['slider_image'] = base_url().'uploads/homebannerslider/'.$banner_slider_image->image;
            $data['link'] = $banner_slider_image->link;
            $slider_images[]           = $data;
        }
        if($slider_images){
            $this->response(['success' => true,'message'=>"banner slider images found successfully.",'data'=>$slider_images], REST_Controller::HTTP_OK);
        }else{
            
            $this->response(['success' => false,'message'=>"Record not found.",'data'=>''], REST_Controller::HTTP_NOT_FOUND);
        }
	}
    	
}