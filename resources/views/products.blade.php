<x-app-layout>
    <div class="flex justify-center mt-8 grid grid-flow-col auto-cols-max gap-10">
        @forelse($products as $product)
            <div>
                <figure class="card card-product">
                    @if ($product->images->count() > 0)
                        <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$product->images->first()->full) }}" alt=""></div>
                    @else
                        <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                    @endif
                    <figcaption class="info-wrap">
                        <h4 class="title text-center"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                    </figcaption>
                    <div class="">
                        @if ($product->sale_price != 0)
                        <div class="flex justify-center font-bold text-green-500">
                            <!-- <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del> -->
                            $<span class="text-xl">{{ config('settings.currency_symbol').$product->sale_price }} </span>
                        </div>
                        @else
                        <div class="price-wrap text-center text-green-500">
                            <span class=""> ${{ config('settings.currency_symbol').$product->price }} </span>
                        </div>
                        @endif
                        <div class="flex justify-center">
                            <a href="{{ route('product.show', $product->slug) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buy Now</a>
                            <!-- <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-shopping-cart"></i> Add To Cart</button> -->
                        </div>
                    </div>
                </figure>
            </div>
        @empty
            <p>No Products found in.</p>
        @endforelse
    </div>
</x-app-layout>
