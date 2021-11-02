<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $files = ResultFileResource::collection($this->files);
        return [
            'id' => $this->id,
            'organization_name' => $this->organization_name,
            'service_name' => $this->service_name,
            'registration_date' => $this->registration_date,
            'result_date' => $this->result_date,
            'status' => $this->status,
            'files' => $files,
      
        ];
    }
}
