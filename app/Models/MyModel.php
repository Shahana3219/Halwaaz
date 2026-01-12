<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Query;

class MyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

// DB CONNECTION 
public function __construct(ConnectionInterface & $db){
        $this->db=&$db;
        //passing value by reference
    }

public function insert_to_tb($tbl_name,$data){
    return $this->db
    ->table($tbl_name)
    ->insert($data);
}
 public function select_data($tbl_name, $columns = '', $condition = [], $keywords = [], $searchColumns = [])
{
    $query=$this->db->table($tbl_name);

    if($columns){
        $query->select($columns);
    }
    else{
        $query->select('*');
    }
    if(!empty($condition)){
        $query->where($condition);
    }
    // If keywords and columns present, apply LIKE condition to 
    // each combination of column and keyword
    if (!empty($keywords) && !empty($searchColumns)) {
        $query->groupStart(); // start parentheses
 //Wrapping orLike() inside groupStart() and groupEnd() ensures that
 //  the search is applied together without affecting the main WHERE status=0.
        foreach ($searchColumns as $column) {
            foreach ($keywords as $keyword) {
                // Apply LIKE condition for each combination of column and keyword
                $query->orLike($column, $keyword);
            }
        }
        $query->groupEnd(); // end parentheses
    }

    // Execute the query and return the results as an array
    return $query->get()->getResultArray();

}

 public function update_data($tbl_name, $data, $condition)
    {
        return $this->db
            ->table($tbl_name)
            ->where($condition)
            ->update($data);
    }


    //ALL items (from all categories)
public function get_items($search = null, $category = null, $priceSort = null, $qtySort = null)
{
    $query = $this->db->table('tbl_items i');
    $query->select('i.id, i.name, i.quantity, i.amount, i.image, c.name AS category');
    $query->join('tbl_category c', 'c.id = i.category', 'left');
    $query->where('i.status',0);
 

    if($search)
    {
       $query->like('i.name',$search); 
    }
    if($category)
    {
        $query->where('i.category',$category);
    }
    if ($priceSort == 'price_asc') 
    {
        $query->orderBy('i.amount', 'ASC');
    }elseif ($priceSort == 'price_desc') 
    {
        $query->orderBy('i.amount', 'DESC');
    }

    if ($qtySort == 'qty_asc') 
    {
        $query->orderBy('i.quantity', 'ASC');
    } elseif ($qtySort == 'qty_desc') 
    {
        $query->orderBy('i.quantity', 'DESC');
    }
    // Log the SQL query for debugging
    log_message('debug', 'Executed SQL: ' . $this->db->getLastQuery());
    return $query->get()->getResultArray();
}
   

            //ONLY items of ONE category
public function get_item_by_category($categoryId)
{
    $query=$this->db->table('tbl_items i');
    $query->select('i.id,i.name,i.quantity,i.amount,i.image,c.name AS category_name ');
    $query->join('tbl_category c','c.id=i.category','left');
    $query->where('i.category',$categoryId);
    $query->where(['i.status'=>0]);
    
    return $query->get()->getResultArray();

}

       ///user cart items listing
public function user_cartitems($userid){
    return $this->db
    ->table('tbl_cart c')
    ->select(
        'c.id AS cart_id,
        c.quantity,
        i.id AS item_id,
        i.quantity AS item_stock,
        i.name,
        i.amount,
        i.image'
    )

    ->join('tbl_items i','i.id=c.item_id','left')
    ->where('c.user_id',$userid)
    ->where('c.status' , 0)
    ->get()
    ->getResultArray();
}

        // each users orders listing view
