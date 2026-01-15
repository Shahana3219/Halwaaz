<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MyModel;
use TCPDF;

class MyController extends Controller
{
    protected $MyModel;

    public function __construct(){
        $db=db_connect();
        $this->MyModel=new MyModel($db);
        $this->session=session();

    }

    public function index()
    {
        //
    }
            //LOGIN
    public function login()
    {
        return view('login');
    }
            // SIGN UP
    public function signup(){
        return view('signup');
    }

                            //CHECK LOGIN
private function checkLogin()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/');
    }
}


                                //SAVE_SIGNUP

        public function save_signup(){
        if($this->request->getMethod()!=="post"){
                return redirect()->to('/signup');
        }
// reads the data POST data and Converts form fields into an array
            $signupdata=$this->request->getPost();
            $session = session();
//preparing database-ready data
            $data=[
                'added_by'   => 1,
                'name'=>$signupdata['name'],
                'username'=> $signupdata['username'],
                'email'=>$signupdata['email'],
                'password'   => password_hash($signupdata['password'], PASSWORD_BCRYPT),
                'address'=>$signupdata['address'],
                'phone'=>$signupdata['phone'],
                'created_at' => date('Y-m-d H:i:s'),
                'status'=>0
            ];
   
//if user leave any required field empty then error (validation)
    if(empty ($signupdata['name']) || empty($signupdata['username'])  || empty($signupdata['email']) || empty($signupdata['password'] || empty($signupdata['address']) || empty($signupdata['phone'])))
    {
        //ERROR FLASH MESSAGE
        $session->setFlashdata('signup_error', '❌please fill the fields to signup');
        return redirect()->to('/signup');
    }

//Check if the username already exists
$existinguser=$this->MyModel->select_data('tbl_users','id',['email'=>$signupdata['email']]);

if(!empty($existinguser))
{
    $session->setFlashdata('signup_error','email already exists please login');
    return redirect()->to('/signup');
}


//Database insertion
     $this->MyModel->insert_to_tb('tbl_users',$data);

    
// SUCCESS FLASH MESSAGE
        $session->setFlashdata('signup_success', ' Successfully Registered! Please Login.');
    return redirect()->to('/signup');

}

                                //SAVE_LOGIN
public function save_login(){
     if($this->request->getMethod()!=="post")
        {
        return redirect()->to('/');
        }
        $logindata=$this->request->getPost();
        $session = session();
//VALIDATION
        if (empty($logindata['username'] || ($logindata['password'])))
        {
            $session->setFlashdata('error_login','please fill to login');
            return redirect()->to('/');

        }
//DB LOOKUP BY USERNAME
         $details=$this->MyModel->select_data('tbl_users','id, name, password, username, email, role,phone,address',['username'=>$logindata['username']]);
//CHECKING username 'exists' 
        if (empty($details)) {
        $session->setFlashdata('error_login', ' username does not exists');
        return redirect()->to('/');
    }

    // Verify password [“Username exists, but password does not match.”]
    if (!password_verify($logindata['password'], $details[0]['password'])) {
         $session->setFlashdata('error_password', ' password wrong');
        return redirect()->to('/');
            return redirect()->to('/');
    }
      // Store session
    $session->set([
        'user_id'   => $details[0]['id'],// first row from database result -> details is array of rows
        'name' => $details[0]['name'],
        'username'  => $details[0]['username'],
        'email'     => $details[0]['email'],
        'role'      => $details[0]['role'], 
        'logged_in' => true
    ]);

 
    // ROLE-BASED REDIRECTING
    if (
      
        $details[0]['role'] == 1 &&
        $details[0]['username'] === 'admin@123'
    ) {
        return redirect()->to('/admin_dashboard');
    }
   $session->setFlashdata(
        'login_success',
        '🎉 Welcome ' . $details[0]['name'] . '!'
    );
    return redirect()->to('/home');   
}


                         //ADMIN_DASHBOARD
