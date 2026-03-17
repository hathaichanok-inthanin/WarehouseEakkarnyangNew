<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\TyreWarehouseBypass;

class WarehouseBypassController extends Controller
{
    public function tyreWarehouseBypass(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseBypass::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseBypass/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('products',$products);
    }

    // Search
    public function searchTyreWarehouseBypass(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseBypass::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseBypass/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('products',$products);            
    }
}
