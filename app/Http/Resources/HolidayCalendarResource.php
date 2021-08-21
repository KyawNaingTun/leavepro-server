<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class HolidayCalendarResource extends JsonResource
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
            'id' => 'h'.$this->id,
            'title' => $this->name,
            'startDate' => Str::of($this->start_date)->limit(10, ''),//->format('Y-m-d'),
            'endDate' => Str::of($this->end_date)->limit(10, ''),//->format('Y-m-d'),
            'classes' => 'red',
        ];
    }
}
