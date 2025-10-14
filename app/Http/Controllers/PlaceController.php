<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Placetype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginateSize = config('settings.paginateListSize', 10);
        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $places = Place::where('id', 'like', $searchTerm . '%')
                ->orWhere('name', 'like', $searchTerm . '%')
                ->orWhere('description', 'like', $searchTerm . '%')->paginate($paginateSize);
            $placecount = $places->count();
        }
        else {
            if (config('settings.enablePagination')) {
                $places = Place::latest()->paginate($paginateSize);
            } else {
                $places = Place::all();
            }
            $placecount = Place::all()->count();
        }
        return view('pages.place.index', compact('places', 'placecount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::latest()->get();
        $placetypes = Placetype::latest()->get();
        return view('pages.place.create-or-update', compact('districts', 'placetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:places',
                'district_id' => 'required',
                'placetype_id' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg',
                'description' => 'required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Get Form Image
        $image = $request->file('image');
        if (isset($image)) {

            // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            // Check Category Dir is exists

            if (!Storage::disk('public')->exists('place')) {
                Storage::disk('public')->makeDirectory('place');
            }


            // Resize Image for category and upload
            $PlaceImage = Image::make($image)->resize(1000, 600)->stream();
            Storage::disk('public')->put('place/' . $imageName, $PlaceImage);
        } else {
            $imageName = null;
        }

        $place = new Place();
        $place->addedBy = Auth::user()->name;
        $place->name = $request->name;
        $place->district_id = $request->district_id;
        $place->placetype_id = $request->placetype_id;
        $place->description = $request->description;
        $place->image = $imageName;
        $place->save();
        return redirect(route('user.places.index'))->with('success',  trans('alerts.placeCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        // dd($place->name);
        return view('pages.place.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        $districts = District::latest()->get();
        $placetypes = Placetype::latest()->get();
        return view('pages.place.create-or-update', compact('place', 'districts', 'placetypes'));
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
        $place = Place::findOrFail($id);
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:places,name,' . $place->id,
            'district_id' => 'required',
            'placetype_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'description' => 'required',
        ]);

        // Get Form Image
        $image = $request->file('image');
        if (isset($image)) {
            // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();


            // Check Category Dir is exists
            if (!Storage::disk('public')->exists('place')) {
                Storage::disk('public')->makeDirectory('place');
            }

            // Delete old post image
            if (Storage::disk('public')->exists('place/' . $place->image)) {
                Storage::disk('public')->delete('place/' . $place->image);
            }

            // Resize Image for category and upload
            $PlaceImage = Image::make($image)->resize(1000, 600)->stream();
            Storage::disk('public')->put('place/' . $imageName, $PlaceImage);
        } else {
            $imageName = $place->image;
        }

        $place->name = $request->name;
        $place->district_id = $request->district_id;
        $place->placetype_id = $request->placetype_id;
        $place->description = $request->description;
        $place->image = $imageName;
        $place->save();
        return redirect(route('user.places.index'))->with('success', trans('alerts.placeUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {

        $place->delete();
        return redirect(route('user.places.index'))->with('success', 'Place Information deleted Successfully');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchRules = [
            'search' => 'required|string|max:255',
        ];
        $searchMessages = [
            'search.required' => 'Search term is required',
            'search.string'   => 'Search term has invalid characters',
            'search.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Place::where('id', 'like', $searchTerm . '%')
            ->orWhere('name', 'like', $searchTerm . '%')
            ->orWhere('description', 'like', $searchTerm . '%')
            ->with('district', 'placetype')
            ->get();


        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
