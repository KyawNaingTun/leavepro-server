<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
//resource
use App\Http\Resources\HolidayResource;

class HolidayAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HolidayResource::collection(Holiday::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $holiday = Holiday::create($request->all());
        return response()->json($holiday);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Holiday  $eholiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $eholiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Holiday  $eholiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $eholiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Holiday  $eholiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $eholiday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holiday  $eholiday
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Holiday::destroy($id);
        return response()->json(['message' => 'Deleted!']);
    }
}
