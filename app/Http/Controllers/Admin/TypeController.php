<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\Placetype;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Placetype::latest()->paginate(8);
        $typescount = Placetype::all()->count();
        return view('pages.admin.placeType.index',compact('types', 'typescount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.placeType.create');
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
            'name' => 'required|unique:placetypes'
        ]);

        $types = new Placetype();
        $types->name = $request->name;
        $types->save();

            return redirect(route('admin.placetype.index'))->with('success', 'Place Type inserted successfully');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Placetype $placetype)
    {
       return view('pages.admin.placeType.edit',compact('placetype'));
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
        $types=Placetype::find($id);
        $this->validate($request,[
            'name' => 'required|unique:placetypes,name,'.$types->id,
            ]);


        $types->name = $request->name;
        $types->save();

         return redirect(route('admin.placetype.index'))->with('success', 'Place Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placetype $placetype)
    {

        // dd($placetype->id);
        if(Place::where('placetype_id', $placetype->id)->count() > 0 ){
            session()->flash('danger', 'Place type do not removed, because it has some places');
            return redirect()->back();
        }
        $placetype->delete();
        return redirect(route('admin.placetype.index'))->with('success', 'Place Type Deleted Successfully');
    }
}
