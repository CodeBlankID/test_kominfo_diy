<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Models\Bookings;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $data = Bookings::with( "rooms", "users" )->get();
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
                'room_id'    => $request->room_id,
                'user_id'    => $request->user_id,
                'title'      => $request->title,
                'start_time' => $request->start_time,
                'end_time'   => $request->end_time,
                'status'     => $request->status,
                'updated_at' => Carbon::now(),
            ];
            if( empty( $request->id ) )
            {
                $insertData["created_at"] = Carbon::now();
            }
            Bookings::updateOrCreate( [ "id" => $request->id ], $insertData );
        }
        catch ( \Throwable $th )
        {
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg );
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
            $data = Bookings::with( "rooms", "users" )->where( "id", "=", $id )->get();
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
            Bookings::destroy( $id );
        }
        catch ( \Throwable $th )
        {
            $dataMsg = [
                [ "error_code" => $th->getCode() ],
                [ "message" => $th->getMessage() ],
            ];
            return response()->json( $dataMsg );
        }
        return response( [ "status" => TRUE ], 200, [ "Content-Type" => "application/json" ] );
    }
}
