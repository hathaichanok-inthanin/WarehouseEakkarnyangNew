<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TyreWarehouseSuratthani;
use Validator;

class WarehouseSuratthaniController extends Controller
{
    public function tyreWarehouseSuratthani(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseSuratthani::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/staff/warehouseSuratthani/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('products',$products);
    }

    public function createTyreWarehouseSuratthani() {
        return view('frontend/staff/warehouseSuratthani/tyre/create-tyre');
    }

    public function createTyreWarehouseSuratthaniPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreWarehouseSuratthaniPost(), $this->messages_createTyreWarehouseSuratthaniPost());
        if($validator->passes()) {
            $product = $request->all();
            $product = TyreWarehouseSuratthani::create($product);
            $request->session()->flash('alert-success', 'เพิ่มสินค้าใหม่สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'เพิ่มสินค้าใหม่ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // ปรับเพิ่ม-ลดสต๊อก
    public function addStockTyre(Request $request) {
        $id = $request->get('id');
        $amountadd = $request->get('amount');
        $amount = TyreWarehouseSuratthani::findOrFail($id);
        $amount = TyreWarehouseSuratthani::where('id',$id)->value('amount');
        $amount += $amountadd;
        $amount = TyreWarehouseSuratthani::where('id',$id)->update(['amount' =>  $amount]);        
        return redirect()->action('App\Http\Controllers\Staff\WarehouseSuratthaniController@tyreWarehouseSuratthani');
    }

    public function deleteStockTyre(Request $request) {
        $id = $request->get('id');
        $amountdelete = $request->get('amount');
        $amount = TyreWarehouseSuratthani::findOrFail($id);
        $amount = TyreWarehouseSuratthani::where('id',$id)->value('amount');
        $amount -= $amountdelete;
        $amount = TyreWarehouseSuratthani::where('id',$id)->update(['amount' =>  $amount]);
        return redirect()->action('App\Http\Controllers\Staff\WarehouseSuratthaniController@tyreWarehouseSuratthani');
    }

    // Search
    public function searchTyreWarehouseSuratthani(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseSuratthani::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/staff/warehouseSuratthani/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                 ->with('page',$page)
                                                                 ->with('products',$products);            
    }

    // แก้ไขรายการสินค้า
    public function editTyre($id){
        $product = TyreWarehouseSuratthani::findOrFail($id);
        return view('frontend/staff/warehouseSuratthani/tyre/edit')->with('product', $product);
    }
  
    public function updateTyre(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTyre(), $this->messages_updateTyre());
        if($validator->passes()) {
            $id = $request->get('id');
            $product = TyreWarehouseSuratthani::findOrFail($id);
            $product->update($request->all());
            $product->save();
  
            $request->session()->flash('alert-success', 'อัพเดตข้อมูลสินค้าสำเร็จ');
            return redirect()->action('App\Http\Controllers\Staff\WarehouseSuratthaniController@tyreWarehouseSuratthani');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลสินค้าไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }
  
    public function rules_updateTyre() {
        return [
            'size' => 'required',
            'amount' => 'required',
            'year' => 'required',
            'dot' => 'required',
            'stock' => 'required',
        ];
    }
  
    public function messages_updateTyre() {
        return [
            'size.required' => 'กรุณากรอกขนาดยางรถยนต์',
            'amount.required' => 'กรุณากรอกจำนวนที่มีในสต๊อก',
            'year.required' => 'กรุณากรอกปีผลิต',
            'dot.required' => 'กรุณากรอกสัปดาห์ยาง (DOT)',
            'stock.required' => 'กรุณากรอกจำนวนที่ต้องสต๊อก',
        ];
    }

    public function rules_createTyreWarehouseSuratthaniPost() {
        return [
            'size' => 'required',
            'amount' => 'required',
            'year' => 'required',
            'dot' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages_createTyreWarehouseSuratthaniPost() {
        return [
            'size.required' => 'กรุณากรอกขนาดยางรถยนต์',
            'amount.required' => 'กรุณากรอกจำนวนที่มีในสต๊อก',
            'year.required' => 'กรุณากรอกปีผลิต',
            'dot.required' => 'กรุณากรอกสัปดาห์ยาง (DOT)',
            'stock.required' => 'กรุณากรอกจำนวนที่ต้องสต๊อก',
        ];
    }

}
