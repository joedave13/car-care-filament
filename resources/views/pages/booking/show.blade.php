@extends('layouts.app', ['title' => 'Booking Detail'])

@section('content')
    <div class="bg-[#270738] absolute top-0 max-w-[640px] w-full mx-auto rounded-b-[50px] h-[472px]"></div>

    <div id="Top-nav" class="flex items-center justify-between px-8 pt-5 relative z-10">
        <a href="{{ route('bookings.check') }}">
            <div class="w-10 h-10 flex shrink-0">
                <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
            </div>
        </a>
        <div class="flex flex-col w-fit text-center">
            <h1 class="font-semibold text-lg leading-[27px] text-white">Booking Details</h1>
            <p class="text-sm leading-[21px] text-white">Treat Your Car Nicely</p>
        </div>
        <div class="w-10 h-10 flex shrink-0">
        </div>
    </div>

    <div id="Status-details" class="flex flex-col gap-2 px-8 mt-[30px] relative z-10">
        <div class="flex flex-col w-full rounded-2xl border border-[#E9E8ED] p-4 gap-4 bg-white">
            <div id="Service" class="flex flex-col gap-2">
                <div class="flex items-center w-full gap-[10px] bg-white justify-between">
                    <div class="flex items-center gap-[10px]">
                        <div class="w-[60px] h-[60px] flex shrink-0">
                            <img src="{{ asset('assets/images/icons/illustration6.svg') }}" alt="icon">
                        </div>
                        <div class="flex flex-col h-fit">
                            <div class="flex items-center gap-1">
                                <p class="font-semibold w-fit">{{ $booking->code }}</p>
                                <div class="w-[18px] h-[18px] flex shrink-0">
                                    <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                                </div>
                            </div>
                        </div>
                    </div>
                    @switch($booking->payment_status)
                        @case(\App\Enums\TransactionPaymentStatus::PENDING)
                            <p class="rounded-full p-[6px_10px] bg-[#FFCE51] w-fit font-bold text-xs leading-[18px]">PENDING</p>
                        @break

                        @case(\App\Enums\TransactionPaymentStatus::SUCCESS)
                            <p class="rounded-full p-[6px_10px] bg-[#41BE64] w-fit font-bold text-xs leading-[18px] text-white">PAID
                            </p>
                        @break

                        @case(\App\Enums\TransactionPaymentStatus::FAILED)
                            <p class="rounded-full p-[6px_10px] bg-[#F12B3E] w-fit font-bold text-xs leading-[18px] text-white">
                                FAILED</p>
                        @break

                        @default
                            <p class="rounded-full p-[6px_10px] bg-[#FFCE51] w-fit font-bold text-xs leading-[18px]">PENDING</p>
                    @endswitch
                </div>
            </div>
        </div>
    </div>

    <div id="Order-details" class="flex flex-col gap-2 px-8 mt-[18px] relative z-10">
        <div class="flex flex-col w-full rounded-2xl border border-[#E9E8ED] p-4 gap-4 bg-white">
            <div id="Location" class="flex flex-col gap-2">
                <h2 class="font-semibold">Store At</h2>
                <div class="flex items-center w-full gap-[10px] bg-white">
                    <div class="w-[80px] h-[60px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ Storage::url($booking->carStore->carStorePhotos()->first()->photo) }}"
                            class="w-full h-full object-cover" alt="thumbnail">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1">
                            <p class="font-semibold w-fit">{{ $booking->carStore->name }}</p>
                            <div class="w-[18px] h-[18px] flex shrink-0">
                                <img src="{{ asset('assets/images/icons/verify.svg') }}" alt="verified">
                            </div>
                        </div>
                        <div class="flex items-center gap-[2px]">
                            <p class="text-sm leading-[21px] text-[#909DBF]">{{ $booking->carStore->address }},
                                {{ $booking->carStore->city->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-[#E9E8ED]">

            <div id="Service" class="flex flex-col gap-2">
                <h2 class="font-semibold">Your Service</h2>
                <div class="flex items-center w-full gap-[10px] bg-white justify-between">
                    <div class="flex items-center gap-[10px]">
                        <div class="w-[60px] h-[60px] flex shrink-0">
                            <img src="{{ Storage::url($booking->carService->icon) }}" alt="icon">
                        </div>
                        <div class="flex flex-col h-fit">
                            <p class="font-semibold">{{ $booking->carService->name }}</p>
                            <p class="text-sm leading-[21px] text-[#909DBF]">Top Rated Service</p>
                        </div>
                    </div>
                    <p class="rounded-full p-[6px_10px] bg-[#DFB3E6] w-fit font-bold text-xs leading-[18px]">POPULAR</p>
                </div>
            </div>

            <hr class="border-[#E9E8ED]">

            <div id="Time-details" class="flex flex-col gap-[10px]">
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Date At</p>
                    <p class="font-semibold">{{ $booking->started_date->format('d M Y') }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Time At</p>
                    <p class="font-semibold">{{ $booking->started_time }}</p>
                </div>
            </div>
            <hr class="border-[#E9E8ED]">
            <div id="Price-details" class="flex flex-col gap-[10px]">
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">{{ $booking->carService->name }} Price</p>
                    <p class="font-semibold">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Booking Fee</p>
                    <p class="font-semibold">Rp {{ number_format($booking->booking_fee, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">PPN 11%</p>
                    <p class="font-semibold">Rp {{ number_format($booking->vat, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm leading-[21px]">Grand Total</p>
                    <p class="font-bold text-xl leading-[30px] text-[#FF8E62]">Rp
                        {{ number_format($booking->grand_total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-8 mt-[30px] flex">
        <a href="javascript:void(0)"
            class="w-full rounded-full p-[12px_20px] bg-[#FF8E62] font-bold text-white text-center">Call
            Customer Service</a>
    </div>
@endsection
