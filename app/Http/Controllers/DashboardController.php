<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Guide;
use App\Models\Tour;
use App\Models\Place;
use App\Models\Placetype;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index(){
        $countDistricts = District::count();
        $countPlacetypes = Placetype::count();
        $countPlaces = Place::count();
        $countTours = Tour::count();
        $countUsers = User::users()->count();
        $countGuides = User::guides()->count();
        return view('pages.dashboard', compact('countDistricts', 'countPlacetypes', 'countPlaces', 'countTours', 'countUsers', 'countGuides'));
    }



}
