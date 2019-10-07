<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
	protected $guarded = [ 'id', 'created_at', 'updated_at', 'deleted_at' ];

	public function recipes() {
		return $this->belongsToMany( 'App\Models\Recipe' );
	}

}
