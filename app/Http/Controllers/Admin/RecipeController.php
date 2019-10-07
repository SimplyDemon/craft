<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddRecipe;
use App\Http\Requests\EditRecipe;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RecipeController extends Controller {
	protected $name = 'recipes.';
	protected $folderPath = 'admin.pages.recipes.';
	const QUERY_EXCEPTION_READABLE_MESSAGE = 2;

	public function index() {
		$all = Recipe::orderBy( 'name', 'asc' )->get();

		return view( $this->folderPath . 'index', [ 'all' => $all ] );
	}

	public function create() {
		$percentTypes = DB::select( DB::raw( 'SHOW COLUMNS FROM recipes WHERE Field = "percent"' ) )[0]->Type;

		preg_match( '/^enum\((.*)\)$/', $percentTypes, $matches );
		$percentValues = [];
		foreach ( explode( ',', $matches[1] ) as $value ) {
			$percentValues[] = trim( $value, "'" );
		}

		$gradeTypes = DB::select( DB::raw( 'SHOW COLUMNS FROM recipes WHERE Field = "grade"' ) )[0]->Type;

		preg_match( '/^enum\((.*)\)$/', $gradeTypes, $matches );
		$gradeValues = [];
		foreach ( explode( ',', $matches[1] ) as $value ) {
			$gradeValues[] = trim( $value, "'" );
		}

		$categories = Category::orderBy( 'name', 'asc' )->get();


		return view( $this->folderPath . 'create', [
			'percentValues' => $percentValues,
			'gradeValues'   => $gradeValues,
			'categories'    => $categories
		] );
	}

	public function store( AddRecipe $request ) {
		$slug = Str::slug( $request->name, '-' );

		$request->merge( [ 'slug' => $slug ] );

		try {
			Recipe::create( $request->all() );
			$message = 'Добавление выполнено успешно!';
		} catch ( QueryException $exception ) {
			$message = $exception->errorInfo[ self::QUERY_EXCEPTION_READABLE_MESSAGE ];
		}

		$request->session()->flash( 'message', $message );

		return Redirect::to( route( $this->name . 'create' ) );
	}


	public function show( int $id ) {
		$single = Recipe::findOrFail( $id );

		return view( $this->folderPath . 'show', [ 'single' => $single ] );
	}


	public function edit( int $id ) {
		$single       = Recipe::findOrFail( $id );
		$percentTypes = DB::select( DB::raw( 'SHOW COLUMNS FROM recipes WHERE Field = "percent"' ) )[0]->Type;

		preg_match( '/^enum\((.*)\)$/', $percentTypes, $matches );
		$percentValues = [];
		foreach ( explode( ',', $matches[1] ) as $value ) {
			$percentValues[] = trim( $value, "'" );
		}

		$gradeTypes = DB::select( DB::raw( 'SHOW COLUMNS FROM recipes WHERE Field = "grade"' ) )[0]->Type;

		preg_match( '/^enum\((.*)\)$/', $gradeTypes, $matches );
		$gradeValues = [];
		foreach ( explode( ',', $matches[1] ) as $value ) {
			$gradeValues[] = trim( $value, "'" );
		}

		$categories = Category::orderBy( 'name', 'asc' )->get();

		return view( $this->folderPath . 'edit', [
			'single'        => $single,
			'percentValues' => $percentValues,
			'gradeValues'   => $gradeValues,
			'categories'    => $categories
		] );
	}


	public function update( EditRecipe $request, int $id ) {
		$method = $request->input( 'method' );
		$single = Recipe::findOrFail( $id );
		$all    = Recipe::orderBy( 'name', 'asc' )->get();

		try {
			$slug = Str::slug( $request->name, '-' );
			$request->merge( [ 'slug' => $slug ] );
			$single->update( $request->except( 'currentID', 'method' ) );
			$message = 'Обновление выполнено успешно!';
		} catch ( QueryException $exception ) {
			$message = $exception->errorInfo[ self::QUERY_EXCEPTION_READABLE_MESSAGE ];
		}

		$request->session()->flash( 'message', $message );

		if ( $method == 'Применить' ) {
			return Redirect::to( route( $this->name . 'edit', [ 'single' => $single, 'all' => $all ] ) );
		}

		return Redirect::to( route( $this->name . 'index' ) );


	}


	public function destroy( int $id ) {
		$single = Recipe::findOrFail( $id );

		try {
			$single->delete();
			$message = 'Удаление выполнено успешно!';
		} catch ( QueryException $exception ) {
			$message = $exception->errorInfo[ self::QUERY_EXCEPTION_READABLE_MESSAGE ];
		}


		return Redirect::to( route( $this->name . 'index' ) );
	}
}
