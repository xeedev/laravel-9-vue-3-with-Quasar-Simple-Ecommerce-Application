<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'description' => $this->description,
            'total' => $this->total,
            'contact' => $this->contact,
            'transaction_id' => $this->transaction_id,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'status' => $this->status,
            'user' => $this->user
        ];
    }
}
