<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TyreWarehouseThalang;
use Validator;

class WarehouseThalangController extends Controller
{
    public function tyreWarehouseThalang(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseThalang::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/warehouseThalang/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                          ->with('page',$page)
                                                          ->with('products',$products);
    }
    
    public function createTyreWarehouseThalang() {
        return view('backend/warehouseThalang/tyre/create-tyre');
    }

    public function createTyreWarehouseThalangPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreWarehouseThalangPost(), $this->messages_createTyreWarehouseThalangPost());
        if($validator->passes()) {
            $product = $request->all();
            $product = TyreWarehouseThalang::create($product);
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
        $amount = TyreWarehouseThalang::findOrFail($id);
        $amount = TyreWarehouseThalang::where('id',$id)->value('amount');
        $amount += $amountadd;
        $amount = TyreWarehouseThalang::where('id',$id)->update(['amount' =>  $amount]);        
        return redirect()->action('App\Http\Controllers\Backend\WarehouseThalangController@tyreWarehouseThalang');
    }

    public function deleteStockTyre(Request $request) {
        $id = $request->get('id');
        $amountdelete = $request->get('amount');
        $amount = TyreWarehouseThalang::findOrFail($id);
        $amount = TyreWarehouseThalang::where('id',$id)->value('amount');
        $amount -= $amountdelete;
        $amount = TyreWarehouseThalang::where('id',$id)->update(['amount' =>  $amount]);
        return redirect()->action('App\Http\Controllers\Backend\WarehouseThalangController@tyreWarehouseThalang');
    }

    public function deleteTyre($id){
        TyreWarehouseThalang::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\WarehouseThalangController@tyreWarehouseThalang');
    }

    public function editTyre($id){
      $product = TyreWarehouseThalang::findOrFail($id);
      return view('/backend/warehouseThalang/tyre/edit')->with('product', $product);
    }

    public function updateTyre(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTyre(), $this->messages_updateTyre());
        if($validator->passes()) {
            $id = $request->get('id');
            $product = TyreWarehouseThalang::findOrFail($id);
            $product->update($request->all());
            $product->save();

            $request->session()->flash('alert-success', 'อัพเดตข้อมูลสินค้าสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\WarehouseThalangController@tyreWarehouseThalang');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลสินค้าไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // Search
    public function searchTyreWarehouseThalang(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseThalang::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/warehouseThalang/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('products',$products);            
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

    public function rules_createTyreWarehouseThalangPost() {
        return [
            'size' => 'required',
            'amount' => 'required',
            'year' => 'required',
            'dot' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages_createTyreWarehouseThalangPost() {
        return [
            'size.required' => 'กรุณากรอกขนาดยางรถยนต์',
            'amount.required' => 'กรุณากรอกจำนวนที่มีในสต๊อก',
            'year.required' => 'กรุณากรอกปีผลิต',
            'dot.required' => 'กรุณากรอกสัปดาห์ยาง (DOT)',
            'stock.required' => 'กรุณากรอกจำนวนที่ต้องสต๊อก',
        ];
    }
}
