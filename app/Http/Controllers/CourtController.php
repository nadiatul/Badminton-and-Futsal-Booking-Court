<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Transaction;
use App\Models\SportField;
use App\Models\SportLocation;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = SportField::with('sportLocation')->get();
        $sportLocations = SportLocation::get();
        return view('admin.manageCourt', compact('courts', 'sportLocations'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SportField::create($request->all());
        $courts = SportField::get();
        $sportLocations = SportLocation::get();
        return view('admin.manageCourt', ['message'=> 'Record Is Successfully Created'], compact('courts', 'sportLocations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $court = SportField::find($id);
        $court->name = $request->name;
        $court->description = $request->description;
        $court->price_hourly = $request->price_hourly;
        $court->starting_hour = $request->starting_hour;
        $court->ending_hour = $request->ending_hour;
        $court->sport_location_id = $request->sport_location_id;
        $court->save();
        $courts = SportField::with('sportLocation')->get();
        $sportLocations = SportLocation::get();
        return view('admin.manageCourt', ['message'=> 'Record Is Successfully Updated'], compact('courts', 'sportLocations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SportField::destroy($id);
        $courts = SportField::with('sportLocation')->get();
        $sportLocations = SportLocation::get();
        return view('admin.manageCourt', ['message'=> 'Record Is Deleted'], compact('courts', 'sportLocations'));
    }
}
