@extends('layouts.app', ['title' => 'Car Store Detail'])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div id="Top-nav" class="flex items-center justify-between px-4 pt-5 absolute top-0 z-10 w-full">
        <a href="{{ route('car-services.show', ['id' => $carService->id, 'city_id' => $carStore->city->id]) }}">
            <div class="w-10 h-10 flex shrink-0">
                <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <button class="w-10 h-10 flex shrink-0">
            <img src="{{ asset('assets/images/icons/Fav.svg') }}" alt="icon">
        </button>
    </div>

    <section id="Thumbnail" class="relative">
        <div class="swiper h-fit">
            <div class="swiper-wrapper w-full h-fit">
                @foreach ($carStore->carStorePhotos as $carStorePhoto)
                    <div class="swiper-slide !w-[310px] !h-[350px] flex shrink-0 overflow-hidden">
                        <img src="{{ Storage::url($carStorePhoto->photo) }}" class="object-cover w-full h-full"
                            alt="thumbnail">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="px-4 flex justify-between items-center transform translate-y-1/2 absolute bottom-0 z-10 w-full">
            @if ($carStore->is_open)
                <p class="badge w-fit rounded-full p-[6px_10px] bg-[#41BE64] font-bold text-xs leading-[18px] text-white">
                    OPEN NOW</p>
            @else
                <p class="badge w-fit rounded-full p-[6px_10px] bg-[#F12B3E] font-bold text-xs leading-[18px] text-white">
                    CLOSED</p>
            @endif

            <div class="flex items-center w-fit rounded-full border border-[#E9E8ED] p-[6px_12px] bg-white">
                <div class="w-[18px] h-[18px] flex shrink-0">
                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
                </div>
                <p class="text-sm leading-[21px] text-[#909DBF]"><span class="font-semibold text-[#270738]">4.8</span>
                    <span>(145,394)</span>
                </p>
            </div>
        </div>
    </section>

    <section id="details" class="flex flex-col gap-5 px-4 mt-[33px]">
        <div id="title" class="flex flex-col gap-[6px]">
            <div class="flex items-center gap-1">
                <h1 class="font-semibold text-xl leading-[30px] w-fit">{{ $carStore->name }}</h1>
                <div class="w-[22px] h-[22px] flex shrink-0">
                    <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                </div>
            </div>
            <div class="flex items-center gap-[2px]">
                <div class="w-4 h-4 flex shrink-0">
                    <img src="{{ asset('assets/images/icons/location.svg') }}" alt="icon">
                </div>
                <p class="text-sm leading-[21px] text-[#909DBF]">{{ $carStore->address }}, {{ $carStore->city->name }}</p>
            </div>
        </div>

        <div id="Menus" class="flex flex-col gap-5">
            <div class="tab-link-btns flex items-center gap-2">
                <button
                    class="tablink rounded-full border border-[#E9E8ED] p-[8px_16px] font-semibold text-sm leading-[21px] transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-[#5B86EF] text-white"
                    onclick="openPage('about-tab', this)" id="defaultOpen">
                    <h2>About</h2>
                </button>
                <button
                    class="tablink rounded-full border border-[#E9E8ED] p-[8px_16px] font-semibold text-sm leading-[21px] transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white"
                    onclick="openPage('reviews-tab', this)">
                    <h2>Reviews</h2>
                </button>
                <button
                    class="tablink rounded-full border border-[#E9E8ED] p-[8px_16px] font-semibold text-sm leading-[21px] transition-all duration-300 hover:bg-[#5B86EF] hover:text-white bg-white"
                    onclick="openPage('contact-tab', this)">
                    <h2>Contact</h2>
                </button>
            </div>

            <div class="tabs-contents">
                <div id="about-tab" class="tabcontent flex hidden">
                    <div class="flex flex-col gap-5">
                        <p class="leading-[28px]">{{ $carStore->about }}</p>
                        <div id="Service" class="flex flex-col gap-2">
                            <h2 class="font-semibold">Your Service</h2>
                            <div class="rounded-2xl border border-[#E9E8ED] flex items-center justify-between p-4 bg-white">
                                <div class="flex items-center gap-[10px]">
                                    <div class="w-[60px] h-[60px] flex shrink-0">
                                        <img src="{{ Storage::url($carService->icon) }}" alt="icon">
                                    </div>
                                    <div class="flex flex-col h-fit">
                                        <p class="font-semibold">{{ $carService->name }}</p>
                                        <p class="text-sm leading-[21px] text-[#909DBF]">Top Rated Service</p>
                                    </div>
                                </div>
                                <button
                                    class="appearance-none font-semibold text-sm leading-[21px] hover:underline text-[#FF8E62]"
                                    data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    type="button">Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="reviews-tab" class="tabcontent flex hidden">
                    <div class="flex flex-col gap-[14px] w-full">
                        <div class="reviews-card flex gap-3 pb-4 border-b border-[#E9E8ED] w-full last-of-type:border-b-0">
                            <div class="w-[50px] h-[50px] flex shrink-0">
                                <img src="{{ asset('assets/images/photos/photo1.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <div class="flex items-center justify-between">
                                    <p class="font-semibold text-sm leading-[21px]">Sara Putri</p>
                                    <div class="flex shrink-0">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="w-[14px] h-[14px] flex shrink-0">
                                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" alt="star">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm leading-[24px] text-[#909DBF]">Tempatnya enak buat santai sembari cuci
                                    mobil jadi makin mengkilap</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="contact-tab" class="tabcontent flex hidden">
                    <div class="flex flex-col gap-5">
                        <p class="leading-[28px]">Jika Anda memiliki pertanyaan silahkan menghubungi customer service kami
                        </p>
                        <div id="Contact" class="flex flex-col gap-2">
                            <div class="rounded-2xl border border-[#E9E8ED] flex items-center justify-between p-4 bg-white">
                                <div class="flex items-center gap-[10px]">
                                    <div class="w-[60px] h-[60px] flex shrink-0">
                                        <img src="{{ Storage::url($carStore->customer_service_avatar) }}" alt="icon">
                                    </div>
                                    <div class="flex flex-col h-fit">
                                        <p class="font-semibold">{{ $carStore->customer_service_name }}</p>
                                        <p class="text-sm leading-[21px] text-[#909DBF]">
                                            {{ $carStore->customer_service_phone }}</p>
                                    </div>
                                </div>
                                <a href="#"
                                    class="appearance-none font-semibold text-sm leading-[21px] hover:underline text-[#FF8E62]">Call
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="CTA-nav"
        class="fixed bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E9E8ED] flex items-center justify-between p-[16px_24px] bg-white z-20">
        <div class="flex flex-col gap-[2px]">
            <p class="font-bold text-xl leading-[30px]">Rp {{ number_format($carService->price, 0, ',', '.') }}</p>
            <p class="text-sm leading-[21px] text-[#909DBF]">{{ $carService->duration_in_hour }} Hours</p>
        </div>
        @if (!$carStore->is_open || $carStore->is_full)
            <a href="javascript:void(0)" class="rounded-full p-[12px_20px] bg-[#EEEFF4] font-bold text-[#AAADBF]">Full
                Booked</a>
        @else
            <a href="{{ route('bookings.create', ['car_store_id' => $carStore->id, 'car_service_id' => $carService->id]) }}"
                class="rounded-full p-[12px_20px] bg-[#FF8E62] font-bold text-white">Booking Now</a>
        @endif
    </div>

    <!-- About modal -->
    @include('includes.car-service-detail-modal')
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/front/details.js') }}"></script>
@endpush
