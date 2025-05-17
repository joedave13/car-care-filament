<nav id="Bottom-nav"
    class="fixed bottom-0 w-full max-w-[640px] mx-auto border-t border-[#E9E8ED] p-[20px_24px] bg-white z-20">
    <ul class="flex items-center justify-evenly">
        <li>
            <a href="{{ route('home.index') }}" class="flex flex-col items-center text-center gap-1">
                <div class="w-6 h-6 flex shrink-0 ">
                    <img src="{{ request()->routeIs('home.index') ? asset('assets/images/icons/element-equal.svg') : asset('assets/images/icons/element-equal-grey.svg') }}"
                        alt="icon">
                </div>
                <p
                    class="font-semibold text-xs leading-[18px] {{ request()->routeIs('home.index') ? 'text-[#FF8969]' : 'text-[#BABEC7]' }}">
                    Home</p>
            </a>
        </li>
        <li>
            <a href="{{ route('bookings.check') }}" class="flex flex-col items-center text-center gap-1">
                <div class="w-6 h-6 flex shrink-0 ">
                    <img src="{{ request()->routeIs('bookings.check') ? asset('assets/images/icons/note-favorite.svg') : asset('assets/images/icons/note-favorite-grey.svg') }}"
                        alt="icon">
                </div>
                <p
                    class="font-semibold text-xs leading-[18px] {{ request()->routeIs('bookings.check') ? 'text-[#FF8969]' : 'text-[#BABEC7]' }}">
                    Bookings</p>
            </a>
        </li>
        <li>
            <a href="#" class="flex flex-col items-center text-center gap-1">
                <div class="w-6 h-6 flex shrink-0 ">
                    <img src="{{ asset('assets/images/icons/ticket-discount-grey.svg') }}" alt="icon">
                </div>
                <p class="font-semibold text-xs leading-[18px] text-[#BABEC7]">Coupons</p>
            </a>
        </li>
        <li>
            <a href="#" class="flex flex-col items-center text-center gap-1">
                <div class="w-6 h-6 flex shrink-0 ">
                    <img src="{{ asset('assets/images/icons/message-question-grey.svg') }}" alt="icon">
                </div>
                <p class="font-semibold text-xs leading-[18px] text-[#BABEC7]">Help</p>
            </a>
        </li>
    </ul>
</nav>
