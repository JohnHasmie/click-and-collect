<x-app-layout>
    <div class="leading-loose flex justify-center">
        <form action="{{ route('checkout.place.order') }}" method="POST" role="form" class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
            <p class="text-gray-800 font-medium">Billing Details</p>
            @csrf
            <div class="">
                <label class="block text-sm text-gray-00" for="cus_name">Name</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" value="{{ auth()->user()->name }}" id="name" name="name" type="text" required="" placeholder="Your Name" aria-label="Name">
            </div>
            <div class="mt-2">
                <label class="block text-sm text-gray-600" for="cus_email">Email</label>
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" value="{{ auth()->user()->email }}" id="email" name="email" type="text" required="" placeholder="Your Email" aria-label="Email">
            </div>
            <div class="mt-2">
                <label class=" block text-sm text-gray-600" for="address">Address</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="address" name="address" type="text" required="" placeholder="Street" aria-label="Address">
            </div>
            <div class="mt-2">
                <label class="hidden text-sm block text-gray-600" for="city">City</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city" type="text" required="" placeholder="City" aria-label="City">
            </div>
            <div class="inline-block mt-2 w-1/2 pr-1">
                <label class="hidden block text-sm text-gray-600" for="country">Country</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country" type="text" required="" placeholder="Country" aria-label="Country">
            </div>
            <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                <label class="hidden block text-sm text-gray-600" for="post_code">Zip</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="post_code"  name="post_code" type="text" required="" placeholder="Post Code" aria-label="Post Code">
            </div>
            <div class="inline-block mt-2 w-1/2 pr-1">
                <label class="hidden text-sm block text-gray-600" for="phone_number">Phone</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="phone_number" name="phone_number" type="text" required="" placeholder="Phone Number" aria-label="Phone Number">
            </div>
            <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                <label class="hidden text-sm block text-gray-600" for="notes">Notes</label>
                <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="note" name="notes" type="text" required="" placeholder="Notes" aria-label="Notes">
            </div>
            <input type="hidden" name="payment_type" value="paypal">

                <!-- <p class="mt-4 text-gray-800 font-medium">Payment information</p>
                <div class="">
                    <label class="block text-sm text-gray-600" for="cus_name">Card</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_name" name="cus_name" type="text" required="" placeholder="Card Number MM/YY CVC" aria-label="Name">
                </div> -->
            <div class="flex justify-start mt-4">
                <div class="mr-5">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-900 rounded" type="submit">${{ \Cart::getTotal() }} | Paypal</button>
                </div>
                <script
                    src="https://checkout.stripe.com/checkout.js"
                    class="stripe-button"
                    data-key="{{ config('settings.stripe_key') }}"
                    data-name="Pay with Credit Card"
                    data-description="Click and Collect"
                    data-amount="{{ \Cart::getTotal()*100 }}"
                    data-currency="{{ config('settings.currency_code') }}">
                </script>
            </div>
        </form>
    </div>
</x-app-layout>