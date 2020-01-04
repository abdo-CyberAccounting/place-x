<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $stats = Helper::getStats();

        return view('today_guests', [
            'todayGuestsCount' => $stats['todayGuestsCount'],
            'yesterdayGuestsCount' => $stats['yesterdayGuestsCount']
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTodayGuests(Request $request)
    {
        $todayDate = Carbon::now()->toDateString();
        $todayGuests = Guest::where('created_at', 'like', $todayDate . '%')
            ->where('active', 1)
            ->get();

        return \DataTables::of($todayGuests)->addColumn('action', function ($guest) {
            return '<button data-toggle="modal" data-target="#edit-user-modal" data-guest_id="' . $guest->id . '"
                            title="Edit Guest Data" class="btn btn-outline-primary guest-edit far fa-edit"
                             style="font-size:25px">
                    </button>
                    <button data-toggle="modal" data-target="#checkout-modal" data-guest_id="' . $guest->id . '"
                            title="Get Cheque" class="btn btn-outline-danger guest-checkout fas fa-sign-out-alt"
                             style="font-size:25px">
                    </button>';
        })->make(true);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function addNewGuest(Request $request)
    {
        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'speciality' => $request->speciality,
            'mobile' => $request->mobile,
            'come_from' => $request->come_from,
            'start_date' => Carbon::now()->format('g:i:s')
        ]);

        if ($guest) {
            return [
                'code' => 200,
                'message' => 'Guest Has Been Added Successfully'
            ];
        }

        return [
            'code' => 400,
            'message' => 'Sorry, an error occurred while adding the guest'
        ];
    }

    public function checkout(Request $request)
    {
        $guest = Guest::findOrFail($request->guest_id);
        $startDate = $guest->start_date;
        $endDate = Carbon::now()->format('g:i:s');
        $totalTime = round(Carbon::parse($startDate)->floatDiffInHours($endDate), 2);
        $totalCost = $totalTime >= 5 ? 30 : $totalTime * 5 + 5;
        $totalCost = round($totalCost, 2);
        $totalCost = $guest->discount_50 ? $totalCost / 2 : $totalCost;


        $guest->update([
            'end_date' => $endDate,
            'total_time' => $totalTime,
            'total_cost' => $totalCost,
            'active' => $request->checkout ? 0 : 1,
            'discount_50' => $guest->discount_50
        ]);

        return $guest;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateGuestDiscount(Request $request)
    {
        $guest = Guest::findOrFail($request->guest_id);
        $guest->discount_50 = !$guest->discount_50;
        $guest->total_cost = $guest->discount_50 ? $guest->total_cost / 2 : $guest->total_cost * 2;
        $guest->save();

        return $guest;
    }
}
