<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::query()->get();
        $carServices = CarService::query()->withCount('carStores')->get();

        return view('pages.home.index', compact('cities', 'carServices'));
    }
}
