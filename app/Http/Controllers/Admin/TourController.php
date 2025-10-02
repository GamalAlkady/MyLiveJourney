<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guide;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $tours = Tour::latest()->paginate(config('usersmanagement.paginateListSize'));
        } else {
            $tours = Tour::latest()->get();
        }
        return view('pages.admin.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places =  Place::latest()->get();
        return view('pages.admin.tour.create', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric|integer',
            'day' => 'required|numeric|integer',
            'date' => 'required|date',
            'people' => 'required|numeric|integer',
            // 'package_image' => 'required|mimes:jpeg,png,jpg',
            'description' => 'required',
            'places' => 'required',
        ]);

       // Get Form Image
      $image = $request->file('image');
      if (isset($image)) {

         // Make Unique Name for Image
        $currentDate = Carbon::now()->toDateString();
        $imageName =$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


      // Check Category Dir is exists

          if (!Storage::disk('public')->exists('tourImage')) {
             Storage::disk('public')->makeDirectory('tourImage');
          }


          // Resize Image for category and upload
          $PlaceImage = Image::make($image)->resize(1000,600)->stream();
          Storage::disk('public')->put('tourImage/'.$imageName,$PlaceImage);

        }

        $tour = new Tour();
        $tour->added_by = Auth::user()->name;
        $tour->name = $request->name;
        $tour->price = $request->price;
        $tour->day = $request->day;
        $tour->people = $request->people;
        $tour->description = $request->description;
        $tour->image = $imageName;
        $tour->save();

        $tour->places()->attach($request->places);

        return redirect(route('admin.tour.index'))->with('success', __('alerts.tourCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        return view('pages.admin.tour.show')->with('tour', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $places =  Place::latest()->get();
        return view('pages.admin.tour.create')->with('tour', $tour)->with('places', $places);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric|integer',
            'day' => 'required|numeric|integer',
            'date' => 'required|date',
            'people' => 'required|numeric|integer',
            'image' => 'mimes:jpeg,png,jpg',
            'description' => 'required',
            'places' => 'required',
        ]);

        $tour = Tour::findOrFail($id);

        // Get Form Image
        $image = $request->file('image');
        if (isset($image)) {

        // Make Unique Name for Image
        $currentDate = Carbon::now()->toDateString();
        $imageName =$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


      // Check Category Dir is exists

          if (!Storage::disk('public')->exists('tourImage'))
          {
             Storage::disk('public')->makeDirectory('tourImage');
          }

          if(Storage::disk('public')->exists('tourImage/'.$tour->image))
          {
            Storage::disk('public')->delete('tourImage/'.$tour->image);
          }


            // Resize Image for category and upload
            $PlaceImage = Image::make($image)->resize(1000,600)->stream();
            Storage::disk('public')->put('tourImage/'.$imageName,$PlaceImage);
            $tour->image = $imageName;
        }

        $tour->name = $request->name;
        $tour->price = $request->price;
        $tour->day = $request->day;
        $tour->people = $request->people;
        $tour->description = $request->description;
        $tour->save();

        $tour->places()->sync($request->places);

        return redirect(route('admin.tour.index'))->with('success', __('alerts.tourUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        if(Storage::disk('public')->exists('packageImage/'.$tour->package_image))
        {
            Storage::disk('public')->delete('packageImage/'.$tour->package_image);
        }

        $tour->places()->detach();
        $tour->delete();
        return redirect(route('admin.tour.index'))->with('success', __('alerts.tourDeleted'));
    }
}
