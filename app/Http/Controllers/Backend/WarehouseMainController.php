<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\TyreWarehouseMain;

class WarehouseMainController extends Controller
{
    public function tyreWarehouseMain(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseMain::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/warehouseMain/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('products',$products);
    }

    public function createTyreWarehouseMain() {
        return view('backend/warehouseMain/tyre/create-tyre');
    }

    public function createTyreWarehouseMainPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreWarehouseMainPost(), $this->messages_createTyreWarehouseMainPost());
        if($validator->passes()) {
            $product = $request->all();
            $product = TyreWarehouseMain::create($product);
            $request->session()->flash('alert-success', 'เพิ่มสินค้าใหม่สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'เพิ่มสินค้าใหม่ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }


    public function addStockTyre(Request $request) {
        $id = $request->get('id');
        $amountadd = $request->get('amount');
        $amount = TyreWarehouseMain::findOrFail($id);
        $amount = TyreWarehouseMain::where('id',$id)->value('amount');
        $amount += $amountadd;
        $amount = TyreWarehouseMain::where('id',$id)->update(['amount' =>  $amount]);        
        return redirect()->action('App\Http\Controllers\Backend\WarehouseMainController@tyreWarehouseMain');
    }

    public function deleteStockTyre(Request $request) {
        $id = $request->get('id');
        $amountdelete = $request->get('amount');
        $amount = TyreWarehouseMain::findOrFail($id);
        $amount = TyreWarehouseMain::where('id',$id)->value('amount');
        $amount -= $amountdelete;
        $amount = TyreWarehouseMain::where('id',$id)->update(['amount' =>  $amount]);
        return redirect()->action('App\Http\Controllers\Backend\WarehouseMainController@tyreWarehouseMain');
    }

    public function deleteTyre($id){
        TyreWarehouseMain::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\WarehouseMainController@tyreWarehouseMain');
    }

    public function editTyre($id){
      $product = TyreWarehouseMain::findOrFail($id);
      return view('/backend/warehouseMain/tyre/edit')->with('product', $product);
    }

    public function updateTyre(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTyre(), $this->messages_updateTyre());
        if($validator->passes()) {
            $id = $request->get('id');
            $product = TyreWarehouseMain::findOrFail($id);
            $product->update($request->all());

            $request->session()->flash('alert-success', 'อัพเดตข้อมูลสินค้าสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\WarehouseMainController@tyreWarehouseMain');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลสินค้าไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // Search
    public function searchTyreWarehouseMain(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseMain::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/warehouseMain/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                        ->with('page',$page)
                                                        ->with('products',$products);            
    }

    public function brandTyreName($brand_name) {
        return view('/backend/warehouseMain/tyre/brandTyre/index')->with('brand_name',$brand_name);
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

    public function rules_createTyreWarehouseMainPost() {
        return [
            'size' => 'required',
            'amount' => 'required',
            'year' => 'required',
            'dot' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages_createTyreWarehouseMainPost() {
        return [
            'size.required' => 'กรุณากรอกขนาดยางรถยนต์',
            'amount.required' => 'กรุณากรอกจำนวนที่มีในสต๊อก',
            'year.required' => 'กรุณากรอกปีผลิต',
            'dot.required' => 'กรุณากรอกสัปดาห์ยาง (DOT)',
            'stock.required' => 'กรุณากรอกจำนวนที่ต้องสต๊อก',
        ];
    }
}
