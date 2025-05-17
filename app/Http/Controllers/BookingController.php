<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\ConfirmBookingRequest;
use App\Models\CarService;
use App\Models\CarStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $carStore = CarStore::with(['carStorePhotos', 'city'])->find($request->car_store_id);
        $carService = CarService::query()->find($request->car_service_id);

        return view('pages.booking.create', compact('carStore', 'carService'));
    }

    public function save(ConfirmBookingRequest $request)
    {
        $validate = $request->validated();
        $validate['started_date'] = Carbon::now()->addDay()->format('Y-m-d');

        $carService = CarService::query()->find($validate['car_service_id']);

        $payment['price'] = $carService->price;
        $payment['booking_fee'] = 20000;
        $payment['vat'] = 0.11 * $payment['price'];
        $payment['grand_total'] = $payment['price'] + $payment['booking_fee'] + $payment['vat'];

        $booking = array_merge($validate, $payment);

        Session::put('booking_data', $booking);

        return redirect()->route('bookings.confirm');
    }

    public function confirm()
    {
        $booking = Session::get('booking_data', []);

        $carStore = CarStore::with(['carStorePhotos', 'city'])->find($booking['car_store_id']);
        $carService = CarService::query()->find($booking['car_service_id']);

        return view('pages.booking.confirm', compact('booking', 'carStore', 'carService'));
    }
}
