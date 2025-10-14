<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        // dd($search);
        if ($search) {
            $districts = District::where('name', 'LIKE', "%$search%")->paginate(config('settings.paginateListSize'));
        } else {
            $districts = District::latest()->paginate(10);
        }
        // $districtcount = District::all()->count();
        return view('pages.district.index',compact('districts'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('pages.district.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:districts'
            ]);

            $districts = new District();
            $districts->name = $request->name;
            $districts->save();

            return redirect(route('user.districts.index'))->with('success', 'District name inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(District $district)
    // {

    //      return view('pages.district.edit',compact('district'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $districts=District::find($id);
        $this->validate($request,[
            'name' => 'required|unique:districts,name,'.$districts->id,
            ]);


        $districts->name = $request->name;
        $districts->save();

         return redirect(route('user.districts.index'))->with('success', 'District Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        if($district->places->count() > 0){
            return redirect()->back()->with('danger', 'District cannot be deleted, because it has some places');
        }

        $district->delete();
        return redirect(route('user.districts.index'))->with('success', 'District deleted Successfully');
    }

       public function search(SearchRequest $request)
    {

        $searchTerm = $request->input('search');

        $results = District::where('name', 'like', $searchTerm . '%')
            ->with('places')
            ->get();


        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
