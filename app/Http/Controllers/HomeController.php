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
        $tours = Tour::all()->take(3);
        $districts = District::latest()->get();

        return view('welcome', compact('places', 'tours', 'districts', 'placetypes'));
    }

    public function districtWisePlace($id){
        $places = Place::where('district_id', $id)->get();
        $district = District::find($id);
        return view('showDistrictWise', compact('places', 'district'));
    }

    public function placetypeWisePlace($id){
        $places = Place::where('placetype_id', $id)->get();
        $placetype = Placetype::find($id);
        return view('showPlacetypetWise', compact('places', 'placetype'));
    }

    public function about()
    {
        // if(About::all()->count() > 0){
        //     $about = About::all()->first();
        //     return view('about', compact('about'));
        // }
        return view('about');
    }

    public function placeDdetails($id)
    {
        $place = Place::find($id);
        return view('placeDetails', compact('place'));
    }

    public function tourDetails($id)
    {
        $tour = Tour::find($id);
        return view('tourDetails', compact('tour'));
    }

    public function allPlace(){
        $places = Place::latest()->paginate(6);
        return view('allPlaces', compact('places'));
    }


    public function allTours(){
        $tours = Tour::whereStatus(TourStatus::Available->value)->latest()->paginate(12);
        return view('allTours', compact('tours'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $places = Place::where('name','LIKE',"%$query%")->get();
        return view('searchResult', compact('places'));
    }

    public function tourBooking($id){


        $guides = Guide::where('status', 1)->get();
        $tour = Tour::where('id', $id)->first();
        return view('bookingForm', compact('guides', 'tour'));
    }

    public function storeBookingRequest(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'guide' => 'required',
            'date' => 'required',
        ]);



        $guide_id = $request->guide;
        $date = $request->date;
        $tour_id = $request->tour_id;
        $tour_name = $request->tour_name;
        $tour_price = $request->tour_price;
        $day = $request->day;


        $book = new Booking();
        $book->tour_name = $tour_name;
        $book->price = $tour_price;
        $book->date = $date;
        $book->tour_id = $tour_id;
        $book->guide_id = $guide_id;
        $book->day = $day;
        $book->tourist_id = Auth::id();
        $book->save();

        $guide = Guide::find($guide_id);
        $guide->status = 0;
        $guide->save();

        session()->flash('success', 'Your Booking Request Send Successfully, Please wait for admin approval');
        return redirect()->back();


    }
}
