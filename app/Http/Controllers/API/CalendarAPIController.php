<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\Leave;
use Illuminate\Http\Request;
//resource collections
use App\Http\Resources\HolidayCalendarResource;
use App\Http\Resources\LeaveCalendarResource;

class CalendarAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidayCollection = HolidayCalendarResource::collection(Holiday::all());
        $leaveCollection = LeaveCalendarResource::collection(Leave::all());

        $data = [
            'holidays' => $holidayCollection,
            'leaves' => $leaveCollection
        ];
        return response()->json($data);
    }
}