public function get_user_orders($userId) {
    return $this->db
        ->table('tbl_orders o')
        ->select('
        o.id AS order_id,
        o.item_id, 
        i.name AS item_name, i.image AS item_image, o.del_date, 
        SUM(o.item_quantity) AS total_quantity, 
        SUM(o.total_amount) AS total_amount, 
        MAX(o.order_status) AS order_status
        ')
        ->join('tbl_items i','i.id=o.item_id','left')
        ->where('o.user_id',$userId)
        ->where('o.status', 0)
        ->groupBy('o.id') 
        ->orderBy('o.id','DESC')
        ->get()
        ->getResultArray();
}


public function get_order_items($orderId)
{
    return $this->db->table('tbl_orders o')
        ->select('
            o.item_quantity,
            o.total_amount,
            i.name AS item_name,
            i.image AS item_image
        ')
        ->join('tbl_items i','i.id = o.item_id')
        ->where('o.id',$orderId)
        ->get()
        ->getResultArray();
}
public function get_order_summary($orderId)
{
    return $this->db->table('tbl_orders')
        ->select('id,user_id,item_id,item_quantity,order_date,del_status,total_amount,order_status,del_date')
        ->where('id',$orderId)
        ->get()
        ->getRowArray();
}

// ALL ORDERS LIST (Admin / Seller view)
public function get_orders_list($itemName,$delDate)
{
    $query = $this->db->table('tbl_order_items oi');

    $query->select('
        o.id AS order_id,
        o.order_date,
        o.del_date,
        o.order_status,
        o.total_amount,
        o.item_quantity,

        u.name AS user_name,
        u.phone,
        u.address,

        i.name  AS item_name,
        i.image AS item_image,
        ds.name AS delivery_status
    ');


    $query->join('tbl_orders o','o.id=oi.order_id');
    $query->join('tbl_users u','u.id=o.user_id');
    $query->join('tbl_items i','i.id=oi.item_id');
    $query->join('tbl_del_status ds','ds.id = o.del_status','left');

    $query->where('o.status', 0);

//  Item name search
    if (!empty($itemName)) {
        $query->like('i.name', $itemName);
    }

    //  Delivery date search
    if (!empty($delDate)) {
        $query->where('o.del_date', $delDate);
    }
    // LATEST FIRST
    $query->orderBy('o.id', 'DESC');

    // DEBUGGING
    log_message('debug', 'Orders SQL: ' . $this->db->getLastQuery());

    return $query->get()->getResultArray();
}


          //SALE REPORT PER ITEM
public function get_sales_report($fromDate = null, $toDate = null, $itemName = null)
{
    $query = $this->db->table('tbl_order_items oi');

    $query->select('
        i.name AS item_name,
        COUNT(oi.id) AS total_sold,
        SUM(i.amount) AS total_amount
    ');

    $query->join('tbl_orders o', 'o.id = oi.order_id');
    $query->join('tbl_items i', 'i.id = oi.item_id');

    // Only completed/active orders
    $query->where('o.status', 0);
    $query->where('o.order_status !=', 'Cancelled');

    // Date filters
    if (!empty($fromDate)) {
        $query->where('DATE(o.order_date) >=', $fromDate);
    }
    if (!empty($toDate)) {
        $query->where('DATE(o.order_date) <=', $toDate);
    }

    // Item name search
    if (!empty($itemName)) {
        $query->like('i.name', $itemName);
    }

    $query->groupBy('oi.item_id');
    $query->orderBy('MAX(o.order_date)', 'DESC');

    return $query->get()->getResultArray();
}


public function get_userwise_report($userName = null, $fromDate = null, $toDate = null)
{
    $query = $this->db->table('tbl_orders o');

    $query->select('
        u.id   AS user_id,
        u.name AS user_name,
        u.phone,
        COUNT(o.id) AS total_orders,
        SUM(o.item_quantity) AS total_items,
        SUM(o.total_amount) AS total_amount
    ');

    $query->join('tbl_users u', 'u.id = o.user_id');

    // Only active / completed orders
    $query->where('o.status', 0);
    $query->where('o.order_status !=', 'Cancelled');

    // USERNAME filter
    if (!empty($userName)) {
        $query->like('u.name', $userName);
    }

    // DATE filter
    if (!empty($fromDate) && !empty($toDate)) {
        $query->where('DATE(o.order_date) >=', $fromDate);
        $query->where('DATE(o.order_date) <=', $toDate);
    }

    $query->groupBy('o.user_id');
    $query->orderBy('MAX(o.order_date)', 'DESC');

    return $query->get()->getResultArray();
}
// $userWise = true for user-wise report, false for item-wise
public function get_sales_report1($fromDate = null, $toDate = null, $search = null, $userWise = false)
{
    if ($userWise) {
        // User-wise report
        $query = $this->db->table('tbl_orders o');
        $query->select('
            u.name AS user_name,
            u.phone,
            COUNT(DISTINCT o.id) AS total_orders,
            SUM(o.item_quantity) AS total_items,
            SUM(o.item_quantity * i.amount) AS total_amount
        ');
        $query->join('tbl_users u', 'u.id = o.user_id');
        $query->join('tbl_order_items oi', 'oi.order_id = o.id');
        $query->join('tbl_items i', 'i.id = oi.item_id');

        // Only active/completed orders
        $query->where('o.status', 0);
        $query->where('o.order_status !=', 'Cancelled');

        // Date filter
        if (!empty($fromDate)) $query->where('DATE(o.order_date) >=', $fromDate);
        if (!empty($toDate)) $query->where('DATE(o.order_date) <=', $toDate);

        // User search
        if (!empty($search)) $query->like('u.username', $search);

        $query->groupBy('o.user_id');
        $query->orderBy('SUM(o.item_quantity * i.amount)', 'DESC'); // Highest revenue first
    } else {
        // Item-wise report (existing logic)
        $query = $this->db->table('tbl_order_items oi');
        $query->select('
            i.name AS item_name,
            COUNT(oi.id) AS total_sold,
            SUM(i.amount) AS total_amount
        ');
        $query->join('tbl_orders o', 'o.id = oi.order_id');
        $query->join('tbl_items i', 'i.id = oi.item_id');

        $query->where('o.status', 0);
        $query->where('o.order_status !=', 'Cancelled');

        if (!empty($fromDate)) $query->where('DATE(o.order_date) >=', $fromDate);
        if (!empty($toDate)) $query->where('DATE(o.order_date) <=', $toDate);
        if (!empty($search)) $query->like('i.name', $search);

        $query->groupBy('oi.item_id');
        $query->orderBy('SUM(i.amount)', 'DESC');
    }

    return $query->get()->getResultArray();
}
public function get_cart_count($userId)
{
    $count = $this->db->table('tbl_cart')
        ->select('item_id')
        ->where('user_id', $userId)
        ->where('status', 0)
        ->distinct()
        ->countAllResults();

    return (int) $count;
}


}