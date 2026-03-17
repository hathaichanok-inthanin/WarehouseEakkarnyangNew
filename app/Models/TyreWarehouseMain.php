<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreWarehouseMain extends Model
{
	protected $table = 'tyre_warehouse_main';

	protected $fillable = [
    	'brand_id', 'model_id', 'size', 'cost', 'amount', 'year', 'dot', 'stock', 'comment', 'status'
    ];

    protected $primaryKey = 'id';
}
