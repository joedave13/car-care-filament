<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Models\CarStore;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $carStore = CarStore::with(['carStorePhotos', 'city'])->find($request->car_store_id);
        $carService = CarService::query()->find($request->car_service_id);

        return view('pages.booking.create', compact('carStore', 'carService'));
    }
}
