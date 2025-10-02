<?php

namespace App\Http\Controllers\User;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Models\Placetype;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Tour;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index(){
        $districts = District::latest()->get();
        $placetypes = Placetype::latest()->get();
        $places = Place::latest()->get();
        $packages = Tour::latest()->get();
        $guides = Guide::latest()->get();
        return view('pages.user.dashboard', compact('districts', 'placetypes', 'places', 'packages', 'guides'));
    }

    public function getDistrict(){
        $districts = District::latest()->paginate(8);
        $districtcount = District::all()->count();
        return view('pages.user.district.index',compact('districts', 'districtcount'));
    }

    public function getPlaceType(){
        $types = Placetype::latest()->paginate(8);
        $typescount = Placetype::all()->count();
        return view('pages.user.placeType.index',compact('types', 'typescount'));
    }

    public function getPlaces(){
        $places = Place::latest()->paginate(8);
        $placeCount = Place::all()->count();
        return view('pages.user.place.index',compact('places', 'placeCount'));
    }

    public function getPlaceDetails($id){
        $place = Place::find($id);
        return view('pages.user.place.show',compact('place'));
    }


    public function getGuides(){
        $guides = User::whereRoleIs('guide')->paginate(8);
        $guideCount = User::whereRoleIs('guide')->count();
        return view('pages.user.guide.index',compact('guides', 'guideCount'));
    }

    public function getGuideDetails($id){
        $guide = User::find($id);
        return view('pages.user.guide.show',compact('guide'));
    }


    public function getPackage(){
        $packages = Tour::latest()->get();
        return view('pages.user.package.index', compact('packages'));
    }

    public function getPackageDetails($id){
        $package = Tour::find($id);
        return view('pages.user.package.show', compact('package'));
    }

    public function showProfile(){
        $user = User::find(Auth::id());
        return view('pages.user.profile.index', compact('user'));
    }

    public function editProfile($id){
        $user = User::find($id);
        return view('pages.user.profile.edit', compact('user'));
    }


    public function updateProfile(Request $request){
        $profile = Auth::id();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'. $profile,
            'contact' => 'required|numeric|unique:users,contact,'. $profile,
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        $profile = User::findOrFail($profile);

        //handle featured image
        $image = $request->file('image');
        if($image)
        {
             // Make Unique Name for Image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


          // Check Dir is exists

              if (!Storage::disk('public')->exists('profile_photo')) {
                 Storage::disk('public')->makeDirectory('profile_photo');
              }


              if(Storage::disk('public')->exists('profile_photo/'.$profile->image)){
                Storage::disk('public')->delete('profile_photo/'.$profile->image);
            }


              // Resize Image  and upload
              $cropImage = Image::make($image)->resize(300,400)->stream();
              Storage::disk('public')->put('profile_photo/'.$image_name,$cropImage);

              $profile->image = $image_name;

         }


        $profile->name =  $request->name;
        $profile->email =  $request->email;
        $profile->contact =  $request->contact;
        $profile->save();

        session()->flash('success', 'Profile Updated Successfully');
        return redirect(route('profile.show'));
    }



}
