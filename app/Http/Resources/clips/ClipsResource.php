<?php

namespace App\Http\Resources\clips;

use Illuminate\Http\Resources\Json\JsonResource;

class ClipsResource extends JsonResource
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
            'audio'=>env('APP_URL').'/storage/'.$this->content,
            'size'=>$this->content_size,
            'youtube'=>$this->youtube,
            'upvote'=>$this->upvote,
            'lessening'=>$this->listing,
            'question'=>[
                'id'=>$this->question->id,
                'question'=>$this->question->question,
            ],
            'advisor'=>[
                'id'=>$this->advisor->id,
                'name'=>$this->advisor->name,
                'profession'=>$this->advisor->profession,
                'image'=>env('APP_URL').'/storage/'.$this->advisor->image
            ],
            'status'=>$this->status->name
        ];
    }
}
