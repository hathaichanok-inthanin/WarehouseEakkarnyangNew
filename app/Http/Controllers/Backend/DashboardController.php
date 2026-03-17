<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

use App\Models\Warehouse;
use App\Models\TyreBrand;
use App\Models\TyreModel;

use App\Models\TyreWarehouseBypass;
use App\Models\TyreWarehouseChaofa;
use App\Models\TyreWarehouseKhokkloi;
use App\Models\TyreWarehouseMain;
use App\Models\TyreWarehousePhangnga;
use App\Models\TyreWarehouseSuratthani;
use App\Models\TyreWarehouseThaiwatsadu;
use App\Models\TyreWarehouseThalang;

class DashboardController extends Controller
{
    public function dashboard() {
        $warehouses = Warehouse::get();
        return view('dashboard')->with('warehouses', $warehouses);
    }

    public function tyreBrand(Request $request) {
        $NUM_PAGE = 20;
        $tyre_brands = TyreBrand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/manageProduct/tyre-brand')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('tyre_brands', $tyre_brands);
    }

    public function createTyreBrand(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreBrand(), $this->messages_createTyreBrand());
        if($validator->passes()) {
            $tyre_brand = $request->all();
            $tyre_brand = TyreBrand::create($tyre_brand);
            $request->session()->flash('alert-success', 'เพิ่มยี่ห้อยางรถยนต์สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'เพิ่มยี่ห้อยางรถยนต์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteTyreBrand($id) {
        $tyre_warehouse_bypass = TyreWarehouseBypass::where('brand_id',$id)->delete();
        $tyre_warehouse_chaofa = TyreWarehouseChaofa::where('brand_id',$id)->delete();
        $tyre_warehouse_khokkloi = TyreWarehouseKhokkloi::where('brand_id',$id)->delete();
        $tyre_warehouse_main = TyreWarehouseMain::where('brand_id',$id)->delete();
        $tyre_warehouse_phangnga = TyreWarehousePhangnga::where('brand_id',$id)->delete();
        $tyre_warehouse_suratthani = TyreWarehouseSuratthani::where('brand_id',$id)->delete();
        $tyre_warehouse_thaiwatsadu = TyreWarehouseThaiwatsadu::where('brand_id',$id)->delete();
        $tyre_warehouse_thalang = TyreWarehouseThalang::where('brand_id',$id)->delete();
        $tyre_model = TyreModel::where('brand_id',$id)->delete();
        TyreBrand::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\DashboardController@tyreBrand');
    }

    public function editTyreBrand($id) {
        $tyre_brand = TyreBrand::findOrFail($id);
        return view('backend/manageProduct/edit-tyre-brand')->with('tyre_brand', $tyre_brand);
    }

    public function updateTyreBrand(Request $request){
        $id = $request->get('id');
        $tyre_brand = TyreBrand::findOrFail($id);
        $tyre_brand->update($request->all());
        $tyre_brand->save();

        $request->session()->flash('alert-success', 'อัพเดตข้อมูลสำเร็จ');
        return redirect()->action('App\Http\Controllers\Backend\DashboardController@tyreBrand');
    }

    public function tyreModel(Request $request) {
        $NUM_PAGE = 20;
        $tyre_models = TyreModel::get();
        $tyre_brands = TyreBrand::get();
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/manageProduct/tyre-model')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('tyre_models', $tyre_models)
                                                       ->with('tyre_brands', $tyre_brands);
    }

    public function createTyreModel(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createTyreModel(), $this->messages_createTyreModel());
        if($validator->passes()) {
            $tyre_model = $request->all();
            $tyre_model = TyreModel::create($tyre_model);
            $request->session()->flash('alert-success', 'เพิ่มรุ่นยางรถยนต์สำเร็จ');
            return back();
        }
        else {
            $request->session()->flash('alert-danger', 'เพิ่มรุ่นยางรถยนต์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function deleteTyreModel($id) {
        $tyre_warehouse_bypass = TyreWarehouseBypass::where('model_id',$id)->delete();
        $tyre_warehouse_chaofa = TyreWarehouseChaofa::where('model_id',$id)->delete();
        $tyre_warehouse_khokkloi = TyreWarehouseKhokkloi::where('model_id',$id)->delete();
        $tyre_warehouse_main = TyreWarehouseMain::where('model_id',$id)->delete();
        $tyre_warehouse_phangnga = TyreWarehousePhangnga::where('model_id',$id)->delete();
        $tyre_warehouse_suratthani = TyreWarehouseSuratthani::where('model_id',$id)->delete();
        $tyre_warehouse_thaiwatsadu = TyreWarehouseThaiwatsadu::where('model_id',$id)->delete();
        $tyre_warehouse_thalang = TyreWarehouseThalang::where('model_id',$id)->delete();
        TyreModel::destroy($id);
        return redirect()->action('App\Http\Controllers\Backend\DashboardController@tyreModel');
    }

    public function editTyreModel($id) {
        $tyre_model = TyreModel::findOrFail($id);
        return view('backend/manageProduct/edit-tyre-model')->with('tyre_model', $tyre_model);
    }

    public function updateTyreModel(Request $request){
        $id = $request->get('id');
        $tyre_model = TyreModel::findOrFail($id);
        $tyre_model->update($request->all());
        $tyre_model->save();

        $request->session()->flash('alert-success', 'อัพเดตข้อมูลสำเร็จ');
        return redirect()->action('App\Http\Controllers\Backend\DashboardController@tyreModel');
    }

    public function rules_createTyreBrand() {
        return [
            'brand_name' => 'required',
        ];
    }

    public function messages_createTyreBrand() {
        return [
            'brand_name.required' => 'กรุณากรอกยี่ห้อยางรถยนต์',
        ];
    }

    public function rules_createTyreModel() {
        return [
            'model' => 'required',
        ];
    }

    public function messages_createTyreModel() {
        return [
            'model.required' => 'กรุณากรอกรุ่นยางรถยนต์',
        ];
    }
}
