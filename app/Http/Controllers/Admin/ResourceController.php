<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddResource;
use App\Http\Requests\EditResource;
use App\Models\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ResourceController extends Controller {
	protected $name = 'resources.';
	protected $folderPath = 'admin.pages.resources.';
	const QUERY_EXCEPTION_READABLE_MESSAGE = 2;

	public function index() {
		$all = Resource::orderBy( 'name', 'asc' )->get();

		return view( $this->folderPath . 'index', [ 'all' => $all ] );
	}

	public function create() {


		return view( $this->folderPath . 'create' );
	}

	public function store( AddResource $request ) {
		$slug = Str::slug( $request->name, '-' );

		$request->merge( [ 'slug' => $slug ] );

		try {
			Resource::create( $request->all() );
			$message = 'Добавление выполнено успешно!';
		} catch ( QueryException $exception ) {
			$message = $exception->errorInfo[ self::QUERY_EXCEPTION_READABLE_MESSAGE ];
		}

		$request->session()->flash( 'message', $message );

		return Redirect::to( route( $this->name . 'create' ) );
	}


	public function show( int $id ) {
		$single = Resource::findOrFail( $id );

		return view( $this->folderPath . 'show', [ 'single' => $single ] );
	}


	public function edit( int $id ) {
		$single = Resource::findOrFail( $id );
		$all    = Resource::orderBy( 'name', 'asc' )->get();

		return view( $this->folderPath . 'edit', [ 'single' => $single, 'all' => $all ] );
	}


	public function update( EditResource $request, int $id ) {
		$method = $request->input( 'method' );
		$single = Resource::findOrFail( $id );
		$all    = Resource::orderBy( 'name', 'asc' )->get();

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
		$single = Resource::findOrFail( $id );

		try {
			$single->delete();
			$message = 'Удаление выполнено успешно!';
		} catch ( QueryException $exception ) {
			$message = $exception->errorInfo[ self::QUERY_EXCEPTION_READABLE_MESSAGE ];
		}


		return Redirect::to( route( $this->name . 'index' ) );
	}
}
