<?php

namespace App\Http\Resources;

use App\Models\Payload_option;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Datajsonresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( Request $request ) : array
    {
        return parent::toArray( $request );
    }
    public function toMeta( Request $request ) : array
    {
        return [
            'api_version'  => "V1",
            'generated_at' => $this->created_at->diffForHumans(),
        ];
    }
}
