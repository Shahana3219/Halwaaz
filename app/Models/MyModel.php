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
   

//             //ONLY items of ONE category
// public function get_item_by_category($categoryId)
// {
//     $query=$this->db->table('tbl_items i');
//     $query->select('i.id,i.name,i.quantity,i.amount,i.image,c.name AS category_name ');
//     $query->join('tbl_category c','c.id=i.category','left');
//     $query->where('i.category',$categoryId);
//     $query->where(['i.status'=>0]);
    
//     return $query->get()->getResultArray();

// }

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

public function get_user_orders($userId)
{
    return $this->db
        ->table('tbl_orders o')
        ->select('
            o.id AS order_id,
            o.total_amount,
            o.order_status,
            o.del_date,
            GROUP_CONCAT(i.name ORDER BY oi.id) AS item_names,
            GROUP_CONCAT(oi.item_quantity ORDER BY oi.id) AS item_quantities,
            GROUP_CONCAT(i.image ORDER BY oi.id) AS item_images
        ')
        ->join('tbl_order_items oi', 'oi.order_id = o.id', 'left')
        ->join('tbl_items i', 'i.id = oi.item_id', 'left')
        ->where('o.user_id', $userId)
        ->where('o.status', 0)
        ->groupBy('o.id')
        ->orderBy('o.del_date', 'ASC')
        ->get()
        ->getResultArray();
}




public function get_order_items($orderId)
{
    return $this->db->table('tbl_order_items oi')
        ->select('
            oi.item_quantity,
            oi.unit_price,
            oi.total_amount AS item_total,
            i.name AS item_name,
            i.image AS item_image
        ')
        ->join('tbl_items i', 'i.id = oi.item_id', 'left')
        ->where('oi.order_id', $orderId)
        ->where('oi.status', 0)
        ->get()
        ->getResultArray();
}




public function get_order_summary($orderId)
{
    return $this->db->table('tbl_orders')
        ->select('id,user_id,order_date,del_status,total_amount,order_status,del_date')
        ->where('id',$orderId)
        ->get()
        ->getRowArray();
}
public function get_orders_list($itemName = null, $delDate = null, $orderStatus = null)
{
    $builder = $this->db->table('tbl_orders o');

    $builder->select('
        o.id,
        o.order_date,
        o.del_date,
        o.total_amount,
        o.order_status,
        u.name as user_name,
        u.address,
        u.phone,
        i.name as item_name
    ');

    // Order → Order Items
    $builder->join('tbl_order_items oi', 'oi.order_id = o.id', 'left');

    // Order Items → Items
    $builder->join('tbl_items i', 'oi.item_id = i.id', 'left');

    // Orders → Users
    $builder->join('tbl_users u', 'o.user_id = u.id', 'left');

    if (!empty($itemName)) {
        $builder->like('i.name', $itemName);
    }

    if (!empty($delDate)) {
        $builder->where('DATE(o.del_date)', $delDate);
    }

    if (!empty($orderStatus)) {
        $builder->where('o.order_status', $orderStatus);
    }

    $builder->orderBy('o.order_date', 'DESC');

    return $builder->get()->getResultArray();
}







          //SALE REPORT PER ITEM
public function get_sales_report($fromDate = null, $toDate = null, $itemName = null)
{
    $builder = $this->db->table('tbl_order_items oi');

    $builder->select([
        'i.name AS item_name',
        'SUM(oi.item_quantity) AS total_sold', 
        'SUM(oi.total_amount) AS total_amount',
        'COUNT(DISTINCT o.id) AS total_sales'
    ]);

    $builder->join('tbl_orders o', 'o.id = oi.order_id');
    $builder->join('tbl_items i', 'i.id = oi.item_id');

    // ✅ Exclude cancelled orders and items
    $builder->where('o.status', 0);
    $builder->where('oi.status', 0);

    // Optional safety (if legacy data exists)
    $builder->where('o.order_status !=', 'Cancelled');

    // Date filters
    if (!empty($fromDate)) {
        $builder->where('DATE(o.order_date) >=', $fromDate);
    }

    if (!empty($toDate)) {
        $builder->where('DATE(o.order_date) <=', $toDate);
    }

    // Item name filter
    if (!empty($itemName)) {
        $builder->like('i.name', $itemName);
    }

    $builder->groupBy('oi.item_id');
    $builder->orderBy('MAX(o.order_date)', 'DESC');

    return $builder->get()->getResultArray();
}

public function get_userwise_report($userName = null, $fromDate = null, $toDate = null)
{
    $builder = $this->db->table('tbl_orders o');

    $builder->select([
        'u.id AS user_id',
        'u.name AS user_name',
        'u.phone',
        'COUNT(DISTINCT o.id) AS total_orders',
        'SUM(oi.item_quantity) AS total_items',
        'SUM(o.total_amount) AS total_amount'
    ]);

    $builder->join('tbl_users u', 'u.id = o.user_id');
    $builder->join('tbl_order_items oi', 'oi.order_id = o.id');

    // Exclude cancelled
    $builder->where('o.status', 0);
    $builder->where('oi.status', 0);
    $builder->where('o.order_status !=', 'Cancelled');

    if (!empty($userName)) {
        $builder->like('u.name', $userName);
    }

    if (!empty($fromDate)) {
        $builder->where('DATE(o.order_date) >=', $fromDate);
    }

    if (!empty($toDate)) {
        $builder->where('DATE(o.order_date) <=', $toDate);
    }

    $builder->groupBy('o.user_id');
    $builder->orderBy('MAX(o.order_date)', 'DESC');

    return $builder->get()->getResultArray();
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
            SUM(oi.item_quantity) AS total_items,
            SUM(oi.item_quantity * i.amount) AS total_amount
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
        $query->orderBy('SUM(oi.item_quantity * i.amount)', 'DESC'); // Highest revenue first
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
// GLOBAL FILTERED SEARCH (Reusable everywhere)
public function get_filtered_items(
    $search = null,
    $categoryId = null,
    $priceSort = null,
    $qtySort = null,
    $instock = null
) {
    $query = $this->db->table('tbl_items i');

    $query->select('
        i.id,
        i.name,
        i.quantity,
        i.amount,
        i.image,
        c.name AS category_name
    ');

    $query->join('tbl_category c', 'c.id = i.category', 'left');
    $query->where('i.status', 0);

    // SEARCH
    if (!empty($search)) {
        $query->like('i.name', $search);
    }

    // CATEGORY
    if (!empty($categoryId)) {
        $query->where('i.category', $categoryId);
    }

    // IN STOCK ONLY
    if (!empty($instock)) {
        $query->where('i.quantity >', 0);
    }

    // PRICE SORT
    if ($priceSort === 'price_asc') {
        $query->orderBy('i.amount', 'ASC');
    } elseif ($priceSort === 'price_desc') {
        $query->orderBy('i.amount', 'DESC');
    }

    // QUANTITY SORT
    if ($qtySort === 'qty_asc') {
        $query->orderBy('i.quantity', 'ASC');
    } elseif ($qtySort === 'qty_desc') {
        $query->orderBy('i.quantity', 'DESC');
    }

    return $query->get()->getResultArray();
}


}