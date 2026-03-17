<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\TyreWarehousePhangnga;

class WarehousePhangngaController extends Controller
{
    public function tyreWarehousePhangnga(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehousePhangnga::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/warehousePhangnga/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                           ->with('page',$page)
                                                           ->with('products',$products);
    }

    public function createTyreWarehousePhangnga() {
        return view('backend/warehousePhangnga/tyre/create-tyre');
    }

    public function createTyreWarehousePhangngaPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreWarehousePhangngaPost(), $this->messages_createTyreWarehousePhangngaPost());
        if($validator->passes()) {
            $product = $request->all();
            $product = TyreWarehousePhangnga::create($product);
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
        $amount = TyreWarehousePhangnga::findOrFail($id);
        $amount = TyreWarehousePhangnga::where('id',$id)->value('amount');
        $amount += $amountadd;
        $amount = TyreWarehousePhangnga::where('id',$id)->update(['amount' =>  $amount]);        
        return redirect()->action('App\Http\Controllers\Backend\WarehousePhangngaController@tyreWarehousePhangnga');
    }

    public function deleteStockTyre(Request $request) {
        $id = $request->get('id');
        $amountdelete = $request->get('amount');
        $amount = TyreWarehousePhangnga::findOrFail($id);
        $amount = TyreWarehousePhangnga::where('id',$id)->value('amount');
        $amount -= $amountdelete;
        $amount = TyreWarehousePhangnga::where('id',$id)->update(['amount' =>  $amount]);
        return redirect()->action('App\Http\Controllers\Backend\WarehousePhangngaController@tyreWarehousePhangnga');
    }

    public function deleteTyre($id){
        TyreWarehousePhangnga::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\WarehousePhangngaController@tyreWarehousePhangnga');
    }

    public function editTyre($id){
      $product = TyreWarehousePhangnga::findOrFail($id);
      return view('/backend/warehousePhangnga/tyre/edit')->with('product', $product);
    }

    public function updateTyre(Request $request){
        $validator = Validator::make($request->all(), $this->rules_updateTyre(), $this->messages_updateTyre());
        if($validator->passes()) {
            $id = $request->get('id');
            $product = TyreWarehousePhangnga::findOrFail($id);
            $product->update($request->all());
            $product->save();

            $request->session()->flash('alert-success', 'อัพเดตข้อมูลสินค้าสำเร็จ');
            return redirect()->action('App\Http\Controllers\Backend\WarehousePhangngaController@tyreWarehousePhangnga');
        } else {
            $request->session()->flash('alert-danger', 'อัพเดตข้อมูลสินค้าไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    // Search
    public function searchTyreWarehousePhangnga(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehousePhangnga::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('/backend/warehousePhangnga/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
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

    public function rules_createTyreWarehousePhangngaPost() {
        return [
            'size' => 'required',
            'amount' => 'required',
            'year' => 'required',
            'dot' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages_createTyreWarehousePhangngaPost() {
        return [
            'size.required' => 'กรุณากรอกขนาดยางรถยนต์',
            'amount.required' => 'กรุณากรอกจำนวนที่มีในสต๊อก',
            'year.required' => 'กรุณากรอกปีผลิต',
            'dot.required' => 'กรุณากรอกสัปดาห์ยาง (DOT)',
            'stock.required' => 'กรุณากรอกจำนวนที่ต้องสต๊อก',
        ];
    }
}