public function admin_dashboard(){
    if (!session()->get('logged_in') || session()->get('role') != 1) {
        return redirect()->to('/')
            ->with('error', 'Unauthorized access');
    }
    
    // Get total items count
    $totalItems = $this->MyModel->select_data('tbl_items', 'COUNT(*) as count', ['status' => 0]);
    $totalItemsCount = $totalItems[0]['count'] ?? 0;
    
    // Get new items added (last 30 days)
    $newItems = $this->MyModel->select_data('tbl_items', 'COUNT(*) as count', ['status' => 0]);
    $newItemsCount = $newItems[0]['count'] ?? 0;
    
    // Get total categories
    $totalCategories = $this->MyModel->select_data('tbl_category', 'COUNT(*) as count', ['status' => 0]);
    $totalCategoriesCount = $totalCategories[0]['count'] ?? 0;
    
    // Get sales report data
    $salesData = $this->MyModel->get_sales_report();
    
    // Calculate total sales amount
    $totalSalesAmount = 0;
    $salesByItem = [];
    if (!empty($salesData)) {
        foreach ($salesData as $sale) {
            $totalSalesAmount += $sale['total_amount'];
            $salesByItem[] = [
                'name' => $sale['item_name'],
                'sold' => $sale['total_sold'],
                'amount' => $sale['total_amount']
            ];
        }
    }
    
    // Get all orders for statistics (including cancelled ones)
    $allOrders = $this->MyModel->select_data('tbl_orders', 'id, total_amount, order_status, order_date, status', []);
    
    // Calculate profit/loss (assuming 30% profit margin on sales)
    $totalProfit = $totalSalesAmount * 0.30;
    
    // Calculate loss from cancelled orders (status = 1 or order_status = 'Cancelled')
    $totalLoss = 0;
    $cancelledOrders = 0;
    $completedOrders = 0;
    $pendingOrders = 0;
    
    if (!empty($allOrders)) {
        foreach ($allOrders as $order) {
            $status = strtolower(trim($order['order_status'] ?? ''));
            $isCancelled = ($order['status'] == 1) || (strpos($status, 'cancel') !== false);
            
            if ($isCancelled) {
                $cancelledOrders++;
                $totalLoss += (float)($order['total_amount'] ?? 0);
            } elseif (strpos($status, 'placed') !== false || strpos($status, 'complet') !== false || strpos($status, 'deliver') !== false) {
                $completedOrders++;
            } elseif (strpos($status, 'pend') !== false) {
                $pendingOrders++;
            }
        }
    }
    $cancelledOrdersCount = $cancelledOrders;
    
    return view('admin_dashboard', [
        'totalItems' => $totalItemsCount,
        'newItems' => $newItemsCount,
        'totalCategories' => $totalCategoriesCount,
        'totalSales' => $totalSalesAmount,
        'totalProfit' => $totalProfit,
        'totalLoss' => $totalLoss,
        'completedOrders' => $completedOrders,
        'pendingOrders' => $pendingOrders,
        'cancelledOrders' => $cancelledOrdersCount,
        'salesByItem' => $salesByItem,
        'allOrders' => $allOrders
    ]);
}


                        //HOME PAGE
public function home()
{
    if (!session()->get('logged_in') || session()->get('role') != 0) {
        return redirect()->to('/');
    }

    $userid = session()->get('user_id');
    $cartItemIds = [];
    $cartCount = $this->MyModel->get_cart_count($userid);  // updated
    $orders = $this->MyModel->get_user_orders($userid);
    $ordersCount = count($orders);

    $cart_items = $this->MyModel->select_data('tbl_cart', 'item_id', [
        'user_id' => $userid,
        'status'  => 0
    ]);
    $cartItemIds = !empty($cart_items) ? array_column($cart_items, 'item_id') : [];

    return view('home', [
        'cartItemIds' => $cartItemIds,
        'cartCount'   => $cartCount,
        'ordersCount' => $ordersCount
    ]);
}


                            //LOGOUT
public function logout(){
    $this->session->destroy();
    return redirect()->to('/');
}
                         //ADD CATEGORY

public function add_category(){
     if (!session()->get('logged_in') || session()->get('role') != 1) {
        return redirect()->to('/')
            ->with('error', 'Unauthorized access');
    }
$search = trim($this->request->getGet('search') ?? '');

    if ($search) {
    $categories=$this->MyModel->select_data('tbl_category','id,name',
    ['status'=>0],
    [$search],
    ['name']
);
} else{
    $categories = $this->MyModel->select_data('tbl_category', 'id,name', ['status' => 0]);
}
    return view ('add_category',
[
    'categories'=>$categories
]);
}
                             // ADD ITEM
