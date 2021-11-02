<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'orginalname' => $this->orginalname,
            'created_at' => $this->created_at

        ];
    }
}
