<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Models\CarStore;
use App\Models\City;
use Illuminate\Http\Request;

class CarServiceController extends Controller
{
    public function show(Request $request)
    {
        $carServiceId = $request->id;
        $cityId = $request->city_id;

        $carService = CarService::query()->find($carServiceId);
        $carStores = CarStore::with(['carStorePhotos', 'city'])
            ->whereRelation('carServices', 'car_service_id', $carServiceId)
            ->where('city_id', $cityId)
            ->get();
        $city = City::query()->find($cityId);

        return view('pages.car-service.show', compact('carService', 'carStores', 'city'));
    }
}
