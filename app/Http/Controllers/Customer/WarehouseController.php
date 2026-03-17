<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function stockAllWarehouse() {
        return view('/frontend/customer/warehouse/stock-all-warehouse');
    }
}
