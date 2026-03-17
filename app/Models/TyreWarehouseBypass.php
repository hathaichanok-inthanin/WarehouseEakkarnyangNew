<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseBypass extends Model
{
	protected $table = 'tyre_warehouse_bypass';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'amount', 'year', 'dot', 'stock', 'stock_required', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
