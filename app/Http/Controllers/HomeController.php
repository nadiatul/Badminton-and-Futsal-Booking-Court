<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Transaction;
use App\Models\SportField;
use App\Models\SportLocation;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    function index() {
        $booking = Booking::get();
        return view('index');
    }

    public function home() {
        $type = 'Badminton';

        $dropdown = SportLocation::where('type', $type)->get();
        $resources = SportField::get();
        return view('home',
        ['resources'=> $resources],['type'=> 'Badminton']
        )->with('dropdown', $dropdown);
    }


    public function store(Request $request){
        $type = $request->type;
        $resources = SportField::get();
        Booking::create(array_merge($request->all(), ['status_id' => 2]));
        $dropdown = SportLocation::where('type', $type)->get();
        // Booking::create($request->all());
        // dd($type);
        return view('home',
            ['message' =>'successfully created'],
            ['resources'=> $resources],
            ['type' => $type]
        )->with('dropdown', $dropdown);
    }

    public function show($id){
        return;
    }

    public function badminton() {
        $dropdown = SportLocation::where('type', 'Badminton')->get();
        $resources = SportField::where('sport_location_id', 1)->get();
        return view('home', ['resources'=> $resources],['type'=> 'Badminton'])->with('dropdown', $dropdown);
    }

    public function futsal() {
        $dropdown = SportLocation::where('type', 'Futsal')->get();
        $resources = SportField::where('sport_location_id', 1)->get();
        return view('home', ['resources'=> $resources],['type'=> 'Futsal'])->with('dropdown', $dropdown);
    }

    public function scheduleA(Request $request) {
        echo $request->type;
        $type = $request->type;
        $dropdown = SportLocation::where('type', $type)->get();
        $resources = SportField::where('sport_location_id', $request->id)->get();
        return view('home', ['resources'=> $resources], ['type'=> $type])->with('dropdown', $dropdown);
    }


    public function admin() {
        return view('admin.admin');
    }

}
