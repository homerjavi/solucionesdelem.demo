<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id'          => $this->id,
            'user_id'     => $this->user_id,
            'user_name'   => $this->user->name,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price . '€',
        ];
    }
}
