<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TyreWarehouseMain;

class WarehouseMainController extends Controller
{
    public function tyreWarehouseMain(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseMain::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/staff/warehouseMain/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                              ->with('page',$page)
                                                              ->with('products',$products);
    }

    // Search
    public function searchTyreWarehouseMain(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseMain::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/staff/warehouseMain/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                              ->with('page',$page)
                                                              ->with('products',$products);            
    }
}
