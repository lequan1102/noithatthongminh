<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart, Auth;
use App\Products;
use App\Carts;
use App\CustomerLocation;
use App\Order;
use Mail;
use App\Mail\OrderShipped;
use App\Province;
use App\District;
use App\Ward;
use Modules\User\Http\Requests\LocationCustomerRequest;
// use Modules\User\Entities\Street;
// use Modules\User\Entities\Project;
class CartController extends Controller
{
    protected $carts, $products, $customerLocation, $province, $district, $street, $ward, $project;
    public function _constract(Products $product, Carts $carts, CustomerLocation $cuslocation, Province $province, District $district, Ward $ward){
        $this->products = $product;
        $this->carts = $carts;
        $this->customerLocation = $cuslocation;

        $this->province = $province;
        $this->district = $district;
        $this->ward     = $ward;
    }
    /*
    * Cart::add( id, name, price, quantity, attributes' => array() )  ->  associate()
     * associate() lấy ra: $item->model->id
     *
     * Cart::get($product->id) tìm id cart, nếu không tìm thấy trả về null
     * Cart::getPriceSum() lấy tổng giá của 1 sản phẩm
     * Cart::getTotalQuantity() lấy tổng giá của tất cả sản phẩm
    */
    public function index()
    {
        $data['cart'] = Cart::getContent();
        //Client đã đăng nhập với tài khoản với địa chỉ đã thiết lập'
        if(Auth::guard('customer')->check()){
            $customerCurrent = Auth::guard('customer')->user()->id;
            $data['carts'] = Carts::all();
            $data['customerLocation'] = CustomerLocation::where('customer_id',$customerCurrent)
                                                        ->where('default','on')
                                                        ->first();
                                                        //Quận huyện
            $data['province']   = Province::all();
            
            $districtFindId   = District::where('_name',$data['customerLocation']->district)->first();
            $data['district'] = District::where('_province_id',$districtFindId->_province_id)->get();

            $wardFindId       = Ward::where('_name',$data['customerLocation']->wards)->first();
            $data['ward']     = Ward::where('_district_id',$wardFindId->_district_id)->get();
        }
        $data['province']   = Province::all();
        return view('cart.index', $data);
    }
    public function add_cart(Request $request){
        if($request->method('post')){
            $product = Products::find($request->product_id);
            // Cart::clear();
            if($product){
                $status = '';
                //Nếu sản phẩm đã tồn tại trong giỏ hàng
                if(Cart::get($request->product_id)){
                    //Save DB
                    if(Auth::guard('customer')->check()){
                        $update_cart = Carts::where('product_id',$product->id)->first();
                        $update_cart->update(array(
                            'quantity' => $request->quantity
                        ));
                    }
                    Cart::update($request->product_id, array(
                        'quantity'  => array(
                            'relative'      => false,
                            'value'         => $request->quantity
                        ),
                    ));
                    $status = 'Bạn đã thêm '.$request->quantity.' sản phẩm vào giỏ hàng thành công!';
                //Thêm mới sản phẩm vào giỏ
                } else {
                    $addcart = array(
                        'id'                => $product->id,
                        'name'              => $product->title,
                        'price'             => ($product->discount_price != '') ? str_replace(".","",$product->discount_price) : str_replace(".","",$product->price),
                        'discount_price'    => $product->discount_price,
                        'quantity'          => $request->quantity,
                        'attributes'        => array(),
                        'associatedModel'   => $product
                    );
                    Cart::add($addcart);
                    if(Auth::guard('customer')->check()){
                        //$summedPrice  = số tiền * số lượng
                        $summedPrice = Cart::get($product->id)->getPriceSum();
                        //$price Nếu có giá khuyến mãi hoặc không
                        $price = ($product->discount_price != '') ? str_replace(".","",$product->discount_price) : str_replace(".","",$product->price);
                        //Nếu đã có sản phẩm trong giỏ
                        //$issetProductId = (Cart::get($product->id) != null) ? $request->quantity;
                        $carts = array(
                            'name'          => $product->title,
                            'price'         => $price,
                            'quantity'      => $request->quantity,
                            'image'         => $product->image,
                            'customer_id'   => Auth::guard('customer')->user()->id,
                            'product_id'    => $product->id,
                            'total'         => ($summedPrice != null) ? $summedPrice : $price
                        );
                        Carts::create($carts);
                        $status = 'Bạn đã thêm '.$request->quantity.' sản phẩm vào giỏ hàng thành công!';
                    }
                }
            } else {
                $status = 'Không tìm thấy sản phẩm cần thêm vào giỏ';
            }
            return response()->json(array(
                'status'     => $status,
                'total_cart' => Cart::getContent()->count(),
            ));
        }
    }
    //cập nhật mục sản phẩm giỏ hàng
    public function update(Request $request)
    {
        if (Products::find($request->id)){
            Cart::update($request->id,array(
                'name' => $request->name
            ));
        } else {
            return redirect()->back()->with('error','Không tìm thấy sản phẩm bạn cần tìm');
        }
    }
    public function updateQuantityItem(Request $request){
        if($request->method('post')){
            //Nếu sản phẩm đã tồn tại trong giỏ hàng
            if(Cart::get($request->product_id)){
                //Save DB
                $AuthCheck = Auth::guard('customer')->check();
                $update_cart = Carts::where('product_id',$request->product_id)->first();
                if($AuthCheck){
                    $update_cart->update(array(
                        'quantity' => $request->quantity,
                        'total'    => $request->quantity * $update_cart->price
                    ));
                }
                Cart::update($request->product_id, array(
                    'quantity'  => array(
                        'relative'      => false,
                        'value'         => $request->quantity
                    ),
                    'total'             => $request->quantity * $update_cart->price
                ));
                return response()->json(array(
                    'status' => 'success'
                ));
            }
        }
    }
    //Xóa mục sản phẩm trong giỏ hàng
    public function remove(Request $request)
    {
        $product = Products::find($request->id);
        if ($product){
            try {
                // Cart::clear();
                //Client đã đăng nhập
                if(Auth::guard('customer')->check()){
                    Carts::where('product_id', $request->id)->delete();
                }
                //Client chưa đăng nhập
                Cart::remove($request->id);

                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi cố gắng xóa sản phẩm id: '.$request->id.' !');;
            }
        }
    }
    //Đặt hàng
    public function order(Request $request){
        if($request->method('post')){
            if ($request->email != null && $request->full_name != null && $request->location != null && $request->number_phone != null && $request->province != null && $request->district != null && $request->ward != null ){
                try {
                    \DB::beginTransaction();
                    //Check Auth
                    $exsitsCustomer = null;
                    $isEmail = $request->email;
                    $cartContent = Cart::getContent();
                    if(Auth::guard('customer')->check()){
                        $exsitsCustomer = Auth::guard('customer')->user()->id;
                        $isEmail = Auth::guard('customer')->user()->email;
                    }
                    foreach($cartContent as $index => $value){
                        $dataOrderSave = array(
                            'name'              => $value->name,
                            'product_id'        => $value->id,
                            'customer_id'       => $exsitsCustomer,
                            'price'             => $value->price,
                            'discount_price'    => $value->discount_price,
                            'qty'               => $value->quantity,
                            'total'             => $value->total,
                        );
                        Order::create($dataOrderSave);
                        if(Auth::guard('customer')->check()){
                            Carts::where('product_id', $value->id)->delete();
                        }
                    }
                    // $AllRequest = array(
                    //     'email'                 => $request->email,
                    //     'full_name'             => $request->full_name,
                    //     'location'              => $request->location,
                    //     'province'              => $request->province,
                    //     'district'              => $request->district,
                    //     'ward'                  => $request->ward
                    // );
                    Mail::to($isEmail)->send(new OrderShipped($request->all()));
                    // Cart::clear();
                    //If save True
                    \DB::commit();
                    return response()->json(array(
                        'status' => $request->email
                    ));
                } catch (\Exception $e) {
                    \DB::rollback();
                    return response()->json(array(
                        'status' => $e->getMessage()
                    ));
                }
            } else {
                return response()->json(array(
                    'status' => 'Vui lòng điền đầy đủ thông tin giao hàng để chúng tôi phục vụ bạn được tốt nhất'
                ));
            }
        }
    }
    
    //Ajax:: Tải tỉnh/quận/huyện select
    public function loadLocation(Request $request){
        if($request->method('post')){
            $result_province = Province::where('_name',$request->typeId)->first();
            $result_district = District::where('_name',$request->typeId)->first();
            if($request->type == 'province'){
                $location = District::where('_province_id', $result_province->id)->get();
            } elseif($request->type == 'district') {
                $location = Ward::where('_district_id', $result_district->id)->get();
            }
            return response()->json([
                'data' => $location
            ]);
            // return view('user::render.location', $data)->render();
        }
    }
}