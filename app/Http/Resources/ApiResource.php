<?php

namespace App\Http\Resources;

use App\Http\Resources\Datajsonresource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResource extends ResourceCollection
{
    public $collects = Datajsonresource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray( Request $request ) : array
    {
        return [
            'data'       => $this->collection,
            'total_data' => $this->collection->count(),
        ];
    }
}
