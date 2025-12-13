@extends('layouts.theme')
@section('title', 'About Us')
@section('content')
<div class="bg-gray-100 min-h-screen pb-12">
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

 
<!-- About Company -->
<section class="flex flex-col md:flex-row items-center gap-10 md:gap-12">
  <!-- Image -->
  <div class="w-full md:w-1/2">
    <img src="{{ asset('Images/store12.jpg') }}" alt="CellMart Store" class="w-full rounded-3xl object-cover">
  </div>

  <!-- Text -->
  <div class="w-full md:w-1/2 space-y-4 md:space-y-6">
    <h2 class="text-4xl font-extrabold text-center md:text-left text-gray-900">About CellMart</h2>
    <p class="text-gray-700 text-center md:text-left leading-relaxed">
      At CellMart, we provide the latest mobile phones, tablets, and accessories all in one place. 
      Our goal is to make technology accessible, offering high-quality products from trusted brands at competitive prices.
    </p>
    <p class="text-gray-700 text-center md:text-left leading-relaxed">
      Our team is passionate about technology and dedicated to helping customers make informed decisions. 
      From smartphones with cutting-edge features to essential accessories like chargers, headphones, and protective cases, 
      we prioritize quality, authenticity, and excellent service in every purchase.
    </p>
  </div>
</section>

<!-- Products & Quality -->
<section class="flex flex-col md:flex-row-reverse items-center gap-10 md:gap-12 mt-12">
  <!-- Image -->
  <div class="w-full md:w-1/2">
    <img src="{{ asset('Images/allphones.webp') }}" alt="CellMart Products" class="w-full rounded-3xl object-cover">
  </div>

  <!-- Text -->
  <div class="w-full md:w-1/2 space-y-4 md:space-y-6">
    <h2 class="text-4xl font-extrabold text-center md:text-left text-gray-900">Our Products & Quality</h2>
    <p class="text-gray-700 text-center md:text-left leading-relaxed">
      At CellMart, we are committed to providing reliable, safe, and high-quality mobile phones and accessories. 
      Each product is carefully selected and tested to meet industry standards, ensuring customer satisfaction and trust.
    </p>
    <p class="text-gray-700 text-center md:text-left leading-relaxed">
      We continually update our offerings to reflect new technologies and market trends. 
      Our skilled team supports every customer with knowledge, guidance, and exceptional service, making CellMart 
      a trusted destination for all mobile needs.
    </p>
  </div>
</section>



<!-- Why Choose Us -->
<section class="bg-white rounded-2xl p-6 md:p-10">
    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-8">
        Why Choose CellMart?
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Item 1 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Wide Selection</h3>
                <p class="text-sm text-gray-600">
                    Flagship phones, budget devices, and accessories.
                </p>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Competitive Pricing</h3>
                <p class="text-sm text-gray-600">
                    Best value with regular deals and offers.
                </p>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Expert Support</h3>
                <p class="text-sm text-gray-600">
                    Friendly advice to choose the right device.
                </p>
            </div>
        </div>

        <!-- Item 4 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Secure Payments</h3>
                <p class="text-sm text-gray-600">
                    Safe and trusted payment options.
                </p>
            </div>
        </div>

    </div>
</section>


  <!-- Our Values Section -->
  <section class="bg-white rounded-3xl p-8 md:p-12">
    <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-12">Our Core Values</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-gray-100 p-8 rounded-2xl text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Trust & Authenticity</h3>
        <p class="text-gray-600">Every product we sell is 100% authentic and comes with manufacturer warranty</p>
      </div>

      <div class="bg-gray-100 p-8 rounded-2xl text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Customer First</h3>
        <p class="text-gray-600">Your satisfaction is our priority with dedicated support and service</p>
      </div>

      <div class="bg-gray-100 p-8 rounded-2xl text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
        <p class="text-gray-600">We stay ahead with the latest technology and trending products</p>
      </div>
    </div>
  </section>


<!-- Trade-In / Upgrade Section -->
<section class="bg-white rounded-2xl p-6 md:p-10">
    <div class="flex flex-col lg:flex-row items-center gap-8">

        <!-- Image -->
        <div class="w-full lg:w-1/2">
            <img 
                src="{{ asset('Images/Trade-in go to the products page.webp') }}"
                alt="Upgrade Your Device"
                class="w-full rounded-xl object-cover"
            >
        </div>

        <!-- Content -->
        <div class="w-full lg:w-1/2 space-y-5">

            <span class="text-sm font-semibold text-blue-600 uppercase">
                Ready to Upgrade?
            </span>

            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                Find Your Next Device
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Browse our latest smartphones, tablets, and accessories at competitive prices,
                backed by trusted service and warranty.
            </p>

            <!-- Key Points -->
            <ul class="space-y-3">
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    <span class="text-gray-700">Latest models available</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    <span class="text-gray-700">Best prices & special offers</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                    <span class="text-gray-700">Warranty on all products</span>
                </li>
            </ul>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a 
                    href="{{ route('products.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center transition"
                >
                    Browse Products
                </a>

                <a 
                    href="{{ route('contact') }}"
                    class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold px-6 py-3 rounded-lg text-center transition"
                >
                    Contact Us
                </a>
            </div>

            <!-- Trust Text -->
            <p class="text-sm text-gray-500 pt-3">
                ⭐ Trusted by 10,000+ customers · 100% authentic products
            </p>

        </div>
    </div>
</section>








</main>
</div>
@endsection
