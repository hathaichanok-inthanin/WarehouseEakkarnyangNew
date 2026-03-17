<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	protected $table = 'warehouse';

	protected $fillable = [
    	'warehouse_id', 'name', 'url', 'tel', 'status'
    ];

    protected $primaryKey = 'id';
}
