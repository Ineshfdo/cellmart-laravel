<div>
    <!-- Quantity Selector -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-3">Quantity <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-3">
            <button type="button" wire:click="decrementQuantity" class="w-10 h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition font-bold text-lg">
                -
            </button>
            <input type="number" value="{{ $quantity }}" readonly
                   class="w-16 h-10 text-center border-2 border-gray-300 rounded-lg font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="button" wire:click="incrementQuantity" class="w-10 h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition font-bold text-lg">
                +
            </button>
        </div>
    </div>

    <!-- Color Selector -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-3">Color <span class="text-red-500">*</span></label>
        <div class="flex gap-2">
            <!-- Black -->
            <div class="color-option" wire:click="setColor('Black')">
                <div class="w-8 h-8 rounded-full bg-black border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center {{ $color === 'Black' ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                    <svg class="w-4 h-4 text-white {{ $color === 'Black' ? '' : 'hidden' }} checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <!-- White -->
            <div class="color-option" wire:click="setColor('White')">
                <div class="w-8 h-8 rounded-full bg-white border-2 border-gray-300 cursor-pointer hover:scale-110 transition-transform flex items-center justify-center {{ $color === 'White' ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                    <svg class="w-4 h-4 text-gray-800 {{ $color === 'White' ? '' : 'hidden' }} checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <!-- Blue -->
            <div class="color-option" wire:click="setColor('Blue')">
                <div class="w-8 h-8 rounded-full bg-blue-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center {{ $color === 'Blue' ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                    <svg class="w-4 h-4 text-white {{ $color === 'Blue' ? '' : 'hidden' }} checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <!-- Red -->
            <div class="color-option" wire:click="setColor('Red')">
                <div class="w-8 h-8 rounded-full bg-red-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center {{ $color === 'Red' ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                    <svg class="w-4 h-4 text-white {{ $color === 'Red' ? '' : 'hidden' }} checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <!-- Green -->
            <div class="color-option" wire:click="setColor('Green')">
                <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center {{ $color === 'Green' ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                    <svg class="w-4 h-4 text-white {{ $color === 'Green' ? '' : 'hidden' }} checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">Selected: <span class="font-semibold">{{ $color }}</span></p>
    </div>

    <!-- Warranty Selector -->
    <div class="mb-8">
        <label for="warranty" class="block text-sm font-medium text-gray-700 mb-2">Warranty Plan <span class="text-red-500">*</span></label>
        <div class="relative">
            <select wire:model.live="warranty" id="warranty"
                    class="block w-full pl-4 pr-10 py-3 text-base border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-xl bg-gray-50 transition">
                <option value="1 Year Company Warranty">1 Year Company Warranty</option>
                <option value="2 Years Extended Warranty">2 Years Extended Warranty</option>
            </select>
        </div>
    </div>

    <!-- Add to Cart Form Replacement -->
    <div class="flex gap-4">
        <button wire:click="addToCart" wire:loading.attr="disabled" class="flex-1 bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove>Add To Cart</span>
            <span wire:loading>Adding...</span>
        </button>
        <a href="{{ url()->previous() }}" 
            class="px-6 py-4 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition border border-gray-200">
            Back
        </a>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (message) => {
                alert(message);
            });
        });
    </script>
</div>
