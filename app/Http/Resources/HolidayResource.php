<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
class HolidayResource extends JsonResource
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
            'start_date' => Str::of($this->start_date)->limit(10, ''),
            'end_date' => Str::of($this->end_date)->limit(10, ''),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'classes' => 'red',
        ];
    }
}
