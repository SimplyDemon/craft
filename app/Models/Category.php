<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $guarded = [ 'id', 'created_at', 'updated_at', 'deleted_at' ];

	public function recipes() {
		return $this->hasMany( 'App\Models\Recipe' );
	}
}
