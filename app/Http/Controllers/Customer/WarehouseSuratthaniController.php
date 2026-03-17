<?php

namespace App\Http\Controllers\Customer;

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
        return view('frontend/customer/warehouseSuratthani/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('products',$products);
    }

    // Search
    public function searchTyreWarehouseSuratthani(Request $request) {
        $NUM_PAGE = 2000;
        $search = $request->get('search');
        $products = TyreWarehouseSuratthani::where('size','like','%'.$search.'%')->OrderBy('size','asc')->paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('frontend/customer/warehouseSuratthani/tyre/index')->with('NUM_PAGE',$NUM_PAGE)
                                                                       ->with('page',$page)
                                                                       ->with('products',$products);            
    }

}
