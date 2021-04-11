<x-app-layout>
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
            @if (Session::has('message'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-5 rounded relative" role="alert">
                  <span class="block sm:inline">{{ Session::get('message') }}</span>
              </div>
            @endif
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="https://via.placeholder.com/176">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                @csrf
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">PRODUCT NAME</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                    <p class="leading-relaxed">{{ $product->description }}</p>
                    <div class="flex py-2 items-center">
                        <span class="mr-3">Quantity</span>
                        <div class="relative">
                        <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                        <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6"></path>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <div class="flex">
                    <span class="title-font font-medium text-2xl text-gray-900">${{ $product->sale_price }}</span>
                    <button class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Add To Cart</button>
                    <!-- <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                        </svg>
                    </button> -->
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
</x-app-layout>