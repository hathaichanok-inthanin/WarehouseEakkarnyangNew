<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\TyreWarehouseThaiwatsadu;

class WarehouseThaiwatsaduController extends Controller
{
    public function tyreWarehouseThaiwatsadu(Request $request) {
        $NUM_PAGE = 2000;
        $products = TyreWarehouseThaiwatsadu::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseThaiwatsadu/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                        ->with('page',$page)
                                                                        ->with('products',$products);
    }

    // Search
    public function searchTyreWarehouseThaiwatsadu(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseThaiwatsadu::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseThaiwatsadu/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                        ->with('page',$page)
                                                                        ->with('products',$products);            
    }
}
