<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Guide;
use App\Http\Controllers\Controller;
use App\Notifications\PackageApproveConfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function pendingBookingList(){
        $pendinglists = Booking::where('approved_status', 'no')->get();
        return view('pages.admin.booking.pendinglist', compact('pendinglists'));
    }

    /**
     * Approve a booking request by admin
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bookingApprove($id){
        $req = Booking::find($id);
        $req->approved_status = "yes";
        $req->save();

        $req->tourist->notify(new PackageApproveConfirmation($req));

        session()->flash('success', 'Booking Request Approved Successfully');
        return redirect()->back();
    }

    public function bookingRemoveByAdmin($id){

        $req = Booking::find($id);

        $guide = Guide::find($req->guide_id);
        $guide->status = 1;
        $guide->save();


        $req->delete();
        session()->flash('success', 'Booking Request Removed Successfully');
        return redirect()->back();
    }


    public function runningPackage(){
        $runningLists = Booking::where('approved_status', 'yes')->where('is_completed', 'no')->get();
        return view('pages.admin.booking.runningPackage', compact('runningLists'));

    }

    public function runningPackageComplete($id){
       $req = Booking::find($id);

        $guide = Guide::find($req->guide_id);
        $guide->status = 1;
        $guide->save();

       $req->is_completed = "yes";
       $req->save();

       session()->flash('success', 'Tour Completed Successfully');
       return redirect()->back();
    }

    public function tourHistory(){
        $historyList = Booking::where('approved_status', 'yes')->where('is_completed', 'yes')->get();
        return view('pages.admin.booking.historyList', compact('historyList'));
    }


}
