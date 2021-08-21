<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LeaveCalendarResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => 'e'.$this->id,
            'title' => "(#".$this->id.")".auth()->user()->name."'s leave",
            'startDate' => Str::of($this->start_date)->limit(10, ''),
            'endDate' => Str::of($this->end_date)->limit(10, ''),
            'classes' => 'purple',
        ];
    }
}
