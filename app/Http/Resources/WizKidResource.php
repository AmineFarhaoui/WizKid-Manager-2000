<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WizKidResource extends JsonResource
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
            'token' => $this->when(auth()->user(), $this->token),
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'phone_number' => $this->when(auth()->user(), $this->phone_number),
        ];
    }
}
