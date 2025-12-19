@extends('layouts.theme')
@section('title','Contact Us')
@section('content')
<div class="bg-gray-100 min-h-screen pb-12">
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">
   <!-- Contact Info & Image -->
<section class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
    <!-- Image -->
    <div class="w-full md:w-1/2">
        <img src="{{ asset('Images/store11.webp') }}" alt="Contact Us" class="w-full rounded-3xl object-cover">
    </div>

    <!-- Info -->
    <div class="w-full md:w-1/2 space-y-6">
        <h2 class="text-4xl font-extrabold text-center md:text-left text-gray-900">Contact Us</h2>
        <p class="text-gray-700 text-center md:text-left leading-relaxed">
            At CellMart, we prioritize our customers above all. Whether you have a question about our products,
            need assistance with an order, or want to provide feedback, we are here to help. Our dedicated support
            team is available to ensure your experience with us is nothing short of exceptional.
        </p>

        <!-- Contact Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-6">
            <!-- Email -->
            <div class="bg-white p-5 rounded-2xl">
                <p class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email Address
                </p>
                <p class="text-gray-600 mt-1">Cellmart@gmail.com</p>
            </div>

            <!-- Phone -->
            <div class="bg-white p-5 rounded-2xl">
                <p class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Phone Number
                </p>
                <p class="text-gray-600 mt-1">075-869-0018</p>
            </div>

            <!-- YouTube -->
            <div class="bg-white p-5 rounded-2xl">
                <p class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                    YouTube Channel
                </p>
                <p class="text-gray-600 mt-1">CellMart2.0</p>
            </div>

            <!-- WhatsApp -->
            <div class="bg-white p-5 rounded-2xl">
                <p class="font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    WhatsApp
                </p>
                <p class="text-gray-600 mt-1">075-869-0018</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="bg-white rounded-3xl p-8 md:p-12">
    <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-12">Why Choose CellMart?</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Quality Assured -->
        <div class="bg-gray-100 p-6 md:p-8 rounded-2xl text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Quality Assured</h3>
            <p class="text-gray-600">All our products are 100% authentic and come with manufacturer warranties</p>
        </div>

        <!-- Best Prices -->
        <div class="bg-gray-100 p-6 md:p-8 rounded-2xl text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Best Prices</h3>
            <p class="text-gray-600">Competitive pricing with regular discounts and special offers</p>
        </div>

        <!-- 24/7 Support -->
        <div class="bg-gray-100 p-6 md:p-8 rounded-2xl text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">24/7 Support</h3>
            <p class="text-gray-600">Our dedicated team is always ready to assist you with any concerns</p>
        </div>
    </div>
</section>

    <!-- Mission Section -->
<section class="flex flex-col md:flex-row-reverse items-center gap-10 md:gap-12">
    <!-- Image -->
    <div class="w-full md:w-1/2">
        <img src="{{ asset('Images/1.jpg') }}" alt="Our Mission" class="w-full rounded-3xl object-cover">
    </div>

    <!-- Text Content -->
    <div class="w-full md:w-1/2 space-y-4 md:space-y-6">
        <h2 class="text-4xl font-extrabold text-center md:text-left text-gray-900">Our Mission</h2>
        <p class="text-gray-700 text-center md:text-left leading-relaxed">
            CellMart's mission is to redefine the way people shop for mobile phones and accessories. We strive to provide cutting-edge technology at competitive prices while maintaining the highest standards of customer service. Our goal is to make premium mobile devices accessible to everyone.
        </p>
        <p class="text-gray-700 text-center md:text-left leading-relaxed">
            We believe in building lasting relationships with our customers through transparency, reliability, and exceptional support. Every product we offer is carefully selected to ensure quality and value.
        </p>
    </div>
</section>

    <!-- Social Media Section -->
<section class="bg-white rounded-2xl p-6 md:p-10 text-center space-y-6">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
        Stay Connected
    </h2>
    <p class="text-gray-600 text-base md:text-lg">
        Follow us on social media for the latest updates and exclusive deals
    </p>

    <div class="flex justify-center gap-4 md:gap-6">

        <!-- Facebook -->
        <a href="https://www.facebook.com" class="w-12 h-12 md:w-14 md:h-14 bg-blue-50 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors duration-300">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com" class="w-12 h-12 md:w-14 md:h-14 bg-pink-50 rounded-full flex items-center justify-center hover:bg-pink-500 transition-colors duration-300">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-pink-500 hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2.2a2.8 2.8 0 110 5.6 2.8 2.8 0 010-5.6zM17.3 6.7a1.3 1.3 0 11-2.6 0 1.3 1.3 0 012.6 0z"/>
            </svg>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com" class="w-12 h-12 md:w-14 md:h-14 bg-blue-50 rounded-full flex items-center justify-center hover:bg-blue-400 transition-colors duration-300">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-400 hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
            </svg>
        </a>

        <!-- YouTube -->
        <a href="https://www.youtube.com" class="w-12 h-12 md:w-14 md:h-14 bg-red-50 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors duration-300">
            <svg class="w-5 h-5 md:w-6 md:h-6 text-red-600 hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
        </a>

    </div>
</section>


    <!-- Location/Map Section -->
    <section class="space-y-8">
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-extrabold text-gray-900">Visit Our Store</h2>
            <p class="text-gray-600 text-lg">Come experience our products firsthand at our physical location</p>
        </div>
        <div class="bg-gray-200 rounded-3xl overflow-hidden h-96">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31757.71122948794!2d79.8148009024564!3d6.92774495707024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2599b4e9b8aa3%3A0xf28bb033b1c54c71!2sOne%20Galle%20Face%20Mall!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    </section>

    <!-- FAQ Section -->
<section class="space-y-8">
    
    <div class="text-center space-y-2">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
            Frequently Asked Questions
        </h2>
        <p class="text-gray-600">
            Quick answers to common questions
        </p>
    </div>

    <div class="max-w-4xl mx-auto space-y-3">

        <details class="bg-white border border-gray-200 rounded-xl p-5">
            <summary class="font-medium text-gray-900 cursor-pointer">
                What are your business hours?
            </summary>
            <p class="mt-3 text-gray-600 text-sm">
                We are open Monday to Saturday from 9:00 AM to 9:00 PM,
                and Sunday from 10:00 AM to 6:00 PM.
            </p>
        </details>

        <details class="bg-white border border-gray-200 rounded-xl p-5">
            <summary class="font-medium text-gray-900 cursor-pointer">
                Do you offer warranty on products?
            </summary>
            <p class="mt-3 text-gray-600 text-sm">
                Yes, all our products come with manufacturer warranty.
                Extended warranty options are also available.
            </p>
        </details>

        <details class="bg-white border border-gray-200 rounded-xl p-5">
            <summary class="font-medium text-gray-900 cursor-pointer">
                Can I return or exchange a product?
            </summary>
            <p class="mt-3 text-gray-600 text-sm">
                We offer a 7-day return policy on most products.
                Please keep the original packaging and receipt.
            </p>
        </details>

        <details class="bg-white border border-gray-200 rounded-xl p-5">
            <summary class="font-medium text-gray-900 cursor-pointer">
                Do you provide home delivery?
            </summary>
            <p class="mt-3 text-gray-600 text-sm">
                Yes, we offer home delivery services.
                Delivery charges may apply based on your location.
            </p>
        </details>

    </div>
</section>


    
    <!-- Contact Form Section -->
 
    @livewire('contact-form')
    
    

    

    

    
</main>
</div>
@endsection





