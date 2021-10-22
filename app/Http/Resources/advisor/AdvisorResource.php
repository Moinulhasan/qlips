<?php

namespace App\Http\Resources\advisor;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvisorResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'profession'=>$this->profession,
            'image'=>env('APP_URL').'/storage/'.$this->image,
            'created_at'=>$this->created_at,
            'status'=>$this->status->name
        ];
    }
}
