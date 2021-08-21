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
        
        $leaves = Leave::join("employee","employee.id","=","leave.employee_id")
                        ->join("leave_type","leave_type.id","=","leave.leave_type_id");

        $leaves = $leaves->select("leave.*", "employee.name as employee_name","leave_type.name as leave_type_name")
                    ->orderBy("leave.created_at","DESC")
                    ->get();

        $data = [
            'holidays' => $holidayCollection,
            'leaves' => $leaves
        ];
        return response()->json($data);
    }
}
