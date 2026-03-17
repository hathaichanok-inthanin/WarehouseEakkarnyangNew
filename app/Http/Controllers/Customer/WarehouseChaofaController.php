<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

use App\Models\TyreWarehouseChaofa;

class WarehouseChaofaController extends Controller
{
    public function tyreWarehouseChaofa(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseChaofa::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseChaofa/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('products',$products);
    }

    // Search
    public function searchTyreWarehouseChaofa(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseChaofa::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseChaofa/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                   ->with('page',$page)
                                                                   ->with('products',$products);            
    }
}
