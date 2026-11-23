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
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg, $th->getCode() );
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request )
    {
        try
        {
            $insertData = [
                'name'       => $request->name,
                'capacity'   => $request->capacity,
                'is_active'  => $request->is_active,
                'updated_at' => Carbon::now(),
            ];
            if( empty( $request->id ) )
            {
                $insertData["created_at"] = Carbon::now();
            }
            Rooms::updateOrCreate( [ "id" => $request->id ], $insertData );
        }
        catch ( \Throwable $th )
        {
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg, $th->getCode() );
        }
        return response( [ "status" => TRUE ], 200, [ "Content-Type" => "application/json" ] );

    }

    /**
     * Display the specified resource.
     */
    public function show( string $id )
    {
        try
        {
            $data = Rooms::where( "id", "=", $id )->get();
            return new ApiResource( $data );
        }
        catch ( \Throwable $th )
        {
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg, $th->getCode() );
        }

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
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg, $th->getCode() );
        }
        return response( [ "status" => TRUE ], 200, [ "Content-Type" => "application/json" ] );
    }
}
