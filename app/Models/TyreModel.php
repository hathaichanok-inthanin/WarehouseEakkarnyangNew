<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TyreModel extends Model
{
	protected $table = 'tyre_models';

	protected $fillable = [
    	'brand_id', 'model', 'status'
    ];

    protected $primaryKey = 'id';
}
