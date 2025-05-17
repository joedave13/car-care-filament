<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Models\CarStore;
use Illuminate\Http\Request;

class CarStoreController extends Controller
{
    public function show(CarStore $carStore, Request $request)
    {
        $carStore->load(['carStorePhotos', 'city']);
        $carService = CarService::query()->find($request->car_service_id);

        return view('pages.car-store.show', compact('carStore', 'carService'));
    }
}
