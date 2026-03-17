<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\WholesaleBusiness;
use App\Models\Warehouse;

use Validator;

class AdminController extends Controller
{
    // จัดการบัญชีผู้ดูแลระบบ
    public function registerAdmin(){
        return view('backend/adminAccount/register-admin');
    }

    public function accountAdmin(Request $request){
        $NUM_PAGE = 20;
        $admins = Admin::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/adminAccount/account-admin')->with('NUM_PAGE',$NUM_PAGE)
                                                         ->with('page',$page)
                                                         ->with('admins',$admins);
    }

    public function deleteAccountAdmin($id){
        Admin::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\AdminController@accountAdmin');
    }

    public function editAccountAdmin($id){
        $account = Admin::findOrFail($id);
        return view('/backend/adminAccount/edit-account-admin')->with('account', $account);
    }
  
    public function updateAccountAdmin(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateAccountAdmin(), $this->messages_updateAccountAdmin());
        if($validator->passes()) {
            $id = $request->get('id');
            $account = Admin::findOrFail($id);
            $account->update($request->all());
            $account->save();
  
            $request->session()->flash('alert-success', 'อัพเดตข้อมูลบัญชีสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\AdminController@accountAdmin');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลบัญชีไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // จัดการบัญชีสาขา
    public function registerBranchAccount(){
        return view('backend/branchAccount/register-branch-account');
    }

    public function registerBranchAccountPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_registerBranchAccountPost(), $this->messages_registerBranchAccountPost());
        if($validator->passes()) {
            $staff = $request->all();
            $staff['password'] = bcrypt($staff['password_name']);
            $staff = Staff::create($staff);
            $request->session()->flash('alert-success', 'ลงทะเบียนผู้ใช้งานสาขาสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'ลงทะเบียนผู้ใช้งานสาขาไม่สำเร็จ กรุณาตรวจสอบข้อมูล');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function accountBranch(Request $request){
        $NUM_PAGE = 20;
        $staffs = Staff::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/branchAccount/account-branch')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('staffs',$staffs);
    }

    public function deleteAccountBranch($id){
        Staff::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\AdminController@accountBranch');
    }

    public function editAccountBranch($id){
        $account = Staff::findOrFail($id);
        return view('/backend/branchAccount/edit-account-branch')->with('account', $account);
    }
  
    public function updateAccountBranch(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateAccountBranch(), $this->messages_updateAccountBranch());
        if($validator->passes()) {
            $id = $request->get('id');
            $account = Staff::findOrFail($id);
            $account->update($request->all());
            $account->save();
  
            $request->session()->flash('alert-success', 'อัพเดตข้อมูลบัญชีสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\AdminController@accountBranch');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลบัญชีไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // จัดการธุรกิจค้าส่ง
    public function registerWholesaleBusiness(){
        return view('backend/wholesaleBusiness/register-wholesale-business');
    }

    public function registerWholesaleBusinessPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_registerWholesaleBusinessPost(), $this->messages_registerWholesaleBusinessPost());
        if($validator->passes()) {
            $user = $request->all();
            $user['password'] = bcrypt($user['password_name']);
            $user = WholesaleBusiness::create($user);
            $request->session()->flash('alert-success', 'ลงทะเบียนธุรกิจค้าส่งสำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'ลงทะเบียนธุรกิจค้าส่งไม่สำเร็จ กรุณาตรวจสอบข้อมูล');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function accountWholesaleBusiness(Request $request){
        $NUM_PAGE = 20;
        $users = WholesaleBusiness::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/wholesaleBusiness/account-wholesale-business')->with('NUM_PAGE',$NUM_PAGE)
                                                                           ->with('page',$page)
                                                                           ->with('users',$users);
    }

    public function deleteAccountWholesaleBusiness($id){
        WholesaleBusiness::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\AdminController@accountwholesaleBusiness');
    }

    public function editAccountWholesaleBusiness($id){
        $account = WholesaleBusiness::findOrFail($id);
        return view('/backend/wholesaleBusiness/edit-account-wholesale-business')->with('account', $account);
    }
  
    public function updateAccountWholesaleBusiness(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateAccountwholesaleBusiness(), $this->messages_updateAccountwholesaleBusiness());
        if($validator->passes()) {
            $id = $request->get('id');
            $account = WholesaleBusiness::findOrFail($id);
            $account->update($request->all());
            $account->save();
  
            $request->session()->flash('alert-success', 'อัพเดตข้อมูลบัญชีสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\AdminController@accountwholesaleBusiness');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลบัญชีไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // จัดการคลังสินค้า
    public function createWarehouse(){
        return view('backend/warehouse/create-warehouse');
    }

    public function createWarehousePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createWarehousePost(), $this->messages_createWarehousePost());
        if($validator->passes()) {
            $warehouse = $request->all();
            $warehouse = Warehouse::create($warehouse);
            $request->session()->flash('alert-success', 'เพิ่มคลังสินค้าใหม่สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'เพิ่มคลังสินค้าใหม่ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function warehouse(Request $request){
        $NUM_PAGE = 20;
        $warehouses = Warehouse::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/warehouse/warehouse')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('warehouses',$warehouses);
    }

    public function deleteWarehouse($id){
        Warehouse::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\AdminController@warehouse');
    }

    public function editWarehouse($id){
        $warehouse = Warehouse::findOrFail($id);
        return view('/backend/warehouse/edit-warehouse')->with('warehouse', $warehouse);
    }
  
    public function updateWarehouse(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateWarehouse(), $this->messages_updateWarehouse());
        if($validator->passes()) {
            $id = $request->get('id');
            $warehouse = Warehouse::findOrFail($id);
            $warehouse->update($request->all());
            $warehouse->save();
  
            $request->session()->flash('alert-success', 'อัพเดตข้อมูลคลังสินค้าสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\AdminController@warehouse');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลคลังสินค้าไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function rules_registerBranchAccountPost() {
        return [
            'name' => 'required',
            'username' => 'required|unique:staffs',
            'password_name' => 'required|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_registerBranchAccountPost() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งานระบบ',
            'username.unique' => 'username นี้มีผู้ใช้งานแล้ว',
            'password_name.required' => 'กรุณากรอกรหัสผ่าน',
            'password_confirmation.required' => 'กรุณายืนยันรหัสผ่าน',
        ];
    }

    public function rules_registerWholesaleBusinessPost() {
        return [
            'name' => 'required',
            'username' => 'required|unique:wholesales_business',
            'tel' => 'required|unique:wholesales_business',
            'password_name' => 'required|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function messages_registerWholesaleBusinessPost() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งานระบบ',
            'username.unique' => 'username นี้มีผู้ใช้งานแล้ว',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'tel.unique' => 'เบอร์โทรศัพท์นี้มีผู้ใช้งานแล้ว',
            'password_name.required' => 'กรุณากรอกรหัสผ่าน',
            'password_confirmation.required' => 'กรุณายืนยันรหัสผ่าน',
        ];
    }

    public function rules_updateAccountwholesaleBusiness() {
        return [
            'name' => 'required',
            'tel' => 'required',
        ];
    }

    public function messages_updateAccountwholesaleBusiness() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        ];
    }

    public function rules_updateAccountBranch() {
        return [
            'name' => 'required',
        ];
    }

    public function messages_updateAccountBranch() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
        ];
    }

    public function rules_updateAccountAdmin() {
        return [
            'name' => 'required',
        ];
    }

    public function messages_updateAccountAdmin() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
        ];
    }

    public function rules_createWarehousePost() {
        return [
            'warehouse_id' => 'required',
            'name' => 'required',
            'tel' => 'required',
            'url' => 'required',
        ];
    }

    public function messages_createWarehousePost() {
        return [
            'warehouse_id.required' => 'กรุณากรอกรหัสคลังสินค้า',
            'name.required' => 'กรุณากรอกชื่อคลังสินค้า',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'url.required' => 'กรุณากรอก URL',
        ];
    }

    public function rules_updateWarehouse() {
        return [
            'name' => 'required',
            'tel' => 'required',
        ];
    }

    public function messages_updateWarehouse() {
        return [
            'name.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
        ];
    }

}
