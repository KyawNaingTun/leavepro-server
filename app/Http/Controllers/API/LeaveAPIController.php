<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use DateTime;
class LeaveAPIController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leaves = Leave::join("employee","employee.id","=","leave.employee_id")
                        ->join("leave_type","leave_type.id","=","leave.leave_type_id");

        if($request->filled('from_date')){
            $leaves = $leaves->whereDate("leave.created_at",">=", $request->from_date);
        }
        if($request->filled('to_date')){
            $leaves = $leaves->whereDate("leave.created_at","<=", $request->to_date);
        }
        if($request->filled('employee_id')){
            $leaves = $leaves->where("leave.employee_id", $request->employee_id);
        }

        return $leaves = $leaves->select("leave.*", "employee.name as employee_name","leave_type.name as leave_type_name", "leave_type.created_at as created_at,")
                    ->orderBy("leave.created_at","DESC")
                    ->get();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'startDate' => 'required|date_format:d/m/Y',
                'endDate' => 'required|date_format:d/m/Y',
                'reason' => 'required',
                'leaveType' => 'required'
            ]
        );
        // Define request
        $startDate = DateTime::createFromFormat('d/m/Y', $request->startDate);
        $endDate = DateTime::createFromFormat('d/m/Y', $request->endDate);
        $reason = $request->reason;
        $leaveType = $request->leaveType;
        // Create leave model
        $leave = Leave::create([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => $reason,
            'leave_type_id' => $leaveType,
            'employee_id' => auth()->id()
        ]);

        $formatedStartDate = $leave->start_date->format('Y-m-d');
        $formatedEndDate = $leave->end_date->format('Y-m-d');
        // response json msg
        $resp = [
            'id' => 'e'.$leave->id,
            'title' => auth()->user()->name,
            'startDate' => $formatedStartDate,
            'classes' => 'red',
        ];
        // if not equal add
        if($formatedStartDate != $formatedEndDate){
            $resp['endDate'] = $formatedEndDate;
        }
        return response()->json($resp);
    }
}
