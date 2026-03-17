<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseKhokkloi extends Model
{
	protected $table = 'tyre_warehouse_khokkloi';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'amount', 'year', 'dot', 'stock', 'stock_required', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
