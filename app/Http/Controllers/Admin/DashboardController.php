<?php

namespace App\Http\Controllers\Admin;

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
        $districts = District::latest()->get();
        $placetypes = Placetype::latest()->get();
        $places = Place::latest()->get();
        $packages = Tour::latest()->get();
        $users = User::latest()->get();
        $guides = Guide::latest()->get();
        return view('pages.admin.dashboard', compact('districts', 'placetypes', 'places', 'packages', 'users', 'guides'));
    }



}
