<?php

namespace App\Http\Resources\question;

use App\Http\Resources\clips\TopicClipsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionClipsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'status' => $this->status->name,
            'clips' => Clips::collection($this->clips),
            'topic' => Topic::collection($this->topic)
        ];
    }
}

class Clips extends JsonResource
{
    public function toArray($request)
    {
        return [
            'clips_id' => $this->id,
            'content' => env("APP_URL") . '/storage/' . $this->content,
            'content_size' => $this->content_size,
            'youtube' => $this->youtube,
            'upvote' => $this->upvote,
            'listening' => $this->listing,
            'advisor' => [
                'advisor_id' => $this->advisor->id,
                'advisor_name' => $this->advisor->name,
                'profession' => $this->advisor->profession,
                'advisor_image' => env('APP_URL') . '/storage/' . $this->advisor->image,
            ]
        ];
    }
}

class Topic extends JsonResource
{
    public function toArray($request)
    {
        return [
            'topic_id' => $this->id,
            'topic_name' => $this->name,
            'topic_slug' => $this->slug,
            'topic_thumbnail' => env('APP_URL') . '/storage/' . $this->thumbnail,
        ];
    }
}
