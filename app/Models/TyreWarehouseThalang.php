<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseThalang extends Model
{
	protected $table = 'tyre_warehouse_thalang';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'amount', 'year', 'dot', 'stock', 'stock_required', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
