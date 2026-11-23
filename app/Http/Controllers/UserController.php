<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $data = User::get();
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
                'email'      => $request->email,
                'password'   => $request->password,
                'role'       => $request->role,
                'updated_at' => Carbon::now(),
            ];
            if( empty( $request->id ) )
            {
                $insertData["created_at"] = Carbon::now();
            }
            User::updateOrCreate( [ "id" => $request->id ], $insertData );
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
            $data = User::where( "id", "=", $id )->get();
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
            User::destroy( $id );
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

    function login( Request $request )
    {
        try
        {
            $credentials = request( [ 'email', 'password' ] );
            if( ! $token = auth( "api" )->attempt( $credentials ) )
            {
                return response()->json( [ 'error' => 'Unauthorized' ], 401 );
            }

            return $this->respondWithToken( $token );
        }
        catch ( \Throwable $th )
        {
            return response()->json( $th->getMessage() );
        }

    }
    function logout( Request $request )
    {
        auth()->logout();
        return response()->json( [ 'message' => 'Successfully logged out' ] );
    }
    protected function respondWithToken( $token )
    {
        return response()->json( [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth( "api" )->factory()->getTTL() * 60
        ] );
    }
}
