<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Products;
use DateTime, DB, Auth;
use Modules\User\Entities\Customer;
use Modules\User\Entities\CustomerLocation;
use Modules\User\Entities\Province;
use Modules\User\Entities\District;
use Modules\User\Entities\Street;
use Modules\User\Entities\Ward;
use Modules\User\Entities\Project;
use Modules\User\Entities\Favourite;

class UserController extends BaseController
{
    private $province, $district, $street, $ward, $project;
    public function __construct(Province $province, District $district, Street $street, Ward $ward, Project $project){
        parent::__construct();
        $this->province = $province;
        $this->district = $district;
        $this->street   = $street;
        $this->ward     = $ward;
        $this->project  = $project;
    }
    //Hiển thị tổng quát
    public function index()
    {
        // return view('user::index');
        return redirect()->route('profile.user');
    }
    /*******************************
     ******* Sổ địa chỉ************
     ******************************/
    //View::index Sổ địa chỉ
    public function location()
    {
        $data['location'] = CustomerLocation::where('customer_id', Auth::guard('customer')->user()->id)->paginate(12);
        return view('user::location.index', $data);
    }
    //View:: Tạo địa chỉ
    public function create_location()
    {
        $data['province']   = $this->province->all();
        return view('user::location.create', $data);
    }
    //Create Sổ địa chỉ
    public function create_location_submit(Request $request)
    {
        if ($request->method('POST')) {
            echo 'true';
            try {
                \DB::beginTransaction();
                $data = array(
                    'full_name'      => $request->full_name,
                    'number_phone'   => $request->number_phone,
                    'location'       => $request->location,
                    'province'       => $request->province,
                    'district'       => $request->district,
                    'wards'          => $request->wards,
                    'default'        => $request->default,
                    'customer_id'    => Auth::guard('customer')->user()->id
                );
                $create = CustomerLocation::create($data);
                $update_default = false;
                //Nếu địa chỉ đặt mặc định
                if ($request->default == 'on'){
                    $update_default = CustomerLocation::where('id', '<>', $create->id)->update(['default'=>null]);
                } elseif($request->default == ''){
                    $update_default = true;
                }

                if ($create && $update_default){
                    \DB::commit();
                    return redirect()->route('location.user')->with('success', 'Tạo mới địa chỉ thành công!');
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                return redirect()->route('location.user')->with('error', 'Đã có lỗi bất ngờ sảy ra!, vui lòng thử lại sau.');
            }
        }
    }

    //View:: Chỉnh sửa sổ địa chỉ
    public function edit_location(Request $request)
    {
        $data['province']   = $this->province->all();
        $data['location'] = CustomerLocation::where('id', $request->id)->first();
        return view('user::location.edit', $data);
    }
    //Create Sổ địa chỉ
    public function edit_submit_location(Request $request)
    {
        
    }
    public function del_location(Request $request)
    {
        $delLocation = CustomerLocation::where('id',$request->id)->first();
        if ($delLocation) {
            $delLocation->delete();
            return redirect()->back()->with('success','Xóa địa chỉ thành công!');
        } else {
            return redirect()->back()->with('error','Không tìm thấy địa chỉ bạn cần tìm');
        }
    }

    //Ajax:: Tải tỉnh/quận/huyện select
    public function loadLocation(Request $request){
        if($request->method('post')){
            $result_province = $this->province->where('_name',$request->typeId)->first();
            $result_district = $this->district->where('_name',$request->typeId)->first();
            if($request->type == 'province'){
                $location = $this->district->where('_province_id', $result_province->id)->get();
            } elseif($request->type == 'district') {
                $location = $this->ward->where('_district_id', $result_district->id)->get();
            }
            return response()->json([
                'data' => $location
            ]);
            // return view('user::render.location', $data)->render();
        }
    }
    /**
     * Profile Account
     */
    /*******************************
     ***** Profile Account *********
     ******************************/
    //Quản lý tài khoản
    public function manage_user(){
        $data['customerLocation'] = CustomerLocation::where('customer_id',Auth::guard('customer')->user()->id)
                                                    ->where('default','on')
                                                    ->first();
        return view('user::manageUser.index', $data);
    }
    //View::index Danh sách yêu thích
    public function favorite(){
        $data['favorite'] = Products::where('favorite', 1)->orderBy('id','DESC')->get();
        return view('user::managerUser.index.favorite', $data);
    }
    //View:: Thông tin cá nhân
    public function profile_user(){
        $data['myProfile'] = Customer::where('id', Auth::guard('customer')->user()->id)->first();
        return view('user::manageUser.profile', $data);
    }
    //View::edit Thông tin cá nhân
    public function profile_edit_user(Request $request){
        $data['myProfile'] = Customer::where('id', $request->id)->first();
        return view('user::manageUser.profile_edit', $data);
    }
    //Edit Submit Thông tin cá nhân
    public function profile_edit_submit_user(Request $request){
        if ($request->method('post')) {
            try {
                \DB::beginTransaction();
                $data = array(
                    'full_name'         =>  $request->full_name,
                    // 'email'             =>  $request->email,
                    // 'phone'             =>  $request->phone,
                    'date'              =>  $request->d .'-'. $request->m .'-'. $request->y,
                    'gender'            =>  $request->gender,
                );
                $customerUpdate = Customer::where('id',$request->id)->first();
                if ($customerUpdate->update($data)) {
                    \DB::commit();
                    return redirect()->route('profile.user')->with('success','Cập nhật thông tin thành công!');
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                return redirect()->route('profile.user')->with('error','Cập nhật thông tin thất bại, vui lòng thử lại sau!');
            }
        }
    }
    /*******************************
     ***** Danh sách yêu thích *****
     ******************************/
    public function favourite(){
        $customerId = Auth::guard('customer')->user()->id;
        $data['exists_favourite'] = Favourite::where('customer_id', $customerId)->get();
        
        if(isset($data['exists_favourite'])){
            $arrayProductId = array();
            foreach($data['exists_favourite'] as $item){
                $arrayProductId[] = $item->product_id;
            }
            $data['product_favourite'] = Products::whereIn('id',$arrayProductId)->get();
        }
        return view('user::favourite.index', $data);
    }
}
