<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Models\Rooms;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $data = Rooms::get();
            return new ApiResource( $data );
        }
        catch ( \Throwable $th )
        {
            return response( "erorr", 400 );
        }


    }
    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request )
    {
        try
        {
            Rooms::updateOrCreate( [ "id" => $request->id ], [
                'name'       => $request->name,
                'capacity'   => $request->capacity,
                'is_active'  => $request->is_active,
                'updated_at' => Carbon::now(),
            ] );
        }
        catch ( \Throwable $th )
        {
            return response()->json( $th->getMessage() );
        }
        return response( [ "status" => TRUE ], 200, [ "Content-Type" => "application/json" ] );

    }

    /**
     * Display the specified resource.
     */
    public function show( string $id )
    {
        $data = Rooms::where( "id", "=", $id )->get();
        return new ApiResource( $data );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id )
    {
        try
        {
            Rooms::destroy( $id );
        }
        catch ( \Throwable $th )
        {
            return response()->json( $th->getMessage() );
        }
        return response( [ "status" => TRUE ], 200, [ "Content-Type" => "application/json" ] );
    }
}