public function add_item(){
     if (!session()->get('logged_in') || session()->get('role') != 1) {
        return redirect()->to('/')
            ->with('error', 'Unauthorized access');
    }
    $categories = $this->MyModel->select_data(
        'tbl_category',
        'id,name',
        ['status' => 0]
    );
    return view ('add_item',
[
    'categories'=>$categories
]);
//  return $this->response->setJSON([
//         'status' => 'success',
//         'data'   => $categories
//     ]);
}
                                // SAVE CATEGORY
public function save_category()
{
    $category=$this->request->getPost();
    $name=$this->request->getPost('name');
    $session=session();

    $data=[
        'added_by' =>1,
        'name'      =>$name,
        'created_at' => date('Y-m-d H:i:s'),
        'status'=>0
    ];
    if(empty($name)){
            $session->setFlashdata('error', 'Category name cannot be empty.');
            return redirect()->to('/add_category');
    }
    //Database insertion
     $this->MyModel->insert_to_tb('tbl_category',$data);
     $session->setFlashdata('success', 'Category added successfully.');
     return redirect()->back();
}

                             //SAVING EDITED CATEGORY

public function save_edit_category(){
    $id=$this->request->getPost('id');
    $session = session();
    $name=$this->request->getPost('name');
    if (empty($name)) 
    {
        $session->setFlashdata('error', 'Category name cannot be empty.');
        return redirect()->back();
    }
        $this->MyModel->update_data('tbl_category',
        [
            'name'=>$name   //updatingdata
        ],
        [
            'id'=>$id  //WHERE Condition
        ]
        );
        $session->setFlashdata('success', 'Category updated successfully.');
}
                         //DELETE CATEGORY
public function delete_category(){
    $id=$this->request->getPost('id');
    $session = session();

  $this->MyModel->update_data('tbl_category',
  ['status'=>1],
  ['id'=>$id]
);
 $session->setFlashdata('success', 'Category deleted successfully.');
}
                                ///GET CATEGORIES

public function get_categories()
{
    $categories=$this->MyModel->select_data('tbl_category','id,name',['status'=>0]);
    return $this->response->setJSON($categories);
}

                                //SAVE ITEM

public function save_item(){
    $formdata=$this->request->getPost();
    $session=session();
    $imageFile = $this->request->getFile('image');
     if (empty($formdata['name']) || empty($formdata['category']) || empty($formdata['quantity']) || empty($formdata['amount'])) 
    {
        $session->setFlashdata('save_error','error');
        return redirect()->to('add_item');
    }
    // $newName = $imageFile->getClientName(); //original file name
    $newName = time() . '_' . $imageFile->getClientName();   // Keeps original name + guarantees uniqueness

    $imageFile->move('uploads/items', $newName);
    $data=[
        'added_by'   => 1,
        'name'=>$formdata['name'],
        'quantity'=>$formdata['quantity'],
        'amount'=>$formdata['amount'],
        'image'=>$newName,
        'category' => (int)$formdata['category'],
        'created_at' => date('Y-m-d H:i:s'),
        'status'=>0       
    ];
    $this->MyModel->insert_to_tb('tbl_items',$data);
    $session->setFlashdata('save_success','succcessfully added item');
    return redirect()->to('add_item');
}

                                 //ITEM LIST
public function items_list(){
 if (!session()->get('logged_in') || session()->get('role') != 1) {
        return redirect()->to('/')
            ->with('error', 'Unauthorized access');
    }
    $categories=$this->MyModel->select_data('tbl_category','id,name',['status'=>0]);
    log_message('debug','Items list accessed by user ID: '.session()->get('user_id'));
$search = trim($this->request->getGet('search') ?? '');

    $category=$this->request->getGet('category');
    $priceSort=$this->request->getGet('price_sort');
    $qtySort=$this->request->getGet('qty_sort');

    
    $items=$this->MyModel->get_items($search,$category,$priceSort,$qtySort);
    return view('items_list',
    ['items'=>$items,
    'categories'=>$categories
    ]
);
   

}

                               //EDITING ITEMS
public function edit_itemlist($id){
    $categories=$this->MyModel->select_data('tbl_category','id,name',['status'=>0]);
    
    $item=$this->MyModel->select_data('tbl_items','id,name,category,amount,quantity,image',
    [
        'id'=>$id,
        'status'=>0
    ]
    );

    return view('edit_itemlist',[
        'item'=>$item[0],
        'categories'=>$categories
        
    ]);
}


                         //SAVING THE EDITED ITEMS
