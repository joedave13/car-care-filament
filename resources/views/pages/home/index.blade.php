@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <div class="bg-[#270738] absolute top-0 max-w-[640px] w-full mx-auto rounded-b-[50px] h-[370px]"></div>
    <header class="flex flex-col gap-3 items-center text-center pt-10 relative z-10">
        <div class="flex shrink-0">
            <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="logo">
        </div>
        <p class="text-sm leading-[21px] text-white">Premium Wash & Car Detailing</p>
    </header>

    <form action="" class="flex flex-col gap-6 mt-6 relative z-10">
        <div class="flex flex-col gap-2 px-4">
            <label for="Location" class="font-semibold text-white">Location</label>
            <div
                class="rounded-full flex items-center p-[12px_16px] bg-white w-full transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FF8E62]">
                <div class="w-6 h-6 flex shrink-0 mr-[6px]">
                    <img src="{{ asset('assets/images/icons/location-normal.svg') }}" alt="icon">
                </div>
                <select name="location" id="city-id" class="bg-white font-semibold w-full outline-none">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <section id="Services" class="flex flex-col gap-3 px-4">
            <h1 class="font-semibold text-white">Our Great Services</h1>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($carServices as $carService)
                    <a href="javascript:void(0)" class="service-link card-services"
                        data-car-service-id="{{ $carService->id }}">
                        <div
                            class="rounded-[20px] border border-[#E9E8ED] py-4 flex flex-col items-center text-center gap-4 bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FF8E62]">
                            <div class="w-[50px] h-[50px] flex shrink-0">
                                <img src="{{ Storage::url($carService->icon) }}" alt="icon">
                            </div>
                            <div class="flex flex-col">
                                <p class="font-semibold text-sm leading-[21px]">{{ $carService->name }}</p>
                                <p class="text-xs leading-[18px] text-[#909DBF]">{{ $carService->car_stores_count }} Stores
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </form>

    <section id="Promo" class="flex flex-col gap-3 px-4 mt-6 relative z-10">
        <h1 class="font-semibold">Special Offers</h1>
        <a href="#">
            <div class="w-full aspect-[360/120] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{ asset('assets/images/thumbnails/banner.png') }}" class="object-cover w-full h-full"
                    alt="promo banner">
            </div>
        </a>
    </section>

    @include('includes.bottom-navigation')

    @push('scripts')
        <script>
            document.querySelectorAll('.service-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const cityId = document.getElementById('city-id').value;
                    const carStoreServiceId = this.getAttribute('data-car-service-id');

                    if (cityId && carStoreServiceId) {
                        window.location.href =
                            `/car-services/show?id=${carStoreServiceId}&city_id=${cityId}`;
                    } else {
                        window.location.href = 'javascript:void(0)';
                    }
                })
            });
        </script>
    @endpush
@endsection
