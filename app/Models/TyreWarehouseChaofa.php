<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseChaofa extends Model
{
	protected $table = 'tyre_warehouse_chaofa';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'amount', 'year', 'dot', 'stock', 'stock_required', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
