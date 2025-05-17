<div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-[#01031090]">
    <div class="relative p-4 px-9 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="bg-white max-w-[320px] mx-auto flex flex-col h-fit rounded-[20px] pb-4 gap-4 overflow-hidden">
            <div class="w-full h-[150px] flex shrink-0">
                <img src="{{ Storage::url($carService->photo) }}" class="w-full h-full object-cover" alt="thumbnail">
            </div>
            <div class="flex flex-col px-4 gap-4">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-semibold text-lg leading-[27px]">{{ $carService->name }}</p>
                        <p class="text-sm leading-[21px] text-[#909DBF]">Top Rated Service</p>
                    </div>
                    <p class="rounded-full p-[6px_10px] bg-[#DFB3E6] w-fit font-bold text-xs leading-[18px]">POPULAR
                    </p>
                </div>
                <hr class="border-[#E9E8ED]">
                <p class="leading-[28px]">{{ $carService->description }}</p>
                <button class="rounded-full border border-[#E9E8ED] p-[12px_16px] bg-white w-full font-semibold"
                    data-modal-hide="default-modal">Close Details</button>
            </div>
        </div>
    </div>
</div>
