<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreBrand extends Model
{
	protected $table = 'tyre_brands';

	protected $fillable = [
    	'brand_name', 'status'
    ];

    protected $primaryKey = 'id';
}
