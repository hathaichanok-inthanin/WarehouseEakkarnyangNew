<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseSuratthani extends Model
{
	protected $table = 'tyre_warehouse_suratthani';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'amount', 'year', 'dot', 'stock', 'stock_required', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