public function save_edit_itemlist()
{
    $session=session();

    $formdata=$this->request->getPost();
    $image=$this->request->getFile('image');
    //keeeping the old image
    $imageName=$formdata['old_image'];
//if user selects a new file,that file saved with new name
    if ($image && $image->isValid() && !$image->hasMoved() ) 
    {
            $imageName=$image->getClientName();
            $image->move('uploads/items', $imageName);
    }

    $data=[
        'name'=>$formdata['name'],
        'category'=>$formdata['category'],
        'quantity'=>$formdata['quantity'],
        'amount'=>$formdata['amount'],
        'image'=>$imageName
    ];
 // Log for debugging
    log_message('debug', 'Updating item ID '.$formdata['id'].' with: '.json_encode($data));
    
    $this->MyModel->update_data('tbl_items',$data,
    ['id'=>$formdata['id']]
);

     $session->setFlashdata('update_success', 'Item updated successfully');
    return redirect()->to('items_list');
}


                        ///DELETING ITEMS
public function delete_item(){
     if (!session()->get('logged_in') || session()->get('role') != 1) {
        return redirect()->to('/')
            ->with('error', 'Unauthorized access');
    }
     $id=$this->request->getPost('id');
       if (!$id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid ID'
        ]);
    }

  $this->MyModel->update_data('tbl_items',
  ['status'=>1],
  ['id'=>$id]
);
  return $this->response->setJSON([
        'status' => 'success'
    ]);
}
                    //SEEING ITEMS BASED ON SELECTED CATEGORY
public function items_by_category($categoryId)
{
    $redirect = $this->checkLogin();

if ($redirect) {
    return $redirect;
}

    $userid = session()->get('user_id');



$search     = $this->request->getGet('search');
$priceSort = $this->request->getGet('price_sort');
$qtySort   = $this->request->getGet('qty_sort');
$instock   = $this->request->getGet('instock');

$items = $this->MyModel->get_filtered_items(
    $search,
    $categoryId,
    $priceSort,
    $qtySort,
    $instock
);

    $categories=$this->MyModel->select_data('tbl_category','id,name',['status'=>0]);

    $cartItemIds = [];
    $cartCount = $this->MyModel->get_cart_count($userid);
     $orders = $this->MyModel->get_user_orders($userid);
    $ordersCount = count($orders);
    if($userid)
        {
          $cart_items=$this->MyModel->select_data('tbl_cart',
          'item_id',
          [
            'user_id'=>$userid,
            'status'  => 0 
          ]);  
    if (!empty($cart_items)) {
    $cartItemIds = !empty($cart_items) ? array_column($cart_items, 'item_id') : [];
}
        }
    return view('category_items',
    [
        'items'=>$items,
        'categories'=>$categories,
        'cartItemIds'=>$cartItemIds,
        'cartCount' => $cartCount,
        'ordersCount' => $ordersCount,
        'selected_category_id'=>$categoryId,
        'selected_category_name'=>$items[0]['category_name']??''
    ]);
}

 //CART
public function cart()
{
    // Check if user is logged in
    $redirect = $this->checkLogin();
    if ($redirect) {
        return $redirect;
    }

    $session = session();
    $userid = $session->get('user_id');

    // Get total cart count using your helper method
    $cartCount = $this->MyModel->get_cart_count($userid);

    // Get user's orders count
    $orders = $this->MyModel->get_user_orders($userid);
    $ordersCount = count($orders);

    // Get unique item IDs in the cart
    $cart_items = $this->MyModel->select_data('tbl_cart', 'item_id', [
        'user_id' => $userid,
        'status'  => 0
    ]);
    $cartItemIds = !empty($cart_items) ? array_column($cart_items, 'item_id') : [];

    // Get detailed cart items (for display)
    $cart = $this->MyModel->user_cartitems($userid);

    return view('cart', [
        'cart'        => $cart,
        'cartCount'   => $cartCount,
        'ordersCount' => $ordersCount,
        'cartItemIds' => $cartItemIds
    ]);
}



                        //ADD TO CART
