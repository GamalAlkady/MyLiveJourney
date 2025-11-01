<?php

namespace App\Http\Controllers;

use App\Enums\TourStatus;
use App\Models\About;
use App\Models\Booking;
use App\Models\District;
use App\Models\Guide;
use App\Models\Place;
use App\Models\Tour;
use App\Models\Placetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $places = Place::with('placetype')->get()->take(6);
        $placetypes = Placetype::all();
        $tours = Tour::whereStatus(TourStatus::Available->value)->take(3)->get();
        $districts = District::latest()->get();

        return view('home.index', compact('places', 'tours', 'districts', 'placetypes'));
    }

    /**
     * Show all places for a given district
     *
     * @param int $id The district id
     * @return \Illuminate\View\View
     */
    public function districtWisePlace($id){
        $places = Place::where('district_id', $id)->get();
        $district = District::find($id);
        return view('home.show-district-wise', compact('places', 'district'));
    }

    public function placetypeWisePlace($id){
        $places = Place::where('placetype_id', $id)->get();
        $placetype = Placetype::find($id);
        return view('home.show-placetypet-wise', compact('places', 'placetype'));
    }

    public function about()
    {
        // if(About::all()->count() > 0){
        //     $about = About::all()->first();
        //     return view('about', compact('about'));
        // }
        return view('home.about');
    }

    public function placeDdetails($id)
    {
        $place = Place::find($id);
        return view('home.place-details', compact('place'));
    }

    public function tourDetails($id)
    {
        $tour = Tour::find($id);
        return view('home.tour-details', compact('tour'));
    }

    public function allPlace(){
        $places = Place::latest()->paginate(6);
        return view('home.places', compact('places'));
    }


    public function allTours(){
        $tours = Tour::whereStatus(TourStatus::Available->value)->latest()->paginate(12);
        return view('home.tours', compact('tours'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $places = Place::where('name','LIKE',"%$query%")->get();
        return view('home.searchResult', compact('places'));
    }
}
