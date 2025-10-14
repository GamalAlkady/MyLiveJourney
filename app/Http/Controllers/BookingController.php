<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\TourStatus;
use App\Models\Booking;
use App\Models\Guide;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Tour;
use App\Notifications\BookingApprovedConfirmation;
use App\Notifications\BookingRejectedConfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // return $user->tours;
        // $bookings = Booking::pending();
        if ($user->isGuide()) {
            $bookings = $user->bookings();
        } else if ($user->isUser()) {
            $bookings = $user->bookings();
        } else {
            $bookings = Booking::Query();
        }
        $bookings = $bookings->paginate(config('settings.paginateListSize'));

        // return ($bookings->first());
        return view('pages.booking.index', compact('bookings'));
    }


    public function pendingBookings()
    {
        $bookings = Auth::user()->bookings();
        $bookings = $bookings->pending()->paginate(config('settings.paginateListSize'));
        // return ($bookings->first());
        return view('pages.booking.pendingBookings', compact('bookings'));
    }

    public function approvedBookings()
    {
        $bookings = Auth::user()->bookings();
        $bookings = $bookings->approved()->paginate(config('settings.paginateListSize'));
        // return ($bookings->first());
        return view('pages.booking.approvedBookings', compact('bookings'));
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            'tour_id' => 'required',
            'seats' => 'required|integer|min:1',
        ]);

        try {
            // return response()->json(['error' => json_encode($request->input('id'))], Response::HTTP_UNPROCESSABLE_ENTITY);
            DB::transaction(function () use ($request) {

                $data['tour_id'] = $request->input('tour_id');
                $data['tourist_id'] = Auth::id();

                // throw new \Exception(json_encode($data));

                $tour = Tour::findOrFail($data['tour_id']);
                if ($tour->status != TourStatus::Available) {
                    throw new \Exception(__('alerts.tourNotAvailable'));
                    // return response()->json(['error' => __('alerts.tourNotAvailable'), Response::HTTP_UNPROCESSABLE_ENTITY]);
                }

                $price = $tour->price;
                $data['seats'] = $request->input('seats');
                $data['total_price'] = $price * $data['seats'];

                // dd($data);
                $book = Booking::firstOrNew(['id' => $request->input('id')]);
                $book->fill($data);
                $book->save();
            });
            return response()->json(['message' => __('alerts.bookingRequestSent')], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }

        // session()->flash('success', '');
        // return redirect()->back();
    }

    /**
     * Approve a booking request by admin
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bookingApprove(Booking $booking)
    {
        try {
            DB::transaction(function () use ($booking) {

                $booking->status = BookingStatus::Approved;
                $booking->save();

                $tour = Tour::find($booking->tour_id);
                $tour->decrement('remaining_seats', $booking->seats);
                if ($tour->isFull()) {
                    $tour->status = TourStatus::Full;
                }
                $tour->save();
            });

            $booking->tourist->notify(new BookingApprovedConfirmation($booking));
            session()->flash('success', __('alerts.bookingRequestApproved'));
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    public function bookingReject(Booking $booking)
    {
        try {

            $booking->status = BookingStatus::Rejected;
            $booking->save();

            $booking->tourist->notify(new BookingRejectedConfirmation($booking));
            session()->flash('success', __('alerts.bookingRequestRejected'));
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    public function bookingCancel(Booking $booking)
    {
        try {
            $booking->status = BookingStatus::Cancelled;
            $booking->save();

            // $booking->tourist->notify(new BookingRejectedConfirmation($booking));
            session()->flash('success', __('alerts.bookingRequestCancelled'));
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    public function bookingRemoveByAdmin($id)
    {

        $req = Booking::find($id);

        $guide = Guide::find($req->guide_id);
        $guide->status = 1;
        $guide->save();


        $req->delete();
        session()->flash('success', __('alerts.bookingRequestRejected'));
        return redirect()->back();
    }


    public function runningPackage()
    {
        $runningLists = Booking::where('approved_status', 'yes')->where('is_completed', 'no')->get();
        return view('pages.booking.runningPackage', compact('runningLists'));
    }

    public function runningPackageComplete($id)
    {
        $req = Booking::find($id);

        $guide = Guide::find($req->guide_id);
        $guide->status = 1;
        $guide->save();

        $req->is_completed = "yes";
        $req->save();

        session()->flash('success', 'Tour Completed Successfully');
        return redirect()->back();
    }



    // function  destroy
    public function destroy(Booking $booking)
    {
        $booking->delete();
        session()->flash('success', __('alerts.bookingDeleted'));
        return redirect()->back();
    }
}