public function add_to_cart(){
    
    $session = session();
    $itemid=$this->request->getPost('id');
    $userid=session()->get('user_id');
    //Checking if the user is logged in.
    if(!$userid)
    {
        return $this->response->setJSON(
            [
              'status'=>'error',
            'message'=>'login please'
            ]
            );
    }
    //checking if the item already exists in user's cart
   $existing=$this->MyModel->select_data('tbl_cart','*',
   [
    'user_id'=>$userid,
    'item_id'=>$itemid,
    'status'  => 0 
   ]);

   //if exists ,increase its quantity and also update the db table
    if(!empty($existing))
    {
        $new_quantity=$existing[0]['quantity']+1;

        $this->MyModel->update_data('tbl_cart',
        [
            'quantity'=>$new_quantity
        ],
        [
            'id'=>$existing[0]['id']
        ]
    );
    $message='item quantity updated';
    } else {

    // Check if the item exists but is deleted earlier (status=1)
    $deleted_item = $this->MyModel->select_data('tbl_cart', '*', [
        'user_id' => $userid,
        'item_id' => $itemid,
        'status'  => 1
    ]);

    if (!empty($deleted_item)) {
        // Reactivate it
        $this->MyModel->update_data('tbl_cart', [
            'quantity' => 1,
            'status'   => 0
        ], 
        [
            'id' => $deleted_item[0]['id']
        ]
    );

        $message = 'item added again';
        
    }
    else{
          $item=$this->MyModel->select_data('tbl_items','id,name,category,amount,quantity,image',
          [
            'id'=>$itemid
          ]
          );

         if(empty($item))
            {
            return $this->response->setJSON(
                [
                    'status'=>'error',
                    'message' => 'Item not found'
                ]
                );
            }
    //insertion
         
         $this->MyModel->insert_to_tb('tbl_cart',[
            'user_id'=>$userid,
            'item_id'=>$item[0]['id'],
            // 'name'=>$item[0]['name'],
            // 'amount'=>$item[0]['amount'],
            // 'image'=>$item[0]['image'],
            'quantity'=>1
         ]);
        $message="item added";
    }
}
//CART ITEMS WITH USER ID
    $cartItems=$this->MyModel->select_data('tbl_cart','quantity',
    [
        'user_id'=>$userid,
         'status'  => 0
    ]);
    // SUM  
    $total_quantity=array_sum(array_column($cartItems,'quantity'));

    return $this->response->setJSON([
    'status'  => 'success',
    'message' => $message,
    'count'   => $total_quantity
    ]);

    


}
public function cart_plus()
{
    $cartId = $this->request->getPost('cart_id');
    $cart = $this->MyModel->select_data('tbl_cart', 'quantity,item_id', 
    [
        'id' => $cartId,
        'status'  => 0 
    ]);

if (!empty($cart)) {
        $new_quantity = $cart[0]['quantity'] + 1;

        $this->MyModel->update_data('tbl_cart',
        [
            'quantity'=>$new_quantity
        ], 
        [
            'id'=>$cartId
        ]);

        $item = $this->MyModel->select_data('tbl_items','amount',
        [
            'id'=>$cart[0]['item_id']
        ]);

        $subtotal = $item[0]['amount']*$new_quantity;

        return $this->response->setJSON(
            [
             'status'=>'success',
             'quantity'=>$new_quantity,
             'subtotal'=>$subtotal
            ]);
    }
}

public function cart_minus()
{
    $cartId = $this->request->getPost('cart_id');

    $cart = $this->MyModel->select_data('tbl_cart', 'quantity,item_id',
    [
        'id'=>$cartId,
        'status'  => 0 
    ]);

    if (!empty($cart) && $cart[0]['quantity'] > 1) 
        {
        $new_quantity = $cart[0]['quantity'] - 1;

        $this->MyModel->update_data('tbl_cart', 
        [
            'quantity'=>$new_quantity
        ],
        [
            'id'=>$cartId
        ]);

        $item = $this->MyModel->select_data('tbl_items','amount',
        [
            'id'=>$cart[0]['item_id']
        ]);

        $subtotal = $item[0]['amount'] * $new_quantity;

        return $this->response->setJSON(
            [
            'status'=>'success',
            'quantity'=>$new_quantity,
            'subtotal'=>$subtotal
            ]);
    }
}


        //CART REMOVE
