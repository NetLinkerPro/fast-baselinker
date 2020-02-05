<?php

namespace NetLinker\FastBaselinker\Sections\Accounts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
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
            'name' => $this->name,
            'api_token' => $this->api_token,
            'uuid' => $this->uuid,
        ];
    }
}