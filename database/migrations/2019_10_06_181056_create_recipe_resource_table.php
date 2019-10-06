<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeResourceTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'recipe_resource', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );
			$table->bigInteger( 'recipe_id' )->unsigned();
			$table->bigInteger( 'resource_id' )->unsigned();
			$table->foreign( 'recipe_id' )->references( 'id' )->on( 'recipes' );
			$table->foreign( 'resource_id' )->references( 'id' )->on( 'resources' );
			$table->integer( 'resource_quantity' )->default( '1' ); //how many resources with that id need for this recipe
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'recipe_resource' );
	}
}
