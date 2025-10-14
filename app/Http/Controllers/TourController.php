<?php

namespace App\Http\Controllers;

use App\Enums\TourStatus;
use App\Models\Guide;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreTourRequest;
use App\Models\Tour;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        // return Tour::findOrFail(1);
        // $paginationEnabled = config('usersmanagement.enablePagination');

        $tours = Tour::search($searchTerm);

        if (auth()->user()->isUser()) {
            $tours = $tours->whereStatus(TourStatus::Available->value);
        } else
            $tours = $tours->where('guide_id', Auth::user()->id)->whereNot('status',TourStatus::InProgress->value);


        // if ($searchTerm) {
        //     $tours = $tours->where('name', 'LIKE', '%' . $searchTerm . '%')->paginate(config('usersmanagement.paginateListSize'));
        // } else {
            $tours = $tours->latest()->paginate(config('settings.paginateListSize'));
            // $tours = Tour::latest()->get();
        // }

    // return $tours;
        return view('pages.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: guide couldn't create other tour in the same or during the current tour is running
        if (Auth()->user()->canCreateTours()) {
            $places =  Place::latest()->get();
            return view('pages.tour.create', compact('places'));
        }
        return redirect(route('user.tours.index'))->with('error', __('alerts.createPermission', ['type' => __('titles.tour')]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {
        $inputs = $request->except('_token');
        $inputs['remaining_seats'] = $inputs['max_seats'];
        $inputs['guide_id'] = Auth::user()->id;
        // dd($inputs);
        $tour = Tour::create($inputs);

        $tour->places()->attach($request->places);

        return redirect(route('user.tours.index'))->with('success', __('alerts.tourCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        // $tour = Tour::with('guide')->get();
        // return $tour->guide;
        return view('pages.tour.show')->with('tour', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        if (Auth()->user()->canUpdateTours()) {
            $places =  Place::latest()->get();
            return view('pages.tour.create',compact('tour', 'places'));
        }
        return redirect(route('user.tours.index'))->with('error', __('alerts.editPermission', ['type' => __('titles.tour')]));
    }

    /**
     * Update the specified  resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTourRequest $request, $id)
    {
        $tour = Tour::findOrFail($id);
        
        $inputs = $request->safe()->all();
        $inputs['remaining_seats'] = $inputs['max_seats'];
        $inputs['guide_id'] = Auth::user()->id;
        $tour->fill($inputs);
        $tour->save();
        $tour->places()->sync($request->places);

        return redirect(route('user.tours.index'))->with('success', __('alerts.tourUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        if (Storage::disk('public')->exists('packageImage/' . $tour->package_image)) {
            Storage::disk('public')->delete('packageImage/' . $tour->package_image);
        }

        $tour->places()->detach();
        $tour->delete();
        return redirect(route('user.tours.index'))->with('success', __('alerts.tourDeleted'));
    }

  public function runningTours(){
    $tours = Tour::where('status',TourStatus::InProgress->value)
    ->paginate(config('settings.paginateListSize'));
    return view ('pages.tour.running',compact('tours'));
  }
}