public function cart_remove()
{
    $cartId = $this->request->getPost('cart_id');
    $this->MyModel->update_data('tbl_cart',
        ['status'=>1],   // mark as removed
        ['id'=>$cartId]
    );

    return $this->response->setJSON(
    [
      'status' => 'success',
      'message' => 'Item removed from cart'
    ]
);
}
    
                //BUY NOW
public function buy_now()
{
    $session = session();
    $userId  = $session->get('user_id');
    $itemId = $this->request->getPost('item_id');
    $qty = $this->request->getPost('quantity') ?? 1;

    if (!$userId) 
    {
        return $this->response->setJSON(
        [
            'status'  => 'error',
            'message' => 'Please login to continue'
        ]
        );
    }
    if (!$itemId) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid item'
        ]);
    }
$db = \Config\Database::connect();
    $db->transStart();
    
    $orderDate=date('Y-m-d H:i:s');
    $delDate   = date('Y-m-d', strtotime('+3 days'));
// Fetch item
    $item = $this->MyModel->select_data(
        'tbl_items',
        'id,quantity,amount',
        ['id' => $itemId, 'status' => 0]
    );
     if (empty($item)) {
        $db->transRollback();
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Item not found'
        ]);
    }

    if ($item[0]['quantity'] < $qty) {
        $db->transRollback();
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Insufficient stock'
        ]);
    }
    $orderDate=date('Y-m-d H:i:s');
    $delDate=date('Y-m-d', strtotime('+3 days'));
    $total=$item[0]['amount'] * $qty;

    
    // Get 'placed' status from tbl_del_status
    $delStatus=$this->MyModel->select_data(
        'tbl_del_status',
        'id',
        ['name' => 'placed']
    );

    $placedStatusId = $delStatus[0]['id'];

        // INSERT INTO tbl_orders
    $this->MyModel->insert_to_tb('tbl_orders', 
        [
            'status'=>0,
            'user_id'=>$userId,
            'item_id'=>$itemId,
            'item_quantity'=>$qty,
            'order_date'=>$orderDate,
            'del_date'=>$delDate,
            'del_status'=>$placedStatusId,
            'total_amount'=>$total,
            'order_status'=>'Placed'  
        ]
    );

    $orderId = $db->insertID();

    // INSERT ORDER ITEMS
        $this->MyModel->insert_to_tb('tbl_order_items', 
        [
            'status'=>0,
            'order_id'=>$orderId,
            'item_id'=>$itemId,
            'order_date'=>$orderDate,
            'del_status'=>$placedStatusId
        ]);

         // REDUCE ITEM QUANTITY
        $this->MyModel->update_data(
            'tbl_items',
            ['quantity' => $item[0]['quantity'] - $qty],
            ['id' => $itemId]
        );
    
    
   $db->transComplete();
   
    if ($db->transStatus() === false) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Order failed'
        ]);
    }

 return $this->response->setJSON(
    [
        'status'  => 'success',
        'message' => 'Order placed successfully',
        'order_id' => $orderId
    ]
    );
}


public function my_orders() {
    $userId = session()->get('user_id');

    $orders=$this->MyModel->get_user_orders($userId);
    $ordersCount=count($orders);

    // Cart count
    $cartItemIds=[];
    $cartCount = $this->MyModel->get_cart_count($userId);
    $cart_items = $this->MyModel->select_data('tbl_cart', 'item_id', 
    [
        'user_id' => $userId,   
        'status'  => 0 
    ]
    );


    return view('my_orders', 
    [
        'orders' => $orders,
        'cartCount' => $cartCount,
        'ordersCount' => $ordersCount
    ]
    );
}

