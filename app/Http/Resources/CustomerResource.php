<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => $this->resource->name,
            "last_name" => $this->resource->last_name,
            "address" => !empty($this->resource->address) ? $this->resource->address : null,
            "region" => $this->resource->region->description,
            "commune" => $this->resource->commune->description
        ];
    }
}
