<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LegislatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'external_id' => $this->external_id,
            'chamber' => $this->chamber,
            'parliamentary_name' => $this->parliamentary_name,
            'photo_url' => $this->photo_url,
            'party' => $this->party,
            'state' => $this->state,
        ];
    }
}
