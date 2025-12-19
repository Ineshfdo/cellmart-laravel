<div class="bg-white rounded-2xl p-6 md:p-10">
    <div class="max-w-3xl mx-auto">

        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-3">
            Send Us a Message
        </h2>
        <p class="text-center text-gray-600 mb-8">
            Fill out the form below and we’ll get back to you shortly.
        </p>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms
                 class="mb-6 bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <p class="font-medium mb-2">Please fix the following:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="submit" x-on:form-submitted="$el.reset()">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Full Name 
                    </label>
                    <input type="text" wire:model="name" required
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address 
                    </label>
                    <input type="email" wire:model="email" required
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Phone Number
                    </label>
                    <input type="tel" wire:model="phone"
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Subject 
                    </label>
                    <input type="text" wire:model="subject" required
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Message 
                </label>
                <textarea wire:model="message" rows="5" required
                          class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"></textarea>
                @error('message')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center mt-8">
                <button type="submit" wire:loading.attr="disabled"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-10 py-3 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading>Sending...</span>
                </button>
            </div>
        </form>
    </div>
</div>
