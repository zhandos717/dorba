<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Review */
class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id'         => $this->id,
            'product_id' => $this->product_id,
            'user_id'    => $this->user_id,
            'rating'     => $this->rating,
            'comment'    => $this->comment,
        ];
    }
}