public function order_details($orderId)
{
    $session = session();
    $userId  = $session->get('user_id');
    $order = $this->MyModel->get_order_summary($orderId);

    if (!$order) {
        return redirect()->to('my_orders');
    }

    $items=$this->MyModel->get_order_items($orderId);
    $orders=$this->MyModel->get_user_orders($userId);
    $ordersCount=count($orders);
     // Cart info
    $cartItemIds=[];
    $cartCount = $this->MyModel->get_cart_count($userId);
    $cart_items=$this->MyModel->select_data('tbl_cart', 'item_id', 
    [
        'user_id'=>$userId,   
        'status'=>0 
    ]
    );

    

    return view('order_details', [
        'order'=>$order,
        'items'=>$items,
        'cartCount'=>$cartCount,
        'ordersCount'=>$ordersCount
    ]);
}
public function cancel_order()
{
    $orderId = $this->request->getPost('id'); // get ID from POST
    $userId = session()->get('user_id');
    $session = session();

    // Update the order status using your generic update_data()
    $updated = $this->MyModel->update_data(
        'tbl_orders',
        [
            'status'=> 1,
            'order_status'=> 'Cancelled',
            'del_status'=> 3
        ],
        [
            'id'=>$orderId,
            'user_id'=>$userId,
            'status'=>0 // only active orders
        ]
    );

    if ($updated) {
        $session->setFlashdata('success', 'Order cancelled successfully.');
    } else {
        $session->setFlashdata('error', 'Unable to cancel order.');
    }
    
    return redirect()->to(base_url('my_orders'));
}


public function orders_list()
{
    $itemName    = $this->request->getGet('item_name');
    $delDate     = $this->request->getGet('del_date');
    $orderStatus = $this->request->getGet('order_status'); // optional filter

    $orders = $this->MyModel->get_orders_list($itemName, $delDate, $orderStatus);

    return view('orders_list', [
        'orders' => $orders,
        'selected_status' => $orderStatus, // to keep selected in dropdown
        'itemName' => $itemName,
        'delDate' => $delDate
    ]);
}




public function itemwise_report()
{
    $fromDate=$this->request->getGet('from_date');
    $toDate=$this->request->getGet('to_date');
    $itemName=$this->request->getGet('item_name');

    $reports=$this->MyModel->get_sales_report($fromDate, $toDate, $itemName);

    return view('report_list', 
    [
        'reports'=>$reports,
        'fromDate'=> $fromDate,
        'toDate'=>$toDate,
        'itemName'=>$itemName
    ]
    );
}

public function userwise_report()
{
    $userName = $this->request->getGet('user_name');
    $fromDate = $this->request->getGet('from_date');
    $toDate   = $this->request->getGet('to_date');

    $reports = $this->MyModel->get_userwise_report($userName, $fromDate, $toDate);

    return view('userwise_report', [
        'reports'   => $reports,
        'user_name' => $userName,
        'fromDate'  => $fromDate,
        'toDate'    => $toDate
    ]);
}




public function report_section()
{
    return view('report_section');
}
public function report_pdf()
{
    $itemName = $this->request->getGet('item_name');
    $fromDate = $this->request->getGet('from_date');
    $toDate   = $this->request->getGet('to_date');

    // Fetch data
    $reports = $this->MyModel->get_sales_report($fromDate, $toDate, $itemName);

    // Current date
    $reportDate = date('d-m-Y H:i:s');

    // Totals (optional, view can also compute this)
    $totals = [
        'totalSold'    => array_sum(array_column($reports, 'total_sold')),
        'totalRevenue' => array_sum(array_column($reports, 'total_amount')),
    ];

    // Load the table view into a variable
    $html = view('itemwise_table', [
        'reports'    => $reports,
        
    ]);

    // TCPDF setup
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Halwaaz');
    $pdf->SetAuthor('Halwaaz Admin');
    $pdf->SetTitle('Itemwise Report');
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('halwaaz_itemwise_report.pdf', 'D'); // Download
}

public function report_pdf1()
{
    $userName = $this->request->getGet('user_name');
    $fromDate = $this->request->getGet('from_date');
    $toDate   = $this->request->getGet('to_date');

    // Fetch data (user-wise)
    $reports = $this->MyModel->get_sales_report1(
        $fromDate,
        $toDate,
        $userName,
        true // user-wise flag
    );

    // Optional totals (view can also calculate)
    $totals = [
        'totalOrders'  => array_sum(array_column($reports, 'total_orders')),
        'totalItems'   => array_sum(array_column($reports, 'total_items')),
        'totalRevenue' => array_sum(array_column($reports, 'total_amount')),
    ];

    // Load USERWISE view
    $html = view('userwise_table', [
        'reports' => $reports,
        'totals'  => $totals
    ]);

    // TCPDF setup
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Halwaaz');
    $pdf->SetAuthor('Halwaaz Admin');
    $pdf->SetTitle('Userwise Sales Report');
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();

    // Render PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('halwaaz_userwise_report.pdf', 'D');
}


}