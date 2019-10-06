<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'recipes', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );
			$table->string( 'name' )->unique();
			$table->string( 'slug' )->unique();
			$table->integer( 'cost' );
			$table->string( 'img' ); //url
			$table->enum( 'percent', [ '60', '100' ] )->default( '100' ); //chance to craft
			$table->enum( 'grade', [ 'none', 'NG', 'C', 'B', 'A', 'S', 'S-80', 'S-84' ] )->default( 'none' );
			$table->bigInteger( 'category_id' )->unsigned();
			$table->foreign( 'category_id' )->references( 'id' )->on( 'categories' );
			$table->timestamps();
			$table->softDeletes();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'recipes' );
	}
}
