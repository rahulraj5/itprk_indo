<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model {
	function getAllRecords($table){
		$query = $this->db->get($table);
		return $query->result_array();
	}

	function getSingleRecordById($table,$conditions){
		$query = $this->db->get_where($table,$conditions);
		return $query->row_array();
	}

	function geRandomString($length = 4){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function getAllRecordsById($table,$conditions){
		$query = $this->db->get_where($table,$conditions);
		return $query->result_array();
	}

	function getwhere($table,$conditions)
	{
		$query = $this->db->get_where($table,$conditions);
		return $query->result_array();
		//$this->db->last_query(); //die;
	}

	function getAllRecordsOrderById($table, $field, $short, $conditions){

		$this->db->order_by($field, $short);

		$query = $this->db->get_where($table,$conditions);

		return $query->result_array();
	}

	function addRecords($table,$post_data){
		$this->db->insert($table,$post_data); 
		return $this->db->insert_id();
	}

	function insertMultiple($table, $data){
		$this->db->insert_batch($table, $data); 
	}

	function updateRecords($table, $post_data, $where_condition){
		$this->db->where($where_condition);
		return $this->db->update($table, $post_data); 
	}

	public function updateData($tab,$data,$whr){

		$this->db->update($tab,$data,$whr);
		//echo $this->db->last_query(); die();
		return true;
	}

	function deleteRecords($table,$where_condition){
		$this->db->where($where_condition);
		return $this->db->delete($table);
	}
	
	

	function getSingleData($tab,$whr){
		$result = $this->db->get_where($tab,$whr)->row_array();
		return $result;
	}

	function getPaginateRecords($table, $result, $offset = 0){
		$query = $this->db->get($table,$result,$offset);
		return $query->result_array();
	}

	function getPaginateRecordsByConditions($table, $result, $offset=0, $condition){
		$query = $this->db->get_where($table, $condition, $result, $offset);
		return $query->result_array();
	}

	function getPaginateRecordsByLikeConditions($table, $result, $offset=0, $condition, $like_field, $like_value){
		$this->db->like($like_field, $like_value);
		$query = $this->db->get_where($table, $condition, $result, $offset);
		return $query->result_array();
	}

	function getTotalRecords($table){
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	function getTotalRecordsByIdLike($table, $condition, $like_field, $like_value){
		$this->db->like($like_field, $like_value);
		$query = $this->db->get_where($table, $condition);
		return $query->num_rows();
	}

	function getPaginateRecordsByCondition($table,$result,$offset=0,$where_condition,$condition){
		$this->db->where($where_condition,$condition);
		$query = $this->db->get($table,$result,$offset);
		return $query->result_array();
	}

	function getPaginateRecordsByOrderByCondition($table, $field, $short, $result, $offset=0, $condition){
		$this->db->where($condition);
		$this->db->order_by($field, $short);
		$query = $this->db->get($table,$result,$offset);
		return $query->result_array();
	}
	
	function getTotalRecordsByCondition($table, $condition)
	{

	    $this->db->where($condition);

		$query = $this->db->get($table);

		return $query->num_rows();

	}

	function fetchMaxRecord($table,$field)

	{

		$this->db->select_max($field,'max');

        $query = $this->db->get($table);

		return $query->row_array();	

	}

	function fetchRecordsByOrder($table,$field,$sort)

	{

	    $this->db->order_by($field,$sort);

		$query = $this->db->get($table);

		return $query->result_array();

	}			

	function getAllRecordsByLimitId($table,$conditions,$limit)

	{

	    $this->db->limit($limit);

		$query = $this->db->get_where($table,$conditions);

		return $query->result_array();

	}

	function getLatestRecords($table,$date,$limit)

	{
	    $this->db->order_by($date,'desc');

	    $this->db->limit($limit);

		$query = $this->db->get($table);

		return $query->result_array();

	}

	function getRelatedRecords($table,$date,$conditions)

	{

	    $this->db->order_by($date,'desc');

	    $this->db->limit(4);

		$query = $this->db->get_where($table,$conditions);

		return $query->result_array();

	}

	function getAscLatestRecords($table,$date,$limit)

	{

	    $this->db->order_by($date,'asc');

	    $this->db->limit($limit);

		$query = $this->db->get($table);

		return $query->result_array();

	}

	function getLimitedRecords($table,$limit)

	{

	    $this->db->limit($limit);

		$query = $this->db->get($table);

		return $query->result_array();

	}

	function getRecordCount($table, $where_condition) 

	{

	    $this->db->where($where_condition);

		$query = $this->db->get($table);

		$rd = $query->num_rows();

		// echo $this->db->last_query(); die();

		return $rd;

	}

	function getSingleRecord($table,$conditions)

	{

		// $this->db->order_by('id','desc');

	   	$query = $this->db->get_where($table,$conditions);

	   	return $query->row_array();

	}

	function getAllRecordsByIdDes($table)

	{

		$this->db->order_by('id','desc');

	   	$query = $this->db->get($table);

	   	return $query->result_array();

	}

    function getWhereDataByCol($tab,$whr,$col){

		$this->db->select($col);

		$result = $this->db->get_where($tab,$whr)->row_array();

		//echo $this->db->last_query(); die();

		return $result[$col];

	}

	function getWhereDatanew($tab,$whr,$col=false,$limit=false){

	 	if($col){

			$this->db->select($col);

		}

		if($limit){

			$this->db->limit($limit);

		}

		$result = $this->db->get_where($tab,$whr)->result_array();

		//echo $this->db->last_query(); die();

		return $result;

	}

	public function getWhereData($tab,$whr)

	{

		$result = $this->db->get_where($tab,$whr)->result_array();

		//echo $this->db->last_query(); die();

		return $result;

	}

	function uploadfile($key)

	{

	    $message = array();

	    if($_FILES[$key]['size'] > 0)

	    {

	    $config = array(

	            'upload_path' => "./uploads/",

	            'allowed_types' => "gif|jpg|png|jpeg",

	            /*'overwrite' => TRUE*/

	            'max_size' => 500,

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

	            $image_name = $uploadData['file_name'];

	            $message['success'] = 'Your uploaded image file is blank.';

	            return $image_name;

	        }

	        else

	        {

	            return $this->upload->display_errors();

	        }

	    }

	    else

	    {

	        return 'Your uploaded image file is blank.';

	    }

	}

	public function getshopsbylatlong($cols,$whr,$user_lat,$user_long,$orderby)

    {

        $sql = "SELECT 

                $cols,

                ( 6371 * acos( cos( radians($user_lat) ) * cos( radians( s.shop_latitude ) ) * 

                cos( radians( s.shop_longitude ) - radians($user_long) ) + sin( radians($user_lat) ) * 

                sin( radians( s.shop_latitude ) ) ) ) AS distance,

                (select avg(sr.rating) as ratings from shopreviewrating as sr where sr.shop_id = s.shop_id) as ratings

                FROM shops as s
               	$whr

               	HAVING distance < 5

                $orderby";

        $result = $this->db->query($sql)->result_array();

        // echo $this->db->last_query(); die;

        return $result;

    }

    public function getOrdersByMonth($whr="")

    {

        $result = $this->db->query("SELECT YEAR(create_date) as year, MONTH(create_date) as month, COUNT(id) as num FROM orders $whr GROUP BY YEAR(create_date), MONTH(create_date) ASC");

        $result = $result->result_array();

        $orders = array();

        $years = array();

        foreach ($result as $res) {

            if (!isset($orders[$res['year']])) {

                for ($i = 1; $i <= 12; $i++) {

                    $orders[$res['year']][$i] = 0;
                }
            }

            $years[] = $res['year'];

            $orders[$res['year']][$res['month']] = $res['num'];

        }

        return array(

            'years' => array_unique($years),

            'orders' => $orders

        );

    }

    public function getshopswhr($cols,$whr,$orderby){

    	$sql = "SELECT 

                $cols,

                (select avg(sr.rating) as ratings from shopreviewrating as sr where sr.shop_id = s.shop_id) as ratings

                FROM shops as s 

               	$whr

                $orderby";

        $result = $this->db->query($sql)->result_array();

        // echo $this->db->last_query(); die;

        return $result;

    }

	public function getwherecustomesingle($table,$whr,$orderby){

		$sql = "SELECT 

				* 

				FROM $table

				$whr

				$orderby";

		$result = $this->db->query($sql)->row_array();

		//echo $this->db->last_query();

		return $result;

	}

	public function getwherecustome($table,$whr,$orderby){

		$sql = "SELECT 

				* 
				FROM $table

				$whr

				$orderby";

		$result = $this->db->query($sql)->result_array();

			//echo $this->db->last_query();

		return $result;

	}

	public function getwherecustomecol($table,$col,$whr,$orderby){

		$sql = "SELECT 

				$col 

				FROM $table

				$whr

				$orderby";

		$result = $this->db->query($sql)->result_array();

			//echo $this->db->last_query();

		return $result;

	}

	public function getwherecustomeuser($whr,$orderby){

		$sql = "SELECT 

				u.*

				FROM users as u
				$whr

				$orderby";

		$result = $this->db->query($sql)->result_array();

		//echo $this->db->last_query();

		return $result;

	}

	public function getwherecustomeusercountrow($whr){

		$sql = "SELECT 

				u.*

				FROM users as u

				$whr";

		$result = $this->db->query($sql)->num_rows();

		//echo $this->db->last_query();

		return $result;

	}

	public function getmaxfromcol($table,$col,$whr){

		$sql = "SELECT 

				max($col) as total

				FROM $table

				$whr";

		$result = $this->db->query($sql)->row_array();

		// echo $this->db->last_query();

		return (isset($result['total']) ? $result['total'] : 0);

	}

	public function getwhrsum($table,$col,$whr){

		//SELECT sum(subtotal) as total FROM txn WHERE DATE(create_date) = CURDATE() and userid = 1

		 $sql = "SELECT 

				sum($col) as total

				FROM $table

				$whr

				";

		$result = $this->db->query($sql)->row_array();

	     //echo $this->db->last_query(); die;
		return (isset($result['total']) ? $result['total'] : 0.00);

	}

	public function getwhrcountcustom($table,$whr){

		$sql = "SELECT 

				count(id) as total

				FROM $table

				$whr";

		$result = $this->db->query($sql)->row_array();

		//echo $this->db->last_query();

		return $result['total'];

	}

	public function getwhrcountbycol($table,$col,$whr){

		$sql = "SELECT 

				count($col) as total

				FROM $table

				$whr";

		$result = $this->db->query($sql)->row_array();

		//echo $this->db->last_query();

		return $result['total'];

	}

	public function GetWheresubcategory($whr){

		$sql = "SELECT c1.*,c2.category_name as parent_category_name

				FROM categories as c1 ,categories as c2

				$whr";

		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query();

		return $result;		

	}
	
	public function GetWheresuboncategory($whr){

		$sql = "SELECT c1.*,c2.category_name as parent_category_name

				FROM categories as c1 ,categories as c2

				$whr";

		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query();

		return $result;		

	}

	public function getwhrcategoiesbycatname($whr){

		$sql = "SELECT *

				FROM categories

				$whr";
		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query(); die;

		return $result;	
	}

	public function getwhrcategoiesbycatid($whr){

		$sql = "SELECT *

				FROM categories

				$whr";

		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query(); die;

		return $result;	
	}

	public function getwhrshopid($whr){

		$sql = "SELECT *

				FROM shops

				$whr";

		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query(); die;

		return $result;	
	}

	public function getwhrclearance($whr){
		$sql = "SELECT

			shop_id 

			FROM product 

			WHERE clearance_status = 1 GROUP BY shop_id";

		$result = $this->db->query($sql)->result_array();

		// echo $this->db->last_query();

		return $result;	
	}	

	public function getwhrcshopidbyproduct($whr){
		$sql = "SELECT
			shop_id 
			FROM product 
			$whr GROUP BY shop_id";
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		return $result;	
	}

	public function getwhrshopclearance($whr){
		$sql = "SELECT
			shop_id 
			FROM shops 
			$whr ";
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		return $result;	
	}		

	public function getwhrclearanceproduct($whr){
		$sql = "SELECT * FROM product $whr";
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		return $result;	
	}			

	public function getwheresingleorder($whr){
		$sql = "SELECT o.*,
				ds.delivery_status_name
				FROM orders as o
				LEFT JOIN delivery_status as ds ON ds.ds_id = o.delivery_status
				$whr";
		$result = $this->db->query($sql)->row_array();
		// echo $this->db->last_query();
		return $result;	
	}

	public function getwhereorders($whr,$orderby){
		$sql = "SELECT o.*,
				ds.delivery_status_name,
				s.shop_reg_id,
				s.shop_name
				FROM orders as o
				LEFT JOIN delivery_status as ds ON ds.ds_id = o.delivery_status
				LEFT JOIN shops as s ON s.shop_id = o.seller_id
				$whr
				$orderby
				";
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query(); die;
		return $result;
	}

    public function getwhrproductrating($where){
		$sql = "SELECT count(rating) as rating FROM productreviewrating $where";
	    
		$result = $this->db->query($sql)->result_array();
// 		echo $this->db->last_query(); die;
		return $result;	
	    
    }
    
    public function getwhrproductratingdetail($where){
		$sql = "SELECT *, floor((rating/5)*100) as ratingper FROM productreviewrating $where";
	    
		$result = $this->db->query($sql)->result_array();
// 		echo $this->db->last_query(); die;
		return $result;	
	    
    }
    
    public function getwhrproductratingaverage($where){
        $sql = "SELECT floor(((avg(rating))/5)*100) as rating
                from productreviewrating

                $where";
                
        $result = $this->db->query($sql)->result_array();
// 		echo $this->db->last_query(); die;
		return $result;	
    }
    
    public function getwhrproductratinguser($where){
        $sql = "SELECT floor((rating/5)*100) as rating
                from productreviewrating

                $where";
                
        $result = $this->db->query($sql)->result_array();
// 		echo $this->db->last_query(); die;
		return $result;	
    }
    
    public function getwhrsubcatgo(){
		$sql = "SELECT * FROM categories where parent_category_id != 0 ";
		$result = $this->db->query($sql)->result_array();
		// echo $this->db->last_query();
		return $result;	
	}

	public function getwhrcountordersbycol($whr){

		$sql = "SELECT 

				count(o.id) as total

				FROM orders as o

				$whr";

		$result = $this->db->query($sql)->row_array();

		//echo $this->db->last_query();

		return $result['total'];

	}

	public function deleteData($tab,$whr)

	{

		$this->db->delete($tab,$whr);

		return true;
	}
}



